<?php
require __DIR__ . '/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

require_once __DIR__ . '/function.php';

if (!isset($_GET['ncvs']) || $_GET['ncvs'] === "") {
    die("NCVS tidak boleh kosong.");
}

$NCVS = mysqli_real_escape_string($conn, $_GET['ncvs']);

// === TENTUKAN PROD DARI DIGIT PERTAMA NCVS ===
$firstDigit = substr($NCVS, 0, 1);
if ($firstDigit == "1") {
    $PROD = "Production 1";
} elseif ($firstDigit == "2") {
    $PROD = "Production 2";
} else {
    $PROD = "Production ?";
}

// === AMBIL LIST AREA UNIK ===
$areaQuery = mysqli_query($conn, "
    SELECT DISTINCT area 
    FROM tbl_transac
    WHERE status_transac='For_Validation'
      AND ncvs='$NCVS'
    ORDER BY area ASC
");

$areas = [];
while ($ar = $areaQuery->fetch_assoc()) {
    $areas[] = $ar['area'];
}

// === TEMPLATE HEADER PER HALAMAN ===
function headerTemplate($AREA, $NCVS, $PROD) {
    return "
        <style>
            body { font-family: Arial, sans-serif; font-size: 11px; }
            table { width:100%; border-collapse: collapse; }
            th, td { border:1px solid #000; padding:5px; font-size:10px; }
            th { background:#eee; }
            .title { text-align:center; font-size:20px; font-weight:bold; margin-bottom:0; }
            .subtitle { text-align:center; font-size:12px; margin-top:0; }
            .info-table td { border:1px solid #000; padding:4px; font-size:11px; }
            .bar { height:3px; background:black; margin:5px 0; }
        </style>

        <div class='title'>STOCK OPNAME PRODUCTION</div>
        <div class='subtitle'>" . date('d F Y') . "</div>
        <div class='bar'></div>

        <table class='info-table'>
            <tr>
                <td width='35%'><b>PROD</b> : $PROD</td>
                <td width='30%' rowspan='3'><b>PIC :</b><br><br><br>TTD</td>
                <td width='35%' rowspan='3'><b>AUDITOR :</b><br><br><br>TTD</td>
            </tr>
            <tr><td><b>AREA</b> : $AREA</td></tr>
            <tr><td><b>NCVS</b> : $NCVS</td></tr>
        </table>

        <br>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>STYLE</th>
                    <th>SIZE</th>
                    <th>QTY</th>
                    <th>ORACLE CODE</th>
                    <th>MATERIAL SET</th>
                    <th>KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
    ";
}

// === MULAI BANGUN PDF HTML ===
$html = "";

foreach ($areas as $AREA_NAME) {

    // Tambahkan header untuk halaman ini
    $html .= headerTemplate($AREA_NAME, $NCVS, $PROD);

    // Ambil data untuk area ini
    $rows = mysqli_query($conn, "
        SELECT ncvs, area, style_name, category, status_set, size, qty
        FROM tbl_transac
        WHERE status_transac='For_Validation'
          AND ncvs='$NCVS'
          AND area='$AREA_NAME'
        ORDER BY last_update DESC
    ");

    $no = 1;
    $totalArea = 0;

    while ($r = $rows->fetch_assoc()) {
        $oracle = "{$r['category']}.{$r['style_name']}.{$r['size']}";

        $html .= "
            <tr>
                <td style='text-align:center;'>$no</td>
                <td>{$r['style_name']}</td>
                <td>{$r['size']}</td>
                <td style='text-align:center;'>{$r['qty']}</td>
                <td>$oracle</td>
                <td>{$r['status_set']}</td>
                <td>{$r['area']}</td>
            </tr>
        ";

        $totalArea += $r['qty'];
        $no++;
    }

    // Tambahkan TOTAL
    $html .= "
        <tr>
            <td colspan='3' style='text-align:right;'><b>TOTAL</b></td>
            <td style='text-align:center;'><b>$totalArea</b></td>
            <td colspan='3'></td>
        </tr>
    ";

    // Tutup table
    $html .= "</tbody></table>";

    // Tambahkan PAGE BREAK jika masih ada area berikutnya
    $html .= "<div style='page-break-after: always;'></div>";
}

// === RENDER DOMPDF ===
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// download
$dompdf->stream("stock_opname_Final_$NCVS.pdf", ["Attachment" => false]);

?>

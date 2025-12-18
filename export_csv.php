<?php
require_once __DIR__ . '/function.php';

if (!isset($_GET['ncvs']) || $_GET['ncvs'] === "") {
    die("Parameter NCVS tidak ada.");
}

$NCVS = mysqli_real_escape_string($conn, $_GET['ncvs']);

$sql = "
    SELECT ncvs, area, style_name, size, qty, category, status_set
    FROM tbl_transac
    WHERE status_transac='For_Validation'
      AND ncvs='$NCVS'
    ORDER BY area ASC, style_name ASC, size ASC
";

$query = mysqli_query($conn, $sql);

if (!$query) {
    die("ERROR QUERY: " . mysqli_error($conn));
}

if (mysqli_num_rows($query) == 0) {
    die("DATA TIDAK DITEMUKAN UNTUK NCVS = $NCVS");
}

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=stock_opname_$NCVS.csv");
header("Pragma: no-cache");
header("Expires: 0");

$output = fopen('php://output', 'w');

fputcsv($output, [
    'NCVS', 'STYLE', 'SIZE', 'QTY', 'ORACLE CODE', 'MATERIAL SET', 'AREA'
]);

while ($row = mysqli_fetch_assoc($query)) {

    $oracle = "{$row['category']}";

    fputcsv($output, [
        $row['ncvs'],
        $row['style_name'],
        $row['size'],
        $row['qty'],
        $oracle,
        $row['status_set'],
        $row['area']
    ]);
}

fclose($output);
exit;

<?php
session_start(); // ready to go!

//Koneksi ke DBMS
$conn = mysqli_connect("localhost", "root", "", "db_stockopname");
date_default_timezone_set('Asia/Jakarta');

// REGISTER USERS
if (isset($_POST['submit-user'])) {
    date_default_timezone_set('Asia/Jakarta');

    // Ambil dan filter data
    $updated_by = mysqli_real_escape_string($conn, $_POST['updated_by']);
    $username   = mysqli_real_escape_string($conn, $_POST['username']);
    $nik_user   = mysqli_real_escape_string($conn, $_POST['nik_user']);
    $authorize  = mysqli_real_escape_string($conn, $_POST['authorize']);
    $name_ncvs  = mysqli_real_escape_string($conn, $_POST['name_ncvs']);
    $password   = mysqli_real_escape_string($conn, $_POST['password']);
    $last_update  = date('Y-m-d H:i:s');

    // Cek apakah NIK sudah ada
    $check_nik = mysqli_query($conn, "SELECT 1 FROM tbl_user WHERE nik_user = '$nik_user'");
    if (mysqli_num_rows($check_nik) > 0) {
        $_SESSION['red_notif'] = "NIK sudah terdaftar, mohon gunakan NIK lain.";
        header("Location: /stockopname/input-data-user.php");
        exit();
    }

    // Simpan ke tbl_user
    $query_user = mysqli_query($conn, "INSERT INTO tbl_user 
        (username, nik_user, password, authorize, name_ncvs, updated_by, `last_update`) 
        VALUES 
        ('$username', '$nik_user', '$password', '$authorize', '$name_ncvs', '$updated_by', '$last_update')
    ");

    if ($query_user) {
        $_SESSION['green_notif'] = "User berhasil didaftarkan.";
    } else {
        $_SESSION['red_notif'] = "User tidak berhasil didaftarkan.";
    }

    header("Location: /stockopname/input-data-user.php");
    exit();
}

// SUBMIT STYLE
if (isset($_POST['submit-style'])) {
    date_default_timezone_set('Asia/Jakarta');

    // Ambil dan filter data
    $updated_by = mysqli_real_escape_string($conn, $_POST['updated_by']);
    $name_style   = mysqli_real_escape_string($conn, $_POST['name_style']);
    $last_update  = date('Y-m-d H:i:s');

    // Cek apakah Style sudah ada
    $check_style = mysqli_query($conn, "SELECT 1 FROM tbl_master_style WHERE name_style = '$name_style'");
    if (mysqli_num_rows($check_style) > 0) {
        $_SESSION['red_notif'] = "Style sudah terdaftar, mohon gunakan Style lain.";
        header("Location: /stockopname/input-style.php");
        exit();
    }

    // Simpan ke tbl_master_style
    $query_user = mysqli_query($conn, "INSERT INTO tbl_master_style 
        (name_style, updated_by, `last_update`) 
        VALUES 
        ('$name_style', '$updated_by', '$last_update')
    ");

    if ($query_user) {
        $_SESSION['green_notif'] = "Style berhasil didaftarkan.";
    } else {
        $_SESSION['red_notif'] = "Style tidak berhasil didaftarkan.";
    }

    header("Location: /stockopname/input-style.php");
    exit();
}

// SUBMIT SET
if (isset($_POST['Set-submit'])) {

    date_default_timezone_set('Asia/Jakarta');

    $updated_by       = mysqli_real_escape_string($conn, $_POST['updated_by']); // simpan ke "updated_by"
    $ncvs           = mysqli_real_escape_string($conn, $_POST['ncvs']);
    $style_name     = mysqli_real_escape_string($conn, $_POST['style_name']);
    $area           = mysqli_real_escape_string($conn, $_POST['area']);
    $category       = "SA.UPR";
    $status_set     = mysqli_real_escape_string($conn, $_POST['status_set']);
    $status_transac = mysqli_real_escape_string($conn, $_POST['status_transac']);
    $last_update    = date('Y-m-d H:i:s');

    $sizes = $_POST['size'];

    // VALIDASI WAJIB
    if (empty($area) || empty($style_name)) {
        $_SESSION['red_notif'] = "Area dan Style wajib dipilih!";
        header("Location: input-set.php");
        exit();
    }

    $adaData = false;

    foreach ($sizes as $size_code => $qty) {

        $qty = trim($qty);

        if ($qty !== "" && is_numeric($qty) && $qty > 0) {

            $adaData = true;

            $size_code = mysqli_real_escape_string($conn, $size_code);
            $qty       = mysqli_real_escape_string($conn, $qty);

            $insert = mysqli_query($conn, "
                INSERT INTO tbl_transac
                (ncvs, style_name, category, status_set, size, qty, area, updated_by, status_transac, last_update)
                VALUES
                ('$ncvs', '$style_name', '$category', '$status_set', '$size_code', '$qty', '$area', '$updated_by', '$status_transac', '$last_update')
            ");

            if (!$insert) {
                echo "Error SQL: " . mysqli_error($conn);
                exit();
            }
        }
    }

    // NOTIF
    $_SESSION['green_notif'] = 
        $adaData ? "Data berhasil disimpan." : "Tidak ada qty yang diinput.";

    header("Location: input-set.php");
    exit();
}

// Update data SET
if (isset($_POST['update-set'])) {

    // Ambil data wajib
    $id_transac = $_POST['id_transac'];
    $style_name = $_POST['style_name'];
    $size       = $_POST['size'];
    $area       = $_POST['area'];
    $qty        = $_POST['qty'];
    $updated_by = $_SESSION['username'] ?? 'system';

    // Validasi ID
    if (empty($id_transac)) {
        $_SESSION['green_notif'] = "Data gagal diperbarui.";
        header("Location: input-non-set.php");
        exit();
    }

    // Query UPDATE (hanya field yang boleh diedit)
    $query = "
        UPDATE tbl_transac
        SET
            style_name   = ?,
            size         = ?,
            area         = ?,
            qty          = ?,
            updated_by   = ?,
            last_update  = CURRENT_TIMESTAMP
        WHERE id_transac = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "sssssi",
        $style_name,
        $size,
        $area,
        $qty,
        $updated_by,
        $id_transac
    );

    $adaData = $stmt->execute();

    // NOTIF (SESUAI REQUEST KAMU)
    $_SESSION['green_notif'] = 
        $adaData ? "Data berhasil disimpan." : "Tidak ada qty yang diinput.";

    $stmt->close();
    $conn->close();

    header("Location: input-set.php");
    exit();
}

// Delete Data Set
if (isset($_POST['delete-set'])) {

    $id_transac = $_POST['id_transac'];

    if (empty($id_transac)) {
        $_SESSION['green_notif'] = "Data gagal dihapus.";
        header("Location: input-set.php");
        exit();
    }

    $query = "DELETE FROM tbl_transac WHERE id_transac = ?";
    $stmt  = $conn->prepare($query);
    $stmt->bind_param("i", $id_transac);

    $adaData = $stmt->execute();

    // NOTIFIKASI (SESUAI POLA KAMU)
    $_SESSION['green_notif'] = 
        $adaData ? "Data berhasil dihapus." : "Data gagal dihapus.";

    $stmt->close();
    $conn->close();

    header("Location: input-set.php");
    exit();
}



// SUBMIT NON-SET
if (isset($_POST['NonSet-submit'])) {

    date_default_timezone_set('Asia/Jakarta');

    $updated_by     = mysqli_real_escape_string($conn, $_POST['updated_by']); // simpan ke "updated_by"
    $ncvs           = mysqli_real_escape_string($conn, $_POST['ncvs']);
    $style_name     = mysqli_real_escape_string($conn, $_POST['style_name']);
    $area           = mysqli_real_escape_string($conn, $_POST['area']);
    $category       = mysqli_real_escape_string($conn, $_POST['category']);
    $status_set     = mysqli_real_escape_string($conn, $_POST['status_set']);
    $status_transac = mysqli_real_escape_string($conn, $_POST['status_transac']);
    $last_update    = date('Y-m-d H:i:s');

    $sizes = $_POST['size'];

    // VALIDASI WAJIB
    if (empty($area) || empty($style_name) || empty($category)) {
        $_SESSION['red_notif'] = "Area, Style & Kategori wajib dipilih!";
        header("Location: input-non-set.php");
        exit();
    }

    $adaData = false;

    foreach ($sizes as $size_code => $qty) {

        $qty = trim($qty);

        if ($qty !== "" && is_numeric($qty) && $qty > 0) {

            $adaData = true;

            $size_code = mysqli_real_escape_string($conn, $size_code);
            $qty       = mysqli_real_escape_string($conn, $qty);

            $insert = mysqli_query($conn, "
                INSERT INTO tbl_transac
                (ncvs, style_name, category, status_set, size, qty, area, updated_by, status_transac, last_update)
                VALUES
                ('$ncvs', '$style_name', '$category', '$status_set', '$size_code', '$qty', '$area', '$updated_by', '$status_transac', '$last_update')
            ");

            if (!$insert) {
                echo "Error SQL: " . mysqli_error($conn);
                exit();
            }
        }
    }

    // NOTIF
    $_SESSION['green_notif'] = 
        $adaData ? "Data berhasil disimpan." : "Tidak ada qty yang diinput.";

    header("Location: input-non-set.php");
    exit();
}

// Update data NON-SET
if (isset($_POST['update-nonset'])) {

    // Ambil data wajib
    $id_transac = $_POST['id_transac'];
    $style_name = $_POST['style_name'];
    $category   = $_POST['category'];
    $size       = $_POST['size'];
    $area       = $_POST['area'];
    $qty        = $_POST['qty'];
    $updated_by = $_SESSION['username'] ?? 'system';

    // Validasi ID
    if (empty($id_transac)) {
        $_SESSION['green_notif'] = "Data gagal diperbarui.";
        header("Location: input-non-set.php");
        exit();
    }

    // Query UPDATE (hanya field yang boleh diedit)
    $query = "
        UPDATE tbl_transac
        SET
            style_name   = ?,
            category     = ?,
            size         = ?,
            area         = ?,
            qty          = ?,
            updated_by   = ?,
            last_update  = CURRENT_TIMESTAMP
        WHERE id_transac = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "ssssssi",
        $style_name,
        $category,
        $size,
        $area,
        $qty,
        $updated_by,
        $id_transac
    );

    $adaData = $stmt->execute();

    // NOTIF (SESUAI REQUEST KAMU)
    $_SESSION['green_notif'] = 
        $adaData ? "Data berhasil disimpan." : "Tidak ada qty yang diinput.";

    $stmt->close();
    $conn->close();

    header("Location: input-non-set.php");
    exit();
}

// Delete Data NON Set
if (isset($_POST['delete-nonset'])) {

    $id_transac = $_POST['id_transac'];

    if (empty($id_transac)) {
        $_SESSION['green_notif'] = "Data gagal dihapus.";
        header("Location: input-non-set.php");
        exit();
    }

    $query = "DELETE FROM tbl_transac WHERE id_transac = ?";
    $stmt  = $conn->prepare($query);
    $stmt->bind_param("i", $id_transac);

    $adaData = $stmt->execute();

    // NOTIFIKASI (SESUAI POLA KAMU)
    $_SESSION['green_notif'] = 
        $adaData ? "Data berhasil dihapus." : "Data gagal dihapus.";

    $stmt->close();
    $conn->close();

    header("Location: input-non-set.php");
    exit();
}

// UPLOAD Master STYLE
if (isset($_POST['upload-data-style'])) {

    // pastikan autoload tersedia (jika belum di-include di file ini)
    if (file_exists(__DIR__ . '/vendor/autoload.php')) {
        require_once __DIR__ . '/vendor/autoload.php';
    }

    if (!isset($_FILES['file_csv']) || $_FILES['file_csv']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['red_notif'] = "Gagal upload file.";
        header("Location: input-style.php");
        exit;
    }

    $updated_by = mysqli_real_escape_string($conn, $_POST['updated_by']);
    $fileTmp    = $_FILES['file_csv']['tmp_name'];
    $fileName   = $_FILES['file_csv']['name'];

    if (!file_exists($fileTmp)) {
        $_SESSION['red_notif'] = "File tidak ditemukan.";
        header("Location: input-style.php");
        exit;
    }

    // detect extension
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $fileRows = [];

    if ($ext === "csv") {
        // CSV
        if (($fh = fopen($fileTmp, 'r')) === false) {
            $_SESSION['red_notif'] = "Gagal membuka CSV.";
            header("Location: input-style.php");
            exit;
        }
        // optional: apakah ada header? skip satu baris
        $maybeHeader = fgetcsv($fh);
        // if header looks like header (non-numeric etc) we keep skipping — for simplicity we already skip first row
        while (($row = fgetcsv($fh)) !== false) {
            $style = trim($row[0] ?? "");
            if ($style !== "") {
                $style = preg_replace('/^\xEF\xBB\xBF/', '', $style);
                $fileRows[] = $style;
            }
        }
        fclose($fh);

    } elseif ($ext === "xlsx" || $ext === "xls") {
        // Excel: use fully-qualified class name (no "use" inside block)
        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileTmp);
        } catch (\Throwable $e) {
            $_SESSION['red_notif'] = "Gagal membaca file Excel: " . $e->getMessage();
            header("Location: input-style.php");
            exit;
        }

        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true); // returns indexed array
        // If first row is header, skip it
        $skipHeader = true;
        foreach ($rows as $idx => $row) {
            if ($skipHeader) { $skipHeader = false; continue; }
            // For spreadsheets using numeric indexes, access A column:
            $style = "";
            if (is_array($row)) {
                // try column A or first element
                if (isset($row['A'])) $style = trim($row['A']);
                else {
                    // fallback: get first element value
                    $vals = array_values($row);
                    $style = trim($vals[0] ?? "");
                }
            }
            if ($style !== "") {
                $style = preg_replace('/^\xEF\xBB\xBF/', '', $style);
                $fileRows[] = $style;
            }
        }

    } else {
        $_SESSION['red_notif'] = "Format tidak didukung. Gunakan CSV / XLS / XLSX.";
        header("Location: input-style.php");
        exit;
    }

    // dedupe within file
    $seen = [];
    $uniqueRows = [];
    $fileDup = 0;
    foreach ($fileRows as $style) {
        $style = trim($style);
        if ($style === "") continue;
        if (isset($seen[$style])) { $fileDup++; continue; }
        $seen[$style] = 1;
        $uniqueRows[] = $style;
    }

    // prepared statements
    $checkSql = "SELECT id_master_style FROM tbl_master_style WHERE name_style = ?";
    $checkStmt = mysqli_prepare($conn, $checkSql);
    if (!$checkStmt) {
        $_SESSION['red_notif'] = "DB prepare error: " . mysqli_error($conn);
        header("Location: input-style.php");
        exit;
    }
    $insertSql = "INSERT INTO tbl_master_style (name_style, updated_by) VALUES (?, ?)";
    $insertStmt = mysqli_prepare($conn, $insertSql);
    if (!$insertStmt) {
        $_SESSION['red_notif'] = "DB prepare error: " . mysqli_error($conn);
        header("Location: input-style.php");
        exit;
    }

    $inserted = 0;
    $dbDup = 0;

    foreach ($uniqueRows as $style) {
        mysqli_stmt_bind_param($checkStmt, "s", $style);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            $dbDup++;
            continue;
        }

        mysqli_stmt_bind_param($insertStmt, "ss", $style, $updated_by);
        mysqli_stmt_execute($insertStmt);
        $inserted++;
    }

    // set notification
    if ($inserted > 0) {
        $_SESSION['green_notif'] =
            "Upload selesai.<br>Baru masuk: <b>$inserted</b><br>Duplikat dalam file: <b>$fileDup</b><br>Sudah ada di database: <b>$dbDup</b>";
    } else {
        $_SESSION['red_notif'] =
            "Tidak ada data baru.<br>Duplikat dalam file: <b>$fileDup</b><br>Sudah ada di database: <b>$dbDup</b>";
    }

    header("Location: input-style.php");
    exit;
}



// ==========================================
//  UPLOAD FINAL SO CSV
// ==========================================
if (isset($_POST['upload-final-data'])) {

    // ================================
    // VALIDASI FILE
    // ================================
    if (!isset($_FILES['file_csv']) || $_FILES['file_csv']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['red_notif'] = "Gagal upload file.";
        header("Location: input-final-data.php");
        exit;
    }

    $updated_by     = mysqli_real_escape_string($conn, $_POST['updated_by']);
    $status_transac = mysqli_real_escape_string($conn, $_POST['status_transac']);

    $filename = $_FILES['file_csv']['tmp_name'];
    if (!file_exists($filename)) {
        $_SESSION['red_notif'] = "File tidak ditemukan.";
        header("Location: input-final-data.php");
        exit;
    }

    // ================================
    // BACA CSV
    // ================================
    $file = fopen($filename, "r");

    // Lewati header
    fgetcsv($file);

    $seen     = []; // deteksi duplikat dalam file
    $fileRows = [];
    $fileDup  = 0;
    $fileOk   = 0;

    while (($row = fgetcsv($file)) !== false) {

        // Pastikan minimal 7 kolom
        $row = array_pad($row, 7, "");

        // Hilangkan BOM
        $row[0] = preg_replace('/^\xEF\xBB\xBF/', '', $row[0]);

        // TRIM semua data
        $ncvs     = trim($row[0]);
        $style    = trim($row[1]);
        $size     = trim($row[2]);
        $qty      = trim($row[3]); // QTY STRING
        $category = trim($row[4]); // CATEGORY langsung pakai file
        $material = trim($row[5]);
        $area     = trim($row[6]);

        // Skip full blank row
        if ($ncvs === "" && $style === "" && $size === "") continue;

        // KEY unik untuk deteksi duplikat dalam file
        $key = "$ncvs|$style|$size|$category|$material|$area|$qty";

        if (isset($seen[$key])) {
            $fileDup++;
            continue;
        }

        $seen[$key] = 1;

        $fileRows[] = [
            $ncvs, $style, $size, $qty, $category, $material, $area
        ];

        $fileOk++;
    }

    fclose($file);

    // ================================
    // PREPARED STATEMENTS
    // ================================
    $checkSql = "
        SELECT id_transac FROM tbl_transac
        WHERE ncvs=? AND style_name=? AND size=? 
          AND category=? AND status_set=? AND area=? 
          AND qty=? AND status_transac=?
    ";
    $checkStmt = mysqli_prepare($conn, $checkSql);

    $insertSql = "
        INSERT INTO tbl_transac
        (ncvs, style_name, size, qty, category, status_set, area, updated_by, status_transac)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $insertStmt = mysqli_prepare($conn, $insertSql);

    $inserted = 0;
    $dbDup    = 0;

    // ================================
    // PROSES DATA
    // ================================
    foreach ($fileRows as $r) {

        list($ncvs, $style, $size, $qty, $category, $material, $area) = $r;

        // === CEK APAKAH SUDAH ADA DI DATABASE ===
        mysqli_stmt_bind_param(
            $checkStmt,
            "ssssssss", // semua string
            $ncvs, $style, $size, $category, $material, $area, $qty, $status_transac
        );
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            $dbDup++;
            continue;
        }

        // === INSERT DATA BARU ===
        mysqli_stmt_bind_param(
            $insertStmt,
            "sssssssss", // semua string!
            $ncvs, $style, $size, $qty,
            $category, $material, $area,
            $updated_by, $status_transac
        );
        mysqli_stmt_execute($insertStmt);

        $inserted++;
    }

    // ================================
    // NOTIF
    // ================================
    if ($inserted > 0) {
        $_SESSION['green_notif'] =
        "Upload selesai.<br>
         Data baru masuk: <b>$inserted</b><br>
         Duplikat dalam file: <b>$fileDup</b><br>
         Duplikat database: <b>$dbDup</b>";
    } else {
        $_SESSION['red_notif'] =
        "Tidak ada data baru yang masuk.<br>
         Duplikat dalam file: <b>$fileDup</b><br>
         Duplikat database: <b>$dbDup</b>";
    }

    header("Location: input-final-data.php");
    exit;
}










?>

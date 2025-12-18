<?php
// menghubungkan php dengan koneksi database
require_once __DIR__ . '/function.php';

function checkAuth() {
    // Cek apakah sudah login
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        header("Location: login.php"); // 401
        exit;
    }

    return true;
}
?>
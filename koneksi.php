<?php
// ============================
// KONEKSI KE DATABASE MYSQL
// ============================

$host = "localhost";       // biasanya localhost
$user = "root";            // user MySQL, default XAMPP: root
$pass = "";                // password, default XAMPP kosong
$db   = "smartnotify_db";  // nama database yang kamu buat

// Buat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("⚠️ Koneksi database gagal: " . mysqli_connect_error());
}

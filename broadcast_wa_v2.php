<?php
// Tampilkan semua error untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php";

// Token Fonnte
$token = "F2b46XQ7yKXj39giPyAq"; // ganti sesuai token aktif kamu

// Ambil input dari form
$pesan = isset($_POST['pesan']) ? $_POST['pesan'] : '';
$kontak_input = isset($_POST['kontak']) ? $_POST['kontak'] : ''; // contoh: "1,2,3"

if(empty($pesan) || empty($kontak_input)){
    die("⚠️ Pesan atau kontak belum diisi!");
}

$kontak_array = explode(",", $kontak_input);

foreach($kontak_array as $id){
    $id = trim($id);

    // Ambil nomor dari database
    $q = mysqli_query($koneksi, "SELECT nomor_hp FROM kontak WHERE id='$id'");
    if(!$q){
        echo "⚠️ Query gagal untuk ID $id: " . mysqli_error($koneksi) . "<br>";
        continue;
    }

    if(mysqli_num_rows($q) == 0){
        echo "⚠️ ID kontak $id tidak ditemukan di database.<br>";
        continue;
    }

    $row = mysqli_fetch_assoc($q);
    $nomor = $row['nomor_hp'];

    // Persiapkan data untuk API Fonnte
    $data = [
        'target' => $nomor,
        'message' => $pesan
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.fonnte.com/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => ["Authorization: $token"],
    ]);

    $response = curl_exec($curl);

    if(curl_errno($curl)){
        echo "⚠️ CURL error untuk nomor $nomor: " . curl_error($curl) . "<br>";
    } else {
        // Tampilkan response lengkap dari Fonnte
        echo "Nomor: $nomor<br>Response: $response<br><br>";
    }

    curl_close($curl);
}

echo "<br>✅ Script selesai dijalankan!";

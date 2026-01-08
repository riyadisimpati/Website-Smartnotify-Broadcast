<?php
include "koneksi.php";

$token = "F2b46XQ7yKXj39giPyAq";

$pesan = $_POST['pesan'];
$kontak_input = $_POST['kontak']; // "1,2,3"
$kontak_array = explode(",", $kontak_input);

foreach($kontak_array as $id){
    $id = trim($id);
    $q = mysqli_query($koneksi, "SELECT nomor_hp FROM kontak WHERE id='$id'");
    $row = mysqli_fetch_assoc($q);
    $nomor = $row['nomor_hp'];

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
    curl_close($curl);

    echo "Pesan dikirim ke: $nomor<br>";
}

echo "✅ Semua pesan berhasil dikirim!";

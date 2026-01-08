<?php
include "koneksi.php";

$token = "TOKEN_KAMU_DI_SINI";

// Ambil semua kontak dari database
$queryKontak = mysqli_query($koneksi, "SELECT nomor_hp FROM kontak");

$pesan = "ðŸ”” SmartNotify TEST\nPesan berhasil dikirim!";

while($kontak = mysqli_fetch_assoc($queryKontak)){
    $nomor = $kontak['nomor_hp'];

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

    echo "Pesan dikirim ke: $nomor\n";
    sleep(1); // agar aman dari limit
}

echo "âœ… Semua pesan berhasil dikirim!";



<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "CRON BERJALAN<br>";   // ⬅️ TARUH DI SINI


include "koneksi.php";

$token = "F2b46XQ7yKXj39giPyAq";

// waktu sekarang
$hari_sekarang = date('l');
$jam_sekarang  = date('H:i');

// ambil jadwal cocok
$q = mysqli_query($koneksi,
    "SELECT * FROM jadwal_matkul
     WHERE hari='$hari_sekarang'
     AND jam='$jam_sekarang'
     AND status=0"
);

while($row = mysqli_fetch_assoc($q)){
    $pesan = $row['pesan'];

    // ambil semua kontak
    $kontak = mysqli_query($koneksi,"SELECT nomor_hp FROM kontak");

    while($k = mysqli_fetch_assoc($kontak)){
        $data = [
            'target' => $k['nomor_hp'],
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
        curl_exec($curl);
        curl_close($curl);
    }

    // tandai sudah dikirim
    mysqli_query($koneksi,
        "UPDATE jadwal_matkul SET status=1 WHERE id=".$row['id']
    );
}

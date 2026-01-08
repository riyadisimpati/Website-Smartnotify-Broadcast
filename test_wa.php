<?php
// ==============================
// TEST WHATSAPP SMARTNOTIFY
// ==============================

// GANTI DENGAN TOKEN KAMU
$token = "F2b46XQ7yKXj39giPyAq";

// NOMOR TUJUAN (PAKAI NOMOR SENDIRI DULU)
$nomor = "6281223140348"; // contoh: 6281234567890

$pesan = "🔔 SmartNotify TEST\n\nPesan WhatsApp berhasil dikirim!\n\nJika pesan ini masuk, berarti sistem WA kamu SUKSES ✅";

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
    CURLOPT_HTTPHEADER => [
        "Authorization: $token"
    ],
]);

$response = curl_exec($curl);
curl_close($curl);

echo $response;

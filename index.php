<?php
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SmartNotify Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>SmartNotify Dashboard</header>

<div class="container">
    <h2>Kirim Pesan WhatsApp</h2>
    <form action="broadcast_wa_v2.php" method="POST">
        <label for="pesan">Tulis Pesan:</label>
        <textarea name="pesan" id="pesan" rows="5" placeholder="Masukkan pesan di sini..." required></textarea>

        <label for="kontak">Pilih Kontak (ID, pisahkan koma):</label>
        <input type="text" name="kontak" placeholder="1,2,3" required>

        <button type="submit">Kirim Pesan</button>
    </form>
</div>
</body>
</html>
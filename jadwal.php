<?php
include "koneksi.php";

if(isset($_POST['simpan'])){
    $matkul = $_POST['matkul'];
    $hari   = $_POST['hari'];
    $jam    = $_POST['jam'];
    $pesan  = $_POST['pesan'];

    mysqli_query($koneksi,
        "INSERT INTO jadwal_matkul (matkul,hari,jam,pesan)
         VALUES ('$matkul','$hari','$jam','$pesan')"
    );

    echo "✅ Jadwal berhasil disimpan";
}
?>

<h2>Tambah Jadwal Matkul</h2>
<form method="post">
    Mata Kuliah:<br>
    <input type="text" name="matkul" required><br><br>

    Hari:<br>
    <select name="hari">
        <option>Monday</option>
        <option>Tuesday</option>
        <option>Wednesday</option>
        <option>Thursday</option>
        <option>Friday</option>
        <option>Saturday</option>
    </select><br><br>

    Jam:<br>
    <input type="time" name="jam" required><br><br>

    Pesan WA:<br>
    <textarea name="pesan" required></textarea><br><br>

    <button name="simpan">Simpan Jadwal</button>
</form>

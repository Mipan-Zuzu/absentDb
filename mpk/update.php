<?php
include "../koneksi.php";

// Cek apakah ada ID absensi di URL
if (!isset($_GET['id'])) {
    header("Location: absen.php?page=absensi");
    exit;
}

$id = $_GET['id'];

// Ambil data absensi berdasarkan ID
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_absensi=$id"));

// Proses update data
if (isset($_POST['update'])) {
  $id_siswa = $_POST['id_siswa'];
    $tgl_absensi = $_POST['tgl_absensi'];
    $keterangan    = $_POST['keterangan'];

    mysqli_query($koneksi, "UPDATE absensi SET 
        id_siswa='$id_siswa',
        tgl_absensi='$tgl_absensi',
        keterangan='$keterangan'
        WHERE id_absensi=$id");

    header("Location: absen.php?page=absensi&pesan=edit");
    exit;
}
?>
<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM absensi WHERE id_absensi=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?page=absensi&pesan=hapus");
    exit;
} else {
    header("Location: index.php?page=absensi");
    exit;
}

?>
<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM pegawai WHERE id_pegawai=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?page=pegawai&pesan=hapus");
    exit;
} else {
    header("Location: index.php?page=pegawai");
    exit;
}

?>
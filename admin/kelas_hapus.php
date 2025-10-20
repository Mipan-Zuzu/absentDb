<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM kelas WHERE id_kelas=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?page=kelas&pesan=hapus");
    exit;
} else {
    header("Location: index.php?page=kelas");
    exit;
}
?>
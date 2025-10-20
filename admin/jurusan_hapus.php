<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM jurusan WHERE id_jurusan=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?page=jurusan&pesan=hapus");
    exit;
} else {
    header("Location: index.php?page=jurusan");
    exit;
}
?>
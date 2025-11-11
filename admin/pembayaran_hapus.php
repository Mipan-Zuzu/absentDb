<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM pembayaran WHERE id_pembayaran=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?page=pembayaran&pesan=hapus");
    exit;
} else {
    header("Location: index.php?page=pembayaran");
    exit;
}

?>
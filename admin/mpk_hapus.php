<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM mpk WHERE id_mpk=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?page=mpk&pesan=hapus");
    exit;
} else {
    header("Location: index.php?page=mpk");
    exit;
}

?>
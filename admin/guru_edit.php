<?php
include "../koneksi.php";
if (!isset($_GET['id'])) {
    header("Location: index.php?page=guru");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM guru WHERE id_guru=$id"));

if (isset($_POST['update'])) {
    $nama_guru = $_POST['nama_guru'];
    $tgl_lahir    = $_POST['tgl_lahir'];
    $alamat    = $_POST['alamat'];
    $telp    = $_POST['telp'];
    $username    = $_POST['username'];
    $password    = $_POST['password'];

    mysqli_query($koneksi, "UPDATE guru SET nama_guru='$nama_guru', tgl_lahir='$tgl_lahir', alamat = '$alamat', telp = '$telp', username = '$username', password = '$password'  WHERE id_guru=$id");
    header("Location: index.php?page=guru&pesan=edit");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Edit Guru</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">nama guru</label>
            <input type="text" name="nama_guru" class="form-control" value="<?= $data['nama_guru'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">tgl_lahir</label>
            <input type="text" name="tgl_lahir" maxlength="5" class="form-control" value="<?= $data['tgl_lahir'] ?>" required>
        </div>
            <div class="mb-3">
            <label class="form-label">alamat</label>
            <input type="text" name="alamat" maxlength="5" class="form-control" value="<?= $data['alamat'] ?>" required>
        </div>
            <div class="mb-3">
            <label class="form-label">alamat</label>
            <input type="text" name="alamat" maxlength="5" class="form-control" value="<?= $data['alamat'] ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index.php?page=guru" class="btn btn-secondary">Kembali</a>
    </form>
</div>

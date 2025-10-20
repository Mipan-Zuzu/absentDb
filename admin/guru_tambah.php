<?php
include "../koneksi.php";
if (isset($_POST['simpan'])) {
    $nama_guru = $_POST['nama_guru'];
    $tgl_lahir    = $_POST['tgl_lahir'];
    $alamat    = $_POST['alamat'];
    $telp    = $_POST['telp'];
    $username    = $_POST['username'];
    $password    = md5($_POST['password']);

    mysqli_query($koneksi, "INSERT INTO guru (nama_guru, tgl_lahir, alamat, telp, username, password ) VALUES ('$nama_guru','$tgl_lahir', '$alamat','$telp','$username','$password')");
    header("Location: index.php?page=guru&pesan=tambah");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Tambah Guru</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama Guru</label>
            <input type="text" name="nama_guru" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">tgl_lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">telp</label>
            <input type="number" name="telp" maxlength="15" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">sername</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">password</label>
            <input type="text" name="password" maxlength="5" class="form-control" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php?page=guru" class="btn btn-secondary">Kembali</a>
    </form>
</div>

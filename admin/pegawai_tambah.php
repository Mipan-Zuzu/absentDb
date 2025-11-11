<?php
include "../koneksi.php";
if (isset($_POST['simpan'])) {
    $nama_pegawai = $_POST['nama_pegawai'];
    $tgl_lahir    = $_POST['tgl_lahir'];
     $alamat = $_POST['alamat'];
    $telp    = $_POST['telp'];
      $username = $_POST['username'];
    $password    = md5($_POST['password']);

    mysqli_query($koneksi, "INSERT INTO pegawai (nama_pegawai,tgl_lahir,alamat,telp,username,password) VALUES ('$nama_pegawai','$tgl_lahir','$alamat','$telp','$username','$password')");
    header("Location: index.php?page=pegawai&pesan=tambah");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Tambah pegawai</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama pegawai</label>
            <input type="text" name="nama_pegawai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">tgl lahir</label>
            <input type="date" name="tgl_lahir" maxlength="5" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">telp</label>
            <input type="text" name="telp" maxlength="12" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">password</label>
            <input type="text" name="password" maxlength="5" class="form-control" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php?page=pegawai" class="btn btn-secondary">Kembali</a>
    </form>
</div>
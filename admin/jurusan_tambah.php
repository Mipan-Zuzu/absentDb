<?php
include "../koneksi.php";
if (isset($_POST['simpan'])) {
    $nama_jurusan = $_POST['nama_jurusan'];
    $singkatan    = $_POST['singkatan'];

    mysqli_query($koneksi, "INSERT INTO jurusan (nama_jurusan, singkatan) VALUES ('$nama_jurusan','$singkatan')");
    header("Location: index.php?page=jurusan&pesan=tambah");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Tambah Jurusan</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama Jurusan</label>
            <input type="text" name="nama_jurusan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Singkatan</label>
            <input type="text" name="singkatan" maxlength="5" class="form-control" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php?page=jurusan" class="btn btn-secondary">Kembali</a>
    </form>
</div>

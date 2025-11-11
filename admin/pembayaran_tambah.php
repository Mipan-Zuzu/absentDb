<?php
include "../koneksi.php";
if (isset($_POST['simpan'])) {
    $id_siswa = $_POST['id_siswa'];
    $tgl_pembayaran = $_POST['tgl_pembayaran'];
    $bulan    = $_POST['bulan'];
     $nominal    = $_POST['nominal'];
     $metode    = $_POST['metode'];
     $id_pegawai    = $_POST['id_pegawai'];


    mysqli_query($koneksi, "INSERT INTO pembayaran (id_siswa, tgl_pembayaran, bulan,nominal,metode,id_pegawai) VALUES ('$id_siswa','$tgl_pembayaran','$bulan','$nominal','$metode','$id_pegawai')");
    header("Location: index.php?page=pembayaran&pesan=tambah");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Tambah pembayaran</h2>
    <form method="post">
         <div class="mb-3">
            <label class="form-label">nama siswa</label>
            <select name="id_siswa" class="form-select" required>
                <option value="">-- pilih siswa --</option>
                <?php 
                    $siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                    while ($row = mysqli_fetch_assoc($siswa)) { ?>
                    <option value="<?= $row['id_siswa']; ?>">
                        <?= $row['nama_siswa']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">tgl pembayaran</label>
            <input type="date" name="tgl_pembayaran" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">bulan</label>
            <input type="text" name="bulan" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">nominal</label>
            <input type="text" name="nominal" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">metode</label>
            <input type="text" name="metode" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">nama pegawai</label>
            <select name="id_pegawai" class="form-select" required>
                <option value="">-- pilih pegawai --</option>
                <?php 
                    $pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nama_pegawai ASC");
                    while ($row = mysqli_fetch_assoc($pegawai)) { ?>
                    <option value="<?= $row['id_pegawai']; ?>">
                        <?= $row['nama_pegawai']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php?page=pembayaran" class="btn btn-secondary">Kembali</a>
    </form>
</div>
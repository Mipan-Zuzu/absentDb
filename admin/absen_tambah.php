<?php
include "../koneksi.php";
if (isset($_POST['simpan'])) {
    $id_siswa = $_POST['id_siswa'];
    $tgl_absensi = $_POST['tgl_absensi'];
    $keterangan    = $_POST['keterangan'];

    mysqli_query($koneksi, "INSERT INTO absensi (id_siswa, tgl_absensi, keterangan) VALUES ('$id_siswa','$tgl_absensi','$keterangan')");
    header("Location: index.php?page=absensi&pesan=tambah");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Tambah absensi</h2>
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
            <label class="form-label">tgl absensi</label>
            <input type="date" name="tgl_absensi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">keterangan</label>
            <input type="text" name="keterangan" class="form-control" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php?page=absensi" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php
include "../koneksi.php";

// Cek apakah ada ID siswa di URL
if (!isset($_GET['id'])) {
    header("Location: index.php?page=siswa");
    exit;
}

$id = $_GET['id'];

// Ambil data siswa berdasarkan ID
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa=$id"));

// Proses update data
if (isset($_POST['update'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $no_absen   = $_POST['no_absen'];
    $tgl_lahir  = $_POST['tgl_lahir'];
    $alamat     = $_POST['alamat'];
    $telp       = $_POST['telp'];
    $nis        = $_POST['nis'];
    $nisn       = $_POST['nisn'];
    $id_kelas   = $_POST['id_kelas'];

    mysqli_query($koneksi, "UPDATE siswa SET 
        nama_siswa='$nama_siswa',
        no_absen='$no_absen',
        tgl_lahir='$tgl_lahir',
        alamat='$alamat',
        telp='$telp',
        nis='$nis',
        nisn='$nisn',
        id_kelas='$id_kelas'
        WHERE id_siswa=$id");

    header("Location: index.php?page=siswa&pesan=edit");
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Edit Data Siswa</h2>

    <form method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Siswa</label>
                <input type="text" name="nama_siswa" class="form-control" value="<?= $data['nama_siswa'] ?>" required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">No Absen</label>
                <input type="number" name="no_absen" class="form-control" value="<?= $data['no_absen'] ?>" required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="<?= $data['tgl_lahir'] ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required><?= $data['alamat'] ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="telp" class="form-control" maxlength="15" value="<?= $data['telp'] ?>" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">NIS</label>
                <input type="number" name="nis" class="form-control" value="<?= $data['nis'] ?>" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">NISN</label>
                <input type="text" name="nisn" maxlength="15" class="form-control" value="<?= $data['nisn'] ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <select name="id_kelas" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                <?php
                $qKelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                while ($kelas = mysqli_fetch_assoc($qKelas)) {
                    $selected = ($kelas['id_kelas'] == $data['id_kelas']) ? "selected" : "";
                    echo "<option value='{$kelas['id_kelas']}' $selected>{$kelas['nama_kelas']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index.php?page=siswa" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php
include "../koneksi.php";

// Cek apakah ada ID absensi di URL
if (!isset($_GET['id'])) {
    header("Location: index.php?page=absensi");
    exit;
}

$id = $_GET['id'];

// Ambil data absensi berdasarkan ID
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_absensi=$id"));

// Proses update data
if (isset($_POST['update'])) {
  $id_siswa = $_POST['id_siswa'];
    $tgl_absensi = $_POST['tgl_absensi'];
    $keterangan    = $_POST['keterangan'];

    mysqli_query($koneksi, "UPDATE absensi SET 
        id_siswa='$id_siswa',
        tgl_absensi='$tgl_absensi',
        keterangan='$keterangan'
        WHERE id_absensi=$id");

    header("Location: index.php?page=absensi&pesan=edit");
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Edit Data absensi</h2>

    <form method="post">
        <div class="row">
           <div class="mb-3">
            <label class="form-label">siswa</label>
            <select name="id_siswa" class="form-control" required>
                <option value="">-- Pilih siswa --</option>
                <?php
                $qsiswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                while ($siswa = mysqli_fetch_assoc($qsiswa)) {
                    $selected = ($siswa['id_siswa'] == $data['id_siswa']) ? "selected" : "";
                    echo "<option value='{$siswa['id_siswa']}' $selected>{$siswa['nama_siswa']}</option>";
                }
                ?>
            </select>
        </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">tgl absensi</label>
                <input type="date" name="tgl_absensi" class="form-control" value="<?= $data['tgl_absensi'] ?>" required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">keterangan</label>
                <input type="text" name="keterangan" class="form-control" value="<?= $data['keterangan'] ?>" required>
            </div>
        </div>

       
<div class="row">
    <div class="col-auto">
        <button type="submit" name="update" class="btn btn-success">Update</button>
    </div>
    <div class="col-auto">
        <a href="index.php?page=absensi" class="btn btn-secondary">Kembali</a>
    </div>
</div>
    
    </form>
</div>
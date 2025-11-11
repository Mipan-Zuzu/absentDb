<?php
include "../koneksi.php";

// Cek apakah ada ID pembayaran di URL
if (!isset($_GET['id'])) {
    header("Location: index.php?page=pembayaran");
    exit;
}

$id = $_GET['id'];

// Ambil data pembayaran berdasarkan ID
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_pembayaran=$id"));

// Proses update data
if (isset($_POST['update'])) {
  $id_siswa = $_POST['id_siswa'];
    $tgl_pembayaran = $_POST['tgl_pembayaran'];
    $bulan    = $_POST['bulan'];
     $nominal    = $_POST['nominal'];
     $metode    = $_POST['metode'];
     $id_pegawai    = $_POST['id_pegawai'];

    mysqli_query($koneksi, "UPDATE pembayaran SET 
        id_siswa='$id_siswa',
        tgl_pembayaran='$tgl_pembayaran',
        bulan='$bulan',
        nominal='$nominal',
        metode='$metode',
        id_pegawai='$id_pegawai'
        WHERE id_pembayaran=$id");

    header("Location: index.php?page=pembayaran&pesan=edit");
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Edit Data pembayaran</h2>

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
                <label class="form-label">tgl pembayaran</label>
                <input type="date" name="tgl_pembayaran" class="form-control" value="<?= $data['tgl_pembayaran'] ?>" required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">bulan</label>
                <input type="text" name="bulan" class="form-control" value="<?= $data['bulan'] ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">nominal</label>
            <input type="text" name="nominal" class="form-control" value="<?= $data['nominal'] ?>" required>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">metode</label>
                <input type="text" name="metode" class="form-control" maxlength="15" value="<?= $data['metode'] ?>" required>
            </div>

    
<div class="mb-3">
    <label class="form-label">pegawai</label>
    <select name="id_pegawai" class="form-control" required>
        <option value="">-- Pilih pegawai --</option>
        <?php
        $qpegawai = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nama_pegawai ASC");
        while ($pegawai = mysqli_fetch_assoc($qpegawai)) {
            $selected = ($pegawai['id_pegawai'] == $data['id_pegawai']) ? "selected" : "";
            echo "<option value='{$pegawai['id_pegawai']}' $selected>{$pegawai['nama_pegawai']}</option>";
        }
        ?>
    </select>
</div>

       
<div class="row">
    <div class="col-auto">
        <button type="submit" name="update" class="btn btn-success">Update</button>
    </div>
    <div class="col-auto">
        <a href="index.php?page=pembayaran" class="btn btn-secondary">Kembali</a>
    </div>
</div>
    
    </form>
</div>
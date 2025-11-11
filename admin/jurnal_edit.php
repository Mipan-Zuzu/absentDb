<?php
include "../koneksi.php";

// Cek apakah ada ID absensi di URL
if (!isset($_GET['id'])) {
    header("Location: index.php?page=jurnal");
    exit;
}

$id = $_GET['id'];

// Ambil data absensi berdasarkan ID
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jurnal WHERE id_jurnal=$id"));

// Proses update data
if (isset($_POST['update'])) {
  $id_guru = $_POST['id_guru'];
    $tgl_mengajar = $_POST['tgl_mengajar'];
    $id_kelas    = $_POST['id_kelas'];
     $materi = $_POST['materi'];
    $ket    = $_POST['ket'];

    mysqli_query($koneksi, "UPDATE mpk SET 
        id_guru='$id_guru',
        tgl_mengajar='$tgl_mengajar',
        id_kelas='$id_kelas',
        materi='$materi',
        ket='$ket'
        WHERE id_jurnal=$id");

    header("Location: index.php?page=jurnal&pesan=edit");
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Edit Data jurnal</h2>

    <form method="post">
        <div class="row">
  <!-- Pilih Guru -->
  <div class="col-md-6 mb-3">
    <label class="form-label">Guru</label>
    <select name="id_guru" class="form-control" required>
      <option value="">-- Pilih guru --</option>
      <?php
      $qguru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama_guru ASC");
      while ($guru = mysqli_fetch_assoc($qguru)) {
          $selected = ($guru['id_guru'] == $data['id_guru']) ? "selected" : "";
          echo "<option value='{$guru['id_guru']}' $selected>{$guru['nama_guru']}</option>";
      }
      ?>
    </select>
  </div>

  <!-- Tanggal Mengajar -->
  <div class="col-md-6 mb-3">
    <label class="form-label">Tanggal Mengajar</label>
    <input type="date" name="tgl_mengajar" class="form-control" value="<?= $data['tgl_mengajar'] ?>" required>
  </div>
</div>

<div class="row">
  <!-- Kelas -->
  <div class="col-md-6 mb-3">
    <label class="form-label">Kelas</label>
    <select name="id_kelas" class="form-control" required>
      <option value="">-- Pilih kelas --</option>
      <?php
      $qkelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
      while ($kelas = mysqli_fetch_assoc($qkelas)) {
          $selected = ($kelas['id_kelas'] == $data['id_kelas']) ? "selected" : "";
          echo "<option value='{$kelas['id_kelas']}' $selected>{$kelas['nama_kelas']}</option>";
      }
      ?>
    </select>
  </div>

  <!-- Materi -->
  <div class="col-md-6 mb-3">
    <label class="form-label">Materi</label>
    <input type="text" name="materi" class="form-control" value="<?= $data['materi'] ?>" required>
  </div>
</div>

<div class="row">
  <!-- Keterangan -->
  <div class="col-md-6 mb-3">
    <label class="form-label">Keterangan</label>
    <input type="text" name="ket" class="form-control" value="<?= $data['ket'] ?>" required>
  </div>
</div>



       
<div class="row">
    <div class="col-auto">
        <button type="submit" name="update" class="btn btn-success">Update</button>
    </div>
    <div class="col-auto">
        <a href="index.php?page=jurnal" class="btn btn-secondary">Kembali</a>
    </div>
</div>
    
    </form>
</div>
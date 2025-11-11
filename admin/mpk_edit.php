<?php
include "../koneksi.php";

// Cek apakah ada ID absensi di URL
if (!isset($_GET['id'])) {
    header("Location: index.php?page=mpk");
    exit;
}

$id = $_GET['id'];

// Ambil data absensi berdasarkan ID
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM mpk WHERE id_mpk=$id"));

// Proses update data
if (isset($_POST['update'])) {
  $id_siswa = $_POST['id_siswa'];
    $id_kelas = $_POST['id_kelas'];
    $username    = $_POST['username'];

    mysqli_query($koneksi, "UPDATE mpk SET 
        id_siswa='$id_siswa',
        id_kelas='$id_kelas',
        username='$username'
        WHERE id_mpk=$id");

    header("Location: index.php?page=mpk&pesan=edit");
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Edit Data mpk</h2>

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

        <div class="mb-3">
            <label class="form-label">kelas</label>
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


            <div class="col-md-3 mb-3">
                <label class="form-label">username</label>
                <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
            </div>
        </div>

       
<div class="row">
    <div class="col-auto">
        <button type="submit" name="update" class="btn btn-success">Update</button>
    </div>
    <div class="col-auto">
        <a href="index.php?page=mpk" class="btn btn-secondary">Kembali</a>
    </div>
</div>
    
    </form>
</div>
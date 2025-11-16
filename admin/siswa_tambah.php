<?php
include "../koneksi.php";


$qKelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");


if (isset($_POST['simpan'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $no_absen   = $_POST['no_absen'];
    $tgl_lahir  = $_POST['tgl_lahir'];
    $alamat     = $_POST['alamat'];
    $telp_negara = $_POST['telp_negara'];
    $telp_nomor  = $_POST['telp_nomor'];
    $telp       = $telp_negara . $telp_nomor;
    $nis        = $_POST['nis'];
    $nisn       = $_POST['nisn'];
    $id_kelas   = $_POST['id_kelas'];


    $query = "INSERT INTO siswa (nama_siswa, no_absen, tgl_lahir, alamat, telp, nis, nisn, id_kelas)
              VALUES ('$nama_siswa', '$no_absen', '$tgl_lahir', '$alamat', '$telp', '$nis', '$nisn', '$id_kelas')";
    mysqli_query($koneksi, $query);

    header("Location: index.php?page=siswa&pesan=tambah");
    exit;
}
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
    #map {
        height: 300px;
        border-radius: 10px;
    }
</style>

<div class="container mt-5">
    <h2 class="mb-4 text-center"><i class='bx bx-user-plus'></i> Tambah Data Siswa</h2>

    <form method="post" class="border rounded p-4 shadow-sm bg-light">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nama Siswa</label>
                <input type="text" name="nama_siswa" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold">No Absen</label>
                <input type="number" name="no_absen" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" required>
            </div>
        </div>


        <div class="mb-3">
            <label class="form-label fw-bold">Alamat</label>
            <div class="d-flex gap-2">
                <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukkan alamat..." required>
                <button type="button" id="btnCari" class="btn btn-primary">
                    <i class='bx bx-search-alt'></i>
                </button>
            </div>


            <div id="map" class="mt-3"></div>
        </div>


        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Telepon</label>

                <div class="input-group">
                    <select class="form-select" name="telp_negara" required>
                        <option value="+62">🇮🇩 +62 (Indonesia)</option>
                        <option value="+60">🇲🇾 +60 (Malaysia)</option>
                        <option value="+65">🇸🇬 +65 (Singapore)</option>
                        <option value="+66">🇹🇭 +66 (Thailand)</option>
                        <option value="+81">🇯🇵 +81 (Japan)</option>
                        <option value="+1">🇺🇸 +1 (USA)</option>
                        <option value="+44">🇬🇧 +44 (UK)</option>
                    </select>

                    <input type="text" name="telp_nomor" maxlength="15" class="form-control" placeholder="Nomor" required>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">NIS</label>
                <input type="number" name="nis" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">NISN</label>
                <input type="text" name="nisn" maxlength="15" class="form-control" required>
            </div>
        </div>


        <div class="mb-3">
            <label class="form-label fw-bold">Kelas</label>
            <select name="id_kelas" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                <?php while ($kelas = mysqli_fetch_assoc($qKelas)) { ?>
                    <option value="<?= $kelas['id_kelas'] ?>">
                        <?= htmlspecialchars($kelas['nama_kelas']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>


        <div class="d-flex justify-content-end mt-4">
            <button type="submit" name="simpan" class="btn btn-success me-2">
                <i class='bx bx-save'></i> Simpan
            </button>
            <a href="index.php?page=siswa" class="btn btn-secondary">
                <i class='bx bx-arrow-back'></i> Kembali
            </a>
        </div>
    </form>
</div>


<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>

var map = L.map('map').setView([-8.65, 115.22], 12); 

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

var marker;


document.getElementById("btnCari").addEventListener("click", function() {
    let alamat = document.getElementById("alamat").value;

    if (!alamat.trim()) {
        alert("Masukkan alamat dahulu!");
        return;
    }


    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(alamat)}`)
        .then(res => res.json())
        .then(data => {
            if (data.length === 0) {
                alert("Alamat tidak ditemukan!");
                return;
            }

            let lat = data[0].lat;
            let lon = data[0].lon;


            map.setView([lat, lon], 17);

            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lon]).addTo(map)
                .bindPopup("Lokasi ditemukan!").openPopup();
        });
});
</script>

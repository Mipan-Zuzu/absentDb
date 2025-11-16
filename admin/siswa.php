<?php
include("../koneksi.php");

$cari = "";
$filterKelas = "";
$filterJurusan = "";

$kelasList = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
$jurusanList = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");

$where = "WHERE siswa.id_kelas = kelas.id_kelas AND kelas.id_jurusan = jurusan.id_jurusan";

if (!empty($_GET['cari'])) {
    $cari = $_GET['cari'];
    $where .= " AND nama_siswa LIKE '%$cari%' ";
}

if (!empty($_GET['kelas'])) {
    $filterKelas = $_GET['kelas'];
    $where .= " AND kelas.id_kelas = '$filterKelas' ";
}

if (!empty($_GET['jurusan'])) {
    $filterJurusan = $_GET['jurusan'];
    $where .= " AND jurusan.id_jurusan = '$filterJurusan' ";
}

$result = mysqli_query($koneksi, "
    SELECT siswa.*, kelas.nama_kelas, jurusan.nama_jurusan
    FROM siswa
    JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    JOIN jurusan ON kelas.id_jurusan = jurusan.id_jurusan
    $where
    ORDER BY id_siswa DESC
");
?>

<div class="flex justify-end mb-5 mt-5">
    <form class="flex flex-col sm:flex-row items-center gap-2 w-full sm:w-auto justify-end" method="get" action="">
        <input type="hidden" name="page" value="siswa">

        <select name="kelas" class="select select-bordered rounded-xl w-full sm:w-44">
            <option value="">Semua Kelas</option>
            <?php while ($k = mysqli_fetch_assoc($kelasList)) { ?>
                <option value="<?= $k['id_kelas'] ?>" <?= $filterKelas == $k['id_kelas'] ? 'selected' : '' ?>>
                    <?= $k['nama_kelas'] ?>
                </option>
            <?php } ?>
        </select>

        <select name="jurusan" class="select select-bordered rounded-xl w-full sm:w-44">
            <option value="">Semua Jurusan</option>
            <?php while ($j = mysqli_fetch_assoc($jurusanList)) { ?>
                <option value="<?= $j['id_jurusan'] ?>" <?= $filterJurusan == $j['id_jurusan'] ? 'selected' : '' ?>>
                    <?= $j['nama_jurusan'] ?>
                </option>
            <?php } ?>
        </select>

        <label class="input rounded-2xl flex items-center gap-2 w-full sm:w-64">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input type="search" name="cari" placeholder="Cari Absen..." class="grow focus:outline-none"
                   value="<?= htmlspecialchars($cari) ?>" />
        </label>

        <button class="btn btn-info rounded-xl px-5 w-full sm:w-auto" type="submit">Cari</button>
    </form>

    <a href="siswa_tambah.php" class="btn btn-success rounded-xl px-5 ml-0 sm:ml-3 mt-2 sm:mt-0 w-full sm:w-auto text-center">
        Tambah Data
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['nama_kelas'] ?></td>
                        <td><?= $row['nama_jurusan'] ?></td>
                        <td>
                            <button class="btn btn-dash" onclick="openDetail(
                                '<?= $row['nama_siswa'] ?>',
                                '<?= $row['nis'] ?>',
                                '<?= $row['nisn'] ?>',
                                '<?= $row['nama_kelas'] ?>',
                                '<?= $row['nama_jurusan'] ?>',
                                '<?= $row['alamat'] ?>',
                                '<?= $row['id_siswa'] ?>'
                            )">Detail</button>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">⚠️ Data tidak ditemukan</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal Dialog -->
<dialog id="my_modal_1" class="modal">
  <div class="modal-box relative p-5">
    <div class="absolute top-2 left-3 flex space-x-2">
      <span class="w-3 h-3 bg-red-500 rounded-full"></span>
      <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
      <span class="w-3 h-3 bg-green-500 rounded-full"></span>
    </div>

    <h3 class="text-lg font-bold mt-3" id="modalNama">Nama Siswa</h3>

    <p class="py-2"><strong>NIS:</strong> <span id="modalNIS"></span></p>
    <p class="py-2"><strong>NISN:</strong> <span id="modalNISN"></span></p>
    <p class="py-2"><strong>Kelas:</strong> <span id="modalKelas"></span></p>
    <p class="py-2"><strong>Jurusan:</strong> <span id="modalJurusan"></span></p>
    <p class="py-2"><strong>Alamat:</strong> <span id="modalAlamat"></span></p>

    <div class="modal-action flex justify-start gap-2 mt-4" id="modalActions">
      <form method="dialog">
        <button class="btn">Close</button>
      </form>
    </div>
  </div>
</dialog>

<script>
function openDetail(nama, nis, nisn, kelas, jurusan, alamat, id) {
    document.getElementById('modalNama').textContent = nama;
    document.getElementById('modalNIS').textContent = nis;
    document.getElementById('modalNISN').textContent = nisn;
    document.getElementById('modalKelas').textContent = kelas;
    document.getElementById('modalJurusan').textContent = jurusan;
    document.getElementById('modalAlamat').textContent = alamat;

    const modalActions = document.getElementById('modalActions');
    modalActions.innerHTML = `
      <a href="siswa_edit.php?id=${id}" class="btn btn-warning">Edit</a>
      <a href="siswa_hapus.php?id=${id}" class="btn btn-error"
         onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</a>
      <form method="dialog">
        <button class="btn">Close</button>
      </form>
    `;

    document.getElementById('my_modal_1').showModal();
}
</script>

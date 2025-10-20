<?php
include("../koneksi.php");

$cari = "";
$where = "";

if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
    $where = "WHERE siswa.nama_siswa LIKE '%$cari%' OR absensi.tgl_absensi LIKE '%$cari%'";
}

$sql = "SELECT absensi.id_absensi, siswa.nama_siswa, kelas.nama_kelas, absensi.tgl_absensi, absensi.keterangan
        FROM absensi
        JOIN siswa ON absensi.id_siswa = siswa.id_siswa
        JOIN kelas ON siswa.id_kelas = kelas.id_kelas
        $where
        ORDER BY absensi.id_absensi DESC";

$result = mysqli_query($koneksi, $sql);
?>

<div class="flex justify-end mb-3 mt-5 flex-wrap gap-2">
    <form class="flex items-center mr-2 gap-2" method="get" action="">
        <input type="hidden" name="page" value="absen">
        <label class="input rounded-2xl flex items-center gap-2 w-40 sm:w-64">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input type="search" name="cari" required placeholder="Cari Absen..." class="grow focus:outline-none"
                value="<?= htmlspecialchars($cari) ?>" />
        </label>
        <button class="btn btn-outline btn-info rounded-b-2xl text-xs sm:text-sm md:text-base px-3 py-1 sm:px-4 sm:py-2"
            type="submit">
            Cari
        </button>
    </form>
    <a href="absen_tambah.php"
        class="btn btn-outline btn-success rounded-bl-2xl text-xs sm:text-sm md:text-base px-3 py-1 sm:px-4 sm:py-2 text-center">
        Tambah Data
    </a>
</div>

<!-- Tabel Ringkas -->
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
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
                        <td>
                            <button class="btn btn-dash" onclick="openDetail(
                                '<?= $row['nama_siswa'] ?>',
                                '<?= $row['nama_kelas'] ?>',
                                '<?= $row['tgl_absensi'] ?>',
                                '<?= $row['keterangan'] ?>',
                                '<?= $row['id_absensi'] ?>'
                            )">Detail</button>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <div role="alert" class="alert alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Error Tidak ada data yg cocok</span>
                    </div>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal Dialog ala macOS -->
<dialog id="my_modal_1" class="modal">
    <div class="modal-box relative p-5">
        <!-- Traffic light macOS -->
        <div class="absolute top-2 left-3 flex space-x-2">
            <span class="w-3 h-3 bg-red-500 rounded-full"></span>
            <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
            <span class="w-3 h-3 bg-green-500 rounded-full"></span>
        </div>

        <!-- Konten Modal -->
        <h3 class="text-lg font-bold mt-3" id="modalNama">Nama Siswa</h3>
        <p class="py-2"><strong>Kelas:</strong> <span id="modalKelas"></span></p>
        <p class="py-2"><strong>Tanggal:</strong> <span id="modalTgl"></span></p>
        <p class="py-2"><strong>Keterangan:</strong> <span id="modalKet"></span></p>

        <!-- Aksi Modal -->
        <div class="modal-action flex justify-start gap-2 mt-4" id="modalActions">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>

<script>
    function openDetail(nama, kelas, tgl, ket, id) {
        document.getElementById('modalNama').textContent = nama;
        document.getElementById('modalKelas').textContent = kelas;
        document.getElementById('modalTgl').textContent = tgl;
        document.getElementById('modalKet').textContent = ket;

        // Tambahkan tombol Edit & Hapus
        const modalActions = document.getElementById('modalActions');
        modalActions.innerHTML = `
      <a href="absensi_edit.php?id=${id}" class="btn btn-warning">Edit</a>
      <a href="absensi_hapus.php?id=${id}" class="btn btn-error"
         onclick="return confirm('Yakin ingin menghapus absensi ini?')">Hapus</a>
      <form method="dialog">
        <button class="btn">Close</button>
      </form>
    `;

        document.getElementById('my_modal_1').showModal();
    }
</script>
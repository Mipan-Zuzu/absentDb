<?php
include("../koneksi.php");
$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
    $result = mysqli_query($koneksi, "SELECT * FROM mpk
                                      JOIN siswa ON mpk.id_siswa = siswa.id_siswa
                                      JOIN kelas ON mpk.id_kelas = kelas.id_kelas
                                      WHERE nama_siswa LIKE '%$cari%'
                                      ORDER BY id_mpk DESC");
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM mpk
                                      JOIN siswa ON mpk.id_siswa = siswa.id_siswa
                                      JOIN kelas ON mpk.id_kelas = kelas.id_kelas
                                      ORDER BY id_mpk DESC");
}
?>

<div class="flex justify-end mb-3 mt-5 flex-wrap gap-2">
    <form class="flex items-center mr-2 gap-2" method="get" action="">
        <input type="hidden" name="page" value="mpk">
        <label class="input rounded-2xl flex items-center gap-2 w-40 sm:w-64">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input 
                type="search" 
                name="cari" 
                required
                placeholder="Cari MPK..." 
                class="grow focus:outline-none"
                value="<?= htmlspecialchars($cari) ?>"
            />
        </label>
        <button 
            class="btn btn-outline btn-info rounded-b-2xl text-xs sm:text-sm md:text-base px-3 py-1 sm:px-4 sm:py-2"
            type="submit">
            Cari
        </button>
    </form>
    <a href="mpk_tambah.php" 
       class="btn btn-outline btn-success rounded-bl-2xl text-xs sm:text-sm md:text-base px-3 py-1 sm:px-4 sm:py-2 text-center">
       Tambah Data
    </a>
</div>

<!-- Tabel Ringkas MPK -->
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama MPK</th>
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
                            '<?= $row['nisn'] ?>',
                            '<?= $row['nis'] ?>',
                            '<?= $row['id_mpk'] ?>'
                        )">Detail</button>
                    </td>
                </tr>
        <?php } 
        } else { ?>
            <tr>
                <td colspan="3" class="text-center text-muted">⚠️ Data tidak ditemukan</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal Dialog MPK ala macOS -->
<dialog id="my_modal_1" class="modal">
  <div class="modal-box relative p-5">
    <!-- Traffic light macOS -->
    <div class="absolute top-2 left-3 flex space-x-2">
      <span class="w-3 h-3 bg-red-500 rounded-full"></span>
      <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
      <span class="w-3 h-3 bg-green-500 rounded-full"></span>
    </div>

    <!-- Konten Modal -->
    <h3 class="text-lg font-bold mt-3" id="modalNama">Nama MPK</h3>
    <p class="py-2"><strong>Kelas:</strong> <span id="modalKelas"></span></p>
    <p class="py-2"><strong>NISN:</strong> <span id="modalNISN"></span></p>
    <p class="py-2"><strong>NIS:</strong> <span id="modalNIS"></span></p>

    <!-- Aksi Modal -->
    <div class="modal-action flex justify-start gap-2 mt-4" id="modalActions">
      <form method="dialog">
        <button class="btn">Close</button>
      </form>
    </div>
  </div>
</dialog>

<script>
function openDetail(nama, kelas, nisn, nis, id) {
    document.getElementById('modalNama').textContent = nama;
    document.getElementById('modalKelas').textContent = kelas;
    document.getElementById('modalNISN').textContent = nisn;
    document.getElementById('modalNIS').textContent = nis;

    const modalActions = document.getElementById('modalActions');
    modalActions.innerHTML = `
      <a href="mpk_edit.php?id=${id}" class="btn btn-warning">Edit</a>
      <a href="mpk_hapus.php?id=${id}" class="btn btn-error"
         onclick="return confirm('Yakin ingin menghapus MPK ini?')">Hapus</a>
      <form method="dialog">
        <button class="btn">Close</button>
      </form>
    `;

    document.getElementById('my_modal_1').showModal();
}
</script>

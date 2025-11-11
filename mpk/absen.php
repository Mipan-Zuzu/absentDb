<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: ../loginn.php");
  exit;
}

include './koneksi.php';

if (isset($_GET['id_kelas'])) {
  $_SESSION['id_kelas'] = $_GET['id_kelas'];
  header("Location: absen.php");
  exit;
}

$id_kelas = $_SESSION['id_kelas'] ?? null;
if (!$id_kelas) {
  echo "<p style='color:red;'>ID kelas tidak ditemukan!</p>";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = $_POST['absen'] ?? [];
  $tgl = date('Y-m-d');
  $inserted = 0;

  foreach ($data as $id_siswa => $keterangan) {
    $keterangan = mysqli_real_escape_string($koneksi, $keterangan);
    $id_siswa = (int) $id_siswa;

    $cek = mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_siswa='$id_siswa' AND tgl_absensi='$tgl'");
    if (mysqli_num_rows($cek) > 0)
      continue;

    $sql = "INSERT INTO absensi (id_siswa, tgl_absensi, keterangan)
            VALUES ('$id_siswa', '$tgl', '$keterangan')";
    if (mysqli_query($koneksi, $sql))
      $inserted++;
  }

  echo "<script>alert('Absensi berhasil disimpan ($inserted siswa)!'); window.location='absen.php?id_kelas=$id_kelas';</script>";
  exit;
}

$cariSiswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$id_kelas' ORDER BY nama_siswa ASC");
$siswaData = [];
while ($row = mysqli_fetch_assoc($cariSiswa)) {
  $siswaData[] = $row;
}

$filter_bulan = $_GET['bulan'] ?? date('Y-m');
$filter_tgl = $_GET['tgl'] ?? '';

$querySummary = "
    SELECT DATE(tgl_absensi) AS tanggal, keterangan, COUNT(*) AS jumlah
    FROM absensi
    JOIN siswa ON absensi.id_siswa = siswa.id_siswa
    WHERE siswa.id_kelas = '$id_kelas'
      AND DATE_FORMAT(tgl_absensi, '%Y-%m') = '$filter_bulan'
";

if (!empty($filter_tgl)) {
  $querySummary .= " AND DATE(tgl_absensi) = '$filter_tgl'";
}

$querySummary .= " GROUP BY DATE(tgl_absensi), keterangan ORDER BY tanggal DESC";

$resSummary = mysqli_query($koneksi, $querySummary);
$summary = [];
while ($row = mysqli_fetch_assoc($resSummary)) {
  $summary[$row['tanggal']][] = $row;
}

// Ambil semua detail absensi untuk toggle minimalis
$allDetail = [];
foreach ($summary as $tanggal => $listKet) {
  foreach ($listKet as $ketData) {
    $detail_q = "
            SELECT siswa.nama_siswa
            FROM absensi
            JOIN siswa ON absensi.id_siswa = siswa.id_siswa
            WHERE siswa.id_kelas = '$id_kelas'
              AND absensi.keterangan = '" . $ketData['keterangan'] . "'
              AND DATE(absensi.tgl_absensi) = '$tanggal'
            ORDER BY siswa.nama_siswa ASC
        ";
    $resDetail = mysqli_query($koneksi, $detail_q);
    $detailList = [];
    while ($r = mysqli_fetch_assoc($resDetail)) {
      $detailList[] = $r;
    }
    $allDetail[$tanggal][$ketData['keterangan']] = $detailList;
  }
}
?>

<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Absen Siswa</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style-absen.css">
  <style>
    .detail-card {
      display: none;
      margin-top: 10px;
      padding: 10px 15px;
      border-radius: 8px;
      background: #fefefe;
      border: 1px solid #ddd;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .detail-card li {
      margin: 4px 0;
      font-size: 14px;
      padding-left: 8px;
      position: relative;
    }

    .detail-card li::before {
      content: "•";
      position: absolute;
      left: 0;
      color: #4CAF50;
    }

    .toggle-btn {
      cursor: pointer;
      padding: 6px 12px;
      border-radius: 6px;
      background: #4CAF50;
      color: #fff;
      font-size: 13px;
      text-decoration: none;
      margin-left: 10px;
    }

    .rekap-item {
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <div class="frame">
    <div class="top">
      <div class="title">
        <h1>Absensi</h1>
        <div class="subtitle"><?= date('d M Y'); ?></div>
      </div>
      <div style="display:flex;align-items:center;gap:12px">
        <h1 style="font-size: 15px; color: green;"><?= $_SESSION['username'] ?? 'Guru'; ?></h1>
        <div class="avatar" title="profile"></div>
      </div>
    </div>

    <div class="toolbar">
      <div class="legend">
        <div class="item"><span class="dot hadir"></span> Hadir</div>
        <div class="item"><span class="dot izin"></span> Izin</div>
        <div class="item"><span class="dot sakit"></span> Sakit</div>
        <div class="item"><span class="dot dispen"></span> Telat</div>
        <div class="item"><span class="dot alpha"></span> Alpha</div>
      </div>
      <div style="margin-left:auto;display:flex;gap:8px">
        <button class="btn ghost" id="helpBtnDesktop">Help !</button>
      </div>
    </div>

    <form method="post">
      <div class="list" id="listDesktop">
        <?php if (count($siswaData) === 0): ?>
          <p style="color:red;">Tidak ada siswa pada kelas ini.</p>
        <?php else: ?>
          <?php foreach ($siswaData as $s): ?>
            <div class="student">
              <div style="display:flex;align-items:center;justify-content:space-between;width:100%;padding:8px 0">
                <div style="display:flex;align-items:center;gap:12px">
                  <div class="avatar"></div>
                  <div class="info">
                    <div class="name" style="font-weight:600;">
                      <?php
                      $nama = htmlspecialchars($s['nama_siswa']);
                      echo mb_strlen($nama) > 15 ? mb_substr($nama, 0, 15) . '...' : $nama;
                      ?>
                    </div>
                    <div class="class" style="font-size:12px;color:#555;">NIS: <?= htmlspecialchars($s['nis']); ?></div>
                  </div>
                </div>
                <select name="absen[<?= $s['id_siswa']; ?>]"  style="
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding:10px 10px;
    border-radius:8px;
    padding-right: 20px;
    border:1px solid #ccc;
    background:#fff url('data:image/svg+xml;utf8,<svg fill=\'gray\' height=\'6\' viewBox=\'0 0 10 6\' width=\'10\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M0 0l5 6 5-6z\'/></svg>') no-repeat right 4px center; /* ubah 10px ke 5px */
    background-size:10px;
    font-size:14px;
    cursor:pointer;
    color:#000;
  ">
                  <option value="hadir">Hadir</option>
                  <option value="izin">Izin</option>
                  <option value="sakit">Sakit</option>
                  <option value="telat">Telat</option>
                  <option value="alpha">Alpha</option>
                </select>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <div class="footer">
        <div class="count"><?= count($siswaData); ?> siswa</div>
        <div class="buttons">
          <button type="reset" class="btn ghost">Kosongkan</button>
          <button type="submit" class="btn primary">Kirim</button>
        </div>
      </div>
    </form>

  </div>

  <hr style="margin:30px 0;border:none;border-top:2px solid #eee;">

  <div class="summary"
    style="background:#fff;padding:20px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.08);margin-top:20px;">
    <h2 style="margin-bottom:15px;color:#333;font-size:20px;">Rekap Absensi</h2>

    <form method="get" style="margin-bottom:20px;display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
      <h1 id="tanggal" style="padding:8px 10px;border:1px solid #ccc;border-radius:8px;font-size:14px;"></h1>
      <input type="date" name="tgl" value="<?= $filter_tgl ? date('Y-m-d', strtotime($filter_tgl)) : ''; ?>"
        style="padding:8px 10px; border:1px solid #ccc; border-radius:8px; font-size:14px;">
      <button type="submit" class="btn primary" style="padding:8px 14px;border-radius:8px;">Filter</button>
    </form>

    <?php if (empty($summary)): ?>
      <p style="color:red;">Belum ada absensi di bulan atau tanggal ini.</p>
    <?php else: ?>
      <?php foreach ($summary as $tanggal => $listKet): ?>
        <div style="background:#f9f9f9;border:1px solid #ddd;padding:15px;border-radius:10px;margin-bottom:20px;">
          <div style="margin-bottom:10px;font-weight:600;">Tanggal: <?= htmlspecialchars($tanggal); ?></div>
          <?php foreach ($listKet as $ketData): ?>
            <div class="rekap-item">
              <div style="display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex;align-items:center;gap:10px;">
                  <span class="dot <?= htmlspecialchars($ketData['keterangan']); ?>"></span>
                  <span
                    style="text-transform:capitalize;font-weight:600;"><?= htmlspecialchars($ketData['keterangan']); ?></span>
                </div>
                <div>
                  <span style="margin-right:10px;color:#555;">Total: <?= $ketData['jumlah']; ?></span>
                  <span class="toggle-btn" data-tgl="<?= htmlspecialchars($tanggal); ?>"
                    data-ket="<?= htmlspecialchars($ketData['keterangan']); ?>">Detail</span>
                </div>
              </div>
              <div class="detail-card"
                id="detail-<?= htmlspecialchars($tanggal); ?>-<?= htmlspecialchars($ketData['keterangan']); ?>">
                <ul>
                  <?php
                  $details = $allDetail[$tanggal][$ketData['keterangan']] ?? [];
                  foreach ($details as $d):
                    ?>
                    <li><?= htmlspecialchars($d['nama_siswa']); ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <div id="assistiveTouch"></div>
  <div id="assistiveMenu">
    <div class="pointerCur" id="helpBtnMobile"> <i title="Help" class='bx bx-info-circle'></i><br> <span class="isiNav"
        style="color: red;">Help</span> </div>
    <div class="back pointerCur" id="utama"> <i title="Utama" class='bx bx-circle'></i><br> <span class="isiNav"
        style="color: re;">utama</span> </div>
    <div id="logout" class="pointerCur"> <i title="Logout" class='bx bx-exit'></i><br> <span class="isiNav"
        style="color: #ccc;">Exit</span> </div>
  </div> <!-- Modal -->
  <div class="modal-backdrop" id="modalBackdrop">
    <div class="modal" id="modalContent" role="dialog" aria-modal="true"></div>
  </div>

  <script>
    document.querySelectorAll('.toggle-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const tgl = btn.getAttribute('data-tgl');
        const ket = btn.getAttribute('data-ket');
        const detailDiv = document.getElementById(`detail-${tgl}-${ket}`);
        if (detailDiv.style.display === 'block') {
          detailDiv.style.display = 'none';
        } else {
          detailDiv.style.display = 'block';
        }
      });
    });
  </script>

  <script src="absen.js"></script>
</body>

</html>
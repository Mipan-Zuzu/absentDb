<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../loginn.php");
    exit;
}

include '../koneksi.php';

$id_kelas = $_SESSION['id_kelas'] ?? $_GET['id_kelas'] ?? null;

if (!$id_kelas) {
    echo "<p style='color:red;'>ID kelas tidak ditemukan!</p>";
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$id_kelas'");
?>

<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Absen Siswa — Demo</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style-absen.css">
  <script>
  const ID_KELAS = "<?php echo $_SESSION['id_kelas']; ?>";
</script>
<script src="../js/main.js"></script>

</head>
<body>

  <div class="frame" role="application" aria-label="Absen Desktop">
    <div class="top">
      <div class="title">
        <h1>Absen</h1>
        <div class="subtitle">Today</div>
      </div>
      <div style="display:flex;align-items:center;gap:12px">
        <div class="avatar" title="profile"></div>
      </div>
    </div>

    <div class="toolbar">
      <div class="date-picker" title="Calender">
        <div id="todayDesktop"></div>
        <i class='bx bx-calendar'></i>
      </div>

      <div class="legend" aria-hidden="true">
        <div class="item"><span class="dot hadir"></span> Hadir</div>
        <div class="item"><span class="dot izin"></span> Izin</div>
        <div class="item"><span class="dot sakit"></span> Sakit</div>
        <div class="item"><span class="dot dispen"></span> Telat</div>
        <div class="item"><span class="dot alpha"></span> Alpha</div>
      </div>

      <div style="margin-left:auto;display:flex;gap:8px">
        <button class="btn ghost" id="helpBtnDesktop">Help !</button>
        <button class="btn ghost" id="historyToggle">History</button>
      </div>
    </div>

    <div class="search">
      <i class="bx bx-search"></i>
      <input id="searchDesktop" type="text" placeholder="Cari nama siswa..." />
      <div class="count" id="countDesktop">0</div>
    </div>

    <div class="list" id="listDesktop" aria-live="polite">
    </div>

    <div class="footer">
      <div class="count" id="totalDesktop">0 siswa</div>
      <div class="buttons">
        <button class="btn ghost" id="clearBtnDesktop">Kosongkan</button>
        <button class="btn primary" id="submitBtnDesktop">Kirim</button>
      </div>
    </div>
  </div>

  <div class="mobile" role="application" aria-label="Absen Mobile">
    <div class="top">
      <div>
        <h3 style="margin:0">Absen</h3>
        <div class="subtitle" style="font-size:12px">History</div>
      </div>
      <div class="avatar"></div>
    </div>

    <div style="display:flex;gap:8px;align-items:center;margin-bottom:8px">
      <div style="flex:1" class="date-picker">
        <div id="todayMobile"></div>
        <i class="bx bx-calendar"></i>
        <div class="time">
        </div>
      </div>
    </div>

    <div style="display:flex;gap:8px;align-items:center;margin-bottom:8px">
      <div class="legend" style="flex:1">
        <div class="item"><span class="dot hadir"></span> Hadir</div>
        <div class="item"><span class="dot izin"></span> Izin</div>
        <div class="item"><span class="dot sakit"></span> Sakit</div>
        <div class="item"><span class="dot dispen"></span> Telat</div>
        <div class="item"><span class="dot alpha"></span> Alpha</div>
      </div>
      <div style="display: none;" class="count" id="countMobile">0</div>
    </div>

    <div class="search">
      <i class="bx bx-search"></i>
      <input id="searchMobile" type="text" placeholder="Cari Rekap absen..." />
    </div>

    <!-- ! Important dont delete this -->
    <div class="history" id="historyDesktop" style="margin-top:12px;">
      <h4 style="margin:6px 0 8px 0">History</h4>
      <div id="historyListDesktop"></div>
    </div>
    <!--! todo Gak penting tapi gak boleh di hapus -->
    <div style="display: none;" class="list" id="listMobile"></div>
    <div class="footer">
      <div style="font-weight:700;display: none;" id="totalMobile">0 siswa</div>

      <div class="buttons" style="display: none;">
        <button class="btn ghost" id="clearBtnMobile">Kosongkan</button>
        <button class="btn primary" id="submitBtnMobile">Kirim</button>
      </div>
    </div>
    <div style="display: none;" class="history" id="historyMobile" style="display:none;margin-top:12px;">
      <h4 style="margin:6px 0 8px 0">History</h4>
      <div id="historyListMobile"></div>
    </div>
  </div>

  <div id="assistiveTouch">
  </div>
  <div id="assistiveMenu">
    <div class="pointerCur" id="helpBtnMobile">
      <i title="Help" class='bx bx-info-circle'></i><br>
      <span class="isiNav">Help</span>
    </div>
    <div class="back pointerCur" id="logout">
      <i title="Utama" class='bx bx-circle'></i><br>
      <span class="isiNav">Out</span>
    </div>
    <div id="gptToggle" class="pointerCur">
      <i title="Gpt" class='bx bx-exit'></i><br>
    <span class="isiNav">Gpt</span>
</div>

  </div>

  <div class="modal-backdrop" id="modalBackdrop">
    <div class="modal" id="modalContent" role="dialog" aria-modal="true">
    </div>
  </div>

  <script src="absen.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // ketika tombol "History" diklik
      document.getElementById('historyToggle').addEventListener('click', function () {
        (
          fetch.then(response => response.json()) 
        sesponse.json())
        .then(data => {
          let html = `
          <table border="1" cellspacing="0" cellpadding="6" style="width:100%;border-collapse:collapse;text-align:left">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Absen</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
        `;

          data.forEach((siswa, index) => {
            html += `
            <tr>
              <td>${index + 1}</td>
              <td>${siswa.nama}</td>
              <td>${siswa.ke}</td>
              <td>${siswa.keterangan}</td>
            </tr>
          `;
          });

          html += '</tbody></table>';

          document.getElementById('historyListDesktop').innerHTML = html;
        })
        .catch(err => {
          document.getElementById('historyListDesktop').innerHTML = '<p style="color:red;">Gagal memuat data siswa.</p>';
          console.error(err);
        });
    });
});;
  document.getElementById('helpBtnDesktop').addEventListener('click', function() {
    document.getElementById('driverSidebar').classList.add('open');
  });

  document.getElementById('closeDriver').addEventListener('click', function() {
    document.getElementById('driverSidebar').classList.remove('open');
  });

  const logOut = document.getElementById('logout')
  logOut.addEventListener('click', function () {
    if (confirm("Yakin mau logout?")) {
          window.location.href = "../logout.php";
        })
  })
  </script>

</body>

</html>
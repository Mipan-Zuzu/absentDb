<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../loginn.php");
    exit;
}

include '../koneksi.php';

// ambil id dari session atau url
$id_kelas = $_GET['id_kelas'] ?? $_SESSION['id_kelas'] ?? null;

if (!$id_kelas) {
    echo "<p style='color:red;'>ID kelas tidak ditemukan!</p>";
    exit;
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Absen Siswa - Demo</title>

  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style-absen.css">
  <script src="../js/main.js"></script>

  <script>
    // ✅ Ambil ID kelas dari PHP
    const ID_KELAS_SESSION = "<?php echo $_SESSION['id_kelas'] ?? ''; ?>";
    const params = new URLSearchParams(window.location.search);
    const ID_KELAS_URL = params.get("id_kelas");
    const FINAL_ID_KELAS = ID_KELAS_URL || ID_KELAS_SESSION;

    console.log("🟢 FINAL_ID_KELAS:", FINAL_ID_KELAS);
  </script>
</head>

<body>
  <div class="frame" role="application" aria-label="Absen Desktop">
    <div class="top">
      <div class="title">
        <h1>Absen</h1>
        <div class="subtitle">Today</div>
      </div>
      <div style="display:flex;align-items:center;gap:12px">
        <div><h1 style="font-size: 15px; color: green;" id="user"></h1></div>
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

    <div class="list" id="listDesktop" aria-live="polite"></div>

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
        <div class="time"></div>
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

    <div class="history" id="historyDesktop" style="margin-top:12px;">
      <h4 style="margin:6px 0 8px 0">History</h4>
      <div id="historyListDesktop"></div>
    </div>

    <div style="display: none;" class="list" id="listMobile"></div>

    <div class="footer">
      <div style="font-weight:700;display: none;" id="totalMobile">0 siswa</div>
      <div class="buttons" style="display: none;">
        <button class="btn ghost" id="clearBtnMobile">Kosongkan</button>
        <button class="btn primary" id="submitBtnMobile">Kirim</button>
      </div>
    </div>
  </div>

  <div id="assistiveTouch"></div>
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
    <div class="modal" id="modalContent" role="dialog" aria-modal="true"></div>
  </div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const ID_KELAS_URL = params.get("id_kelas");
    const ID_KELAS_SESSION = "<?php echo isset($_SESSION['id_kelas']) ? $_SESSION['id_kelas'] : ''; ?>";
    const FINAL_ID_KELAS = ID_KELAS_URL || ID_KELAS_SESSION || null;

    console.log("🟢 FINAL_ID_KELAS:", FINAL_ID_KELAS);
    console.log("🌐 URL ID:", ID_KELAS_URL, "| 💾 Session ID:", ID_KELAS_SESSION);

    if (!FINAL_ID_KELAS) {
      document.getElementById('listDesktop').innerHTML =
        `<p style="color:red;">⚠️ ID kelas tidak ditemukan.</p>`;
      return;
    }

    const fetchURL = `getSiswa.php?id_kelas=${FINAL_ID_KELAS}`;
    console.log("📡 Fetch URL:", fetchURL);

    fetch(fetchURL)
      .then(res => res.json())
      .then(data => {
        console.log("📦 Raw response:", data);

        if (!Array.isArray(data)) {
          console.error("❌ Data bukan array:", data);
          document.getElementById('listDesktop').innerHTML =
            `<p style="color:red;">⚠️ Format data salah / tidak ditemukan siswa.</p>`;
          return;
        }

        const list = document.getElementById('listDesktop');
        list.innerHTML = "";

        data.forEach((siswa, i) => {
          const item = document.createElement("div");
          item.className = "student";
          item.innerHTML = `
            <div class="avatar"></div>
            <div class="info">
              <div class="name">${siswa.nama_siswa}</div>
              <div class="class">NIS: ${siswa.nis}</div>
            </div>
          `;
          list.appendChild(item);
        });

        document.getElementById('totalDesktop').innerText = `${data.length} siswa`;
        console.log(`✅ Berhasil memuat ${data.length} siswa.`);
      })
      .catch(err => {
        console.error("❌ Fetch error:", err);
        document.getElementById('listDesktop').innerHTML =
          `<p style="color:red;">⚠️ Gagal memuat data siswa. Periksa koneksi atau path file.</p>`;
      });
  });
</script>



</body>
</html>
 
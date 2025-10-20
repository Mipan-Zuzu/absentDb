<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Rekap</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }
    body {
      display: flex;
      background: #f9f9f9;
      color: #333;
    }

    /* Sidebar */
    .sidebar {
  width: 100px;
  background: #fff;
  height: 100vh;
  border-right: 1px solid #ddd;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 30px 0;
  justify-content: space-between;
  gap: 0;
    }
    .sidebar i {
      font-size: 24px;
      color: #333;
      cursor: pointer;
    }

    /* Main */
    .main {
      flex: 1;
      padding: 20px;
    }

    /* Header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .weather {
      font-size: 30px;
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 20px 25px;
      border-radius: 10px;
      font-size: 14px;
    }
    .time {
      background: #f4ede3;
      padding: 15px 35px;
      border-radius: 25px;
      font-weight: bold;
      font-size: 20px;
    }
    .profile {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .profile img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }
    .profile-info {
      font-size: 13px;
    }
    .status-online {
      color: green;
      font-size: 12px;
      font-weight: bold;
    }

    /* Table */
    .table {
      margin-top: 20px;
      background: #fff;
      border-radius: 10px;
      padding: 15px;
    }
    .table-header {
      display: flex;
      justify-content: space-between;
      padding: 10px;
      font-weight: bold;
      border: 0.5px solid gray;
      border-radius: 8px;
    }
    .row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #f6eee4;
      border: 1px solid #333;
      margin-top: 10px;
      padding: 10px;
      border-radius: 8px;
      font-size: 14px;
  }
  .status-dot {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 8px;
    vertical-align: middle;
  }
  .dot-done { background: green; }
  .dot-pending { background: orange; }
  .dot-null { background: red; }
    }
    .status {
      font-size: 12px;
      font-weight: bold;
      padding: 4px 8px;
      border-radius: 5px;
    }
    .done { color: green; }
    .pending { color: orange; }
    .null { color: red; }

    /* Rekap */
    .rekap {
      margin-top: 20px;
      background: #fff;
      border-radius: 10px;
      padding: 15px;
    }
    .rekap-title {
      font-weight: bold;
      margin-bottom: 10px;
    }
    .rekap-bar {
      display: flex;
      align-items: center;
      justify-content: space-around;
    }
    .rekap-item {
      text-align: center;
    }
    .rekap-item i {
      font-size: 28px;
    }
    .rekap-item span {
      display: block;
      font-size: 13px;
      margin-top: 5px;
    }
    .green { color: green; }
    .orange { color: orange; }
    .grey { color: grey; }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div style="display: flex; flex-direction: column; gap: 40px; align-items: center;">
      <i class='bx bx-home'></i>
      <i class='bx bx-book'></i>
      <i class='bx bx-user'></i>
      <i class='bx bx-notepad'></i>
    </div>
    <div style="display: flex; flex-direction: column; gap: 18px; align-items: center; margin-bottom: 10px;">
      <i class='bx bx-bell'></i>
      <i class='bx bx-cog'></i>
    </div>
  </div>

  <!-- Main -->
  <div class="main">
    <!-- Header -->
    <div class="header">
      <div style="font-size:20px; font-weight: bold;" class="weather">
        <i style="font-size: 25px;" class='bx bx-cloud'></i> <span>Berawan 24°</span>
      </div>
      <div class="time">09:12</div>
      <div class="profile">
        <img src="https://randomuser.me/api/portraits/men/10.jpg" alt="profile">
        <div class="profile-info">
          <strong>Mipan Zuz</strong><br>
          <span class="status-online">● ONLINE</span>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="table">
      <div class="table-header">
        <span>KELAS</span>
        <span>TANGGAL</span>
        <span>STATUS</span>
      </div>

      <div class="row">
  <span><span class="status-dot dot-done"></span>REKAYASA PERANGKAT LUNAK</span>
  <span>28/November/2025</span>
  <span class="status done">DONE</span>
      </div>
      <div class="row">
  <span><span class="status-dot dot-pending"></span>DESIGN KOMUNIKASI VISUAL</span>
  <span>28/November/2025</span>
  <span class="status pending">PENDING</span>
      </div>
      <div class="row">
  <span><span class="status-dot dot-done"></span>SENI PATUNG</span>
  <span>28/November/2025</span>
  <span class="status done">DONE</span>
      </div>
      <div class="row">
  <span><span class="status-dot dot-null"></span>SENI LUKIS</span>
  <span>28/November/2025</span>
  <span class="status null">NULL</span>
      </div>
      <div class="row">
  <span><span class="status-dot dot-done"></span>TEKNIK KOMPUTER JARINGAN</span>
  <span>28/November/2025</span>
  <span class="status done">DONE</span>
      </div>
    </div>

    <!-- Rekap -->
    <div class="rekap">
      <div class="rekap-title">REKAPAN HARI INI</div>
      <div class="rekap-bar">
        <div class="rekap-item green">
          <i class='bx bx-check-circle'></i>
          <span>HADIR 80%</span>
        </div>
        <div class="rekap-item orange">
          <span style="font-size:22px;font-weight:bold;">2</span>
          <span>PENDING</span>
        </div>
        <div class="rekap-item grey">
          <i class='bx bx-circle'></i>
          <span>NULL</span>
        </div>
        <div class="rekap-item grey">
          <i class='bx bx-circle'></i>
          <span>NULL</span>
        </div>
      </div>
    </div>
  </div>

</body>
</html>

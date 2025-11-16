<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="plugin/boxicons/boxicons.min.css" />
    <link rel="stylesheet" href="plugin/aos/aos.css" />
    <link rel="stylesheet" href="style/style-index.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/daisyui@5"
      rel="stylesheet"
      type="text/css"
    />
    <title>SMSR</title>
    <link rel="icon" href="asset/logo.png" sizes="64x64" type="image/png" />
  </head>
  <style>
  #intro-logo {
    position: relative;
    width: 100%;
    height: 300px;
    overflow: hidden;
    margin: 0 auto;
  }
  .floating-box {
    position: absolute;
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.15);
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.12);
    animation: floatMove 8s infinite alternate ease-in-out;
    pointer-events: none;
  }
  @keyframes floatMove {
    0% { transform: translateY(0) translateX(0); }
    20% { transform: translateY(-20px) translateX(20px); }
    40% { transform: translateY(20px) translateX(-20px); }
    60% { transform: translateY(-10px) translateX(10px); }
    80% { transform: translateY(10px) translateX(-10px); }
    100% { transform: translateY(0) translateX(0); }
  }
    @font-face {
      font-family: "Poppins";
      src: url("/asset/tx/Poppins-Regular.ttf") format("truetype");
      font-weight: normal;
      font-style: normal;
    }
    * {
      font-family: "Poppins", sans-serif;
    }
    body {
      overflow-x: hidden;
    }
    .hero-section {
      position: relative;
      width: 100vw;
      height: 100vh;
      overflow: hidden;
    }
    .bg-video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 1;
    }
    .hero-content {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: center;
      height: 100vh;
      padding: 3rem;
      color: #fff;
    }
    .logo {
      width: 120px;
      margin-bottom: 2rem;
    }
    .navbar {
      display: flex;
      gap: 2rem;
      margin-bottom: 2rem;
    }
    .navbar a {
      color: #fff;
      font-weight: bold;
      text-decoration: none;
    }
    h1 {
      font-size: 3rem;
      margin-bottom: 1rem;
    }
    p {
      font-size: 1.2rem;
      margin-bottom: 2rem;
    }
    .learn-more {
      color: #fff;
      font-weight: bold;
      text-decoration: none;
    }
    .boxicons-menu {
      display: flex;
      gap: 1rem;
      margin-top: 2rem;
    }
    .icon-box {
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      font-size: 2rem;
    }
    .icon-box.yellow {
      background: #ffe066;
    }
    .icon-box.blue {
      background: #4dabf7;
    }
    .icon-box.green {
      background: #51cf66;
    }
    .icon-box.orange {
      background: #ffa94d;
    }
    .dark-light {
      position: absolute;
      top: 0;
      right: 0;
      z-index: 10;
    }
  </style>
  <body>
    <section class="hero-section">
      <div
        title="dark-light"
        class="dark-light flex justify-end justify-self-end z-50 mr-2"
      >
        <div class="mt-3 mr-3">
          <label class="swap swap-rotate">
            <input type="checkbox" class="theme-controller" value="synthwave" />

            <svg
              class="swap-off h-10 text-amber-300 w-10 fill-current"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
            >
              <path
                d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"
              />
            </svg>

            <svg
              class="swap-on h-10 text-white w-10 fill-current"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
            >
              <path
                d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"
              />
            </svg>
          </label>
        </div>
      </div>
      <video
  id="bgVideo"
  class="bg-video"
  autoplay
  loop
  muted
  playsinline
>
  <source src="asset/vidBackgroudn.mp4" type="video/mp4" />
</video>
      <div class="hero-content">
        <div
          class="logo-row"
          style="display: flex; align-items: center; gap: 16px"
        >
          <img src="asset/logo.png" alt="Logo" class="logo" />
          <span
            class="logo-tex"
            style="
              font-size: 2.5rem;
              font-weight: bold;
              color: #ffffff;
              letter-spacing: 2px;
            "
            >SMSR <br />
          </span>
        </div>
        <p>
          <span class="font-bold text-xl">COBA !</span> <br />
          <span data-aos="fade-right" class="smText text-6xl font-extrabold dark-bg-text"
            >Semua Sistem dalam <br />
            Satu website <i class="bx bx-link"></i>
          </span>
        </p>
        <div data-aos="fade-up" class="custom-bottom-border"></div>
        <p data-aos="fade-up" class="moto">
          Semua sistem dalam satu website<em> Untuk </em> Siswa , guru SMSR<br />
          Mempermudah manage sistem secara otomatis.
        </p>
        <a  class="learn-more"
          >Menerapkan sistem (CRUD) <i class="bx bx-right-arrow-alt"></i></a>
  <div onclick="login()" style="width:100%;display:flex;justify-content:flex-start;margin-top:10px;">
          <a class="no-username-btn shiny-button" style="min-width:180px;max-width:320px;width:100%;text-align:center;display:inline-block;font-size:1.2rem;padding:14px 0;box-shadow:0 4px 16px rgba(0,0,0,0.12);">
            Login Sekarang
          </a>
        </div>
        <div class="boxicons-menu">
          <div title="Create" class="icon-box yellow cursor-pointer" onclick="showCard('pencil')"><i class="bx bx-pencil cursor-pointer"></i></div>
          <div title="Read" class="icon-box blue cursor-pointer" onclick="showCard('book')"><i class="bx bx-book"></i></div>
          <div title="Update" class="icon-box green cursor-pointer" onclick="showCard('refresh')"><i class="bx bx-refresh"></i></div>
          <div title="Delete" class="icon-box orange cursor-pointer" onclick="showCard('trash')"><i class="bx bx-trash"></i></div>
        </div>
        <div id="card-container" class="card-container" style="display:none;"></div>
        </div>
      </div>
    </section>

    <div class="abaout mt-32">
    <div class="jis-section">
  <div class="jis-nav">
    <a  class="active">Admissions</a>
  </div>

  <div class="jis-content">
    <h2 class="jis-title">Misi SMSR</h2>
    <p class="jis-desc">
      SMSR mengambil langkah pertama dengan merubah 
      sistem input di sekolah menjadi digital.
    </p>
    <a href="#" class="jis-link">Selebih nya →</a>
  </div>
</div>
</div>

<div class="fitur-sekolah">
  <a href="./mpk/absen.php" class="fitur-card">
    <i class='bx bx-calendar-check'></i>
    <h3>Absensi</h3>
    <p>Mencatat kehadiran siswa secara cepat dan akurat.</p>
  </a>

  <div class="fitur-card">
    <i class='bx bx-book'></i>
    <h3>Jurnal Kelas</h3>
    <p>Mengelola catatan kegiatan belajar mengajar harian.</p>
  </div>

  <div class="fitur-card">
    <i class='bx bx-credit-card'></i>
    <h3>Pembayaran SPP</h3>
    <p>Memudahkan proses pembayaran SPP secara online.</p>
  </div>
</div>

  <h1 class="text-center">Ask With AI</h1>
  <h2 id="output" class="text-gray-800 text-center">Hai Users, apa yang ingin anda sampaikan</h2>

  <div class="inputs">
   <div class="input-wrapper">
    <input id="inputss" type="text" placeholder="sampaikan sesuatu ...">
    <button onclick="calls()">Go</button>
  </div>
  </div>

        <footer class="footer">
  <div class="footer-left">
    <img src="asset/logo.png" alt="Logo" class="footer-logo">
    <span>© 2025 SMSR.</span>
  </div>

  <div class="footer-right">
    <a href="#">Privacy</a>
    <a href="#">Security</a>
    <a href="#">Status</a>
    <a href="#">Docs</a>
    <a href="#">Contact</a>
  </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="plugin/aos/aos.js"></script>
    <script>
  const video = document.getElementById("bgVideo");

  const intervalPause = 7000; 
  const intervalResume = 7000; 

  setInterval(() => {
    if (!video.paused) {
      video.pause(); 
      setTimeout(() => {
        video.play();
      }, intervalResume);
    }
  }, intervalPause);
</script>
    <script>
      AOS.init({});
    </script>
    <script src="plugin/typedjs/typed.umd.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>

<!DOCTYPE html> 
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login SMSR</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="icon" href="asset/logo.png" sizes="64x64" type="image/png" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      height: 100%;
      margin: 0;
    }

    .bubble {
      position: absolute;
      bottom: -100px;
      border-radius: 50%;
      opacity: 0.6;
      z-index: 100;
      animation: rise 12s infinite ease-in;
    }

    @keyframes rise {
      0% {
        transform: translateY(0) scale(1);
        opacity: 0.6;
      }

      100% {
        transform: translateY(-800px) scale(1.3);
        opacity: 0;
      }
    }

    .test {
      display: none;
      background-color: blue;
      padding: 30px;
    }

    .shine {
      position: relative;
      overflow: hidden;
      transition: all 0.5s ease-out;
    }

    .shine:hover {
      background-color: salmon;
      transition: all 0.5s ease-in-out;
    }

    .shine::before {
      content: "";
      position: absolute;
      top: 0;
      left: -75%;
      width: 50%;
      height: 100%;
      background: linear-gradient(120deg,
          rgba(255, 255, 255, 0.4) 0%,
          rgba(255, 255, 255, 0) 80%);
      animation: shine 2.5s infinite;
    }

    @media (max-width: 640px) {
      body{
        over
      }

      #heroImage {
        width: 300px !important;
        max-width: 70%;
      }
      .card-login-mobile {
    transform: translateY(0px);
  }
    }

    .card-login-mobile {
  background: rgba(255,255,255,0.8); /* ada transparansi */
  backdrop-filter: blur(6px); /* efek kaca */
}




    @keyframes shine {
      100% {
        left: 125%;
      }
    }

    /* Container popup */
    .popup {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: linear-gradient(135deg, rgba(244, 67, 54, 0.4), #ffff, #fff, #fff);
      border-radius: 10px;
      border-radius: 50px;
      display: flex;
      align-items: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      padding: 13px 25px;
      min-width: 260px;
      color: #000;
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.4s ease;
    }

    .popup.show {
      opacity: 1;
      transform: translateY(0);
    }

    .popup i {
      font-size: 26px;
      margin-right: 12px;
      color: #000;
    }

    .popup .text {
      flex-grow: 1;
    }

    .popup .text h4 {
      margin: 0;
      font-size: 16px;
      font-weight: bold;
      color: #000;
    }

    .popup .text p {
      margin: 2px 0 0;
      font-size: 13px;
      color: #000;
    }

    .popup .close {
      cursor: pointer;
      font-size: 20px;
      margin-left: 10px;
      color: #000;
    }

    .popup .close:hover {
      color: #000;
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100 relative">

      <!-- container bubble -->
  <div class="absolute inset-0 overflow-hidden -z-10">
    <div class="bubble w-20 h-20 bg-yellow-200" style="left: 10%; animation-delay: 0s;"></div>
    <div class="bubble w-16 h-16 bg-pink-200" style="left: 30%; animation-delay: 3s;"></div>
    <div class="bubble w-24 h-24 bg-gray-200" style="left: 60%; animation-delay: 6s;"></div>
    <div class="bubble w-14 h-14 bg-orange-200" style="left: 80%; animation-delay: 9s;"></div>
  </div>


  <div
    class="bg-white shadow-xl rounded-2xl flex flex-col md:flex-row overflow-hidden w-full max-w-5xl card-login-mobile">

    <div class="flex flex-1 items-center justify-center bg-white p-6 relative">
      <img id="heroImage" src="asset/Dictionary-pana.png" alt="Person" class="w-60 md:w-80 transition-all duration-500">
    </div>

    <div class="flex-1 p-8 flex flex-col justify-center">
      <h2 style="color:#6E4C4C;" class="text-3xl font-bold  mb-2 transition-all duration-500">
        Sign In <span id="brandText">Mpk</span>
      </h2>
      <p class="text-gray-500 mb-6">Masukan User Name & Password Valid</p>


      <form action="proses_login.php" method="post">

        <!-- username -->
        <div class="flex items-center border rounded-lg px-3 py-2 mb-4">
          <i class='bx bx-user text-gray-400 mr-2'></i>
          <input type="text" name="username" placeholder="User Name" class="w-full outline-none" required>
        </div>

        <!-- pasword -->
        <div class="flex items-center border rounded-lg px-3 py-2 mb-2">
          <i class='bx bx-lock-alt text-gray-400 mr-2'></i>
          <input type="password" name="password" placeholder="Password" class="w-full outline-none" required>
        </div>
        <a href="#" class="text-sm text-orange-500 mb-4 inline-block">Forgot Password?</a>

        <button type="submit" class="shine bg-orange-400 text-white font-semibold py-3 rounded-lg w-full mb-6">
          Login
        </button>

      </form>


      <p class="text-gray-600 mb-3">Pilih Login Sebagai</p>
      <div class="flex gap-4 justify-center">
        <button onclick="changeRole('asset/Dictionary-pana.png','Mpk')" class="flex flex-col items-center">
          <i title="Mpk" class='bx bx-desktop text-3xl bg-orange-100 p-3 rounded-lg'></i>
        </button>
        <button onclick="changeRole('asset/parents.png','ortu')" class="flex flex-col items-center">
          <i title="ortu" class='bx bx-group text-3xl bg-orange-100 p-3 rounded-lg'></i>
        </button>
        <button onclick="changeRole('asset/teacher.png','guru')" class="flex flex-col items-center">
          <i title="guru" class='bx bxs-graduation text-3xl bg-orange-100 p-3 rounded-lg'></i>
        </button>
      </div>


      <p class="text-sm text-gray-500 mt-6">
        Mendapati error kontak <a href="#" class="text-blue-600">admin</a>
      </p>
    </div>
  </div>

  <div id="popup" class="popup">
    <i style="color: red;" class='bx bx-message-x'></i>
    <div class="text">
      <h4>Login gagal</h4>
      <p>Please type again later</p>
    </div>
    <i class='bx bx-x close' onclick="closePopup()"></i>
  </div>



  <script>
    function changeRole(img, text) {
      const hero = document.getElementById("heroImage");
      const brand = document.getElementById("brandText");

      hero.classList.add("opacity-0", "scale-90");
      setTimeout(() => {
        hero.src = img;
        brand.innerText = text;
        hero.classList.remove("opacity-0", "scale-90");
        hero.classList.add("zoom-in", "opacity-100", "scale-100");
        setTimeout(() => {
          hero.classList.remove("zoom-in");
        }, 500);
      }, 300);
    }


    function closePopup() {
      const popup = document.getElementById("popup");
      popup.classList.remove("show");
    }
  </script>

</body>

</html>
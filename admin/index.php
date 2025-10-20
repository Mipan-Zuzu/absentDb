<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="navbar bg-base-100 shadow-sm">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">SSRI</a>
        </div>
        <div class="drawer">
            <input id="my-drawer-1" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">

                <label for="my-drawer-1" class="drawer-button cursor-pointer"><img src="../asset/sidebar.png"
                        alt=""></label>
            </div>
            <div class="drawer-side">
                <label for="my-drawer-1" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu bg-base-200 min-h-full w-55 p-4">
                    <div class="flex text-2xl gap-2 mb-5">
                        <img width="30" height="30" src="../asset/logo.png" alt="">
                        <h1 class="text-xl">Side <span class="">Bar</span></h1>
                    </div>
                    <div>
                        <ul class="text-1xl">
                            <li class="mb-2">
                                <a class="justify-between">
                                    Profile
                                    <span class="badge">New</span>
                                </a>
                            </li>
                            <li class="mb-1">
                                <a onclick="my_modal_2.showModal()" class=" justify-between">
                                    <i class="bx bx-bell"> Nontifikasi</i>
                                </a>
                            </li>
                            <li class="mb-5">
                                <a href="index.php" class="justify-between">
                                    <i class="bx bx-home"> Home</i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <ul class="text-1xl">
                            <li class="mb-2">Page</li>
                            <li>
                                <details class="dropdown">
                                    <summary class="m-1">Siswa X</summary>
                                    <ul class="menu dropdown-content bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                                        <li><a href="index.php?page=kelas&nama_kelas=10%20RPL">X RPL</a></li>
                                        <li><a>X TKJ</a></li>
                                        <li><a>X SR</a></li>
                                        <li><a>X PATUNG</a></li>
                                        <li><a>X DITF</a></li>
                                        <li><a>X DKV I</a></li>
                                        <li><a>X DKV II</a></li>
                                        <li><a>X KRIYA</a></li>
                                    </ul>
                                </details>
                            </li>
                            <li>
                                <details class="dropdown">
                                    <summary class="m-1">Siswa XI</summary>
                                    <ul class="menu dropdown-content bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                                        <li><a>XI RPL</a></li>
                                        <li><a>XI TKJ</a></li>
                                        <li><a>XI SR</a></li>
                                        <li><a>XI PATUNG</a></li>
                                        <li><a>XI DITF</a></li>
                                        <li><a>XI DKV I</a></li>
                                        <li><a>XI DKV II</a></li>
                                        <li><a>XI KRIYA</a></li>
                                    </ul>
                                </details>
                            </li>
                            <li class="mb-1">
                                <a href="index.php?page=guru" class="justify-between">
                                    Guru
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="index.php?page=pegawai" class="justify-between">
                                    Pegawai
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="index.php?page=siswa" class="justify-between">
                                    Siswa
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="index.php?page=jurusan" class="justify-between">
                                    Jurusan
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="index.php?page=mpk" class="justify-between">
                                    Mpk
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="index.php?page=pembayaran" class="justify-between">
                                    Pembayaran
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="index.php?page=kelas" class="justify-between">
                                    Kelas
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="index.php?page=absen" class="justify-between">
                                    Absensi
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="index.php?page=jurnal" class="justify-between">
                                    Jurnal
                                </a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
        <div class="flex gap-2">
            <input type="text" placeholder="Search" class="input rounded-2xl input-bordered w-24 md:w-auto" />
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component"
                            src="../asset/sizu.jpeg" />
                    </div>
                </div>
                <ul tabindex="-1"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    <li>
                        <a onclick="openDrawer()" class="justify-between">
                            Gpt 4.0
                            <span class="badge">New</span>
                        </a>
                    </li>
                    <li><a href="index.php?page=setting" >Settings</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <dialog id="my_modal_2" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Nontifikasi</h3>
            <p class="py-4">There no Nontification /:</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>

    <div class="drawer-side">
        <label onclick="closeDrawer()" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 min-h-full w-80 p-4">
            <li><a>Sidebar Item 1</a></li>
            <li><a>Sidebar Item 2</a></li>
        </ul>
    </div>
    </div>

    <!-- Drawer kanan (AI Drawer) -->
<div class="drawer drawer-end z-50 fixed inset-0 pointer-events-none">
  <input id="drawerToggle" type="checkbox" class="drawer-toggle" />
  <div class="drawer-side pointer-events-auto">
    <label onclick="closeDrawer()" class="drawer-overlay"></label>
    <ul class="menu bg-base-200 min-h-full w-96 p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">AI Chat</h2>
        <button onclick="closeDrawer()" class="btn btn-sm btn-ghost">✕</button>
      </div>
      <div class="flex flex-col gap-3">
        <div id="result" class="bg-white p-3 rounded-lg shadow-sm border">Halo! Ada yang bisa saya bantu?</div>
        <div class="flex mt-4">
          <input id="input" type="text" placeholder="Ketik pesan..." class="input input-bordered flex-1 rounded-l-lg" />
          <button class="btn btn-primary rounded-r-lg"><i class='bx bx-send'></i></button>
        </div>
      </div>
    </ul>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>

</html>



<div class="badan">
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {
            case 'home':
                include "home.php";
                break;
            case 'guru':
                include "guru.php";
                break;
            case 'pegawai':
                include "pegawai.php";
                break;
            case 'jurusan':
                include "jurusan.php";
                break;
            case "kelas":
                include "kelas.php";
                break;
            case "pembayaran":
                include "pembayaran.php";
                break;
            case "siswa":
                include "siswa.php";
                break;
            case "mpk":
                include "mpk.php";
                break;
            case "jurnal":
                include "jurnal.php";
                break;
            case "absen":
                include "absen.php";
                break;
            case "setting":
                include "setting.php";
                break;
            case "pengaturan":
                echo "<h3>Halaman Pengaturan</h3>";
                break;
            default:
                echo "<center><h3>Maaf, halaman tidak ditemukan</h3></center>";
        }
    } else {
        include "home.php";
    }

    //!IMportant 
    if (isset($_GET['nama_kelas'])) {
        $nama_kelas = $_GET['nama_kelas'];
    }

    ?>
</div>
<script src="main.js"></script>
<script>
    function openDrawer() {
        document.getElementById("drawerToggle").checked = true;
    }

    function closeDrawer() {
        document.getElementById("drawerToggle").checked = false;
    }

    const input = document.getElementById('input').value
    const result = document.getElementById('result')

    fetch(`https://api.nazirganz.space/api/ai/chatgpt?text=hi`)
  .then(response => response.json())
  .then(result => {
    console.log(result)
  })
  .catch(error => console.log('error', error))



</script>
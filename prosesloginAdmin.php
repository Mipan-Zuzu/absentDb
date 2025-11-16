<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']); 

$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$query = mysqli_query($koneksi, $sql);
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    $_SESSION['username'] = $data['username'];
    $_SESSION['login'] = true;

    echo "<script>
        window.location.href = 'admin/index.php';
    </script>";
} else {
    echo "<script>
        alert('Login gagal! Username atau password salah.');
        window.location.href = 'adminLogin.php';
    </script>";
}
?>


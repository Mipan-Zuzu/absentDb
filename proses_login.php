<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']); 

$sql = "SELECT * FROM mpk WHERE username='$username' AND password='$password'";
$query = mysqli_query($koneksi, $sql);
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    $_SESSION['username'] = $data['username'];
    $_SESSION['id_kelas'] = $data['id_kelas'];
    $_SESSION['login'] = true;

    $id_kelas = $data['id_kelas'];
    echo "<script>
        alert('Login berhasil! Selamat datang, {$data['username']}');
        window.location.href = 'mpk/absen.php?id_kelas={$id_kelas}';
    </script>";
} else {
    echo "<script>
        alert('Login gagal! Username atau password salah.');
        window.location.href = 'loginn.php';
    </script>";
}
?>


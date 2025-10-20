<?php
session_start();
include '../koneksi.php';
include 'login.php';

$username = $_POST['username'];
$password = md5($_POST['password']);


$sql = "SELECT * FROM mpk WHERE username='$username' AND password='$password'";

$query = mysqli_query($koneksi, $sql);
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    //simpan session
    $_SESSION['username'] = $data['username'];
    $_SESSION['login'] = true;
    header("Location: halamanutama.php");

    echo "<script>
        alert('Login Berhasil');
        window.location.href = 'abesen.php';
        </script>";
} else {
    echo "<script>
    popup.classList.add('show');
        setTimeout(()=>{
        window.location.href = 'loginn.php';
        },2000)
        </script>";

}
?>
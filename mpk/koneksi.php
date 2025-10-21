<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "smsr_siskom";

    $koneksi = new mysqli($host, $user, $pass, $db);

    if($koneksi->connect_error) {
        die("koneksi gagal cok ". $koneksi->connect_error);
    }
?>  
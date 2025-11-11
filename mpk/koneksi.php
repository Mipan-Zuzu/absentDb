<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "smsr_siskom";

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    http_response_code(500);
    exit();  
}
?>
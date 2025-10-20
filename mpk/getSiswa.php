<?php
include "koneksi.php";

$sql = "SELECT siswa.*, kelas.nama_kelas 
        FROM siswa  
        JOIN kelas ON siswa.id_kelas = kelas.id_kelas";
$result = $koneksi->query($sql);

if(!$result){
    http_response_code(500);
    echo json_encode(["error" => $koneksi->error]);
    exit;
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        "id" => $row["id_siswa"],
        "name" => $row["nama_siswa"],
        "profile" => "Kelas " . $row["nama_kelas"]
    ];
}

header("Content-Type: application/json");
echo json_encode($data);

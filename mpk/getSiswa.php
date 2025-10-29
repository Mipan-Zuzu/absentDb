<?php
header('Content-Type: application/json');
include './koneksi.php'; // atau sesuaikan path

$id_kelas = $_GET['id_kelas'] ?? null;

if (!$id_kelas) {
  echo json_encode(["error" => "ID kelas tidak dikirim"]);
  exit;
}

$query = "SELECT * FROM siswa WHERE id_kelas = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_kelas);
$stmt->execute();
$result = $stmt->get_result();

$siswa = [];
while ($row = $result->fetch_assoc()) {
  $siswa[] = $row;
}

echo json_encode($siswa);

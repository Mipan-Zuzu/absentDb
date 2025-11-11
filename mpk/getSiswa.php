<?php
session_start();
header('Content-Type: application/json');
include './koneksi.php'; 

// Ambil id_kelas dari session
$id_kelas = $_SESSION['id_kelas'] ?? null;

if (!$id_kelas) {
  echo json_encode(["error" => "ID kelas tidak ditemukan di session"]);
  exit;
}

// Query ambil siswa sesuai kelas dari session
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

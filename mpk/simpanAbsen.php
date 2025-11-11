<?php
ob_clean();
header("Content-Type: application/json; charset=utf-8");
session_start();
date_default_timezone_set("Asia/Jakarta");

error_reporting(E_ALL);
ini_set("display_errors", 0); // cegah HTML error keluar

include "./koneksi.php";

// Baca JSON
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!$data || !isset($data["data"])) {
    echo json_encode([
        "status" => "error",
        "message" => "Payload tidak valid",
        "raw" => $raw
    ]);
    exit;
}

$absenList = $data["data"];
$tanggal = date("Y-m-d");

// Validate connection
if ($conn->connect_errno) {
    echo json_encode([
        "status" => "error",
        "message" => "Database Error: " . $conn->connect_error
    ]);
    exit;
}

// Validate table structure
$query = "
    INSERT INTO absen (id_siswa, tgl_absensi, keterangan)
    VALUES (?, ?, ?)
";

$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode([
        "status" => "error",
        "message" => "Prepare failed: " . $conn->error
    ]);
    exit;
}

foreach ($absenList as $absen) {
    $id_siswa = (int)$absen["id_siswa"];
    $ket = $absen["keterangan"];

    if (!$stmt->bind_param("iss", $id_siswa, $tanggal, $ket)) {
        echo json_encode([
            "status" => "error",
            "message" => "Bind error: " . $stmt->error
        ]);
        exit;
    }

    if (!$stmt->execute()) {
        echo json_encode([
            "status" => "error",
            "message" => "Execute error: " . $stmt->error
        ]);
        exit;
    }
}

echo json_encode([
    "status" => "ok",
    "message" => "Absensi berhasil disimpan"
]);

exit;

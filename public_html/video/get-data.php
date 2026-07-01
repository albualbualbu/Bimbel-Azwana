<?php

// 1. Set Header agar browser mengenali ini sebagai JSON
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *"); // Mengizinkan akses dari domain mana saja (CORS)

// 2. Konfigurasi Database
include "../penghubung.php";

// Cek Koneksi
if ($con->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi database gagal"]);
    exit;
}

// 3. Ambil Parameter dari Request (Frontend)
// 'page' adalah halaman ke berapa, 'limit' adalah jumlah data per load
$page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; 
$offset = ($page - 1) * $limit;

// Gunakan JOIN agar tidak perlu query lagi di dalam while
$sql = "SELECT * 
        FROM `video` 
        ORDER BY `id` DESC LIMIT ? OFFSET ? ";

$stmt = $con->prepare($sql);

// Angka 0 jangan pakai tanda kutip jika kolomnya INT
// i = integer
$publish_status = 0; 
$stmt->bind_param("ii", $limit, $offset);

$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        "judul"          => $row['judul'],
        "filename"       => $row['filename']
    ];
}

// 5. Kirim Response
if (count($data) > 0) {
    echo json_encode($data);
} else {
    // Jika tidak ada data lagi, kirim array kosong
    echo json_encode([]);
}

$stmt->close();
$con->close();
?>
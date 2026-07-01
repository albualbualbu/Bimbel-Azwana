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
        FROM `berita` 
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
    $judul_sub = mb_substr($row['judul'], 0, 50);
    $judul = strip_tags($judul_sub);
    $isi_p = mb_substr($row['isi'], 0, 50);
    $isi_p2 = strip_tags($isi_p);
    $gambar = $row['gambar'];
    $url = $row['url'];
    $data[] = [
        "gambar"    => $gambar,
        "url"       => $url,
        "judul"     => $judul,
        "isi"       => $isi_p2
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
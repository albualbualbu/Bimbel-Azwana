<?php
header('Content-Type: application/json');

include "../penghubung.php";

// Set zona waktu ke Asia/Jakarta
date_default_timezone_set('Asia/Jakarta');

// Cek koneksi
if ($con->connect_error) {
    die("Koneksi gagal: " . $con->connect_error);
}

// Mendapatkan tanggal dari query string (jika ada)
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;

// Query untuk mengambil data dari tabel 'date' berdasarkan rentang tanggal
$query = "SELECT date, value FROM date WHERE 1";

// Menambahkan kondisi tanggal jika ada
if ($startDate && $endDate) {
    $query .= " AND date BETWEEN '$startDate' AND '$endDate'";
}

$result = $con->query($query);

$data = array();

// Fetch data dari database
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Menutup koneksi database
$con->close();

// Mengembalikan data dalam format JSON
echo json_encode($data);
?>

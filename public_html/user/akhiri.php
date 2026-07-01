<?php
session_start();
include "../penghubung.php";

$parent_id = $_GET['id_c'];
$aktif_id = $_GET['id_a'];

$awal = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `aktif` WHERE `id`='$aktif_id'"));

date_default_timezone_set('Asia/Jakarta');

// Membuat objek DateTime untuk waktu sekarang
$currentTime = new DateTime(); 
$mulai = new DateTime($awal['mulai']); 
$selesai = new DateTime($awal['selesai']); 
$sekarang = $currentTime->format('Y-m-d H:i:s');

if($currentTime > $selesai){
    $currentTime = new DateTime($awal['selesai']); 
    $sekarang = $selesai->format('Y-m-d H:i:s');
}

// Menghitung interval
$interval = $mulai->diff($currentTime); // Menghitung selisih antara waktu awal dan waktu yang ditambahkan
$hasil = $interval->format('%h jam %i menit %s detik'); // Menampilkan interval

$update_aktif = mysqli_query($con, "UPDATE `aktif` SET `selesai`='$sekarang', `durasi`='$hasil' WHERE `id`='$aktif_id'");

$semua_jawaban = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(skor) as total FROM jawab WHERE `id_user`='$_SESSION[user]' AND `parent_id`='$parent_id'"));

$update_nilai = mysqli_query($con, "UPDATE `nilai` SET `nilai`='$semua_jawaban[total]' WHERE `parent_id`='$aktif_id' AND `id_user`='$_SESSION[user]'");

if($update_aktif && $update_nilai){
    echo '
    <script>
    window.location.href="hasil_akhir.php?id_a='.$awal['id'].'&id_c='.$parent_id.'";
    </script>
    ';
}else{
    echo '
    <script>
    alert("Gagal menyimpan data saat mengakhiri sesi ujian, hubungi Customer Service Kami.");
    window.location.href="hasil_akhir.php?id_a='.$awal['id'].'&id_c='.$parent_id.'";
    </script>
    ';
}
?>
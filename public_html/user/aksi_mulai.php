<?php
session_start();
include "../penghubung.php";

$parent_id = mysqli_real_escape_string($con, $_POST['parent_id']);

$menit = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `categories` WHERE `id`='$parent_id'"));

date_default_timezone_set('Asia/Jakarta');

// Membuat objek DateTime untuk waktu sekarang
$currentTime = new DateTime(); 
$sekarang = $currentTime->format('Y-m-d H:i:s'); 

// Menyimpan waktu awal untuk interval
$startTime = clone $currentTime; // Mengkloning waktu sekarang

// Menambahkan 30 menit
$currentTime->modify('+'.$menit['menit'].' minutes');

// Menampilkan waktu setelah ditambahkan
//echo "Waktu setelah 30 menit: " . $currentTime->format('Y-m-d H:i:s') . "\n";

// Menghitung interval
$interval = $startTime->diff($currentTime); // Menghitung selisih antara waktu awal dan waktu yang ditambahkan
//echo "Interval: " . $interval->format('%h jam %i menit %s detik'); // Menampilkan interval

$hasil = $currentTime->format('Y-m-d H:i:s');

$aktif = mysqli_query($con, "SELECT * FROM aktif WHERE id_user='$_SESSION[user]' AND `parent_id`='$parent_id'");

if(mysqli_num_rows($aktif) > 0){
    $cek = mysqli_fetch_array($aktif);
    echo '
    <script>
    window.location.href="kerjakan.php?id_a='.$cek['id'].'&id_c='.$_POST['parent_id'].'&nomor=1";
    </script>
    ';
}else{
    $tambah = mysqli_query($con, "INSERT INTO aktif (`id_user`,`parent_id`,`mulai`,`selesai`) VALUES ('$_SESSION[user]','$_POST[parent_id]','$sekarang','$hasil')");

    
    if($tambah){
        $id = $con->insert_id;
        mysqli_query($con, "INSERT INTO `nilai` (`parent_id`,`id_user`,`nilai`) VALUES ('$_POST[parent_id]','$_SESSION[user]','0')");
        echo '
        <script>
        window.location.href="kerjakan.php?id_a='.$id.'&id_c='.$_POST['parent_id'].'&nomor=1";
        </script>
        ';
    }else{
        echo '
        <script>
            alert("Error ! Mohon Maaf atas ketidak nyamanan ini, Hubungi Customer Service Kami, Terima Kasih.");
            window.location.href="mulai.php?id='.$_POST['parent_id'].'";
        </script>
        ';
    }
}
?>
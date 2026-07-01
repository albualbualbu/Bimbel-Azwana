<?php
session_start();
include "../penghubung.php";

// Ambil data dari POST
$data = json_decode(file_get_contents('php://input'), true);
$choice = trim($data['choice']);
$idPertanyaan = $data['id_pertanyaan'];
$idPaket = $data['id_paket'];
$tipe = $data['tipe'];

$jawaban = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `answer` WHERE `id_pertanyaan`='$idPertanyaan'"));
$isi_jawaban = trim($jawaban['isi']);

if($tipe == "radio"){
    $skor = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `answer` WHERE `id`='$choice'"));
}else{
    $skor = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `answer` WHERE `id_pertanyaan`='$idPertanyaan'"));
}

if($tipe == "radio"){
    $skor_akhir = $skor['skor'];
}else{
    if(strtolower($choice) == strtolower($isi_jawaban)){
        $skor_akhir = $skor['skor'];
    }else{
        $skor_akhir = 0;
    }
}
// Pastikan untuk menyiapkan query dengan parameter yang sesuai
$sql = "SELECT * FROM jawab WHERE id_pertanyaan = '$idPertanyaan' AND id_user='$_SESSION[user]'"; // Ganti dengan kondisi yang sesuai
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Jika ada, lakukan UPDATE
    if($tipe == "radio"){
        $sql = "UPDATE `jawab` SET id_jawaban='$choice', skor='$skor_akhir' WHERE id_pertanyaan='$idPertanyaan' AND id_user='$_SESSION[user]' AND `parent_id`='$idPaket'";
    }else{
        $sql = "UPDATE `jawab` SET `skor`='$skor_akhir',`isi`='$choice' WHERE id_pertanyaan='$idPertanyaan' AND id_user='$_SESSION[user]' AND `parent_id`='$idPaket'";
    }
} else {
    // Jika tidak ada, lakukan INSERT
    if($tipe == "radio"){
        $sql = "INSERT INTO `jawab` (`id_user`,`id_pertanyaan`,`id_jawaban`,`parent_id`,`skor`,`isi`) VALUES ('$_SESSION[user]', '$idPertanyaan', '$choice', '$idPaket', '$skor_akhir','')";
    }else{
        $sql = "INSERT INTO `jawab` (`id_user`,`id_pertanyaan`,`id_jawaban`,`parent_id`,`skor`,`isi`) VALUES ('$_SESSION[user]', '$idPertanyaan', '', '$idPaket', '$skor_akhir','$choice')";
    }
}

if ($con->query($sql) === TRUE) {
        $semua_jawaban = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(skor) as total FROM jawab WHERE `id_user`='$_SESSION[user]' AND `parent_id`='$idPaket'"));
        
        mysqli_query($con, "UPDATE `nilai` SET `nilai`='$semua_jawaban[total]' WHERE `parent_id`='$idPaket' AND `id_user`='$_SESSION[user]'");
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $con->error]);
}

$con->close();
?>


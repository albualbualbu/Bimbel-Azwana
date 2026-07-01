<?php
error_reporting(0);
include "../penghubung.php";

$idSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='1'"));

$program = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM program WHERE `id`='$_POST[id_p]'"));
$sub_program = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM sub_program WHERE `id`='$_POST[sub_program]'"));

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Daftar - <?= $idSatu['judul'];?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../<?= $idSatu['isi'];?>">  

    <!-- CSS FILES -->        
    <link href="../css/bootstrap2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../main-assets/css/sb-admin-3.css">

</head>
<style>
    body{
        background:radial-gradient(circle, #ff0084, #ff0020);
    }
	.input{
	width:100%;
	padding:12px 20px;
	margin:1px 0;
	box-sizing:border-box;
	}
</style>
<body>
<center>
<div class="p-2" style="width:350px; display:block; background-color:white; position:fixed; border-radius:15px; top:50%; left:50%; height:auto; transform:translate(-50%,-50%); font-family:Arial; color:#7a7a7a; ">
	<img style="height:100px; margin-top:10px; border-radius:15px 15px 0 0;" src="../img/logo wm 2.png" />
    <br>
    <h3><a style="text-decoration:none;" href="./<?= $program['url'];?>">&nbsp;&#10094;&nbsp;</a> Daftar</h3>
    <form action="aksi_daftar.php" method="post" style="text-align:left;">
        <p>Nama Anak : 
        <input type="text" name="nama" id="" class="form-control" placeholder="Masukkan Nama" required></p>
        <p>Email Orang Tua : 
        <input type="email" name="email" id="" class="form-control" placeholder="Masukkan Email" required></p>
        <p>Nomor Whatsapp : 
        <input required type="number" name="wa" id="" class="form-control" placeholder="Masukkan Nomor WA"></p>

        <input type="hidden" name="id_p" id="" value="<?= $program['id'];?>">
        <input type="hidden" name="id_sub" id="" value="<?= $sub_program['id'];?>">
        <center>
            <input type="submit" value="Daftar" id="submit-btn" style="background-color:#ff0084; border:none; border-radius:5px; color:white; padding:13px 27px;
        </center>
		text-decoration:none; margin:4px 2px; cursor:pointer;">
    </form>

</div>
<center>

</body>
</html>
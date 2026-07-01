<?php
error_reporting(0);
include "../penghubung.php";

$idSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='1'"));

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Daftar - <?= $idSatu['judul'];?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../<?= $idSatu['isi'];?>">  

    <!-- CSS FILES -->        
    <link href="../css/bootstrap2.min.css" rel="stylesheet">


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
	<a href="../"><img style="height:100px; margin-top:10px; border-radius:15px 15px 0 0;" src="../img/logo wm 2.png" /></a>
    <?php
        $program_q = mysqli_query($con, "SELECT * FROM program");
        while($program = mysqli_fetch_array($program_q)){
        ?>
        <a class="btn btn-primary d-grid mb-2" href="<?= $program['url'];?>"><?= $program['nama'];?></a>
    <?php } ?>

</div>
<center>

</body>
</html>
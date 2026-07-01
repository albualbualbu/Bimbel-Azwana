<?php
error_reporting(0);
include "../penghubung.php";

$idSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='1'"));

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Login - <?= $idSatu['judul'];?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../<?= $idSatu['isi'];?>">  

</head>
<style>
	.input{
	width:100%;
	padding:12px 20px;
	margin:1px 0;
	box-sizing:border-box;
	}
</style>
<body style="background:radial-gradient(circle, #ff0084, #ff0020); ">
<?php
$isi = '
<center>
<div style="width:350px; display:block; background-color:white; position:fixed; border-radius:15px; top:50%; left:50%; height:350px; transform:translate(-50%,-50%); font-family:Arial; color:#7a7a7a; ">
	<a href="../"><img style="height:100px; margin-top:10px; border-radius:15px 15px 0 0;" src="../img/logo wm 2.png" /></a>
	<form method="post" action="login.php" style="display:block;">
		<div style="text-align:left; width:300px; height:5px;"><br>
		Email
		<input type="text" name="username" class="input" ><br><br>
		Password<br>
		<input type="password" name="password" class="input"><br><br>
		<center>
		<input type="submit" value="Login" 
		style="background-color:#ff0084; border:none; border-radius:5px; color:white; padding:13px 27px;
		text-decoration:none; margin:4px 2px; cursor:pointer;">
		<center>
		</div>
	</form>
</div>
<center>';
if(!isset($_SESSION['admin'])){

	switch($_GET['value']){
	
	case '':
	echo $isi;
	break;
	
	case 'password_salah':
	echo'<script>alert("Password Salah")</script>';
	echo $isi;
	break;
	
	case 'user_salah':
	echo'<script>alert("Username Salah")</script>';
	echo $isi;
	break;
	
	case 'gagal':
	echo'<script>alert("Terjadi Kesalahan")</script>';
	echo $isi;
	break;

	case '94ec4siq26kjm2b3l6sfsqtm41':
	echo'<script>alert("Changed Successfully")</script>';
	echo $isi;
	break;
	}
}else{
 header('location:94ec4siq26kjm2b3l6sfsqtm41.php');
}
?>
</body>
</html>
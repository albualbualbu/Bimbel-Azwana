<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
<?php
session_start();
$ids=session_id();

	include "../penghubung.php";

$u = $_POST['username'];
$p = $_POST['password'];
$query = mysqli_query($con,"select * from user where email='$u'");
$fetch = mysqli_fetch_array($query);
$id = $fetch['id'];
$name = $fetch['nama'];
$password = $fetch['password'];
$ketemu = mysqli_num_rows($query);
if($u=='' && $p==''){
	header('location:index.php?value=gagal');
	}elseif ($ketemu==0){
	header('location:index.php?value=user_salah');
	}else{
		if($p <> $password){
	header('location:index.php?value=password_salah');
		}else{
			$_SESSION['user'] = $id ;
			header("location:../user");
		}
	}
?>
</body>
</html>
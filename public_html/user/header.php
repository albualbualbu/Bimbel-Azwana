<?php
include "../penghubung.php";

$idSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='1'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title><?= $idSatu['judul'];?></title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="../<?= $idSatu['isi'];?>" rel="icon">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="../assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<!-- Main CSS File -->
	<link href="../assets/css/main2.css" rel="stylesheet">

</head>

<body class="starter-page-page">
  
<header id="header" class="header d-flex align-items-center sticky-top">
		<div class="container-fluid container-xl position-relative d-flex align-items-center">

			<a href="./" class="logo d-flex align-items-center me-auto">
				<h1 class="sitename"><?= $idSatu['judul'];?></h1>
			</a>

			<nav id="navmenu" class="navmenu">
				<ul>
					<li><a href="./">Home</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
				<i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
			</nav>

			<a class="btn-getstarted" href="akun.php">Akun</a>

		</div>
	</header>
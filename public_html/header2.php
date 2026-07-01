<?php
session_start();
include "../penghubung.php";
$id = session_id();

$idSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='1'"));
$idDua = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='2'"));
$idDelapan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='8'"));
$idSembilan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='9'"));
$idSepuluh = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='10'"));
$idSebelas = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='11'"));
$idDuabelas = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='12'"));

$isi = strip_tags($idDua['isi']);

$alamat = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='alamat'"));
$telephone = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='telephone'"));
$email = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='email'"));
$youtube = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='youtube'"));
$twitter = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='twitter'"));
$facebook = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='facebook'"));
$instagram = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='instagram'"));
$tiktok = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='tiktok'"));
$whatsapp = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='whatsapp'"));
$pesan_whatsapp = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='pesan_whatsapp'"));

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="description" content="">
		<meta name="author" content="">

		<title><?= $idSatu['judul'];?></title>
		<link rel="shortcut icon" href="../<?= $idSatu['isi'];?>" type="image/x-icon">
        
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="<?= $idSatu['judul'];?>" />
		<meta property="og:description"   content="<?= $isi;?>" />
		<meta property="og:image"         content="<?= $url_artikel.$idSatu['isi'];?>" />

		<!-- CSS FILES -->        
		<link href="../vendor/fontawesome-free/css/all.css" rel="stylesheet">
        
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

		<link href="../css/bootstrap-icons.css" rel="stylesheet">

		<link href="../css/kind_heart.css" rel="stylesheet">

		<link href="../css/custom.css" rel="stylesheet">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<!--

TemplateMo 581 Kind Heart Charity

https://templatemo.com/tm-581-kind-heart-charity

-->

<style>
	:root {
		--primary-color: #ff5da2;
		--primary-dark: #d94a87;
		--accent-color: #ff8fbf;
		--text-color: #3a2b35;
		--muted-color: #7a6470;
		--surface-color: #fff7fb;
		--border-color: #f5dfe9;
	}

	body {
		color: var(--text-color);
		background: #ffffff;
		font-family: 'Inter', sans-serif;
	}

	a {
		text-decoration: none;
	}

	.section-eye {
		display: inline-block;
		padding: 0.45rem 0.8rem;
		border-radius: 999px;
		background: rgba(255, 93, 162, 0.12);
		color: var(--primary-color);
		font-weight: 700;
		font-size: 0.8rem;
		letter-spacing: 0.08em;
		text-transform: uppercase;
		margin-bottom: 1rem;
	}

	.section-heading {
		font-size: 2rem;
		font-weight: 700;
		margin-bottom: 0.8rem;
		color: var(--text-color);
	}

	.section-copy {
		color: var(--muted-color);
		font-size: 1rem;
		line-height: 1.7;
	}

	.btn-primary {
		background: var(--primary-color);
		border: none;
		color: #fff;
		padding: 0.8rem 1.25rem;
		border-radius: 999px;
		font-weight: 600;
		transition: 0.2s ease;
	}

	.btn-primary:hover {
		background: var(--primary-dark);
		color: #fff;
	}

	.navbar {
		position: sticky;
		top: 0;
		z-index: 1030;
		background: rgba(255,255,255,0.97) !important;
		backdrop-filter: blur(12px);
		border-bottom: 1px solid rgba(255, 93, 162, 0.10);
		box-shadow: 0 8px 25px rgba(255, 93, 162, 0.08);
		padding: 0.7rem 0;
	}

	.navbar-brand img {
		height: 50px !important;
		width: auto;
	}

	.navbar-nav .nav-item + .nav-item {
		margin-left: 0.15rem;
	}

	.navbar-nav .nav-link {
		color: var(--text-color);
		font-weight: 600;
		padding: 0.6rem 0.95rem;
		border-radius: 999px;
		transition: 0.2s ease;
	}

	.navbar-nav .nav-link:hover,
	.navbar-nav .nav-link:focus {
		color: var(--primary-color);
		background: rgba(255, 93, 162, 0.08);
	}

	.navbar-nav .custom-border-btn {
		background: var(--primary-color);
		color: #fff;
		border: none;
		border-radius: 999px;
		padding: 0.6rem 1rem;
	}

	.navbar-nav .custom-border-btn:hover {
		background: var(--primary-dark);
		color: #fff;
	}

	.navbar .dropdown-menu {
		border: none;
		box-shadow: 0 16px 35px rgba(14, 34, 34, 0.12);
		border-radius: 16px;
		padding: 0.5rem 0;
	}

	.navbar .dropdown-item {
		padding: 0.7rem 1rem;
		font-weight: 500;
		color: var(--text-color);
	}

	.navbar .dropdown-item:hover {
		background: rgba(255, 93, 162, 0.08);
		color: var(--primary-color);
	}

	.contact-bubble {
		position: fixed;
		right: 20px;
		bottom: 20px;
		z-index: 2000;
		display: inline-flex;
		align-items: center;
		gap: 10px;
		background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
		color: #fff;
		padding: 10px 14px;
		border-radius: 999px;
		box-shadow: 0 18px 40px rgba(0,0,0,0.12);
		text-decoration: none;
		transition: transform 0.12s ease, box-shadow 0.12s ease;
		font-weight: 700;
	}

	.contact-bubble:hover {
		transform: translateY(-4px);
		box-shadow: 0 22px 50px rgba(0,0,0,0.16);
		color: #fff;
	}

	.contact-bubble-icon {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 42px;
		height: 42px;
		border-radius: 50%;
		background: rgba(255,255,255,0.12);
		font-size: 18px;
	}

	.contact-bubble-text {
		font-size: 0.98rem;
	}

	/* Modal Styles */
	.modal {
		display: none;
		position: fixed;
		z-index: 1000;
		padding-top: 60px;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgba(0, 0, 0, 0.9);
	}

	.modal-content {
		margin: auto;
		display: block;
		width: 80%;
		max-width: 700px;
		text-align:center;
	}

	.close {
		margin-right: auto;
		margin-left: auto;
		color: #fff;
		font-size: 40px;
		font-weight: bold;
		transition: 0.3s;
		display:contents;
	}

	.close:hover,
	.close:focus {
		color: #bbb;
		text-decoration: none;
		cursor: pointer;
	}

	@media (max-width: 768px) {
		.navbar-nav .nav-item + .nav-item {
			margin-left: 0;
			margin-top: 0.2rem;
		}

		.navbar-nav .nav-link {
			padding: 0.7rem 0.95rem;
		}
	}

	@media (max-width: 576px) {
		.contact-bubble {
			right: 14px;
			bottom: 14px;
			padding: 10px;
		}

		.contact-bubble-text {
			display: none;
		}

		.contact-bubble-icon {
			width: 36px;
			height: 36px;
			font-size: 16px;
		}
	}
</style>

	</head>
    
	<body id="section_1">

		<a class="contact-bubble" href="https://api.whatsapp.com/send?phone=<?= urlencode($whatsapp['isi']); ?>&text=Halo%20Saya%20mau%20menghubungi%20Azwana" aria-label="Hubungi Kami" data-whatsapp="<?= htmlspecialchars($whatsapp['isi']); ?>" data-tel="<?= htmlspecialchars($telephone['isi']); ?>">
			<span class="contact-bubble-icon">
				<?php if(file_exists('../images/phone.png')): ?>
					<img src="../images/phone.png" alt="Telepon" style="width:22px;height:22px;display:block;">
				<?php else: ?>
					<i class="bi bi-telephone-fill"></i>
				<?php endif; ?>
			</span>
			<span class="contact-bubble-text">Hubungi Kami</span>
		</a>

		<script>
		document.addEventListener('DOMContentLoaded', function(){
			var bubble = document.querySelector('.contact-bubble');
			if(!bubble) return;
			var tel = bubble.dataset.tel || '';
			var wa = bubble.dataset.whatsapp || '';
			var isMobile = /Mobi|Android|iPhone|iPad|iPod|Windows Phone/i.test(navigator.userAgent) || window.innerWidth <= 576;
			if(isMobile && tel){
				var t = tel.replace(/[^+\d]/g,'');
				bubble.setAttribute('href','tel:'+t);
			} else if(wa){
				bubble.setAttribute('href','https://api.whatsapp.com/send?phone='+encodeURIComponent(wa)+'&text=Halo%20Saya%20mau%20menghubungi%20Azwana');
			}
		});
		</script>

		<nav class="navbar navbar-expand-lg">
			<div class="container">
				<a class="navbar-brand" href="../">
					<img src="../<?= $idDua['judul'];?>" class="logo img-fluid" alt="Logo Bimbel Azwana">
				</a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ms-auto align-items-lg-center">
						<li class="nav-item">
							<a class="nav-link" href="../">Beranda</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="../promo/">Promo</a>
						</li>

						<li class="nav-item" >
							<a class="nav-link" href="../program/">Program</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="../kegiatan/">Kegiatan</a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Selengkapnya</a>

							<ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">

							<li><a class='dropdown-item footer-menu-link' href='../video/'>Video Pembelajaran</a></li>

							<?php
							$selengkapnya = mysqli_query($con, "SELECT * FROM `page`");
							while($selengkap = mysqli_fetch_array($selengkapnya)){
							echo "
							<li><a class='dropdown-item footer-menu-link' href='../detail.php?url=$selengkap[url]'>$selengkap[nama]</a></li>";
							}
							?>
							</ul>
						</li>

						<li class="nav-item ms-lg-3">
							<a class="nav-link custom-border-btn btn" href="../login/">Login</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

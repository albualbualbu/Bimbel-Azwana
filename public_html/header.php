<?php

$idDelapan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='8'"));
$idSembilan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='9'"));
$idSepuluh = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='10'"));
$idSebelas = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='11'"));
$idDuabelas = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='12'"));
$idDuaSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='21'"));

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

        <title><?= $metaJudul ?></title>
        <link rel="shortcut icon" href="<?= $idSatu['isi'];?>" type="image/x-icon">
        <link rel="canonical" href="<?= $url_artikel;?>" />
        
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="<?= $metaJudul ?>" />
        <meta property="og:description"   content="<?= $isi_deskripsi;?>" />
        <meta property="og:image"         content="<?= $url_artikel;?><?= $metaGambar ?>" />

        <!-- CSS FILES -->        
        <link href="vendor/fontawesome-free/css/all.css" rel="stylesheet">
        
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/kind_heart.css" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $metaJudul ?></title>
        <link rel="shortcut icon" href="<?= $idSatu['isi'];?>" type="image/x-icon">
        <link rel="canonical" href="<?= $url_artikel;?>" />
        
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="<?= $metaJudul ?>" />
        <meta property="og:description"   content="<?= $isi_deskripsi;?>" />
        <meta property="og:image"         content="<?= $url_artikel;?><?= $metaGambar ?>" />

        <!-- CSS FILES -->        
        <link href="<?= $asset_root ?>vendor/fontawesome-free/css/all.css" rel="stylesheet">
        
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
        
        <link href="<?= $asset_root ?>css/bootstrap.min.css" rel="stylesheet">

        <link href="<?= $asset_root ?>css/bootstrap-icons.css" rel="stylesheet">

        <link href="<?= $asset_root ?>css/kind_heart.css" rel="stylesheet">

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

  .section-shell {
    position: relative;
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

  .btn-outline-light {
    border: 1px solid rgba(255,255,255,0.8);
    color: #fff;
    padding: 0.8rem 1.25rem;
    border-radius: 999px;
    font-weight: 600;
  }

  .hero-section {
    position: relative;
    overflow: hidden;
  }

  .hero-carousel .carousel-item {
    min-height: 85vh;
  }

  .carousel-image {
    width: 100%;
    height: 85vh;
    object-fit: cover;
    filter: brightness(0.7);
  }

  .hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(3, 28, 35, 0.82) 0%, rgba(3, 28, 35, 0.5) 45%, rgba(3, 28, 35, 0.3) 100%);
  }

  .hero-caption {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: left;
    padding: 2rem 2.5rem;
  }

  .hero-badge {
    display: inline-block;
    padding: 0.45rem 0.8rem;
    background: rgba(255,255,255,0.16);
    border: 1px solid rgba(255,255,255,0.3);
    color: #fff;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 1rem;
    backdrop-filter: blur(8px);
  }

  .hero-caption h1 {
    font-size: clamp(2rem, 3.8vw, 3.2rem);
    font-weight: 700;
    color: #fff;
    margin-bottom: 1rem;
    line-height: 1.2;
  }

  .hero-caption p {
    max-width: 650px;
    font-size: 1.02rem;
    line-height: 1.8;
    color: rgba(255,255,255,0.9);
  }

  .hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.8rem;
    margin-top: 1.4rem;
  }

  .hero-card {
    background: rgba(255,255,255,0.14);
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    padding: 1.5rem;
    border-radius: 24px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
    color: #fff;
  }

  .hero-card h3 {
    font-size: 1.25rem;
    margin-bottom: 0.8rem;
  }

  .hero-card ul {
    padding-left: 1rem;
    margin: 0;
    color: rgba(255,255,255,0.9);
  }

  .hero-card li + li {
    margin-top: 0.45rem;
  }

  .hero-label {
    display: inline-block;
    margin-bottom: 1rem;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    color: var(--primary-color);
    text-transform: uppercase;
  }

  .hero-title {
    font-size: clamp(2.5rem, 4vw, 3.4rem);
    line-height: 1.05;
    margin-bottom: 1rem;
  }

  .hero-copy {
    color: var(--muted-color);
    font-size: 1.05rem;
    line-height: 1.8;
    max-width: 580px;
    margin-bottom: 1.75rem;
  }

  .hero-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
  }

  .hero-preview-card {
    background: #fff;
    border: 1px solid rgba(255, 93, 162, 0.18);
    box-shadow: 0 20px 50px rgba(255, 93, 162, 0.12);
    border-radius: 32px;
    padding: 1.5rem;
  }

  .hero-preview-badge {
    display: inline-flex;
    padding: 0.5rem 0.9rem;
    border-radius: 999px;
    background: rgba(255, 93, 162, 0.08);
    color: var(--primary-color);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 0.9rem;
  }

  .hero-preview-image {
    border-radius: 24px;
    overflow: hidden;
    margin-bottom: 1rem;
  }

  .hero-preview-image img {
    width: 100%;
    display: block;
    object-fit: cover;
    min-height: 300px;
  }

  .hero-preview-meta h5 {
    font-size: 1.05rem;
    margin-bottom: 0.5rem;
  }

  .hero-preview-meta p {
    color: var(--muted-color);
    line-height: 1.8;
    margin: 0;
  }

  .testimonial-card,
  .kegiatan-main-card,
  .kegiatan-small-card,
  .form-box,
  .cta-alt {
    background: #fff;
    border: 1px solid var(--border-color);
    border-radius: 24px;
  }

  .testimonial-card {
    padding: 2rem;
    min-height: 220px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .hero-alt-title {
    font-size: 3.5rem;
    line-height: 1.05;
    margin-bottom: 1.5rem;
    color: var(--white-color);
  }

  .hero-alt-copy {
    color: rgba(255,255,255,0.9);
    max-width: 540px;
    margin-bottom: 2rem;
    font-size: 1.05rem;
    line-height: 1.8;
  }

  .hero-label {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.9rem 1.5rem;
    border-radius: 999px;
    background: rgba(255,255,255,0.18);
    color: var(--white-color);
    font-weight: 700;
    letter-spacing: 0.8px;
    margin-bottom: 1.8rem;
    text-transform: uppercase;
    font-size: 0.95rem;
  }

  .section-hero-alt {
    background: linear-gradient(135deg, #d71484 0%, #ff5973 100%);
    color: var(--white-color);
    padding-top: 6rem;
    padding-bottom: 6rem;
  }

  .hero-buttons .btn {
    min-width: 170px;
    margin-right: 1rem;
    margin-bottom: 1rem;
  }

  .hero-alt-card {
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.18);
    border-radius: 32px;
    padding: 2rem;
    min-height: 420px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .hero-alt-card img {
    width: 100%;
    height: auto;
    border-radius: 24px;
    object-fit: cover;
    max-height: 420px;
  }

  .hero-alt-placeholder {
    width: 100%;
    height: 350px;
    background: rgba(255,255,255,0.15);
    border-radius: 24px;
  }

  .stats-card {
    background: rgba(255,255,255,0.92);
    border: 1px solid rgba(255, 93, 162, 0.16);
    padding: 2.2rem;
    border-radius: 28px;
    text-align: center;
    min-height: 210px;
  }

  .stats-card .counter-number {
    font-size: 3rem;
    line-height: 1;
    color: var(--primary-color);
    display: block;
    margin-bottom: 0.75rem;
  }

  .stats-card .counter-number-text {
    color: var(--dark-color);
    font-size: 1rem;
    font-weight: 600;
  }

  .feature-card {
    border-radius: 32px;
    padding: 1.8rem;
    min-height: 190px;
    transition: transform 0.3s ease;
  }

  .feature-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
  }

  .feature-icon {
    width: 52px;
    height: 52px;
    border-radius: 18px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    background: rgba(255, 93, 162, 0.15);
    color: var(--primary-color);
    font-size: 1.3rem;
  }

  .featured-block-text {
    color: var(--primary-color);
    font-size: 1.05rem;
    margin-top: 20px;
  }

  .cta-card {
    background: linear-gradient(180deg, rgba(255, 0, 141, 0.96) 0%, rgba(255, 93, 162, 0.98) 100%);
    border-radius: 32px;
    padding: 2.5rem;
    color: #ffffff;
  }

  .cta-card h3 {
    font-size: 2rem;
    margin-bottom: 0.8rem;
    font-weight: 700;
  }

  .cta-card p {
    color: rgba(255,255,255,0.9);
    line-height: 1.8;
  }

  .cta-card .btn {
    min-width: 200px;
  }

  .program-card {
    background: #ffffff;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    cursor: pointer;
    transition: transform 0.3s ease;
    min-height: 320px;
    display: flex;
    flex-direction: column;
  }

  .program-card:hover {
    transform: translateY(-8px);
  }

  .program-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
  }

  .program-content {
    padding: 1.6rem;
    flex: 1;
  }

  .program-content h5 {
    font-size: 1.15rem;
    margin-bottom: 0.75rem;
  }

  .program-content p {
    color: var(--p-color);
    line-height: 1.8;
    margin-bottom: 1.25rem;
  }

  .program-card a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.95rem 1.25rem;
    border-radius: 999px;
    background: var(--primary-color);
    color: #ffffff;
    text-decoration: none;
    font-weight: 700;
    transition: background 0.3s ease;
  }

  .program-card a:hover {
    background: #ff4caf;
  }

  .activity-card {
    border-radius: 28px;
    overflow: hidden;
    background: #ffffff;
    transition: transform 0.3s ease;
  }

  .activity-card:hover {
    transform: translateY(-6px);
  }

  .activity-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
  }

  .activity-card h4,
  .activity-card h6 {
    margin-bottom: 0.75rem;
  }

  .activity-card p {
    color: var(--p-color);
    margin-bottom: 0;
  }

  .form-box {
    background: #ffffff;
    border-radius: 32px;
    padding: 2rem;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
  }

  .form-box h3 {
    margin-bottom: 1rem;
  }

  .form-box .form-control {
    background: #fdf0f7;
    border: 1px solid rgba(255,93,162,0.25);
    border-radius: 16px;
    padding: 1rem 1.2rem;
    color: var(--dark-color);
  }

  .form-box .btn {
    min-width: 100%;
  }

  .testimonial-card p {
    font-size: 1rem;
    line-height: 1.8;
    color: var(--muted-color);
    margin-bottom: 1.25rem;
  }

  .testimonial-card strong {
    color: var(--text-color);
    font-size: 0.95rem;
  }

  .kegiatan-main-card {
    overflow: hidden;
    border-radius: 24px;
  }

  .kegiatan-main-card img {
    width: 100%;
    height: auto;
    display: block;
  }

  .kegiatan-main-body {
    padding: 1.5rem;
  }

  .kegiatan-main-body h3 {
    margin-bottom: 0.75rem;
  }

  .kegiatan-small-card {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    align-items: flex-start;
  }

  .kegiatan-small-card img {
    width: 120px;
    height: 100px;
    object-fit: cover;
    border-radius: 18px;
  }

  .kegiatan-small-body h6 {
    margin-bottom: 0.5rem;
    font-size: 1rem;
  }

  .kegiatan-small-body p {
    color: var(--muted-color);
    font-size: 0.95rem;
    margin: 0;
  }

  .section-cta-alt {
    background: #fff7fb;
  }

  .cta-alt {
    padding: 2.2rem;
    border-radius: 28px;
    background: linear-gradient(180deg, rgba(255, 93, 162, 0.12), rgba(255, 93, 162, 0.03));
    border: 1px solid rgba(255, 93, 162, 0.12);
    text-align: center;
  }

  .cta-alt h2 {
    font-size: 2rem;
    margin-bottom: 0.8rem;
  }

  .cta-alt p {
    color: var(--muted-color);
    margin-bottom: 1.25rem;
  }

  .form-box {
    padding: 2rem;
  }

  .form-benefits {
    list-style: none;
    padding-left: 0;
    margin-top: 1.3rem;
  }

  .form-benefits li {
    position: relative;
    padding-left: 1.6rem;
    margin-bottom: 0.85rem;
    color: var(--muted-color);
  }

  .form-benefits li::before {
    content: '\2022';
    position: absolute;
    left: 0;
    top: 0;
    color: var(--primary-color);
    font-size: 1.15rem;
    line-height: 1;
  }

  .text-link {
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
  }

  .text-link:hover {
    color: var(--primary-dark);
  }

  .btn-outline-secondary {
    color: var(--text-color);
    border: 1px solid rgba(58, 43, 53, 0.12);
    background: #fff;
  }

  .btn-outline-secondary:hover {
    background: rgba(255, 93, 162, 0.08);
    color: var(--primary-color);
  }

  .cta-alt a.btn {
    margin-top: 0.5rem;
  }

  .program-card .program-content {
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    right: 1rem;
    z-index: 1;
    color: #fff;
  }

  .program-card h5 {
    font-size: 1.1rem;
    margin-bottom: 0.45rem;
  }

  .program-card p {
    font-size: 0.95rem;
    margin-bottom: 0.75rem;
  }

  .program-card a.text-link {
    color: #fff;
  }

  .program-card a.text-link:hover {
    color: rgba(255,255,255,0.9);
  }

  .program-card::after {
    background: linear-gradient(180deg, transparent 10%, rgba(0,0,0,0.55) 100%);
  }

  .hero-buttons .btn {
    min-width: 170px;
  }

  @media (max-width: 768px) {
    .hero-preview-card {
      padding: 1.25rem;
    }

    .hero-preview-image img {
      min-height: 220px;
    }

    .hero-buttons {
      flex-direction: column;
      align-items: stretch;
    }
  }

  .feature-card,
  .promo-card,
  .program-card,
  .activity-card,
  .stats-card {
    background: #fff;
    border: 1px solid var(--border-color);
    border-radius: 22px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.05);
  }

  .stats-card {
    padding: 1.4rem;
    text-align: left;
  }

  .stats-card .counter-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
  }

  .stats-card .counter-number-text {
    display: block;
    font-size: 1rem;
    font-weight: 600;
    margin-top: 0.3rem;
    color: var(--text-color);
  }

  .feature-card {
    padding: 1.4rem;
    height: 100%;
  }

  .feature-icon {
    width: 54px;
    height: 54px;
    border-radius: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 93, 162, 0.12);
    color: var(--primary-color);
    font-size: 1.4rem;
    margin-bottom: 1rem;
  }

  .promo-card {
    overflow: hidden;
    height: 100%;
  }

  .promo-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
  }

  .promo-card-body {
    padding: 1.2rem 1.2rem 1.4rem;
  }

  .promo-card h5 {
    font-size: 1.05rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
  }

  .promo-card p {
    color: var(--muted-color);
    font-size: 0.95rem;
    line-height: 1.65;
    margin-bottom: 0.8rem;
  }

  .text-link {
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
  }

  .program-card {
    overflow: hidden;
    position: relative;
    min-height: 270px;
  }

  .program-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .program-card::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 10%, rgba(0,0,0,0.65) 100%);
  }

  .program-card .program-content {
    position: absolute;
    inset: auto 1rem 1rem 1rem;
    z-index: 1;
    color: #fff;
  }

  .activity-card {
    padding: 1.1rem;
    display: flex;
    gap: 1rem;
    align-items: flex-start;
  }

  .activity-card img {
    width: 110px;
    height: 90px;
    object-fit: cover;
    border-radius: 14px;
    flex-shrink: 0;
  }

  .activity-card h6 {
    font-weight: 700;
    margin-bottom: 0.3rem;
  }

  .activity-card p {
    color: var(--muted-color);
    font-size: 0.9rem;
    line-height: 1.6;
    margin: 0;
  }

  .cta-card {
    padding: 2rem;
    border-radius: 28px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: #fff;
    box-shadow: 0 18px 45px rgba(255, 93, 162, 0.2);
  }

  .cta-card h3 {
    font-size: 1.6rem;
    font-weight: 700;
    margin-bottom: 0.8rem;
  }

  .cta-card p {
    color: rgba(255,255,255,0.86);
    line-height: 1.7;
    margin-bottom: 0;
  }

  .cta-card .btn-outline-light {
    margin-top: 1rem;
  }

  .site-header {
    background: linear-gradient(90deg, #ff6ba7 0%, #ff4d95 100%);
    color: #fff;
    padding: 0.7rem 0;
  }

  .site-header .topbar-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.8rem;
    flex-wrap: wrap;
  }

  .site-header .topbar-text {
    color: rgba(255,255,255,0.92);
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 0.35rem;
  }

  .site-header .topbar-btn {
    background: rgba(255,255,255,0.16);
    border: 1px solid rgba(255,255,255,0.22);
    color: #fff;
    border-radius: 999px;
    padding: 0.45rem 0.95rem;
    font-weight: 600;
    font-size: 0.9rem;
  }

  .site-header .social-icon {
    margin: 0;
    padding: 0;
    display: flex;
    gap: 0.35rem;
  }

  .site-header .social-icon-item {
    list-style: none;
  }

  .site-header .social-icon-link {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255,255,255,0.14);
    color: #fff;
    transition: 0.2s ease;
  }

  .site-header .social-icon-link:hover {
    background: #fff;
    color: var(--primary-color);
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

  @media (max-width: 768px) {
    .site-header .topbar-wrap {
      justify-content: center;
      text-align: center;
    }

    .navbar-nav .nav-item + .nav-item {
      margin-left: 0;
      margin-top: 0.2rem;
    }

    .navbar-nav .nav-link {
      padding: 0.7rem 0.95rem;
    }
  }

  /* Modal Styles */
  .modal {
    display: none;
    position: fixed;
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
    .hero-caption {
      padding: 1.2rem;
      align-items: flex-end;
      text-align: left;
    }

    .hero-caption h1 {
      font-size: 1.8rem;
    }

    .hero-card {
      display: none;
    }

    .activity-card {
      flex-direction: column;
    }

    .activity-card img {
      width: 100%;
      height: 180px;
    }
  }

  /* Floating contact bubble styles */
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

  .contact-bubble:hover { transform: translateY(-4px); box-shadow: 0 22px 50px rgba(0,0,0,0.16); }

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

  .contact-bubble-text { font-size: 0.98rem; }

  @media (max-width: 576px) {
    .contact-bubble { right: 14px; bottom: 14px; padding: 10px; }
    .contact-bubble-text { display: none; }
    .contact-bubble-icon { width:36px; height:36px; font-size:16px; }
  }

  .az-entry-overlay {
    position: fixed;
    inset: 0;
    z-index: 5000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    background: rgba(0, 0, 0, 0.78);
    backdrop-filter: blur(3px);
  }

  .az-entry-overlay.is-visible {
    display: flex;
  }

  .az-entry-overlay::before,
  .az-entry-overlay::after {
    content: "";
    position: absolute;
    width: min(36vw, 360px);
    aspect-ratio: 1;
    border-radius: 50%;
    opacity: 0.85;
    filter: blur(10px);
    pointer-events: none;
  }

  .az-entry-overlay::before {
    top: -8%;
    right: 10%;
    background: radial-gradient(circle, rgba(90, 231, 255, 0.65) 0 34%, rgba(90, 231, 255, 0.18) 45%, transparent 70%);
  }

  .az-entry-overlay::after {
    left: 22%;
    bottom: -16%;
    background: radial-gradient(circle, rgba(225, 0, 93, 0.78) 0 34%, rgba(225, 0, 93, 0.2) 48%, transparent 72%);
  }

  .az-entry-panel {
    position: relative;
    z-index: 1;
    width: min(100%, 720px);
    max-height: calc(100vh - 3rem);
    overflow-y: auto;
    background: linear-gradient(135deg, #ffffff 0%, #fffafb 70%, #f4fdff 100%);
    border: 1px solid rgba(255, 255, 255, 0.9);
    border-radius: 26px;
    box-shadow: 0 24px 65px rgba(0, 0, 0, 0.34);
    padding: 1.45rem 2rem 0.9rem;
  }

  .az-entry-panel--program {
    width: min(100%, 820px);
  }

  .az-entry-header {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.7rem;
    text-align: center;
    margin-bottom: 0.75rem;
  }

  .az-entry-panel--program .az-entry-header {
    justify-content: flex-start;
    text-align: left;
  }

  .az-entry-title {
    margin: 0;
    color: #cf0054;
    font-size: 1.55rem;
    font-weight: 800;
    line-height: 1.2;
  }

  .az-entry-title::before {
    content: "";
    display: inline-block;
    width: 6px;
    height: 24px;
    margin-right: 0.55rem;
    border-radius: 999px;
    background: #cf0054;
    vertical-align: -4px;
  }

  .az-entry-subtitle {
    margin: -0.25rem 0 0.65rem;
    color: #78616b;
    font-size: 0.82rem;
    text-align: center;
  }

  .az-entry-close {
    position: absolute;
    top: 1rem;
    right: 1.1rem;
    width: 34px;
    height: 34px;
    border: 0;
    border-radius: 50%;
    background: transparent;
    color: #74545f;
    font-size: 1.75rem;
    line-height: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
  }

  .az-entry-close:hover {
    color: #cf0054;
    background: rgba(207, 0, 84, 0.08);
  }

  .az-path-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1.35rem;
    margin-top: 0.7rem;
  }

  .az-path-card,
  .az-program-card {
    border: 1px solid rgba(225, 218, 222, 0.85);
    background: rgba(255, 255, 255, 0.88);
    box-shadow: 0 12px 26px rgba(65, 38, 49, 0.08);
    text-align: center;
    transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
  }

  .az-path-card {
    min-height: 255px;
    border-radius: 24px;
    padding: 1.35rem 1.35rem 1.45rem;
    color: var(--text-color);
    cursor: pointer;
  }

  .az-path-card:hover,
  .az-program-card:hover {
    transform: translateY(-4px);
    border-color: rgba(207, 0, 84, 0.18);
    box-shadow: 0 16px 32px rgba(65, 38, 49, 0.13);
  }

  .az-entry-icon {
    width: 62px;
    height: 62px;
    margin: 0 auto 1rem;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #cf0054;
    background: #ffd5e0;
    font-size: 1.75rem;
  }

  .az-entry-icon--blue {
    color: #087b88;
    background: #91e9f7;
  }

  .az-entry-icon--green {
    color: #267d36;
    background: #8af18c;
  }

  .az-path-logo {
    width: 100%;
    height: 90px;
    margin: 0 auto 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .az-path-logo img {
    max-width: 100%;
    max-height: 90px;
    object-fit: contain;
    display: block;
  }

  .az-path-card h3,
  .az-program-card h3 {
    margin: 0;
    color: #cf0054;
    font-size: 1.05rem;
    font-weight: 800;
  }

  .az-path-card h3 {
    margin-bottom: 0.8rem;
  }

  .az-path-card p {
    margin: 0;
    color: #74606a;
    font-size: 0.86rem;
    line-height: 1.6;
    font-weight: 600;
  }

  .az-program-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 1.35rem;
    padding: 0.45rem 0 0.85rem;
  }

  .az-program-card {
    border-radius: 20px;
    padding: 0.85rem 0.75rem 0.75rem;
    min-height: 190px;
  }

  .az-program-card .az-entry-icon {
    width: 46px;
    height: 46px;
    margin-bottom: 0.75rem;
    font-size: 1.35rem;
  }

  .az-program-logo {
    width: 100%;
    height: 92px;
    margin: 0 auto 0.65rem;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .az-program-logo img {
    max-width: 100%;
    max-height: 92px;
    object-fit: contain;
    display: block;
  }

  .az-program-card h3 {
    min-height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #35262e;
    font-size: 0.98rem;
  }

  .az-program-button {
    width: 100%;
    display: inline-flex;
    justify-content: center;
    margin-top: 0.65rem;
    padding: 0.45rem 0.85rem;
    border-radius: 999px;
    background: #d6005b;
    color: #fff;
    font-size: 0.78rem;
    font-weight: 800;
    box-shadow: 0 8px 14px rgba(214, 0, 91, 0.22);
  }

  .az-program-button:hover {
    color: #fff;
    background: #bd004f;
  }

  .az-entry-help {
    margin: 0.15rem 0 0;
    color: #7d6871;
    text-align: center;
    font-size: 0.78rem;
    font-weight: 700;
  }

  .az-entry-help a {
    color: #cf0054;
    font-weight: 900;
  }

  @media (max-width: 768px) {
    .az-entry-panel {
      border-radius: 22px;
      padding: 1.25rem 1rem 0.9rem;
    }

    .az-entry-title {
      font-size: 1.25rem;
      padding-right: 2rem;
    }

    .az-entry-subtitle {
      font-size: 0.78rem;
    }

    .az-path-grid,
    .az-program-grid {
      grid-template-columns: 1fr;
      gap: 0.85rem;
    }

    .az-path-card {
      min-height: auto;
      padding: 1.2rem 1rem;
    }

    .az-path-logo {
      height: 72px;
    }

    .az-path-logo img {
      max-height: 72px;
    }

    .az-program-card {
      min-height: auto;
    }

    .az-program-logo {
      height: 110px;
    }

    .az-program-logo img {
      max-height: 110px;
    }
  }

  @media (min-width: 769px) and (max-width: 991px) {
    .az-program-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
  }

</style>

    </head>

    <body id="section_1">

      <!-- Topbar removed per request; floating contact bubble added below -->

      <!-- Floating contact bubble (appears on all pages) -->
      <a class="contact-bubble" href="https://api.whatsapp.com/send?phone=<?= urlencode($whatsapp['isi']); ?>&text=Halo%20Saya%20mau%20menghubungi%20Azwana" aria-label="Hubungi Kami" data-whatsapp="<?= htmlspecialchars($whatsapp['isi']); ?>" data-tel="<?= htmlspecialchars($telephone['isi']); ?>">
        <span class="contact-bubble-icon">
          <?php if(file_exists('images/phone.png')): ?>
            <img src="images/phone.png" alt="Telepon" style="width:22px;height:22px;display:block;">
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
                <a class="navbar-brand" href="./">
                    <img src="<?= $idDua['judul'];?>" class="logo img-fluid" alt="Logo Bimbel Azwana">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link" href="./">Beranda</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="promo/">Promo</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="program/">Program</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="kegiatan/">Kegiatan</a>
                        </li>

                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Selengkapnya</a>

                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class='dropdown-item footer-menu-link' href='video/'>Video Pembelajaran</a></li>

                                <?php
                                $selengkapnya = mysqli_query($con, "SELECT * FROM `page`");
                                while($selengkap = mysqli_fetch_array($selengkapnya)){
                                echo "
                                <li><a class='dropdown-item footer-menu-link' href='./detail.php?url=$selengkap[url]'>$selengkap[nama]</a></li>";
                                }
                                ?>
                            </ul>
                        </li>

                        <li class="nav-item ms-lg-3">
                            <a class="nav-link custom-border-btn btn" href="./login/">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


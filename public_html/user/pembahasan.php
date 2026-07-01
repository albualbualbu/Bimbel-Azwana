<?php
session_start();
if(!isset($_SESSION['user'])){
  header("location:../");
}
include "../penghubung.php";

$idSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='1'"));

$error = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `aktif` WHERE `id`='$_GET[id_a]' AND `parent_id`='$_GET[id_c]' AND `id_user`='$_SESSION[user]'"));

if(!$error){
  echo '
  <script>
      alert("Terjadi kesalahan URL, Terima Kasih.");
      window.location.href="./";
  </script>
  ';
}

$kategori = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `categories` WHERE id='$_GET[id_c]'"));

if (!isset($_GET['id_c']) || !isset($_GET['nomor'])) {
  echo '
  <script>
      alert("Terjadi kesalahan URL, Terima Kasih.");
      window.location.href="./";
  </script>
  ';
}

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

  <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="starter-page-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <nav id="navmenu" class="navmenu">
        <ul style="flex-wrap: wrap;">
        <li><a href="#" style="cursor:default;">Nomor Soal : </a></li>

<?php
$nomor = mysqli_query($con, "SELECT * FROM `soal` WHERE `parent_id`='$_GET[id_c]' ORDER BY nomor ASC");
while($no = mysqli_fetch_array($nomor)){
  echo "<li><a href='?id_c=$_GET[id_c]&id_a=$_GET[id_a]&nomor=$no[nomor]'>$no[nomor]</a></li>";
}
$pertanyaan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `soal` WHERE `parent_id`='$_GET[id_c]' AND nomor='$_GET[nomor]'")); 

?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <h1>Pembahasan Soal</h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container mb-4" data-aos="fade-up">
        <h3>No : <?= $pertanyaan['nomor'];?></h3>
        <?= $pertanyaan['pertanyaan'];?>
        <form>
        <?php
$jawaban = mysqli_query($con, "SELECT * FROM `answer` WHERE id_pertanyaan='$pertanyaan[id]' ORDER BY RAND()");
$esay = mysqli_num_rows($jawaban);
$option = "";
while ($jawab = mysqli_fetch_array($jawaban)) {
    // Cek apakah jawaban sudah ada di tabel 'jawab'
    $ada = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM jawab WHERE `id_user`='$_SESSION[user]' AND `id_pertanyaan`='$pertanyaan[id]'"));

    $ada_j = isset($ada['id_jawaban']) ? $ada['id_jawaban'] : 0 ;
    
    // Jika ada, set jawaban sebagai yang terpilih
    $checked = ($jawab['id'] == $ada_j) ? "checked" : "";

    $option = "
    <p>
        <input type='radio' name='choice' value='$jawab[id]' $checked disabled> $jawab[isi]
    </p>
    ";
}
if($esay <= 1){
  $option = "";
}

$nomorNext = $_GET['nomor']+1;
$nomorPrev = $_GET['nomor']-1;

$num = mysqli_num_rows($nomor);
if($_GET['nomor'] == $num){
  $next = "";
  $selesai = "
  <a href='hasil_akhir.php?id_c=$_GET[id_c]&id_a=$_GET[id_a]' class='btn-get-started mt-2' style='background:red;'>Finish</a>
  ";
}else{
  $next = "
  <a href='pembahasan.php?id_a=$_GET[id_a]&id_c=$_GET[id_c]&nomor=$nomorNext' class='btn-get-started mt-2'>Next</a>
  ";
  $selesai="";
}
if($_GET['nomor'] <= 1){
  $previou = "";
}else{
  $previou = "
  <a href='pembahasan.php?id_a=$_GET[id_a]&id_c=$_GET[id_c]&nomor=$nomorPrev' class='btn-get-started mt-2'>Previous</a>
  ";
}
echo $previou;
echo $next;
echo '<br/>'.$selesai;

$hasilJawaban = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `answer` WHERE id='$pertanyaan[id_jawaban]'"));

$isi_jawaban = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `jawab` WHERE id_pertanyaan='$pertanyaan[id]' AND `id_user`='$_SESSION[user]'"));

$isi_jawab = isset($isi_jawaban['isi']) ? $isi_jawaban['isi'] : "";

?>
</form>
        
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up">

        <div class="row gy-4">
          <b>Jawaban Esai Anda :</b>
          <div class="card bg-secondary bg-opacity-10">
            <div class="card-body">
              <?= $isi_jawab;?>
            </div>
          </div>
          <b>Jawaban yang Benar adalah</b>
          <div class="card bg-primary bg-opacity-10">
            <div class="card-body">
              <?= $hasilJawaban['isi'];?>
            </div>
          </div>
          <b>Pembahasan sebagai berikut :</b>
          <div class="card bg-info bg-opacity-10">
            <div class="card-body">
              <?= $pertanyaan['pembahasan'];?>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Team Section -->


  </main>

  <footer id="footer" class="footer">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename"><?= $idSatu['judul'];?></strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="../assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>
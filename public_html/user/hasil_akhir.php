<?php
session_start();
if(!isset($_SESSION['user'])){
  header("location:../");
}
include "../penghubung.php";

$nama = mysqli_query($con,"SELECT * FROM semua WHERE id='1'");
$namaPerusahaan = mysqli_fetch_array($nama);

$kategori = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `categories` WHERE id='$_GET[id_c]'"));

mysqli_query($con,"UPDATE aktif SET `x`='1' WHERE id='$_GET[id_a]'");

include "header.php";
?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <h1></h1>
      </div>
    </div><!-- End Page Title -->

<?php

$nilai_cek = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM nilai WHERE id_user='$_SESSION[user]' AND  `parent_id`='$_GET[id_c]'"));

?>
    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h3>Selamat Anda Berhasil Menyelesaikan Paket Soal <b><?= $kategori['nama'];?></b></h3>
        <p>Skor Anda : <b><?= $nilai_cek['nilai'];?></b></p>
        <a href='pembahasan.php?id_c=<?= $_GET['id_c'];?>&id_a=<?= $_GET['id_a'];?>&nomor=1'  class="btn-get-started mt-2">Lihat Pembahasan Soal</a>

      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">


        </div>

      </div>

    </section><!-- /Team Section -->


  </main>

  <footer id="footer" class="footer">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename"><?= $namaPerusahaan['judul'];?></strong> <span>All Rights Reserved</span></p>
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
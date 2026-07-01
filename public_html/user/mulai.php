<?php
session_start();
if(!isset($_SESSION['user'])){
  header("location:../");
}
include "../penghubung.php";

$nama = mysqli_query($con,"SELECT * FROM semua WHERE id='1'");
$namaPerusahaan = mysqli_fetch_array($nama);

$kategori = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `categories` WHERE id='$_GET[id]'"));

if(!$kategori){
  echo '
  <script>
      alert("Terjadi Kesalahan Pada Link !");
      window.location.href="./";
  </script>
  ';
  }

$aktif = mysqli_num_rows(mysqli_query($con, "SELECT * FROM aktif WHERE id_user='$_SESSION[user]' AND `parent_id`='$_GET[id]' AND `x`=0"));

if($aktif > 0){
  echo '
  <script>
    window.location.href="kerjakan.php?id_a='.$aktif['id'].'&id_c='.$_GET['id'].'&nomor=1";
  </script>
  ';
}

$id_kat = isset($kategori['id']) ? $kategori['id'] : "#";
$nama_kat = isset($kategori['nama']) ? $kategori['nama'] : "Error";
$menit = isset($kategori['menit']) ? $kategori['menit'] : "Error";

include "header.php";
?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <h1></h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h3>Perhatian !</h3>
        <p>Setelah ini Anda akan membuka Paket Soal <b><?= $nama_kat ?></b></p>
        <p>Ketika klik "Mulai Kerjakan" maka <b><?= $menit ?> menit</b> kedepan, manfaatkan waktu semaksimal mungkin. Ketika waktu berakhir maka halaman akan otomatis keluar.</p>
        
        <form action="aksi_mulai.php" method="post">
          <input type="hidden" name="parent_id" value="<?= $id_kat ?>" />
          <button type="submit" class="btn-get-started mt-2" style="border:none;">Mulai Kerjakan</button>
        </form>

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
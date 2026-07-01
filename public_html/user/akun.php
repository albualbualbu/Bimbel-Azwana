<?php
session_start();
if(!isset($_SESSION['user'])){
  header("location:../");
}

include "header.php";
$detail = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM user WHERE id='$_SESSION[user]'"));
?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <h1>Akun Profil</h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <div class="container">

        <div class="row gy-4">

        <div class="col-lg-3 shadow p-4"><img src="../<?= $detail['foto'];?>" width="100%" alt=""></div>
        <div class="col-lg-9 shadow p-4">
          <table>
            <tr>
              <td>Nama</td>
              <td>: <?= $detail['nama'];?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td>: <?= $detail['email'];?></td>
            </tr>
            <tr>
              <td>Asal Sekolah</td>
              <td>: <?= $detail['asal_sekolah'];?></td>
            </tr>
            <tr>
              <td>Jenis Kelamin</td>
              <td>: <?= $detail['jenis_kelamin'];?></td>
            </tr>
            <tr>
              <td>Kelas</td>
              <td>: <?= $detail['kelas'];?></td>
            </tr>
            <tr>
              <td>Tempat Tanggal Lahir Anak</td>
              <td>: <?= $detail['tempat_lahir_anak']." , ".$detail['tgl_lahir_anak'];?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>: <?= $detail['alamat'];?></td>
            </tr>
            <tr>
              <td>Anak Ke</td>
              <td>: <?= $detail['anak_ke'];?></td>
            </tr>
            <tr>
              <td>Nama Ibu</td>
              <td>: <?= $detail['nama_ibu'];?></td>
            </tr>
            <tr>
              <td>Pendidikan Terakhir</td>
              <td>: <?= $detail['pendidikan_terakhir'];?></td>
            </tr>
            <tr>
              <td>Pekerjaan Ibu</td>
              <td>: <?= $detail['pekerjaan_ibu'];?></td>
            </tr>
            <tr>
              <td>Media Sosial Ibu</td>
              <td>: <?= $detail['medsos']." , ".$detail['medsos_ibu'];?></td>
            </tr>
            <tr>
              <td>Nama Ayah</td>
              <td>: <?= $detail['nama_ayah'];?></td>
            </tr>
            <tr>
              <td>Tempat Tanggal Lahir Ayah</td>
              <td>: <?= $detail['tempat_lahir_ayah']." , ".$detail['tgl_lahir_ayah'];?></td>
            </tr>
            <tr>
              <td>Pekerjaan Ayah</td>
              <td>: <?= $detail['pekerjaan_ayah'];?></td>
            </tr>
          </table>
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
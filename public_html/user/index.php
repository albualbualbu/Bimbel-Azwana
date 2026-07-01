<?php
session_start();
if(!isset($_SESSION['user'])){
  header("location:../");
}

include "header.php";
?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <h1>Semangat Mengerjakan !</h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Paket Soal</h2>
        <p></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

        <?php
include "../penghubung.php";

// Mengambil data id_user dari session
$user_id = $_SESSION['user'];

// Mengambil daftar paket yang dipilih oleh user
$query_pilih = "SELECT `parent_id` FROM pilih WHERE id_user=?";
$stmt_pilih = $con->prepare($query_pilih);
$stmt_pilih->bind_param('i', $user_id);
$stmt_pilih->execute();
$result_pilih = $stmt_pilih->get_result();

// Mengecek apakah user memiliki paket yang dipilih
if ($result_pilih->num_rows > 0) {
    // Mengambil data kategori berdasarkan paket yang dipilih
    while ($hasil = $result_pilih->fetch_assoc()) {
        $id_paket = $hasil['parent_id'];

        $query_kategori = mysqli_query($con,"SELECT * FROM `categories` WHERE `id`=$id_paket");

        // Menampilkan data kategori jika ada
        $isi = mysqli_fetch_array($query_kategori);
        $id_p = isset($isi['id']) ? $isi['id'] : "#";
        $nama_p = isset($isi['nama']) ? $isi['nama'] : "Error";
        $gambar = isset($isi['gambar']) ? $isi['gambar'] : "img/kosong.jpg";
        $isi = isset($isi['isi']) ? $isi['isi'] : "";
        echo "
            <div class='col-lg-6' data-aos='fade-up'>
                <div class='team-member d-flex align-items-start'>
                    <div class='pic'>
                        <div class='bgbg' style='background-image:url(../$gambar);'></div>
                    </div>
                    <div class='member-info'>
                        <h4><a href='mulai.php?id=$id_p'>$nama_p</a></h4>
                        $isi
                    </div>
                </div>
            </div><!-- End Team Member -->
        ";
        }
} else {
    echo "Tidak Ada Paket Soal yang bisa diakses. Hubungi Admin.";
}
?>



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
<?php
session_start();
if(!isset($_SESSION['user'])){
  header("location:../");
}
include "../penghubung.php";

$nama = mysqli_query($con,"SELECT * FROM semua WHERE id='1'");
$namaPerusahaan = mysqli_fetch_array($nama);

$idSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='1'"));

$kategori = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `categories` WHERE id='$_GET[id_c]'"));

if (!isset($_GET['id_a']) || !isset($_GET['id_c']) || !isset($_GET['nomor'])) {
  echo '
  <script>
      alert("Terjadi kesalahan URL, Terima Kasih.");
      window.location.href="mulai.php?id='.$_GET['id_c'].'";
  </script>
  ';
}

$deteksi = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM aktif WHERE id='$_GET[id_a]'"));

if($deteksi['x'] == '1'){
  echo '
  <script>
      alert("Anda Telah Mengerjakan, Terima Kasih.");
      window.location.href="hasil_akhir.php?id_c='.$_GET['id_c'].'&id_a='.$_GET['id_a'].'";
  </script>
  ';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= $namaPerusahaan['judul'];?></title>
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
  echo "<li><a href='?id_a=$_GET[id_a]&id_c=$_GET[id_c]&nomor=$no[nomor]'>$no[nomor]</a></li>";
}
$pertanyaan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `soal` WHERE `parent_id`='$_GET[id_c]' AND nomor='$_GET[nomor]'"));

if($pertanyaan == NULL){
  echo '
  <script>
      alert("Maaf Terjadi kesalahan URL !");
      window.location.href="mulai.php?id='.$_GET['id_c'].'";
  </script>
  ';
}

$time = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM aktif WHERE id='$_GET[id_a]'"));

date_default_timezone_set('Asia/Jakarta'); 

    // Hitung selisih total detik secara absolut di PHP

$target = new DateTime($time['selesai']);
$now = new DateTime(); // Waktu sekarang
$status_expired = ($now > $target); // Cek apakah sudah lewat
$total_detik = $target->getTimestamp() - $now->getTimestamp();
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
        <h1 id="countdown"></h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container" data-aos="fade-up">
        <h3>No : <?= $pertanyaan['nomor'];?></h3>
        <?= $pertanyaan['pertanyaan'];?>
        <form id="myForm">
        <input type="hidden" name="id_pertanyaan" value="<?= $pertanyaan['id'];?>">
        <input type="hidden" name="parent_id" value="<?= $_GET['id_c'];?>">
        <?php
$jawaban = mysqli_query($con, "SELECT * FROM `answer` WHERE `id_pertanyaan`='$pertanyaan[id]' ORDER BY RAND()");
if($pertanyaan['type'] == "ganda"){
  while ($jawab = mysqli_fetch_array($jawaban)) {
      // Cek apakah jawaban sudah ada di tabel 'jawab'
      $ada = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `jawab` WHERE `id_jawaban`='$jawab[id]' AND `id_user`='$_SESSION[user]'"));
      
      // Jika ada, set jawaban sebagai yang terpilih
      $checked = isset($ada) ? "checked" : "";

      echo "
      <p>
          <input type='radio' name='choice' value='$jawab[id]' onchange=\"updateDatabase(this.value, '$pertanyaan[id]', '$_GET[id_c]','radio')\" $checked> $jawab[isi]
      </p>
      ";
      
  }
}

$nomorNext = $_GET['nomor']+1;
$nomorPrev = $_GET['nomor']-1;

$num = mysqli_num_rows($nomor);
if($_GET['nomor'] == $num){
  $next = "";
  $selesai = "
  <a href='akhiri.php?id_a=$_GET[id_a]&id_c=$_GET[id_c]' class='btn-get-started mt-2' style='background:red;z-'>Akhiri TRYOUT</a>
  ";
}else{
  $next = "
  <a href='kerjakan.php?id_a=$_GET[id_a]&id_c=$_GET[id_c]&nomor=$nomorNext' class='btn-get-started mt-2'>Next</a>
  ";
  $selesai="";
}
if($_GET['nomor'] <= 1){
  $previou = "";
}else{
  $previou = "
  <a href='kerjakan.php?id_a=$_GET[id_a]&id_c=$_GET[id_c]&nomor=$nomorPrev' class='btn-get-started mt-2'>Previous</a>
  ";
}

$hasilJawaban = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `answer` WHERE `id`='$pertanyaan[id_jawaban]'"));

$jawaban_isi = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `jawab` WHERE `id_user`='$_SESSION[user]' AND id_pertanyaan='$pertanyaan[id]'"));
$isi_jawaban = isset($jawaban_isi['isi']) ? str_replace(array('<br />', '<br>', '<br/>'), "", $jawaban_isi['isi']) : "";

if($pertanyaan['type'] == "essay"){
  echo "
  <input type='text' id='myTextarea' name='isi' value='$isi_jawaban' onblur=\"updateDatabase(this.value, '$pertanyaan[id]', '$_GET[id_c]','textarea')\" class='form-control mb-2' placeholder='Tulis Jawaban'>
  ";
}
echo "
<p>Skor Jawaban jika Benar : $hasilJawaban[skor]</p>
";

echo $previou;
echo $next;
echo $selesai;
echo "<div id='sending' style='display:none;background:rgba(000, 000, 000, 0.5);margin-top:-47px;height:50px;z-index:100;position:relative;color:white;font-weight:bold;align-items:center;padding:5px;'>Sending ...</div>";
?>
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
  <script>

// Jika sudah lewat, set ke 0, jika belum ambil selisihnya
let timeLeft = <?= $status_expired ? 0 : $total_detik ?>; 

const countdownElement = document.getElementById('countdown');

const countdownTimer = setInterval(() => {
    if (timeLeft <= 0) {
        clearInterval(countdownTimer);
        countdownElement.innerHTML = "Event telah berakhir!";
        window.location.href = "akhiri.php?id_a=<?= $_GET['id_a'] ?>&id_c=<?= $_GET['id_c'] ?>";
    } else {
        const hours = Math.floor(timeLeft / 3600);
        const minutes = Math.floor((timeLeft % 3600) / 60);
        const seconds = timeLeft % 60;

        // Gunakan padStart agar tampilan tetap 00:00:00 (opsional)
        const displayHours = String(hours).padStart(2, '0');
        const displayMinutes = String(minutes).padStart(2, '0');
        const displaySeconds = String(seconds).padStart(2, '0');

        countdownElement.innerHTML = `${displayHours} : ${displayMinutes} : ${displaySeconds}`;
        timeLeft--;
    }
}, 1000);

const form = document.getElementById('myForm');
const textarea = document.getElementById('myTextarea');
const sending = document.getElementById('sending');
let lastChoice = null;

textarea.addEventListener('input',function(){
          if(this.value.length > 0){
            sending.style.display="flex";
          }else{
            sending.style.display="none";
          }
});

// Tambahkan parameter ke fungsi agar bisa menerima data
function updateDatabase(choice, idPertanyaan, idPaket, tipe) {
    
    // 1. Validasi agar tidak mengirim data yang sama berturut-turut
    if (lastChoice === choice) return;
    lastChoice = choice;

    // 2. Tampilkan indikator loading & matikan tombol Next
    if (sending) sending.style.display = "flex";

    fetch('pilihan.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
            choice: choice, 
            id_pertanyaan: idPertanyaan, 
            id_paket: idPaket, 
            tipe: tipe 
        })
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    })
    .finally(() => {
        // 3. Sembunyikan loading & nyalakan tombol LAGI (Berhasil/Gagal tetap muncul)
        if (sending) sending.style.display = "none";
    });
}

// --- BAGIAN EVENT LISTENER ---

// Event untuk Radio Button
form.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        // Ambil data dari atribut atau langsung dari elemen
        const idPertanyaan = form.querySelector('input[name="id_pertanyaan"]').value;
        const idPaket = form.querySelector('input[name="parent_id"]').value;
        updateDatabase(this.value, idPertanyaan, idPaket, 'radio');
    });
});

// Event untuk Textarea
if (textarea) {
    textarea.addEventListener('blur', function() {
        const idPertanyaan = form.querySelector('input[name="id_pertanyaan"]').value;
        const idPaket = form.querySelector('input[name="parent_id"]').value;
        updateDatabase(this.value, idPertanyaan, idPaket, 'textarea');
    });
}
</script>

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
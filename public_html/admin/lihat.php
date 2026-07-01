<?php 
include "../penghubung.php";
include 'header.php'; 
include 'aksi.php'; 

$siswa = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM user WHERE id='$_GET[id_s]'"));
$paket = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `categories` WHERE id='$_GET[id_p]'"));

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mt-2 text-gray-800">
        <a style="border:1px solid blue;" href="nilai.php?id=<?= $_GET['id_s'];?>">&nbsp;&#10094;&nbsp;</a> Jawaban <?= $siswa['nama'];?>
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive">

                Nomor Soal : 
            <nav id="navmenu" class="navmenu">
        <ul style="flex-wrap: wrap;">

<?php
$nomor = mysqli_query($con, "SELECT * FROM `soal` WHERE `parent_id`='$_GET[id_p]' ORDER BY nomor ASC");
while($no = mysqli_fetch_array($nomor)){
  echo "<li><a style='color:blue; text-decoration: underline;' href='?id_p=$_GET[id_p]&id_s=$_GET[id_s]&n=$no[nomor]'>$no[nomor]</a></li>";
}
$pertanyaan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `soal` WHERE `parent_id`='$_GET[id_p]' AND nomor='$_GET[n]'")); 

?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

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
  <div class="container" data-aos="fade-up">
    <h3>No : <?= $pertanyaan['nomor'];?></h3>
    <?= $pertanyaan['pertanyaan'];?>
    <form id="myForm">
    <input type="hidden" name="id_pertanyaan" value="<?= $pertanyaan['id'];?>">
    <input type="hidden" name="id_paket" value="<?= $_GET['id_p'];?>">
    <?php
$jawaban = mysqli_query($con, "SELECT * FROM `answer` WHERE id_pertanyaan='$pertanyaan[id]' ORDER BY RAND()");

while ($jawab = mysqli_fetch_array($jawaban)) {
// Cek apakah jawaban sudah ada di tabel 'jawab'
$ada = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM jawab WHERE `id_user`='$_GET[id_s]' AND `id_pertanyaan`='$pertanyaan[id]' AND `id_jawaban`='$jawab[id]'"));

    $ada_j = isset($ada['id_jawaban']) ? $ada['id_jawaban'] : 0 ;

// Jika ada, set jawaban sebagai yang terpilih
$checked = ($jawab['id'] == $ada_j) ? "checked" : "";
if($pertanyaan['type'] == "ganda"){
echo "
<p>
    <input type='radio' name='choice' value='' disabled $checked> $jawab[isi]
</p>
";
}

}
$nomorNext = $_GET['n']+1;
$nomorPrev = $_GET['n']-1;

$num = mysqli_num_rows($nomor);
if($_GET['n'] == $num){
$next = "";
}else{
$next = "
<a href='?id_p=$paket[id]&n=$nomorNext&id_s=$_GET[id_s]' class='btn-get-started mt-2'>Next</a>
";
}
if($_GET['n'] <= 1){
$previou = "";
}else{
$previou = "
<a href='?id_p=$paket[id]&n=$nomorPrev&id_s=$_GET[id_s]' class='btn-get-started mt-2'>Previous</a>
";
}
echo $previou;
echo $next;

$hasilJawaban = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `answer` WHERE id='$pertanyaan[id_jawaban]'"));

$isi_jawaban = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `jawab` WHERE id_pertanyaan='$pertanyaan[id]' AND `id_user`='$siswa[id]'"));

$isi_jawab = isset($isi_jawaban['isi']) ? $isi_jawaban['isi'] : "";

?>
</form>
    
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up">
    <div class="gy-4">
      <?php
if($pertanyaan['type'] == "essay"){
  ?>
      <b>Jawaban Essay Peserta :</b>
      <div class="card" style="background-color:rgba(000, 000, 000, 0.1);">
        <div class="card-body">
          <?= $isi_jawab;?>
        </div>
      </div>
      <?php } ?>
      <b>Jawaban yang Benar adalah</b>
      <div class="card" style="background-color:rgb(0 184 255 / 10%);">
        <div class="card-body">
          <?= $hasilJawaban['isi'];?>
        </div>
      </div>
      <b>Pembahasan sebagai berikut :</b>
      <div class="card" style="background-color:rgb(0 58 255 / 10%);">
        <div class="card-body">
          <?= $pertanyaan['pembahasan'];?>
        </div>
      </div>
    </div>
  </div>

</section><!-- /Team Section -->


</main>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script>
    
function checkDelete(){
	return confirm('Anda Yakin ingin Menghapus ?');
}
</script>
<?php include 'footer.php'; ?>

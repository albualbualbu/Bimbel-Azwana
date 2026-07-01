<?php  
include 'header.php'; 
include 'aksi.php'; 
$kategori = mysqli_query($con, "SELECT * FROM `pertanyaan` WHERE id='$_GET[id]'");
$hasil = mysqli_fetch_array($kategori);

$jawaban = mysqli_query($con, "SELECT * FROM jawaban WHERE id_pertanyaan='$_GET[id]'");

// Menginisialisasi variabel
$jawaban1 = $jawaban2 = $jawaban3 = $jawaban4 = null;

// Mengambil hasil
$count = 0;
while ($row = mysqli_fetch_assoc($jawaban)) {
    if ($count == 0) {
        $jawaban1 = $row['isi'];
        $id_jawaban1 = $row['id'];
        $skor = $row['skor'];
    } elseif ($count == 1) {
        $jawaban2 = $row['isi'];
        $id_jawaban2 = $row['id'];
    } elseif ($count == 2) {
        $jawaban3 = $row['isi'];
        $id_jawaban3 = $row['id'];
    } elseif ($count == 3) {
        $jawaban4 = $row['isi'];
        $id_jawaban4 = $row['id'];
    }
    $count++;
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">
    <a style="border:1px solid blue;" href="edit_soal.php?id=<?= $_GET['id'];?>&id_k=<?= $_GET['id_k'];?>&id_p=<?= $_GET['id_p'];?>">&nbsp;&#10094;&nbsp;</a> Edit Pembahasan Soal Nomor <?= $hasil['nomor'];?>
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Jawaban yang Benar</label>
                        <input type="hidden" name="id_benar" id="" value="<?= $id_jawaban1;?>">
                        <input type="text" name="benar" id="name" class="form-control" placeholder="Masukkan Jawaban yang Benar" value="<?= $jawaban1;?>" style="background:#c9ffc9;" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Skor</label>
                        <input type="hidden" name="id_benar" id="" value="<?= $id_jawaban1;?>">
                        <input type="number" name="skor" id="name" class="form-control" placeholder="Masukkan Skor" value="<?= $skor;?>" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Jawaban yang Salah</label>
                        <input type="hidden" name="id_salah1" id="" value="<?= $id_jawaban2;?>">
                        <input type="text" name="salah1" id="name" class="form-control" placeholder="Masukkan Jawaban yang Salah" value="<?= $jawaban2;?>" style="background:#fbe0e0;" required>
                    </div>
                    <div class="form-group">
                    <input type="hidden" name="id_salah2" id="" value="<?= $id_jawaban3;?>">
                    <input type="text" name="salah2" id="name" class="form-control" placeholder="Masukkan Jawaban yang Salah" value="<?= $jawaban3;?>" style="background:#fbe0e0;" required>
                    </div>
                    <div class="form-group">
                    <input type="hidden" name="id_salah3" id="" value="<?= $id_jawaban4;?>">
                    <input type="text" name="salah3" id="name" class="form-control" placeholder="Masukkan Jawaban yang Salah" value="<?= $jawaban4;?>" style="background:#fbe0e0;" required>
                    </div>

                    <input type="hidden" name="id_pertanyaan" id="" value="<?= $_GET['id'];?>">
                    <input type="hidden" name="id_p" id="" value="<?= $_GET['id_p'];?>">
                    <input type="hidden" name="id_kategori" id="" value="<?= $hasil['id_kategori'];?>">
                    <div class="form-group">
                        <label for="name">Pembahasan : </label>
                    </div>
                    <textarea id="myTextarea" name="pembahasan" col="5" placeholder="Masukkan Pembahasan"><?= $hasil['pembahasan'];?></textarea>
                    <button type="submit" name="edit_pembahasan" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-file-signature'></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright 2024 &copy; <?= $namaPerusahaan['judul']; ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../main-assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../main-assets/js/demo/chart-area-demo.js"></script>
<script src="../main-assets/js/demo/chart-pie-demo.js"></script>
<script>
ClassicEditor
    .create(document.querySelector("#myTextarea"))
    .catch(error => {
        console.error( error );
    } );
</script>

</body>

</html>

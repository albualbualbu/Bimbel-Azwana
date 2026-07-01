<?php  
include 'header.php'; 
include 'aksi.php';
$id = $_GET['id'];
$id_s = $_GET['id_s'];
$pertanyaan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `soal` WHERE `id`='$id_s'"));
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 text-gray-800">
        <a style="border:1px solid blue;" href="sub-category.php?id=<?= $id ?>">&nbsp;&#10094;&nbsp;</a> Edit Soal Nomor <?= $pertanyaan['nomor'];?></h1>
        <a href="edit_pembahasan.php?id=<?= $id ?>&id_s=<?= $id_s ?>">
        <button type="submit" name="tambah_soal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-2"><i class='fas fa-fw fa-edit'></i> Edit Pembahasan & Jawaban</button></a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nomor Soal</label>
                        <input type="number" name="nomor" id="name" class="form-control" placeholder="Masukkan Nomor Soal" value="<?= $pertanyaan['nomor'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Pertanyaan : </label>
                    </div>
                    <textarea id="myTextarea" name="pertanyaan" col="5" placeholder="Masukkan Pertanyaan"><?= $pertanyaan['pertanyaan'];?></textarea>
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="id_s" value="<?= $id_s ?>">
                    <button type="submit" name="edit_soal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
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

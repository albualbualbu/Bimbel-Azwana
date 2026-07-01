<?php  
include 'header.php'; 
include 'aksi.php'; 
$data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `video` WHERE id='$_GET[id]'"));
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800" style="text-transform:capitalize;">
    <a style="border:1px solid blue;" href="video.php">&nbsp;&#10094;&nbsp;</a> Edit Judul Video
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Judul :</label>
                        <input value="<?= $data['judul'];?>" type="text" name="judul" id="name" class="form-control" placeholder="Masukkan Judul" required>
                    </div>

                    <?php                    
                    echo "<video class='col-lg-6' height='240' controls>
                    <source src='../" . $data["filename"] . "' type='video/mp4'>
                    Your browser does not support the video tag.
                    </video>";
                    ?>

                    <input type="hidden" name="id" value="<?= $data['id'];?>">
                    <br>

                    <button type="submit" name="edit_video" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
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

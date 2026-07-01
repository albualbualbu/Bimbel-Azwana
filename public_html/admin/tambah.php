<?php  
include 'header.php'; 
include 'aksi.php'; 
$nav = $_GET['nav'];
$tabel = $_GET['tabel'];

if($tabel == "page"){
    $tambah = "tambah_page";
}else{
    $tambah = "tambah";
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800" style="text-transform:capitalize;">
    <a style="border:1px solid blue;" href="tabel.php?nav=<?= $nav;?>&tabel=<?= $tabel;?>">&nbsp;&#10094;&nbsp;</a> Tambah <?= $nav;?>
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">
                <?php
                    if($nav == "selengkapnya"){
                        echo "
                        <div class='form-group'>
                            <label for='name'>Nama Tombol</label>
                            <input type='text' name='nama' id='name' class='form-control' placeholder='Masukkan Nama Tombol' required>
                        </div>
                        ";
                    }else{
                        echo "";
                    }
                    ?>
                    <div class="form-group">
                        <label for="name">Judul</label>
                        <input type="text" name="judul" id="name" class="form-control" placeholder="Masukkan Judul" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Gambar</label>
                        <input type="file" name="image" id="nisn" class="form-control-file" placeholder="Enter Username" required>
                    </div>
                    <textarea id="myTextarea" name="isi" col="5"></textarea>

                    <input type="hidden" name="tabel" value="<?= $tabel;?>">
                    <input type="hidden" name="nav" value="<?= $nav;?>">

                    <button type="submit" name="<?= $tambah;?>" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-plus'></i> Tambahkan</button>
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

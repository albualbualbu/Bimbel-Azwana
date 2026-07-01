<?php  
include 'header.php'; 
include 'aksi.php'; 
$kategori = mysqli_query($con, "SELECT * FROM `kategori` WHERE id='$_GET[id_k]'");
$hasil = mysqli_fetch_array($kategori);

$paket = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `paket` WHERE id='$_GET[id_p]'"));
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">
    <a style="border:1px solid blue;" href="tabel_soal.php?id_k=<?= $_GET['id_k'];?>&id_p=<?= $_GET['id_p'];?>">&nbsp;&#10094;&nbsp;</a> Tambah Soal
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                        <label for="name">Kategori</label>
                        <input type="text" name="nomor" id="name" class="form-control" placeholder="Masukkan Nomor Soal" value="<?= $hasil['nama'];?>" disabled >
                        <input type="hidden" name="id_kategori" value="<?= $hasil['id'];?>" >
                    </div>
                    <div class="form-group">
                        <label for="name">Paket</label>
                        <input type="hidden" name="id_paket" value="<?= $paket['id'];?>" >
                        <input type="text" name="nomor" id="name" class="form-control" placeholder="Masukkan Nomor Soal" value="<?= $paket['nama'];?>" disabled >
                    </div>
                    <div class="form-group">
                        <label for="name">Nomor Soal</label>
                        <input type="number" name="nomor" id="name" class="form-control" placeholder="Masukkan Nomor Soal" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Pertanyaan : </label>
                    </div>
                    <textarea id="myTextarea" name="pertanyaan" col="5" placeholder="Masukkan Pertanyaan"></textarea>
                    <button type="submit" name="tambah_soal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-plus'></i> Tambahkan & Lanjut Pembahasan</button>
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

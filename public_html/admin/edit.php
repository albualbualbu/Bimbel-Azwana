<?php  
include 'header.php'; 
include 'aksi.php'; 
$nav = $_GET['nav'];
$tabel = $_GET['tabel'];
$data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `$tabel` WHERE id='$_GET[id]'"));

if($tabel == "page"){
    $edit = "edit_page";
}else{
    $edit = "edit";
}


// Mengambil protokol (http atau https)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

// Mengambil host (domain)
$host = $_SERVER['HTTP_HOST'];

// Mengambil path dan query string
$requestUri = $_SERVER['REQUEST_URI'];

// Menggabungkan semua untuk mendapatkan URL lengkap
$currentUrl = $protocol . '://' . $host . $requestUri;

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-3 text-gray-800" style="text-transform:capitalize;">
        <a style="border:1px solid blue;" href="tabel.php?nav=<?= $nav;?>&tabel=<?= $tabel;?>">&nbsp;&#10094;&nbsp;</a> Edit <?= $nav;?>
        </h1>

        <a href="ubah_header_page.php?nav=<?= $nav;?>&id=<?= $data['id'];?>&tabel=<?= $tabel;?>" >
        <button type="button" class="d-sm-inline-block btn btn-sm btn-secondary shadow-sm mt-2" style="text-transform:capitalize;" ><i class='fas fa-fw fa-edit'></i> Ubah Header</button>
        </a>

    </div>

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
                            <input value='$data[nama]' type='text' name='nama' id='name' class='form-control' placeholder='Masukkan Nama Tombol' required>
                        </div>
                        ";
                    }else{
                        echo "";
                    }
                    ?>
                    <div class="form-group">
                        <label for="name">Judul</label>
                        <input value="<?= $data['judul'];?>" type="text" name="judul" id="name" class="form-control" placeholder="Masukkan Judul" required>
                    </div>
                    <div class='form-group'>
                        <label for='nisn'>Url tidak boleh ada space, gunakan underscore</label>
                        <input value='<?= $data['url'];?>' type='text' name='url' placeholder='Masukkan Url' pattern='[^\s]+' id='myInput' class='form-control' required>
                        <input type='checkbox' name='centang' id='name' value='url'> <- ubah URL ( klik ) centang
                    </div>
                    
<script>
    document.getElementById('myInput').addEventListener('keydown', function(event) {
        if (event.key === ' ') {
            event.preventDefault(); // Mencegah penekanan tombol spasi
        }
    });
        
    $(function() {
        $('#myInput').on('keypress', function(e) {
            if (e.which == 32){
            console.log('Space Detected');
            return false;
            }
        });
    });
</script>
                    <div class="form-group">
                        <label for="nisn">Gambar</label><br>
                        <img src='../<?= $data['gambar'];?>' width='200' class="m-3" />
                        <input type="file" name="image" id="nisn" class="form-control-file" placeholder="Enter Username" >
                        <input type="checkbox" name="cek" id="name" value="ada"> <- Mengubah gambar ( klik ) centang
                    </div>
                    <textarea id="myTextarea" name="isi" col="5"><?= $data['isi'];?></textarea>

                    <input type="hidden" name="id" value="<?= $data['id'];?>">
                    <input type="hidden" name="tabel" value="<?= $tabel;?>">
                    <input type="hidden" name="nav" value="<?= $nav;?>">

                    <button type="submit" name="<?= $edit;?>" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
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

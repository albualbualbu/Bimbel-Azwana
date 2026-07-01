<?php  
include 'header.php'; 
include 'aksi.php'; 

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800" style="text-transform:capitalize;">
    <a style="border:1px solid blue;" href="video.php">&nbsp;&#10094;&nbsp;</a> Tambah Video Pembelajaran
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                
    <!-- Menampilkan Pesan Error atau Success -->
    <?php
    if (isset($_SESSION['error'])) {
        echo "<div class='message-error'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<div class='message-success'>" . $_SESSION['success'] . "</div>";
        unset($_SESSION['success']);
    }
    ?>
<form method="POST" action="upload.php" enctype="multipart/form-data" id="videoForm">
    <div id="upload-form">
        <div class="form-group">
            <label for="name">Judul</label>
            <input type="text" name="judul" id="name" class="form-control" placeholder="Masukkan Judul" required>
        </div>
        <div class="form-group">
            <label for="video">Pilih Video:</label>
            <input type="file" class="form-control-file" name="video" id="video" accept="video/*" required>
            <label for="video">Maksimal Ukuran Video 40 MB</label>
        </div>
        <button type="submit" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2">
            <i class='fas fa-fw fa-plus'></i> Tambahkan
        </button>
    </div>

    <!-- Loader Bar -->
    <div id="loader-containerx" class="loader-containerx">
        <div id="loader-barx" class="loader-barx">0%</div>
    </div>
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

<script>
    const MAX_FILE_SIZE = 41943040; // 40MB dalam bytes
    const form = document.getElementById('videoForm');
    const loaderContainer = document.getElementById('loader-containerx');
    const loaderBar = document.getElementById('loader-barx');
    const uploadForm = document.getElementById('upload-form');

    form.addEventListener('submit', function(event) {
        // Mencegah pengiriman form standar
        event.preventDefault();

        const fileInput = document.getElementById('video');
        const fileSize = fileInput.files[0].size;

        // Cek ukuran file sebelum form disubmit
        if (fileSize > MAX_FILE_SIZE) {
            alert('Ukuran file video melebihi 40MB!');
            return; // Hentikan eksekusi lebih lanjut
        }

        // Menampilkan progress bar saat upload
        loaderContainer.style.display = 'block';
        uploadForm.style.display = 'none'; // Menyembunyikan form upload selama proses upload

        // Membuat FormData untuk mengirim file
        let formData = new FormData(form);

        // Mengirim request dengan XMLHttpRequest
        let xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);

        // Menangani respon setelah upload selesai
        xhr.onload = function() {
            loaderContainer.style.display = 'none'; // Menyembunyikan progress bar setelah selesai
            uploadForm.style.display = 'block'; // Menampilkan kembali form upload setelah selesai

            if (xhr.status === 200) {
                alert('Video berhasil diupload.');
                location.reload();
            } else {
                alert('Terjadi kesalahan saat mengupload video: ' + xhr.statusText);
            }
        };

        // Menangani progress upload
        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                let percent = (e.loaded / e.total) * 100;
                loaderBar.style.width = percent + '%';
                loaderBar.textContent = percent.toFixed(2) + '%';
                console.log('Progres: ' + percent.toFixed(2) + '%');
            }
        };

        // Menangani error selama upload
        xhr.onerror = function() {
            loaderContainer.style.display = 'none'; // Menyembunyikan progress bar jika terjadi error
            alert('Terjadi kesalahan jaringan saat mengupload video.');
            uploadForm.style.display = 'block'; // Menampilkan kembali form upload
        };

        // Mengirim formData
        xhr.send(formData); // Mengirim data form melalui AJAX
    });
</script>


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

</body>

</html>

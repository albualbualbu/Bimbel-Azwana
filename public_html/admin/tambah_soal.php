<?php  
include 'header.php'; 
include 'aksi.php'; 

$id = $_GET['id'];
$kat = mysqli_query($con,"SELECT * FROM `categories` WHERE `id`='$id'");
$f_kat = mysqli_fetch_array($kat);
$is_leaf = $f_kat['is_leaf'];
function getBreadcrumbs($id, $con) {
    $crumbs = [];
    while ($id !== null && $id !== 'NULL' && $id != 0) {
        $stmt = $con->prepare("SELECT id, nama, parent_id FROM `categories` WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($row = $res->fetch_assoc()) {
            // Masukkan ke array (kita akan balik urutannya nanti)
            $crumbs[] = $row['nama'];
            $id = $row['parent_id']; // Naik ke tingkat atasnya
        } else {
            break;
        }
    }
    
    // Balik urutan agar dari Utama -> Sub
    return array_reverse($crumbs);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">
    <a style="border:1px solid blue;" href="sub-category.php?id=<?= $id ?>">&nbsp;&#10094;&nbsp;</a> Tambah Soal
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
            <?php 
            if ($id !== 'NULL' && $id != 0) {
                $breadcrumbs = getBreadcrumbs($id, $con);
                foreach ($breadcrumbs as $crumb) {
                    echo " &raquo; " . htmlspecialchars($crumb);
                }
            }
            ?>
                <form class="mt-4" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nomor Soal</label>
                        <input type="number" name="nomor" id="name" class="form-control" placeholder="Masukkan Nomor Soal" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Type Jawaban :</label>
                        <select name="type" id="" class="form-control" required>
                            <option value="">~ Type Jawaban ~</option>
                            <option value="ganda">Pilihan Ganda</option>
                            <option value="essay">Jawaban Essay</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Pertanyaan : </label>
                    </div>
                    <textarea id="myTextarea" name="pertanyaan" col="5" placeholder="Masukkan Pertanyaan"></textarea>
                    <input type="hidden" name="parent_id" value="<?= $id ?>">
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

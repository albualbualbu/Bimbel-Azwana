<?php 
include 'header.php'; 
include 'aksi.php'; 
$idDelapan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='8'"));
$idDua = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='2'"));
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Lainnya
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="post" enctype="multipart/form-data" class="p-2 mb-2" style="border:2px dashed grey;">
                    <div class="form-group">
                        <label for="nisn">Deskripsi Singkat Website</label>
                        <input type="text" name="isi" id="" class="form-control" placeholder="Masukkan Deskripsi" value="<?= $idDua['isi'];?>" required>
                        <button type="submit" name="deskripsi_website" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2">
                            <i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
                <form method="post" enctype="multipart/form-data" class="p-2 mb-2" style="border:2px dashed grey;">
                    <div class="form-group">
                        <label for="nisn">Gambar Login Admin</label><br>
                        <img src="../<?= $idDelapan['isi'];?>" width="150px" alt="">
                        <input type="file" name="image" id="" class="form-control-file" required>
                        <button type="submit" name="gambar_admin" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2">
                            <i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>

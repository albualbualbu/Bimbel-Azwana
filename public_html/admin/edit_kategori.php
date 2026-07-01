<?php 
include 'header.php'; 
include 'aksi.php'; 
$hasil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `kategori` WHERE id='$_GET[x]'"));

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
        <a style="border:1px solid blue;" href="kategori.php">&nbsp;&#10094;&nbsp;</a> Edit Kategori</h1>
    </div>

    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="nama" id="name" class="form-control" placeholder="Masukkan Nama Kategori" value="<?= $hasil['nama'];?>" required >
                    </div>
                    <div class="form-group">
                        <label for="name">Gambar</label><br>
                        <img src="../<?= $hasil['gambar'];?>" width="100" alt=""><br>
                        <input type="file" name="image" id="name" class="form-control-file" >
                        <input type="checkbox" name="cek" id="" value="ada"> < Mengubah Gambar ( Centang )
                    </div>
                    <div class="form-group">
                        <label for="nisn">Keterangan :</label>
                        <textarea id="myTextarea" name="ket" col="5"><?= $hasil['keterangan'];?></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?= $hasil['id'];?>">
                    <button type="submit" name="edit_kategori" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mb-2"><i class='fas fa-fw fa-edit'></i> Simpan Perubahan</button>
                </form>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script>
ClassicEditor
    .create(document.querySelector("#myTextarea"))
    .catch(error => {
        console.error( error );
    } );
</script>
<?php include 'footer.php'; ?>

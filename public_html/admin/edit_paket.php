<?php 
include 'header.php'; 
include 'aksi.php'; 
$hasil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `kategori` WHERE id='$_GET[id_k]'"));
$hasil2 = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `paket` WHERE id='$_GET[id]'"));

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><a style="border:1px solid blue;" href="paket_soal.php?id=<?= $hasil['id'];?>">&nbsp;&#10094;&nbsp;</a> Edit Paket <?= $hasil['nama'];?></h1>
    </div>

    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nisn">Nama Paket</label>
                        <input type="text" name="paket" id="nisn" class="form-control" placeholder="Masukkan Nama Paket" value="<?= $hasil2['nama'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Menit</label>
                        <input type="number" name="menit" id="nisn" class="form-control" placeholder="Masukkan Durasi" value="<?= $hasil2['menit'];?>"  required>
                    </div>
                    <div class="form-group">
                        <label for="name">Gambar</label><br>
                        <img src="../<?= $hasil2['gambar'];?>" width="100" alt=""><br>
                        <input type="file" name="image" id="name" class="form-control-file" >
                        <input type="checkbox" name="cek" id="" value="ada"> < Mengubah Gambar ( Centang )
                    </div>
                    <div class="form-group">
                        <label for="nisn">Keterangan :</label>
                        <textarea id="myTextarea" name="ket" col="5"><?= $hasil2['keterangan'];?></textarea>
                    </div>
                    <input type="hidden" name="id_kategori" value="<?= $hasil['id'];?>">
                    <input type="hidden" name="id" value="<?= $hasil2['id'];?>">
                    <button type="submit" name="edit_paket" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->
<script>
    
function checkDelete(){
	return confirm('Anda Yakin ingin Menghapus ?');
}
</script>
<script>
ClassicEditor
    .create(document.querySelector("#myTextarea"))
    .catch(error => {
        console.error( error );
    } );
</script>

<?php include 'footer.php'; ?>

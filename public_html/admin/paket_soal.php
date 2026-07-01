<?php 
include 'header.php'; 
include 'aksi.php'; 
$hasil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `kategori` WHERE id='$_GET[id]'"));

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><a style="border:1px solid blue;" href="semua_soal.php">&nbsp;&#10094;&nbsp;</a> Paket Soal <?= $hasil['nama'];?></h1>
    </div>

    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nisn">Nama Paket</label>
                        <input type="text" name="paket" id="nisn" class="form-control" placeholder="Masukkan Nama Paket" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Menit</label>
                        <input type="number" name="menit" id="nisn" class="form-control" placeholder="Masukkan Durasi" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Gambar</label>
                        <input type="file" name="image" id="name" class="form-control-file" >
                    </div>
                    <div class="form-group">
                        <label for="nisn">Keterangan :</label>
                        <textarea id="myTextarea" name="ket" col="5"></textarea>
                    </div>
                    <input type="hidden" name="id_kategori" value="<?= $hasil['id'];?>">
                    <button type="submit" name="tambah_paket" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-plus'></i> Tambahkan</button>
                </form>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Paket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../penghubung.php";
                        $paket = mysqli_query($con, "SELECT * FROM paket WHERE id_kategori='$_GET[id]'");

                        $tr = "";  // Initialize the $tr variable
                        while ($hasil2 = mysqli_fetch_array($paket)) {
                            $tr .= "
                            <tr>
                                <td>{$hasil2['nama']}</td>
                                <td>
                                    <a href='tabel_soal.php?id_p={$hasil2['id']}&id_k={$hasil2['id_kategori']}' class='edit'>
                                        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-success shadow-sm'><i class='fas fa-fw fa-th-list'></i> Soal</button>
                                    </a>
                                    <a href='edit_paket.php?id={$hasil2['id']}&id_k={$hasil2['id_kategori']}' class='edit'>
                                        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                    </a>
                                    <a href='aksi.php?aksi=hapus_paket&id={$hasil2['id']}&id_k={$hasil2['id_kategori']}' onclick='return checkDelete()'>
                                        <button type='button' name='delete' class='d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm'><i class='fas fa-fw fa-trash'></i> Delete</button>
                                    </a>
                                </td>
                            </tr>
                            ";
                        }

                        echo $tr;
                        ?>
                    </tr>
                    </tbody>
                </table>
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

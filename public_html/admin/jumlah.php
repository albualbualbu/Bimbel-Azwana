<?php 
include 'header.php'; 
include 'aksi.php'; 

$idSembilan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='9'"));
$idSepuluh = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='10'"));
$idSebelas = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='11'"));
$idDuabelas = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='12'"));
$idDuaSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='21'"));

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="text-transform:capitalize;">Jumlah</h1>
    </div>

    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive mb-4">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <img src="../<?= $idDuaSatu['isi'];?>" width="150" alt=""><br><br>
                        <label for="nisn">Ubah Gambar :</label>
                        <input type="file" name="image" id="nisn" class="form-control-file" placeholder="Enter Username" required>
                    </div>
                    <button type="submit" name="ubah_gambar_jumlah" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-file-signature'></i> Ubah Gambar</button>
                </form>
            </div>
        
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Jumlah</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $idSembilan['tambahan'];?></td>
                            <td><?= $idSembilan['judul'];?></td>
                            <td>
                                <a href='edit_jumlah.php?id=9' class='edit'>
                                    <button type='button' class=' d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $idSepuluh['tambahan'];?></td>
                            <td><?= $idSepuluh['judul'];?></td>
                            <td>
                                <a href='edit_jumlah.php?id=10' class='edit'>
                                    <button type='button' class=' d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $idSebelas['tambahan'];?></td>
                            <td><?= $idSebelas['judul'];?></td>
                            <td>
                                <a href='edit_jumlah.php?id=11' class='edit'>
                                    <button type='button' class=' d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $idDuabelas['tambahan'];?></td>
                            <td><?= $idDuabelas['judul'];?></td>
                            <td>
                                <a href='edit_jumlah.php?id=12' class='edit'>
                                    <button type='button' class=' d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                </a>
                            </td>
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
<?php include 'footer.php'; ?>

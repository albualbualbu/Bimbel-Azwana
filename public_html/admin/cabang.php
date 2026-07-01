<?php 
include 'header.php'; 
include 'aksi.php'; 

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="text-transform:capitalize;">Cabang</h1>
    </div>

    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive mb-4">
                <form method="POST">
                    <div class="form-group">
                        <input type="text" name="nama" placeholder="Masukkan Nama Cabang" class="form-control" id="">
                    </div>
                    <button type="submit" name="tambah_cabang" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-plus'></i> Tambahkan</button>
                </form>
            </div>
        
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Cabang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q = mysqli_query($con,"SELECT * FROM `cabang`");
                        while($f = mysqli_fetch_array($q)){
                            $id = $f['id'];
                            $nama = $f['nama'];
                            ?>
                        <tr>
                            <td><?= $nama?></td>
                            <td>
                                <a href='#' data-toggle='modal' data-target='#cabang_<?= $id;?>'>
                                    <button type='button' class='d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                </a>
                                <a href='aksi.php?aksi=hapus_cabang&id=<?= $f['id']?>' onclick="return checkDelete()">
                                    <button type='button' class='d-sm-inline-block btn btn-sm btn-danger shadow-sm mt-1'><i class='fas fa-fw fa-trash'></i> Delete</button>
                                </a>
                            </td>
                        </tr>
                                    
<!-- Lihat Modal-->
<div class='modal fade' id='cabang_<?= $id;?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLabel'>Edit</h3>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true' style='color:#d6d6d6;'>×</span>
                </button>
            </div>
            <form method='post'>
                <div class='modal-body text-left'>
                    <div class="form-group">
                        <label for="name">Nama Cabang :</label>
                        <input type='text' class='form-control' placeholder='Masukkan Nama Cabang' name='nama' value='<?= $nama;?>'>
                    </div>
                </div>
                <div class='modal-footer'>
                    <input type='hidden' name='id' value='<?= $id;?>'>
                    <button name='edit_cabang' class='btn btn-success' type='submit'>Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Modal-->
                        <?php
                        }
                        ?>
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

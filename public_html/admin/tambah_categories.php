<?php 
include 'header.php'; 
include 'aksi.php'; 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
        <a style="border:1px solid blue;" href="semua_soal.php">&nbsp;&#10094;&nbsp;</a> Kategori</h1>
    </div>

    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="nama" id="name" class="form-control" placeholder="Masukkan Nama Kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Gambar</label>
                        <input type="file" name="image" id="name" class="form-control-file" >
                    </div>
                    <div class="form-group">
                        <label for="nisn">Keterangan :</label>
                        <textarea id="myTextarea" name="ket" col="5"></textarea>
                        </div>
                    <button type="submit" name="tambah_kategori" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mb-2"><i class='fas fa-fw fa-plus'></i> Tambahkan</button>
                </form>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../penghubung.php";
                        $kategori = mysqli_query($con, "SELECT * FROM `kategori` ORDER BY id DESC");

                        $tr = "";  // Initialize the $tr variable
                        while ($hasil = mysqli_fetch_array($kategori)) {
                            $tr .= "
                            <tr>
                                <td>{$hasil['nama']}</td>
                                <td>
                                    <a href='edit_kategori.php?x={$hasil['id']}' class='edit'>
                                        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                    </a>
                                    <a href='aksi.php?aksi=hapus_kategori&x={$hasil['id']}' onclick='return checkDelete()'>
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
	return confirm('Tindakan Menghapus Kategori akan MENGHAPUS SEMUA SOAL DIDALAMNYA, Anda Yakin ingin Menghapus ?');
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

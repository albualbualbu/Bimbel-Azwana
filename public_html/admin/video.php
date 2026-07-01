<?php 
include 'header.php'; 
include 'aksi.php'; 

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="text-transform:capitalize;">Video Pembelajaran</h1>
        
        <a href="ubah_header_video.php" >
        <button type="button" class="d-sm-inline-block btn btn-sm btn-secondary shadow-sm mt-2" style="text-transform:capitalize;" ><i class='fas fa-fw fa-edit'></i> Ubah Header</button>
        </a>

        <a href="tambah_video.php">
        <button type="button" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2" style="text-transform:capitalize;" ><i class='fas fa-fw fa-plus'></i> Tambah Video</button>
        </a>
    </div>

    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../penghubung.php";
                        $query = mysqli_query($con, "SELECT * FROM `video` ORDER BY id DESC");

                        $tr = "";  // Initialize the $tr variable
                        while ($hasil = mysqli_fetch_array($query)) {
                            $tr .= "
                            <tr>
                                <td>{$hasil['judul']}</td>
                                <td>
                                    <a href='edit_video.php?id={$hasil['id']}' class='edit'>
                                        <button type='button' class=' d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1'><i class='fas fa-fw fa-edit'></i> Edit Judul</button>
                                    </a>
                                    <a href='aksi.php?aksi=hapus_video&id={$hasil['id']}' onclick='return checkDelete()'>
                                        <button type='button' name='delete' class='d-sm-inline-block btn btn-sm btn-danger shadow-sm mt-1'><i class='fas fa-fw fa-trash'></i> Delete</button>
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
<?php include 'footer.php'; ?>

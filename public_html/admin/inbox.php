<?php 
include "../penghubung.php";
include 'header.php'; 
include 'aksi.php'; 

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mt-2 text-gray-800">
        Kotak Masuk
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    $inbox_q = mysqli_query($con,"SELECT * FROM inbox ORDER BY id DESC");
    while($inbox = mysqli_fetch_array($inbox_q)){
        if($inbox['level'] == 0){
            $merah = "#ffdaff";
        }else{
            $merah = "transparent";
        }
    echo "
    <tr style='background:$merah;'>
        <td>{$inbox['nama']}</td>
        <td>
            <a href='aksi.php?aksi=tandai&id={$inbox['id']}' class='edit'>
                <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm'>
                    <i class='fas fa-fw fa-eye-slash'></i> Tandai Belum Dibaca
                </button>
            </a>
            <a href='aksi.php?aksi=tandai_dilihat&id={$inbox['id']}' class='edit'>
                <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'>
                    <i class='fas fa-fw fa-eye'></i> Lihat
                </button>
            </a>
            <a href='aksi.php?aksi=hapus_inbox&id={$inbox['id']}' class='edit' onclick='return checkDelete()'>
                <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm'>
                    <i class='fas fa-fw fa-trash'></i> Delete
                </button>
            </a>
        </td>
    </tr>
    ";
    }
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

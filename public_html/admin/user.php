<?php 
include 'header.php'; 
include 'aksi.php'; 

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mt-2 text-gray-800">
        User Siswa
        </h1>

        <a href="tambah_user.php">
            <button type="button" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2">
            <i class='fas fa-fw fa-plus'></i> Tambah User Siswa</button>
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Cabang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../penghubung.php";
                        $no = 1 ;
                        $user = mysqli_query($con, "SELECT * FROM user ORDER BY id DESC");
                        while ($hasil = mysqli_fetch_array($user)) {
                            $cabang = $hasil['nama'] == "" ? "~" : $hasil['nama'] ;
                            echo "
                            <tr>
                                <td>$no</td>
                                <td>{$hasil['email']}</td>
                                <td>{$hasil['nama']}</td>
                                <td>$cabang</td>
                                <td>
                                    <a href='nilai.php?id={$hasil['id']}' class='edit'>
                                        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm'><i class='fas fa-fw fa-th-large'></i> Nilai</button>
                                    </a>
                                    <a href='akses_soal.php?id={$hasil['id']}' class='edit'>
                                        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-info shadow-sm'><i class='fas fa-fw fa-th-list'></i> Akses Soal</button>
                                    </a>
                                    <a href='edit_user.php?id={$hasil['id']}' class='edit'>
                                        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                    </a>
                                    <a href='aksi.php?aksi=hapus_user&id={$hasil['id']}' onclick='return checkDelete()'>
                                        <button type='button' name='delete' class='d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm'><i class='fas fa-fw fa-trash'></i> Delete</button>
                                    </a>
                                </td>
                            </tr>
                            ";
                            $no++;
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

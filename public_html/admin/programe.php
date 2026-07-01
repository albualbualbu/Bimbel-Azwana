<?php  
include 'header.php'; 
include 'aksi.php'; 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-3 text-gray-800">
        Program
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nisn">Program</label>
                        <input type="text" name="nama" id="nisn" class="form-control" placeholder="Masukkan Nama Program" required>
                    </div>
                    <button type="submit" name="tambah_program" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2 mb-4"><i class='fas fa-fw fa-plus'></i> Tambahkan</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Program</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $program_q = mysqli_query($con,"SELECT * FROM program");
                        while($prog = mysqli_fetch_array($program_q)){
                            echo"
                            <tr>
                                <td>$prog[nama]</td>
                                <td>
                                    <a href='sub_program.php?id={$prog['id']}' class='edit'>
                                        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-success shadow-sm'><i class='fas fa-fw fa-plus'></i> Sub Program</button>
                                    </a>

                                    <a href='edit_programe.php?id={$prog['id']}' class='edit'>
                                        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                    </a>

                                    <a href='aksi.php?aksi=hapus_program&id={$prog['id']}' onclick='return checkDelete()'>
                                        <button type='button' name='delete' class='d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm'><i class='fas fa-fw fa-trash'></i> Delete</button>
                                    </a>
                                </td>
                            </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    
function checkDelete(){
	return confirm('Anda Yakin ingin Menghapus ?');
}
</script>

<?php
include "footer.php";
?>

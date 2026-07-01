<?php  
include 'header.php'; 
include 'aksi.php'; 
$program = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM program WHERE id='$_GET[id]'"));
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-3 text-gray-800">
            <a style="border:1px solid blue;" href="programe.php">&nbsp;&#10094;&nbsp;</a> Sub <?= $program['nama'];?>
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id_program" value="<?= $program['id'];?>">

                    <div class="form-group">
                        <label for="nisn">Sub Program</label>
                        <input type="text" name="nama" id="nisn" class="form-control" placeholder="Masukkan Nama Sub Program" required>
                    </div>
                    <textarea id="myTextarea" name="isi" col="5" placeholder="Masukkan Deskripsi Program"></textarea>


                    <button type="submit" name="tambah_sub_program" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2 mb-4"><i class='fas fa-fw fa-plus'></i> Tambahkan</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Sub Program</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $program_q = mysqli_query($con,"SELECT * FROM sub_program WHERE id_program='$_GET[id]'");
                        while($prog = mysqli_fetch_array($program_q)){
                            echo"
                            <tr>
                                <td>$prog[nama]</td>
                                <td>
                                    <a href='edit_sub_program.php?id={$prog['id']}&id_sub=$_GET[id]' class='edit'>
                                        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                    </a>

                                    <a href='aksi.php?aksi=hapus_sub_program&id_sub={$prog['id']}&id_p=$_GET[id]' onclick='return checkDelete()'>
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
ClassicEditor
    .create(document.querySelector("#myTextarea"))
    .catch(error => {
        console.error( error );
    } );
</script>
<script>
    
function checkDelete(){
	return confirm('Anda Yakin ingin Menghapus ?');
}
</script>

<?php
include "footer.php";
?>

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
            <a style="border:1px solid blue;" href="programe.php">&nbsp;&#10094;&nbsp;</a> Edit Program
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $program['id'];?>">

                    <div class="form-group">
                        <label for="">Program</label>
                        <input type="text" name="nama" id="" class="form-control" placeholder="Masukkan Nama Program" value="<?= $program['nama'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">URL tidak boleh ada space, gunakan underscore</label>
                        <input type="text" name="url" id="myInput" class="form-control" placeholder="Masukkan Nama Program" value="<?= $program['url'];?>" required>
                    </div>

<script>
    document.getElementById('myInput').addEventListener('keydown', function(event) {
        if (event.key === ' ') {
            event.preventDefault(); // Mencegah penekanan tombol spasi
        }
    });
        
    $(function() {
        $('#myInput').on('keypress', function(e) {
            if (e.which == 32){
            console.log('Space Detected');
            return false;
            }
        });
    });
</script>

                    <button type="submit" name="edit_program" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2 mb-4"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
                </form>
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

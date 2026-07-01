<?php  
include 'header.php'; 
include 'aksi.php'; 
$program = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM sub_program WHERE id='$_GET[id]'"));
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-3 text-gray-800">
            <a style="border:1px solid blue;" href="sub_program.php?id=<?= $_GET['id_sub'];?>">&nbsp;&#10094;&nbsp;</a> Edit Sub Program
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
                    <textarea id="myTextarea" name="isi" col="5" placeholder="Masukkan Deskripsi Program"><?= $program['isi'];?></textarea>

                    <button type="submit" name="edit_sub_program" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2 mb-4"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
                </form>
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

<?php
include "footer.php";
?>

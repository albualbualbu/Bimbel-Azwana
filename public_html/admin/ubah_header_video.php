<?php  
include 'header.php'; 
include 'aksi.php'; 

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">
    <a style="border:1px solid blue;" href="video.php">&nbsp;&#10094;&nbsp;</a> Ubah Header Video
    </h1>
<?php
    $queryz=mysqli_query($con,"SELECT * FROM `galeri` WHERE judul='video'");
    $hasilz= mysqli_fetch_array($queryz);
        $img = "
        <div class='bgbg' style='background-image:url(../$hasilz[gambar])' onclick='openModal(\"../" . $hasilz['gambar'] . "\")'></div>";

?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nisn">Gambar</label>
                        <?= $img;?>
                        <input type="file" name="image" id="nisn" class="form-control-file" placeholder="Enter Username" required>
                    </div>
                    <input type="hidden" name="nav" value="video" required >
                    <input type="hidden" name="tabel" value="galeri" required >
                    <button type="submit" name="ubah_header_video" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>
        <div style="display:block;">
        </div>

    </div>

</div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <img class="modal-content" id="modalImage">
        <center>
            <span class="close" onclick="closeModal()">&times;</span>
        </center>
    </div>

<!-- /.container-fluid -->

<script>
function openModal(imageSrc) {
    document.getElementById('myModal').style.display = 'block';
    document.getElementById('modalImage').src = imageSrc;
}

function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}
</script>
<script>
    
function checkDelete(){
	return confirm('Anda Yakin ingin Menghapus ?');
}
</script>

<?php
include "footer.php";
?>

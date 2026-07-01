<?php  
include 'header.php'; 
include 'aksi.php'; 
$tabel = $_GET['tabel'];
if(isset($_GET['nav']) && $_GET['nav']){
    $nav = $_GET['nav'];
    $disabled = "";
    $pesan = "";
}else{
    $disabled = "disabled";
    $pesan = "<p style='color:red;'>Kembalilah ke halaman Sebelumnya !. Terjadi Kesalahan pada URL</p>";
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">
    <a style="border:1px solid blue;" href="edit.php?nav=<?= $nav;?>&id=<?= $_GET['id'];?>&tabel=<?= $tabel;?>">&nbsp;&#10094;&nbsp;</a> Ubah Header
    </h1>
<?php
if($nav == "selengkapnya"){
    $queryz=mysqli_query($con,"SELECT * FROM `page` WHERE id='$_GET[id]'");
    $hasilz= mysqli_fetch_array($queryz);
        $img = "
        <div class='bgbg' style='background-image:url(../$hasilz[header])' onclick='openModal(\"../" . $hasilz['header'] . "\")'></div>";
}else{
    $queryz=mysqli_query($con,"SELECT * FROM `$tabel` WHERE id='$_GET[id]'");
    $hasilz= mysqli_fetch_array($queryz);
        $img = "
        <div class='bgbg' style='background-image:url(../$hasilz[header])' onclick='openModal(\"../" . $hasilz['header'] . "\")'></div>";
}

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
                    <input type="hidden" name="nav" value="<?= $nav;?>" required >
                    <input type="hidden" name="tabel" value="<?= $tabel;?>" required >
                    <input type="hidden" name="id" value="<?= $_GET['id'];?>" required >
                    <button <?= $disabled;?> type="submit" name="ubah_header_page" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
                </form>
                <?= $pesan;?>
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

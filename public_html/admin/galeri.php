<?php  
include 'header.php'; 
include 'aksi.php'; 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">
    Penyimpanan Gambar
    </h1>
    <p>Penyimpanan ini untuk kebutuhan paragraf artikel yang ingin diisi gambar dengan cara copy paste setelah upload disini berhasil.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nisn">Gambar</label>
                        <input type="file" name="image" id="nisn" class="form-control-file" placeholder="Enter Username" required>
                    </div>
                    <button type="submit" name="tambah_gambar" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-plus'></i> Tambahkan</button>
                </form>
            </div>
        </div>
        <div style="display:block;">
<?php
include "../penghubung.php";
$queryz=mysqli_query($con,"SELECT * FROM gambar ORDER BY id DESC");
while($hasilz= mysqli_fetch_array($queryz)){
    echo "
    <div style='display:inline-block; margin:2px; background:#e9e9e9;'>
    <div class='bgbg' style='background-image:url(../$hasilz[gambar])' onclick='openModal(\"../" . $hasilz['gambar'] . "\")'></div>
    <a href='aksi.php?aksi=hapus_galeri&id=$hasilz[id]' onclick='return checkDelete()'>
    <center>
    <button type='button' name='tambah_gambar' class='btn btn-sm btn-danger shadow-sm m-2'><i class='fas fa-fw fa-trash'></i> Hapus</button>
    </center>
    </a>
    </div>
";
}

?>
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

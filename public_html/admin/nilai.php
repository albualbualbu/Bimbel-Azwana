<?php 
include "../penghubung.php";
include 'header.php'; 
include 'aksi.php'; 

$siswa = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM user WHERE id='$_GET[id]'"));
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mt-2 text-gray-800">
        <a style="border:1px solid blue;" href="user.php">&nbsp;&#10094;&nbsp;</a> Tabel Nilai <?= $siswa['nama'];?>
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Paket</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
// Pastikan session sudah dimulai jika perlu
// session_start();

// Mengambil id_user dari GET dan mengamankan inputan
$id_user = mysqli_real_escape_string($con, $_GET['id']);

// Query untuk mengambil data nilai berdasarkan id_user
$query_nilai = "SELECT * FROM nilai WHERE id_user='$id_user'";
$result_nilai = mysqli_query($con, $query_nilai);

// Loop untuk menampilkan data nilai
while ($hasil = mysqli_fetch_array($result_nilai)) {
    // Mengambil data paket berdasarkan id_paket yang ada pada hasil nilai
    $id_paket = $hasil['parent_id'];
    $query_paket = "SELECT * FROM `categories` WHERE id='$id_paket'";
    $result_paket = mysqli_query($con, $query_paket);
    $paket = mysqli_fetch_array($result_paket);
    
    echo "
    <tr>
        <td>{$paket['nama']}</td>
        <td>{$hasil['nilai']}</td>
        <td>
            <a href='lihat.php?id_p={$paket['id']}&id_s=$siswa[id]&n=1' class='edit'>
                <button type='button' class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'>
                    <i class='fas fa-fw fa-eye'></i> Lihat
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

<?php
include 'header.php';
include '../penghubung.php';

if(!isset($_SESSION["admin"])){

    echo '<script>window.location.href="./";</script>';
   
   }
?>

<style>
    .kategori:hover{
        background:#ddf7ff;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paket Soal</h1>
        <a href="kategori.php">
        <button type="button" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2" style="text-transform:capitalize;" ><i class='fas fa-fw fa-plus'></i>Tambah Kategori</button>
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">

<?php
$kategori = mysqli_query($con, "SELECT * FROM kategori");
$div="";
while($hasil = mysqli_fetch_array($kategori)){
    $div.="
    <!-- Card Data Kelas -->
    <div class='col-xl-4 col-md-6 mb-4'>
    <a href='paket_soal.php?id={$hasil['id']}'>
        <div class='card border-left-primary shadow h-100 py-2 kategori'>
            <div class='card-body'>
                <div class='row no-gutters align-items-center'>
                    <div class='col mr-2'>
                        <div class='h4 font-weight-bold text-primary text-uppercase mb-1'>{$hasil['nama']}</div>
                        <div class='h5 mb-0 font-weight-bold text-gray-800'></div>
                    </div>
                    <div class='col-auto'>
                        <i class='fas fa-th-list fa-2x text-gray-400'></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
    </div>
";
}
echo $div;
?>
        
    </div>

</div>

<!-- /.container-fluid -->

<?php include 'footer.php'; ?>
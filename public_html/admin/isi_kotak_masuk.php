<?php 
include "../penghubung.php";
include 'header.php'; 
include 'aksi.php'; 

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mt-2 text-gray-800">
        <a style="border:1px solid blue;" href="inbox.php">&nbsp;&#10094;&nbsp;</a> Kotak Masuk
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
<?php
    $inbox_q = mysqli_query($con,"SELECT * FROM inbox WHERE id='$_GET[id]'");
    $inbox = mysqli_fetch_array($inbox_q);
    $id_program = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM program WHERE id='$inbox[id_program]'"));
    $id_sub = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `sub_program` WHERE id='$inbox[id_sub]'"));
    $program = isset($id_program['nama']) ? $id_program['nama'] : "~";
    $subprogram = isset($id_sub['nama']) ? $id_sub['nama'] : "~";
    $nama = isset($inbox['nama']) ? $inbox['nama'] : "~";
    $email = isset($inbox['email']) ? $inbox['email'] : "~";
    $nomor = isset($inbox['wa']) ? $inbox['wa'] : "~";

    $program = htmlspecialchars($program, ENT_QUOTES, 'UTF-8');
    $subprogram = htmlspecialchars($subprogram, ENT_QUOTES, 'UTF-8');
    $nama = htmlspecialchars($nama, ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $nomor = htmlspecialchars($nomor, ENT_QUOTES, 'UTF-8');
    echo "
    <tr>
        <td>Program</td>
        <td>: $program</td>
    </tr>
    <tr>
        <td>Sub Program</td>
        <td>: $subprogram</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>: $nama</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>: $email</td>
    </tr>
    <tr>
        <td>Nomor Whatsapp</td>
        <td>: $nomor</td>
    </tr>
    ";
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

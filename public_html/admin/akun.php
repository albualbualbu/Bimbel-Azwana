<?php 
include 'header.php'; 
include 'aksi.php'; 
$santri = mysqli_query($con, "SELECT * FROM `login` WHERE id='1'");
$hasil = mysqli_fetch_array($santri);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Akun Admin
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" action="aksi_admin.php">
                    <div class="form-group">
                        <label for="nisn">Username</label>
                        <input value="<?php echo $hasil["username"];?>" type="text" name="username" id="nisn" class="form-control" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Password</label>
                        <input type="password" name="password" id="nisn" class="form-control" placeholder="Kosongkan jika tidak ada perubahan password">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="cek" value="ada"> Ganti Password
                    </div>
                    <button type="submit" class=" d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>

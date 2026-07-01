<?php 
include 'header.php'; 
include 'aksi.php'; 

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <a style="border:1px solid blue;" href="user.php">&nbsp;&#10094;&nbsp;</a> Tambah User Siswa
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" action="" entype="multypart/form-data">
                    <div class="form-group">
                        <label for="nisn">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Email</label>
                        <input type="text" name="email"  class="form-control" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Cabang</label>
                        <select name="cabang" class="form-control" id="" required>
                            <option value="">~ Pilih Cabang ~</option>
                            <?php
                            $q = mysqli_query($con,"SELECT * FROM `cabang`");
                            while($f = mysqli_fetch_array($q)){
                            ?>
                            <option value="<?= $f['nama']?>"><?= $f['nama']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" name="tambah_user" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Selanjutnya <i class='fas fa-fw fa-angle-right'></i></button>
                </form>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>

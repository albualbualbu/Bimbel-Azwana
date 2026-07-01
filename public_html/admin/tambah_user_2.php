<?php 
include 'header.php'; 
include 'aksi.php'; 

$email = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `user` WHERE email='$_GET[email]'"));

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        Detail User Siswa
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" action="" enctype="multypart/form-data">
                    <input type="hidden" name="email" value="<?= $email['email'];?>">
                    <div class="form-group">
                        <label for="nisn">Foto</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Jenis Kelamin :</label>
                        <div class="d-flex">
                            <input type="radio" name="gender" value="Laki-laki" >&nbsp;Laki-laki
                        </div>
                        <div class="d-flex">
                            <input type="radio" name="gender" value="Perempuan" >&nbsp;Perempuan
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Kelas :</label>
                        <input type="text" name="kelas"  class="form-control" placeholder="Masukkan Kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Asal Sekolah :</label>
                        <input type="text" name="asal_sekolah"  class="form-control" placeholder="Masukkan Asal Sekolah" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Tempat Tanggal Lahir Anak :</label>
                        <div class="justify-content-between d-flex">
                            <input type="text" name="tempat_lahir_anak"  class="form-control" placeholder="Masukkan Kota" required>
                            <input type="date" name="tgl_lahir_anak"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Alamat :</label>
                        <input type="text" name="alamat"  class="form-control" placeholder="Masukkan Alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Anak ke :</label>
                        <input type="number" name="anak_ke"  class="form-control" placeholder="Masukkan Anak ke" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Pendidikan Terakhir :</label>
                        <input type="text" name="pendidikan_terakhir" placeholder="Masukkan Pendidikan Terakhir" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Nama Ibu :</label>
                        <input type="text" name="nama_ibu" placeholder="Masukkan Nama Ibu" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Pekerjaan Ibu :</label>
                        <input type="text" name="pekerjaan_ibu" placeholder="Masukkan Pekerjaan Ibu" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Sosial Media Ibu :</label>
                        <div class="justify-content-between d-flex">
                            <select name="medsos" placeholder="Masukkan Nama Aplikasi" required class="form-control">
                                <option value="">Pilih Aplikasi</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Twitter">Twitter</option>
                                <option value="Tiktok">Tiktok</option>
                            </select>
                            <input type="text" name="medsos_ibu" placeholder="Masukkan Sosmed Ibu" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Nama Ayah :</label>
                        <input type="text" name="nama_ayah" placeholder="Masukkan Nama Ayah" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Tempat Tanggal Lahir Ayah :</label>
                        <div class="justify-content-between d-flex">
                            <input type="text" name="tempat_lahir_ayah"  class="form-control" placeholder="Masukkan Kota" required>
                            <input type="date" name="tgl_lahir_ayah"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Pekerjaan Ayah :</label>
                        <input type="text" name="pekerjaan_ayah" placeholder="Masukkan Pekerjaan Ayah" required class="form-control">
                    </div>

                    <button type="submit" name="tambah_isi_user" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class='fas fa-fw fa-plus'></i> Tambahkan</button>
                </form>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>

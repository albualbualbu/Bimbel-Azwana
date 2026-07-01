<?php 
include 'header.php'; 
include 'aksi.php'; 
$hasil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `user` WHERE id='$_GET[id]'"));
$cabang = (!empty($hasil['cabang'])) ? "<option value='$hasil[cabang]'>$hasil[cabang]</option>" : "";
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
    <a style="border:1px solid blue;" href="user.php">&nbsp;&#10094;&nbsp;</a> Edit User Siswa
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nisn">Foto</label><br>
                        <img src="../<?= $hasil['foto'];?>" width="150px" alt="">
                        <input type="checkbox" name="cek" id="" value="ada"> < Mengubah Foto ( Centang )
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Cabang</label>
                        <select name="cabang" class="form-control" id="" required>
                            <?= $cabang?>
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
                    <div class="form-group">
                        <label for="nisn">Nama</label>
                        <input value="<?= $hasil['nama'];?>" type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Email</label>
                        <input value="<?= $hasil['email'];?>" type="text" name="email"  class="form-control" placeholder="Masukkan Email" required>
                        <input type="checkbox" name="cek_email" id="" value="ada"> < Mengubah Email ( Centang )
                    </div>
                    <div class="form-group">
                        <label for="nisn">Password</label>
                        <input type="text" name="password" value="<?= $hasil['password'];?>" class="form-control" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Jenis Kelamin :</label>
                        <div class="d-flex">
                            <input type="radio" name="gender" value="Laki-laki" <?php if ($hasil['jenis_kelamin'] == 'Laki-laki') echo 'checked'; ?> >&nbsp;Laki-laki
                        </div>
                        <div class="d-flex">
                            <input type="radio" name="gender" value="Perempuan" <?php if ($hasil['jenis_kelamin'] == 'Perempuan') echo 'checked'; ?> >&nbsp;Perempuan
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Kelas :</label>
                        <input type="text" name="kelas" value="<?= $hasil['kelas'];?>" class="form-control" placeholder="Masukkan Kelas" >
                    </div>
                    <div class="form-group">
                        <label for="nisn">Asal Sekolah :</label>
                        <input type="text" name="asal_sekolah" value="<?= $hasil['asal_sekolah'];?>"  class="form-control" placeholder="Masukkan Asal Sekolah" >
                    </div>
                    <div class="form-group">
                        <label for="nisn">Tempat Tanggal Lahir Anak :</label>
                        <div class="justify-content-between d-flex">
                            <input type="text" name="tempat_lahir_anak" value="<?= $hasil['tempat_lahir_anak'];?>"  class="form-control" placeholder="Masukkan Kota" >
                            <input type="date" name="tgl_lahir_anak" value="<?= $hasil['tgl_lahir_anak'];?>" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Alamat :</label>
                        <input type="text" name="alamat" value="<?= $hasil['alamat'];?>" class="form-control" placeholder="Masukkan Alamat" >
                    </div>
                    <div class="form-group">
                        <label for="nisn">Anak ke :</label>
                        <input type="number" name="anak_ke" value="<?= $hasil['anak_ke'];?>" class="form-control" placeholder="Masukkan Anak ke" >
                    </div>
                    <div class="form-group">
                        <label for="nisn">Pendidikan Terakhir :</label>
                        <input type="text" name="pendidikan_terakhir" value="<?= $hasil['pendidikan_terakhir'];?>" placeholder="Masukkan Pendidikan Terakhir"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Nama Ibu :</label>
                        <input type="text" name="nama_ibu" value="<?= $hasil['nama_ibu'];?>" placeholder="Masukkan Nama Ibu"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Pekerjaan Ibu :</label>
                        <input type="text" name="pekerjaan_ibu" value="<?= $hasil['pekerjaan_ibu'];?>" placeholder="Masukkan Pekerjaan Ibu"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Sosial Media Ibu :</label>
                        <div class="justify-content-between d-flex">
                            <select name="medsos" placeholder="Masukkan Nama Aplikasi"  class="form-control">
                                <option value="">Pilih Aplikasi</option>
                                <option value="Facebook" <?php if($hasil['medsos'] == "Facebook" ){ echo "selected"; }?> >Facebook</option>
                                <option value="Instagram" <?php if($hasil['medsos'] == "Instagram" ){ echo "selected"; }?> >Instagram</option>
                                <option value="Twitter" <?php if($hasil['medsos'] == "Twitter" ){ echo "selected"; }?> >Twitter</option>
                                <option value="Tiktok" <?php if($hasil['medsos'] == "Tiktok" ){ echo "selected"; }?> >Tiktok</option>
                            </select>
                            <input type="text" name="medsos_ibu" value="<?= $hasil['medsos_ibu'];?>" placeholder="Masukkan Sosmed Ibu"  class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Nama Ayah :</label>
                        <input type="text" name="nama_ayah" value="<?= $hasil['nama_ayah'];?>" placeholder="Masukkan Nama Ayah"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nisn">Tempat Tanggal Lahir Ayah :</label>
                        <div class="justify-content-between d-flex">
                            <input type="text" name="tempat_lahir_ayah"  value="<?= $hasil['tempat_lahir_ayah'];?>" class="form-control" placeholder="Masukkan Kota" >
                            <input type="date" name="tgl_lahir_ayah"  value="<?= $hasil['tgl_lahir_ayah'];?>" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Pekerjaan Ayah :</label>
                        <input type="text" name="pekerjaan_ayah" value="<?= $hasil['pekerjaan_ayah'];?>" placeholder="Masukkan Pekerjaan Ayah"  class="form-control">
                    </div>
                    <input type="hidden" name="id" value="<?= $hasil['id'];?>">
                    <button type="submit" name="edit_user" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
                </form>
            </div>


        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>

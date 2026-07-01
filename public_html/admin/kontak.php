<?php 
include 'header.php'; 
include 'aksi.php'; 

$alamat = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='alamat'"));
$telephone = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='telephone'"));
$email = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='email'"));
$youtube = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='youtube'"));
$twitter = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='twitter'"));
$facebook = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='facebook'"));
$instagram = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='instagram'"));
$tiktok = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='tiktok'"));
$whatsapp = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='whatsapp'"));
$pesan_whatsapp = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE judul='pesan_whatsapp'"));
    $convert_pesan_whatsapp = urldecode($pesan_whatsapp['isi']);
    $hasil_convert = htmlspecialchars($convert_pesan_whatsapp, ENT_QUOTES, 'UTF-8');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm align-items-center justify-content mb-4">
        <h1 class="h3 mt-3 text-gray-800">
        Kontak
    </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST">
                    <div class="form-group">
                        <label for="name">Whatsapp</label>
                        <input value="<?= $whatsapp['tambahan'];?>" type="text" name="isi_whatsapp" id="name" class="form-control" placeholder="Masukkan Pesan Singkat" required>
                        <input value="<?= $whatsapp['isi'];?>" type="text" name="whatsapp" id="name" class="form-control" placeholder="Masukkan Nomor Whatsapp dengan awalan 62" required>
                        <input value="<?= $hasil_convert;?>" type="text" name="pesan_whatsapp" id="name" class="form-control" placeholder="Masukkan Pesan Whatsapp" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Alamat</label>
                        <input value="<?= $alamat['isi'];?>" type="text" name="alamat" id="name" class="form-control" placeholder="Masukkan Alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nomor Telp</label>
                        <input value="<?= $telephone['isi'];?>" type="text" name="nomor" id="name" class="form-control" placeholder="Masukkan Nomor Telpon" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input value="<?= $email['isi'];?>" type="text" name="email" id="name" class="form-control" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Youtube</label>
                        <input value="<?= $youtube['isi'];?>" type="text" name="youtube" id="name" class="form-control" placeholder="Link Youtube" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Twitter</label>
                        <input value="<?= $twitter['isi'];?>" type="text" name="twitter" id="name" class="form-control" placeholder="Link Twitter" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Facebook</label>
                        <input value="<?= $facebook['isi'];?>" type="text" name="facebook" id="nisn" class="form-control" placeholder="Link Facebook" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Instagram</label>
                        <input value="<?= $instagram['isi'];?>" type="text" name="instagram" id="nisn" class="form-control" placeholder="Link Instagram" required>
                    </div>
                    <div class="form-group">
                        <label for="nisn">Tiktok</label>
                        <input value="<?= $tiktok['isi'];?>" type="text" name="tiktok" id="nisn" class="form-control" placeholder="Link Tiktok" required>
                    </div>
                    <button type="submit" name="kontak" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
                    </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>

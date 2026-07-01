<?php 
include 'header.php'; 
include 'aksi.php'; 

$siswa = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM user WHERE id='$_GET[id]'"));

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <a style="border:1px solid blue;" href="user.php">&nbsp;&#10094;&nbsp;</a> Akses Soal <?= $siswa['nama'];?>
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" action="" entype="multypart/form-data">
<?php
// Ambil daftar pilihan paket yang sudah dipilih oleh user
$pilih = mysqli_query($con, "SELECT `parent_id` FROM pilih WHERE id_user='$siswa[id]'");
$pilihan = [];

function getBreadcrumbs($id, $con) {
    $crumbs = [];
    while ($id !== null && $id !== 'NULL' && $id != 0) {
        $stmt = $con->prepare("SELECT id, nama, parent_id FROM `categories` WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($row = $res->fetch_assoc()) {
            // Masukkan ke array (kita akan balik urutannya nanti)
            $crumbs[] = [
                'id' => $row['id'],
                'nama' => $row['nama']
            ];
            $id = $row['parent_id']; // Naik ke tingkat atasnya
        } else {
            break;
        }
    }
    
    // Balik urutan agar dari Utama -> Sub
    return array_reverse($crumbs);
}

while ($row = mysqli_fetch_assoc($pilih)) {
    // Simpan id_paket yang dipilih dalam array
    $pilihan[] = $row['parent_id'];
}

// Ambil daftar paket
$paket = mysqli_query($con, "SELECT * FROM `categories` WHERE `is_leaf`=1 AND `publish`=0");

while ($hasil = mysqli_fetch_array($paket)) {// 1. Logika Checkbox
    $checked = (in_array($hasil['id'], $pilihan)) ? "checked" : "";

    // 2. Ambil data breadcrumbs (Array Multidimensi)
    $breadcrumbsData = getBreadcrumbs($hasil['id'], $con);

    // 3. Ambil hanya kolom 'nama' dari hasil breadcrumbs untuk ditampilkan
    // array_column akan mengambil semua nilai dari key 'nama' menjadi array baru
    $nama_list = array_column($breadcrumbsData, 'nama');
    
    // 4. Gabungkan dengan separator
    $nama_tampil = implode(" &raquo; ", array_map('htmlspecialchars', $nama_list));
?>
    <div class="form-group">
        <label for="paket[]">
            <input type="checkbox" <?= $checked;?> name="paket[]" value="<?= $hasil['id'];?>" >&nbsp;<?= $nama_tampil ?>
        </label>
    </div>
<?php } ?>

                        <input type="hidden" name="id" value="<?= $siswa['id'];?>">
                    <button type="submit" name="pilih_paket" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class='fas fa-fw fa-file-signature'></i> Simpan Perubahan</button>
                </form>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>

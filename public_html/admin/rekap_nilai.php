<?php 
include "../penghubung.php";
include 'header.php'; 
include 'aksi.php'; 

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mt-2 text-gray-800">
        Rekap Nilai
        </h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-body">
            <form action="buka_nilai.php" method="get">
                <select name="parent_id" id="" class="form-control mb-2" required>
                    <option value="">~ Pilih Paket Soal ~</option>
<?php
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

// Ambil daftar paket
$paket = mysqli_query($con, "SELECT * FROM `categories` WHERE `is_leaf`=1 AND `publish`=0");

while ($hasil = mysqli_fetch_array($paket)) {// 1. Logika Checkbox

    // 2. Ambil data breadcrumbs (Array Multidimensi)
    $breadcrumbsData = getBreadcrumbs($hasil['id'], $con);

    // 3. Ambil hanya kolom 'nama' dari hasil breadcrumbs untuk ditampilkan
    // array_column akan mengambil semua nilai dari key 'nama' menjadi array baru
    $nama_list = array_column($breadcrumbsData, 'nama');
    
    // 4. Gabungkan dengan separator
    $nama_tampil = implode(" &raquo; ", array_map('htmlspecialchars', $nama_list));
?>
    <option value="<?= $hasil['id'];?>"><?= $nama_tampil ?></option>
    </div>
<?php } ?>

                </select>
                <button type="submit" class="btn btn-primary"><i class="fa fa-eye"></i> Buka</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php include 'footer.php'; ?>

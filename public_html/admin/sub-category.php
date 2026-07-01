<?php
include 'header.php';
include 'aksi.php';

if(!isset($_SESSION["admin"])){

    echo '<script>window.location.href="./";</script>';
   
   }
$id = $_GET['id'];
$kat = mysqli_query($con,"SELECT * FROM `categories` WHERE `id`='$id'");
$f_kat = mysqli_fetch_array($kat);
$is_leaf = $f_kat['is_leaf'];
$isi = isset($f_kat['isi']) ? str_replace(array('<br />','<br>',',<br/>'),"",$f_kat['isi']) : "";
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
if($is_leaf == 1){
    $head = "Paket Soal";
    $tombol = "
        <a href='tambah_soal.php?id=$id'>
            <button type='button' class='d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2' style='text-transform:capitalize;' ><i class='fas fa-fw fa-plus'></i> Buat Soal</button>
        </a>
        <a href='#' data-toggle='modal' data-target='#editModal' data-id='$id' data-nama='$f_kat[nama]' data-durasi='$f_kat[menit]'>
            <button type='button' class='d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-2' style='text-transform:capitalize;' ><i class='fas fa-fw fa-edit'></i> Edit</button>
        </a>
        <a href='aksi.php?aksi=hapus_paket&id=$id' onclick='return checkDelete()'>
            <button type='button' class='d-sm-inline-block btn btn-sm btn-danger shadow-sm mt-2' style='text-transform:capitalize;' ><i class='fas fa-fw fa-trash'></i> Hapus Paket Soal</button>
        </a>
        ";
}else{
    $head = "Sub-Kategori";
    $tombol = "
        <a href='#' data-toggle='modal' data-target='#categories' data-id='$id'>
            <button type='button' class='d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2' style='text-transform:capitalize;' ><i class='fas fa-fw fa-plus'></i> Tambah Sub-Kategori</button>
        </a>
        ";
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h3 mb-0 text-gray-800">
            <a style="border:1px solid blue;" href="semua_soal.php">&nbsp;&#10094;&nbsp;</a> <?= $head?>
        </h4>
        <?= $tombol?>
    </div>

    <!-- Content Row -->
    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php 
            if ($id !== 'NULL' && $id != 0) {
                $breadcrumbs = getBreadcrumbs($id, $con);
                foreach ($breadcrumbs as $crumb) {
                    echo " &raquo; <a href='sub-category.php?id=$crumb[id]'>" . htmlspecialchars($crumb['nama'])."</a>";
                }
            }
        if($is_leaf == 1){
            ?>

            <div class="table-responsive mt-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Pertanyaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mendeteksi = mysqli_query($con, "SELECT nomor FROM `soal` WHERE `parent_id`='$id' GROUP BY `nomor` HAVING COUNT(nomor) > 1");
                        if(mysqli_num_rows($mendeteksi) > 0){
                            echo "
                            <script>
                                alert('Peringatan: Terdapat nomor soal yang sama');
                            </script>
                            ";
                        }
                        // 1. Ambil semua nomor soal dan urutkan
                        $cek_urutan = mysqli_query($con, "SELECT nomor FROM `soal` WHERE `parent_id`='$id' ORDER BY nomor ASC");
                        $list_nomor = [];
                        while($row = mysqli_fetch_assoc($cek_urutan)) {
                            $list_nomor[] = (int)$row['nomor'];
                        }

                        $is_tidak_urut = false;
                        if (count($list_nomor) > 0) {
                            // 2. Cek apakah dimulai dari 1
                            if ($list_nomor[0] != 1) {
                                $is_tidak_urut = true;
                            } else {
                                // 3. Cek apakah ada angka yang melompat
                                for ($i = 0; $i < count($list_nomor) - 1; $i++) {
                                    if ($list_nomor[$i+1] != $list_nomor[$i] + 1) {
                                        $is_tidak_urut = true;
                                        break;
                                    }
                                }
                            }
                        }
                        // 4. Munculkan Alert jika tidak urut
                        if($is_tidak_urut){
                            echo "
                            <script>
                                alert('Peringatan: Nomor soal tidak urut atau ada nomor yang terlewati!');
                            </script>
                            ";
                        }

                        $pertanyaan = mysqli_query($con, "SELECT *  FROM `soal` WHERE `parent_id`='$id' ORDER BY `nomor`");
                        $tr = "";  // Initialize the $tr variable
                        while ($hasil2 = mysqli_fetch_array($pertanyaan)) {
                            $id_soal = strip_tags($hasil2['id']);
                            $td_pertanyaan = strip_tags($hasil2['pertanyaan']);
                            $substr = substr($td_pertanyaan, 0, 50);
                            $tr .= "
                            <tr>
                                <td>{$hasil2['nomor']}</td>
                                <td>$substr ...</td>
                                <td>
                                    <a href='edit_soal.php?id=$id&id_s=$id_soal' class='edit'>
                                        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                    </a>
                                    <a href='aksi.php?aksi=delete_soal&id=$id&id_s=$id_soal' onclick='return checkDelete()'>
                                        <button type='button' name='delete' class='d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm'><i class='fas fa-fw fa-trash'></i> Delete</button>
                                    </a>
                                </td>
                            </tr>
                            ";
                        }

                        echo $tr;
                        ?>
                    </tr>
                    </tbody>
                </table>
            </div>

        <?php
        }else{
            echo "<div class='row'>";
            $kategori = mysqli_query($con, "SELECT * FROM `categories` WHERE `parent_id`='$_GET[id]' AND `is_leaf`=0 AND `publish`='0'");
            while($hasil = mysqli_fetch_array($kategori)){
                $id_induk = $hasil['id'];
                $nama = htmlspecialchars($hasil['nama'], ENT_QUOTES, 'UTF-8');
                ?>
                <!-- Card Data Kelas -->
                <div class='col-xl-4 col-md-6 mb-4 mt-4'>
                    <div class='card shadow h-100 py-2'>
                        <div class='card-body'>

                            <div class="d-flex justify-content-between">
                                <h4><?= $hasil['nama']?></h4>
                                <a href="#" id="edit_<?= $id_induk?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <h4><i class="fas fa-1x fa-bars text-gray-600"></i></h4>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="edit_<?= $id_induk?>">
                                    <a class="dropdown-item" href="#" data-toggle='modal' data-target='#modalEdit' data-id="<?= $id_induk?>" data-nama="<?= $nama?>">
                                        <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray"></i>
                                        Edit
                                    </a>
                                    <a class="dropdown-item" href="aksi.php?aksi=delete_category&id=<?= $id_induk?>" onclick="return checkDelete()">
                                        <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray"></i>
                                        Hapus
                                    </a>
                                </div>
                            </div>
                            <ul>
                                <?php
                                $anakq = mysqli_query($con, "SELECT * FROM `categories` WHERE `parent_id`='$id_induk'");
                                while($anak = mysqli_fetch_array($anakq)){
                                    $id_anak = isset($anak['id']) ? $anak['id'] : "";
                                    $nama_anak = isset($anak['nama']) ? $anak['nama'] : "";
                                ?>
                                <li>
                                    <a href="sub-category.php?id=<?= $id_anak?>"><?= $nama_anak?></a>
                                </li>
                                <?php
                                }
                                ?>
                                <li>
                                    <a href='#' data-toggle='modal' data-target='#categories' data-id='<?= $id_induk?>'>
                                        <i class='fas fa-fw fa-plus'></i> Tambah
                                    </a>
                                </li>       
                            </ul>
                        </div>
                    </div>
                </div>
                
                <?php
            }
            $kategori2 = mysqli_query($con, "SELECT * FROM `categories` WHERE `parent_id`='$_GET[id]' AND `is_leaf`=1 AND `publish`=0");
            while($hasil2 = mysqli_fetch_array($kategori2)){
                echo "
                <!-- Card Data Kelas -->
                <div class='col-xl-4 col-md-6 mb-4 mt-4'>
                    <div class='card border-left-primary shadow h-100 py-2 kategori'>
                        <div class='card-body'>
                            <div class='row no-gutters align-items-center'>
                                <div class='col mr-2'>
                                    <div class='h4 font-weight-bold text-primary text-uppercase mb-1'>Paket Soal</div>
                                    <div class='h5 mb-0 font-weight-bold text-gray-800'>
                                        <a href='sub-category.php?id={$hasil2['id']}'>
                                        {$hasil2['nama']}
                                        </a>
                                    </div>
                                </div>
                                <div class='col-auto'>
                                    <i class='fas fa-th-list fa-2x text-gray-400'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            <?php
            echo "</div>";
        }
            ?>
        
        </div>
    </div>

</div>

<!-- Modal-->
<div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLabel'>Edit Kategori</h3>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true' style='color:#d6d6d6;'>×</span>
                </button>
            </div>
            <form method='post' enctype="multipart/form-data">
                <div class='modal-body text-left'>
                    <div class="form-group">
                        <label for="name">Nama Kategori :</label>
                        <input type='text' class='form-control' placeholder='Masukkan Nama Sub-Kategori' name='nama' id="input-nama-edit">
                    </div>
                    <div class="form-group" id="input-edit">
                        <label for="name">Durasi Mengerjakan :</label>
                        <input type='number' id="input-durasi-edit" class='form-control' placeholder='Sekian Menit' name='menit'>
                    </div>
                    <div class="form-group" id="input-edit">
                        <label for="name">Deskripsi :</label>
                        <textarea name="isi" id="" rows="5" class="form-control"><?= $isi ?></textarea>
                    </div>
                    <div class="form-group" id="input-edit">
                        <label for="name">Gambar :</label>
                        <input type='file' name='image'>
                        <div class="input-group-text mb-2">
                            <input type="checkbox" name="cek" value="ganti" id="">
                            &nbsp; Ganti Gambar (centang)
                        </div>
                        <img src="../<?= $f_kat['gambar']?>" style="width:150px;" alt="">
                    </div>
                </div>
                <input type="hidden" name="id_induk" id="input-id-edit">
                <div class='modal-footer'>
                    <button name='edit_category' class='btn btn-success' type='submit'><i class='fas fa-fw fa-edit'></i> Edit</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Modal-->                   

<!-- Modal-->
<div class='modal fade' id='modalEdit' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLabel'>Edit Kategori</h3>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true' style='color:#d6d6d6;'>×</span>
                </button>
            </div>
            <form method='post'>
                <div class='modal-body text-left'>
                    <div class="form-group">
                        <label for="name">Nama Kategori :</label>
                        <input type='text' class='form-control' placeholder='Masukkan Nama Sub-Kategori' name='nama' id="input-edit-nama">
                    </div>
                </div>
                <input type="hidden" name="id_induk" id="input-edit-id">
                <div class='modal-footer'>
                    <button name='edit_category' class='btn btn-success' type='submit'><i class='fas fa-fw fa-edit'></i> Edit</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Modal-->                   

<!-- Modal-->
<div class='modal fade' id='categories' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLabel'>Tambah Sub-Kategori</h3>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true' style='color:#d6d6d6;'>×</span>
                </button>
            </div>
            <form method='post' enctype="multipart/form-data">
                <div class='modal-body text-left'>
                    <div class="form-group">
                        <label for="name">Nama Sub-Kategori :</label>
                        <input type='text' class='form-control' placeholder='Masukkan Nama Sub-Kategori' name='nama' value='' required>
                    </div>
                    <div class="d-flex flex-wrap radio form-group">
                        <div class="w-100"><input type='radio' required name='tipe' value='sub' class="radio"> Buat Sub-Kategori Lagi </div>
                        <div class="w-100"><input type='radio' required name='tipe' value='soal' id="paket" class="radio"> ini Paket Soal </div>
                    </div>
                    <div id="input" style="display:none;">
                        <div class="form-group">
                            <label for="name">Durasi Mengerjakan :</label>
                            <input type='number' id="menit" class='form-control' placeholder='Sekian Menit' name='menit' value=''>
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar :</label>
                            <input type='file' id="file" class='' name='image'>
                        </div>
                        <div class="form-group">
                            <label for="name">Deskripsi :</label>
                            <textarea name="isi" class="form-control" id="isi" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_induk" id="input-id-tambah" value="<?= $_GET['id']?>">
                <input type="hidden" name="back" value="sub-category">
                <div class='modal-footer'>
                    <button name='tambah_sub_kategori' class='btn btn-success' type='submit'><i class='fas fa-fw fa-plus'></i> Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Modal-->

<!-- /.container-fluid -->
<script>
function checkDelete(){
	return confirm('Anda Yakin ingin Menghapus ?');
}

document.addEventListener('click', function (event) {
    // Pastikan yang diklik adalah tombol/link edit atau elemen di dalamnya
    const trigger = event.target.closest('[data-target="#modalEdit"]');
    const tambah = event.target.closest('[data-target="#categories"]');
    const edit = event.target.closest('[data-target="#editModal"]');
    
    if (edit) {
        // 1. Ambil data dari atribut data-id dan data-nama
        const id = edit.getAttribute('data-id');
        const nama = edit.getAttribute('data-nama');
        const durasi = edit.getAttribute('data-durasi');

        // 2. Cari elemen input di dalam modal
        const inputId = document.getElementById('input-id-edit');
        const inputNama = document.getElementById('input-nama-edit');
        const inputDurasi = document.getElementById('input-durasi-edit');

        // 3. Masukkan datanya
        if (inputId) inputId.value = id;
        if (inputNama) inputNama.value = nama;
        if (inputDurasi) inputDurasi.value = durasi;
        
        console.log("Data Terambil:", {id, nama, durasi}); // Cek di console F12
    }
    if (trigger) {
        // 1. Ambil data dari atribut data-id dan data-nama
        const id = trigger.getAttribute('data-id');
        const nama = trigger.getAttribute('data-nama');

        // 2. Cari elemen input di dalam modal
        const inputId = document.getElementById('input-edit-id');
        const inputNama = document.getElementById('input-edit-nama');

        // 3. Masukkan datanya
        if (inputId) inputId.value = id;
        if (inputNama) inputNama.value = nama;
        
        console.log("Data Terambil:", {id, nama}); // Cek di console F12
    }
    if (tambah) {
        // 1. Ambil data dari atribut data-id dan data-nama
        const id = tambah.getAttribute('data-id');

        // 2. Cari elemen input di dalam modal
        const inputId = document.getElementById('input-id-tambah');

        // 3. Masukkan datanya
        if (inputId) inputId.value = id;
        
        console.log("Data Terambil:", {id}); // Cek di console F12
    }
    
});

const radios = document.querySelectorAll('.radio');
const paket = document.getElementById('paket');
const input = document.getElementById('input');
const menit = document.getElementById('menit');
const file = document.getElementById('file');
const isi = document.getElementById('isi');
radios.forEach(radio => {
    radio.addEventListener('change', function(){
        if(paket.checked){
            input.style.display = 'block';
        }else{
            input.style.display = 'none';
            menit.value = '';
            file.value = '';
            isi.value = '';
        }
    });
});
</script>
<?php include 'footer.php'; ?>
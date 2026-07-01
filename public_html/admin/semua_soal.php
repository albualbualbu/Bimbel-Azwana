<?php
include 'header.php';
include 'aksi.php';

if(!isset($_SESSION["admin"])){

    echo '<script>window.location.href="./";</script>';
   
   }

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Semua Soal</h1>
        <a href="#" data-toggle='modal' data-target='#categories'>
        <button type="button" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2" style="text-transform:capitalize;" ><i class='fas fa-fw fa-plus'></i> Tambah Kategori</button>
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <?php
        $kategori = mysqli_query($con, "SELECT * FROM `kategori` ORDER BY id DESC");
        $div="";
        while($hasil = mysqli_fetch_array($kategori)){
            $id_induk = $hasil['id'];
            $nama = htmlspecialchars($hasil['nama'], ENT_QUOTES, 'UTF-8');
            ?>
            <!-- Card Data Kelas -->
            <div class='col-xl-4 col-md-6 mb-4'>
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
                            <li>
                                <a href='#' data-toggle='modal' data-target='#tambahSub' data-id="<?= $id_induk?>">
                                    <i class='fas fa-fw fa-plus'></i> Tambah Paket
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <?php
        }
            ?>
        
    </div>

</div>

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
                        <input type='text' class='form-control' placeholder='Masukkan Nama Sub-Kategori' name='nama' id="input-nama-edit">
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
<div class='modal fade' id='categories' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h3 class='modal-title' id='exampleModalLabel'>Tambah Kategori</h3>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true' style='color:#d6d6d6;'>×</span>
                </button>
            </div>
            <form method='post'>
                <div class='modal-body text-left'>
                    <div class="form-group">
                        <label for="name">Nama Kategori :</label>
                        <input type='text' class='form-control' placeholder='Masukkan Nama Kategori' name='nama' value=''>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button name='tambah_categories' class='btn btn-success' type='submit'><i class='fas fa-fw fa-plus'></i> Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Modal-->

<!-- Modal-->
<div class='modal fade' id='tambahSub' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
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
                <input type="hidden" name="id_induk" id="input-id-tambah" value="">
                <input type="hidden" name="back" value="semua_soal">
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

const radios = document.querySelectorAll('.radio');
const paket = document.getElementById('paket');
const input = document.getElementById('input');
const menit = document.getElementById('menit');
radios.forEach(radio => {
    radio.addEventListener('change', function(){
        if(paket.checked){
            input.style.display = 'block';
        }else{
            input.style.display = 'none';
            menit.value = '';
        }
    });
});

document.addEventListener('click', function (event) {
    // Pastikan yang diklik adalah tombol/link edit atau elemen di dalamnya
    const trigger = event.target.closest('[data-target="#modalEdit"]');
    const tambah = event.target.closest('[data-target="#tambahSub"]');
    
    if (trigger) {
        // 1. Ambil data dari atribut data-id dan data-nama
        const id = trigger.getAttribute('data-id');
        const nama = trigger.getAttribute('data-nama');

        // 2. Cari elemen input di dalam modal
        const inputId = document.getElementById('input-id-edit');
        const inputNama = document.getElementById('input-nama-edit');

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
</script>
<?php include 'footer.php'; ?>
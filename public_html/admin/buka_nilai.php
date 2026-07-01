<?php 
include "../penghubung.php";
include 'header.php'; 
include 'aksi.php'; 

?>

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

$parent_id = (int)$_GET['parent_id'];

if(empty($parent_id)){
  echo '
  <script>
      alert("Terjadi Kesalahan Pada Link !");
      window.location.href="rekap_nilai.php";
  </script>
  ';
}

// Ambil daftar paket
$paket = mysqli_query($con, "SELECT * FROM `categories` WHERE `id`='$parent_id'");

$hasil = mysqli_fetch_array($paket);// 1. Logika Checkbox

// 2. Ambil data breadcrumbs (Array Multidimensi)
$breadcrumbsData = getBreadcrumbs($hasil['id'], $con);

// 3. Ambil hanya kolom 'nama' dari hasil breadcrumbs untuk ditampilkan
// array_column akan mengambil semua nilai dari key 'nama' menjadi array baru
$nama_list = array_column($breadcrumbsData, 'nama');

// 4. Gabungkan dengan separator
$nama_tampil = implode(" &raquo; ", array_map('htmlspecialchars', $nama_list));
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mt-2 text-gray-800">
            <a style="border:1px solid blue;" href="rekap_nilai.php">&nbsp;&#10094;&nbsp;</a> Nilai
        </h1>
        <form action="nilai_rekap.php" method="post" target="_blank">
            <input type="hidden" name="parent_id" value="<?= $parent_id?>">
            <button type="submit" class="btn btn-primary"><i class="fa fa-download"></i> Download</button>
        </form>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-body">
            <h4 class="text-gray-800"><?= $nama_tampil ?></h4>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Cabang</th>
                            <th>Jawaban</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    $nilai_q = mysqli_query($con,"SELECT * FROM `nilai` WHERE `parent_id`='$parent_id' ORDER BY id ASC");
    while($nilai = mysqli_fetch_array($nilai_q)){
        $nama_siswa = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `user` WHERE `id`='$nilai[id_user]'"));
        $pertanyaan_q = mysqli_query($con,"SELECT * FROM `soal` WHERE `parent_id`='$parent_id' ORDER BY nomor ASC");
        $isi_jawaban = [];
        while($pertanyaan = mysqli_fetch_array($pertanyaan_q)){
            $jawab_q = mysqli_query($con,"SELECT * FROM `jawab` WHERE `id_user`='$nama_siswa[id]' AND `id_pertanyaan`='$pertanyaan[id]' AND `parent_id`='$parent_id'");
            $jawaban = mysqli_fetch_array($jawab_q);
            $answer ="ERROR";
            if(!empty($jawaban['id_jawaban'])){
                $qAnswer = mysqli_query($con,"SELECT * FROM `answer` WHERE `id`='$jawaban[id_jawaban]'");
                $answerF = mysqli_fetch_array($qAnswer);
                $answer = $answerF['isi'];
            }
            if($jawaban){
                if($jawaban['id_jawaban'] == 0){
                    $isi_jawaban[] = $pertanyaan['nomor']."=".$jawaban['isi'];
                }else{
                    $isi_jawaban[] = $pertanyaan['nomor']."=".$answer;
                }
            }else{
                $isi_jawaban[] = $pertanyaan['nomor']."=Tidak Dijawab";
            }
        }   
    echo "
    <tr>
        <td>{$nama_siswa['nama']}</td>
        <td>{$nama_siswa['cabang']}</td>
        <td>" . implode(", ", $isi_jawaban) . "</td>
        <td>{$nilai['nilai']}</td>
        <td>
            <a href='aksi.php?aksi=hapus_nilai&id={$nilai['id']}' class='edit' onclick='return checkDelete()'>
                <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm'>
                    <i class='fas fa-fw fa-trash'></i> Delete
                </button>
            </a>
        </td>
    </tr>
    ";
    }
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
	return confirm('Menghapus Nilai sama dengan Anda Menghapus Jawaban User ini.');
}
</script>
<?php include 'footer.php'; ?>

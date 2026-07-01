<?php 
include 'header.php'; 
include 'aksi.php'; 
$hasil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `kategori` WHERE id='$_GET[id_k]'"));

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><a style="border:1px solid blue;" href="paket_soal.php?id=<?= $_GET['id_k'];?>">&nbsp;&#10094;&nbsp;</a> Soal <?= $hasil['nama'];?></h1>
        <a href="tambah_soal.php?id_p=<?= $_GET['id_p'];?>&id_k=<?= $_GET['id_k'];?>">
        <button type="submit" name="tambah_soal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mt-2"><i class='fas fa-fw fa-plus'></i> Tambah Soal</button></a>
    </div>

    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
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
                        include "../penghubung.php";
                        $pertanyaan = mysqli_query($con, "SELECT * FROM pertanyaan WHERE id_kategori='$_GET[id_k]' AND id_paket='$_GET[id_p]' ORDER BY nomor");

                        $tr = "";  // Initialize the $tr variable
                        while ($hasil2 = mysqli_fetch_array($pertanyaan)) {
                            $td_pertanyaan = strip_tags($hasil2['pertanyaan']);
                            $substr = substr($td_pertanyaan, 0, 50);
                            $tr .= "
                            <tr>
                                <td>{$hasil2['nomor']}</td>
                                <td>$substr</td>
                                <td>
                                    <a href='edit_soal.php?id={$hasil2['id']}&id_k={$hasil2['id_kategori']}&id_p={$_GET['id_p']}' class='edit'>
                                        <button type='button' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-fw fa-edit'></i> Edit</button>
                                    </a>
                                    <a href='aksi.php?aksi=hapus_soal&id={$hasil2['id']}&id_k={$hasil2['id_kategori']}&id_p={$_GET['id_p']}' onclick='return checkDelete()'>
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
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script>
    
function checkDelete(){
	return confirm('Anda Yakin ingin Menghapus ?');
}
</script>
<?php include 'footer.php'; ?>

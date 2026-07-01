<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Nilai</title>
</head>
<style>
    body{
        font-family:tahoma;
        color:black !important;
    }
    table tr{
        border-bottom:1px solid black;
    }
    table tr td, th{
        padding:5px;
    }
    #center{
        text-align:center;
    }
    table[border] {
    border: 1px solid #cccccc;
    border-collapse: collapse;
    }
</style>
<?php
include "../penghubung.php";
$parent_id = (int)$_POST['parent_id'];
$q_nilai = mysqli_query($con,"SELECT * FROM `nilai` WHERE `parent_id`='$parent_id'");
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

// Ambil daftar paket
$paket = mysqli_query($con, "SELECT * FROM `categories` WHERE `id`='$parent_id' AND `is_leaf`=1 AND `publish`=0");

$hasil = mysqli_fetch_array($paket);// 1. Logika Checkbox

    // 2. Ambil data breadcrumbs (Array Multidimensi)
    $breadcrumbsData = getBreadcrumbs($hasil['id'], $con);

    // 3. Ambil hanya kolom 'nama' dari hasil breadcrumbs untuk ditampilkan
    // array_column akan mengambil semua nilai dari key 'nama' menjadi array baru
    $nama_list = array_column($breadcrumbsData, 'nama');
    
    // 4. Gabungkan dengan separator
    $nama_tampil = implode(" &raquo; ", array_map('htmlspecialchars', $nama_list));
    $nama_file = implode(" _ ", array_map('htmlspecialchars', $nama_list));
?>
<body>
    <table border="1" id="tabelData">
        <thead>
            <tr>
                <td colspan="9" style="text-align:center;"><h4><?= $nama_tampil ?></h4></td>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Cabang</th>
                <th>Nilai</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Durasi Mengerjakan</th>
                <th>Paket Soal</th>
                <th style="width: 200px;">Jawaban</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $data_pengelompokan = [];
        while($nilai = mysqli_fetch_array($q_nilai)){
            $name_siswa = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `user` WHERE `id`='$nilai[id_user]'"));
            $active = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `aktif` WHERE `id_user`='$nilai[id_user]' AND `parent_id`='$nilai[parent_id]'"));
            $aktif_mulai = isset($active['mulai']) ? $active['mulai'] : "";
            $aktif_selesai = isset($active['selesai']) ? $active['selesai'] : "";
            $durasi = isset($active['durasi']) ? $active['durasi'] : "";
            $nama_siswa = isset($name_siswa['nama']) ? $name_siswa['nama'] : "";
            $cabang = isset($name_siswa['cabang']) ? $name_siswa['cabang'] : "~";
            $name_paket = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `categories` WHERE `id`='$nilai[parent_id]'"));
            $nama_paket = isset($name_paket['nama']) ? $name_paket['nama'] : "~";
            $hasil = $nilai['nilai'] ?? "~";

        $pertanyaan_q = mysqli_query($con,"SELECT * FROM `soal` WHERE `parent_id`='$parent_id' ORDER BY nomor ASC");
        $isi_jawaban = [];
        while($pertanyaan = mysqli_fetch_array($pertanyaan_q)){
            $jawab_q = mysqli_query($con,"SELECT * FROM `jawab` WHERE `id_user`='$name_siswa[id]' AND `id_pertanyaan`='$pertanyaan[id]' AND `parent_id`='$parent_id'");
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
            $jawaban_array = implode(", ", $isi_jawaban);
        }  

            $data_pengelompokan[$cabang][] = [
                'nama'=>$nama_siswa,
                'paket'=>$nama_paket,
                'nilai'=>$hasil,
                'mulai'=>$aktif_mulai,
                'selesai'=>$aktif_selesai,
                'durasi'=>$durasi,
                'jawaban'=>$jawaban_array
            ];
        }
        $no=1;
        foreach($data_pengelompokan as $nama_cabang => $daftar_siswa){
            foreach($daftar_siswa as $siswa){
                echo "
                <tr>
                    <td>$no</td>
                    <td>{$siswa['nama']}</td>
                    <td>$nama_cabang</td>
                    <td>{$siswa['nilai']}</td>
                    <td>{$siswa['mulai']}</td>
                    <td>{$siswa['selesai']}</td>
                    <td>{$siswa['durasi']}</td>
                    <td>{$siswa['paket']}</td>
                    <td>{$siswa['jawaban']}</td>
                </tr>
                ";
                $no++;
            }
        }
        ?>
        </tbody>
    </table>
    <div style="position:fixed;bottom:20px;right:20px;">
        <button onclick="downloadXLS()" style="background:transparent;border:none;cursor:pointer;">
            <img src="../images/excel.png" width="200px" alt="">
        </button>
    </div>
    <script>
        function downloadXLS(){
            const table = document.getElementById("tabelData").outerHTML;
            const html = `
            <html xmlns:x="urn:schemas-microsoft-com:office:excel">
            <head>
            <!--[if gte mso 9]>
            <xml>
                <x:ExcelWorkbook>
                <x:ExcelWorksheets>
                    <x:ExcelWorksheet>
                    <x:Name>Rekap Nilai</x:Name>
                    <x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions>
                    </x:ExcelWorksheet>
                </x:ExcelWorksheets>
                </x:ExcelWorkbook>
            </xml>
            <![endif]-->
            </head>
            <body>
            ${table}
            </body>
            </html>
            `;
        const blob = new Blob([html], { type: "application/vnd.ms-excel" });
        const url = URL.createObjectURL(blob);

        const a = document.createElement("a");
        a.href = url;
        a.download = "Rekap Nilai <?= $nama_file ?>.xls";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        }
    </script>
</body>
</html>
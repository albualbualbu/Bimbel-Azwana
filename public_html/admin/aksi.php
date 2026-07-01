<?php
include "../penghubung.php";

// tambah
if (isset($_POST['tambah'])) {

    $tabel = $_POST['tabel'];
    $nav = $_POST['nav'];

    $judul = $con->real_escape_string($_POST['judul']);
    $isi = $con->real_escape_string($_POST['isi']);
    
    // Buat slug URL dari judul
    $url = strtolower($judul);
    $url = preg_replace('/[^a-z0-9\-]+/', '_', $url);
    $url = preg_replace('/_+/', '_', $url); // hilangkan underscore ganda
    $url = trim($url, '_'); // hilangkan underscore di awal/akhir

    $cek = mysqli_query($con,"SELECT * FROM `$tabel` WHERE `url`='$url'");
    $num = mysqli_num_rows($cek);

    if($num > 0){
        echo '
        <script>
            alert("Gagal ! Judul Sudah ada.");
        </script>
        ';
    }else{
    
    $nama=$_FILES["image"]["name"];
	$lokasi=$_FILES["image"]["tmp_name"];
	$temp = explode(".",$nama);
	$round = $tabel."_".$url."_".round(microtime(true)).'.'. end($temp);
	move_uploaded_file($lokasi,"../img/".$round);

    $tambah = mysqli_query($con, "INSERT INTO `$tabel` VALUES(
        '',
        'img/$round',
        '$judul',
        '$url',
        '$isi',
        ''
        )");
    
        if ($tambah) {
            echo '
            <script>
                alert("Data berhasil dibuat !");
                window.location.href="tabel.php?nav='.$nav.'&tabel='.$tabel.'";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal disimpan.");
            </script>
            ';
        }
    }

}

// tambah
if (isset($_POST['tambah_page'])) {

    $judul = $con->real_escape_string($_POST['judul']);
    $tabel = $_POST['tabel'];
    $nav = $_POST['nav'];
    
    // Buat slug URL dari judul
    $url = strtolower($judul);
    $url = preg_replace('/[^a-z0-9\-]+/', '_', $url);
    $url = preg_replace('/_+/', '_', $url); // hilangkan underscore ganda
    $url = trim($url, '_'); // hilangkan underscore di awal/akhir

    $cek = mysqli_query($con,"SELECT * FROM `$tabel` WHERE url='$url'");
    $num = mysqli_num_rows($cek);

    if($num > 0){
        echo '
        <script>
            alert("Gagal ! Judul Sudah ada.");
        </script>
        ';
    }else{
    
    $nama=$_FILES["image"]["name"];
	$lokasi=$_FILES["image"]["tmp_name"];
	$temp = explode(".",$nama);
	$round = $tabel."_".$url."_".round(microtime(true)).'.'. end($temp);
	move_uploaded_file($lokasi,"../img/".$round);

    $tambah = mysqli_query($con, "INSERT INTO `$tabel` VALUES(
        '',
        '$_POST[nama]',
        '$url',
        '$judul',
        'img/$round',
        '$_POST[isi]'
        )");
    
        if ($tambah) {
            echo '
            <script>
                alert("Data berhasil dibuat !");
                window.location.href="tabel.php?nav='.$nav.'&tabel='.$tabel.'";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal disimpan.");
            </script>
            ';
        }
    }

}

// edit
if (isset($_POST['edit'])) {

    $id = $_POST['id'];
    $tabel = $_POST['tabel'];
    $judul = $con->real_escape_string($_POST['judul']);
    $url = $con->real_escape_string($_POST['url']);

    // Buat slug URL dari judul
    $url = strtolower($url);
    $url = preg_replace('/[^a-z0-9\-]+/', '_', $url);
    $url = preg_replace('/_+/', '_', $url); // hilangkan underscore ganda
    $url = trim($url, '_'); // hilangkan underscore di awal/akhir
    
    if(isset($_POST['centang']) && $_POST['centang'] == "url"){
        
        $cekSatu = mysqli_num_rows(mysqli_query($con,"SELECT * FROM `$tabel` WHERE `url`='$url'"));

        if($cekSatu > 0){
            echo '
            <script>
                alert("Gagal disimpan.");
            </script>
            ';
            }else{

            if(isset($_POST['cek']) && $_POST['cek'] == "ada"){
            
                $nama=$_FILES["image"]["name"];
                $lokasi=$_FILES["image"]["tmp_name"];
                $temp = explode(".",$nama);
                $round = $tabel."_".$_POST['id']."_".round(microtime(true)).'.'. end($temp);
                $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `$tabel` WHERE `id`='$id'"));
                if(move_uploaded_file($lokasi,"../img/".$round)){
                    $target = $lawas['gambar'];
                    if($target == "img/kosong.jpg"){
    
                    }else{
                        $filePath = "../". $target; // sesuaikan folder
                
                        // Cek apakah file ada
                        if (file_exists($filePath) && is_file($filePath)) {
                            if (unlink($filePath)) {
                                
                            }
                        }
                    }
                }
            
                $edit1 = mysqli_query($con, "UPDATE `$tabel` SET
                judul='$judul',
                gambar='img/$round',
                isi='$_POST[isi]',
                `url`='$url'
                WHERE
                id='$_POST[id]'
                ");
                
                    if ($edit1) {
                        echo '
                        <script>
                            alert("Data berhasil disimpan !");
                        </script>
                        ';
                    } else {
                        echo '
                        <script>
                            alert("Gagal disimpan.");
                        </script>
                        ';
                    }
            }else{
            
                    $edit1 = mysqli_query($con, "UPDATE `$tabel` SET
                    judul='$_POST[judul]',
                    isi='$_POST[isi]',
                    `url`='$url'
                    WHERE
                    id='$_POST[id]'
                    ");
                    
                        if ($edit1) {
                            echo '
                            <script>
                                alert("Data berhasil disimpan !");
                            </script>
                            ';
                        } else {
                            echo '
                            <script>
                                alert("Gagal disimpan.");
                            </script>
                            ';
                        }
            }
        }
    }else{
        
        if(isset($_POST['cek']) && $_POST['cek'] == "ada"){
    
        $nama=$_FILES["image"]["name"];
        $lokasi=$_FILES["image"]["tmp_name"];
        $temp = explode(".",$nama);
        $round = $tabel."_".$_POST['id']."_".round(microtime(true)).'.'. end($temp);
        $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `$tabel` WHERE `id`='$id'"));
        if(move_uploaded_file($lokasi,"../img/".$round)){
            $target = $lawas['gambar'];
            if($target == "img/kosong.jpg"){

            }else{
                $filePath = "../". $target; // sesuaikan folder
        
                // Cek apakah file ada
                if (file_exists($filePath) && is_file($filePath)) {
                    if (unlink($filePath)) {
                        
                    }
                }
            }
        }
        
        $edit1 = mysqli_query($con, "UPDATE `$tabel` SET
        judul='$_POST[judul]',
        gambar='img/$round',
        isi='$_POST[isi]'
        WHERE
        id='$_POST[id]'
        ");
        
            if ($edit1) {
                echo '
                <script>
                    alert("Data berhasil disimpan !");
                </script>
                ';
            } else {
                echo '
                <script>
                    alert("Gagal disimpan.");
                </script>
                ';
            }
        }else{

            $edit1 = mysqli_query($con, "UPDATE `$tabel` SET
            judul='$_POST[judul]',
            isi='$_POST[isi]'
            WHERE
            id='$_POST[id]'
            ");
            
                if ($edit1) {
                    echo '
                    <script>
                        alert("Data berhasil disimpan !");
                    </script>
                    ';
                } else {
                    echo '
                    <script>
                        alert("Gagal disimpan.");
                    </script>
                    ';
                }
        }

    }

}

// edit
if (isset($_POST['edit_page'])) {

    $id = $_POST['id'];
    $tabel = $_POST['tabel'];
    $judul = $con->real_escape_string($_POST['judul']);
    $url = $con->real_escape_string($_POST['url']);

    // Buat slug URL dari judul
    $url = strtolower($url);
    $url = preg_replace('/[^a-z0-9\-]+/', '_', $url);
    $url = preg_replace('/_+/', '_', $url); // hilangkan underscore ganda
    $url = trim($url, '_'); // hilangkan underscore di awal/akhir
    
    if(isset($_POST['centang']) && $_POST['centang'] == "url"){
        
        $cekSatu = mysqli_num_rows(mysqli_query($con,"SELECT * FROM `$tabel` WHERE `url`='$url'"));

        if($cekSatu > 0){
            echo '
            <script>
                alert("Gagal disimpan.");
            </script>
            ';
            }else{

            if(isset($_POST['cek']) && $_POST['cek'] == "ada"){
            
                $nama=$_FILES["image"]["name"];
                $lokasi=$_FILES["image"]["tmp_name"];
                $temp = explode(".",$nama);
                $round = $tabel."_".$_POST['id']."_".round(microtime(true)).'.'. end($temp);
                $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `$tabel` WHERE `id`='$id'"));
                if(move_uploaded_file($lokasi,"../img/".$round)){
                    $target = $lawas['gambar'];
                    if($target == "img/kosong.jpg"){
    
                    }else{
                        $filePath = "../". $target; // sesuaikan folder
                
                        // Cek apakah file ada
                        if (file_exists($filePath) && is_file($filePath)) {
                            if (unlink($filePath)) {
                                
                            }
                        }
                    }
                }
            
                $edit1 = mysqli_query($con, "UPDATE `$tabel` SET
                nama='$_POST[nama]',
                judul='$_POST[judul]',
                gambar='img/$round',
                isi='$_POST[isi]',
                `url`='$url'
                WHERE
                id='$_POST[id]'
                ");
                
                    if ($edit1) {
                        echo '
                        <script>
                            alert("Data berhasil disimpan !");
                        </script>
                        ';
                    } else {
                        echo '
                        <script>
                            alert("Gagal disimpan.");
                        </script>
                        ';
                    }
            }else{
            
                    $edit1 = mysqli_query($con, "UPDATE `$tabel` SET
                    nama='$_POST[nama]',
                    judul='$_POST[judul]',
                    isi='$_POST[isi]',
                    `url`='$url'
                    WHERE
                    id='$_POST[id]'
                    ");
                    
                        if ($edit1) {
                            echo '
                            <script>
                                alert("Data berhasil disimpan !");
                            </script>
                            ';
                        } else {
                            echo '
                            <script>
                                alert("Gagal disimpan.");
                            </script>
                            ';
                        }
            }
        }
    }else{
        
            if(isset($_POST['cek']) && $_POST['cek'] == "ada"){
        
            $nama=$_FILES["image"]["name"];
            $lokasi=$_FILES["image"]["tmp_name"];
            $temp = explode(".",$nama);
            $round = $tabel."_".$_POST['id']."_".round(microtime(true)).'.'. end($temp);
            $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `$tabel` WHERE `id`='$id'"));
            if(move_uploaded_file($lokasi,"../img/".$round)){
                $target = $lawas['gambar'];
                if($target == "img/kosong.jpg"){

                }else{
                    $filePath = "../". $target; // sesuaikan folder
            
                    // Cek apakah file ada
                    if (file_exists($filePath) && is_file($filePath)) {
                        if (unlink($filePath)) {
                            
                        }
                    }
                }
            }
            
            $edit1 = mysqli_query($con, "UPDATE `$tabel` SET
            nama='$_POST[nama]',
            judul='$_POST[judul]',
            gambar='img/$round',
            isi='$_POST[isi]'
            WHERE
            id='$_POST[id]'
            ");
            
                if ($edit1) {
                    echo '
                    <script>
                        alert("Data berhasil disimpan !");
                    </script>
                    ';
                } else {
                    echo '
                    <script>
                        alert("Gagal disimpan.");
                    </script>
                    ';
                }
            }else{

                $edit1 = mysqli_query($con, "UPDATE `$tabel` SET
                nama='$_POST[nama]',
                judul='$_POST[judul]',
                isi='$_POST[isi]'
                WHERE
                id='$_POST[id]'
                ");
                
                    if ($edit1) {
                        echo '
                        <script>
                            alert("Data berhasil disimpan !");
                        </script>
                        ';
                    } else {
                        echo '
                        <script>
                            alert("Gagal disimpan.");
                        </script>
                        ';
                    }
            }

    }

}

// edit jumlah
if (isset($_POST['edit_jumlah'])) {
    $id = $_POST['id'];
    $judul = $con->real_escape_string($_POST['judul']);
    $isi = $con->real_escape_string($_POST['isi']);
    $tambahan = $con->real_escape_string($_POST['tambahan']);

    // insert to db
    $edit = mysqli_query($con, "UPDATE `semua` SET judul='$judul', isi='$isi', tambahan='$tambahan' WHERE id='$id'");

    if ($edit) {
        echo '
        <script>
            alert("Data berhasil disimpan !");
            window.location.href="edit_jumlah.php?id='.$id.'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal disimpan.");
            window.location.href="edit_jumlah.php?id='.$id.'";
        </script>
        ';
    }
}

// edit judul video
if (isset($_POST['edit_video'])) {
    $id = $_POST['id'];
    $judul = $con->real_escape_string($_POST['judul']);

    // insert to db
    $edit = mysqli_query($con, "UPDATE video SET judul='$judul' WHERE id='$id'");

    if ($edit) {
        echo '
        <script>
            alert("Data berhasil disimpan !");
            window.location.href="edit_video.php?id='.$id.'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal disimpan.");
            window.location.href="edit_video.php?id='.$id.'";
        </script>
        ';
    }
}

// edit deskripsi website
if (isset($_POST['deskripsi_website'])) {
    $isi = $con->real_escape_string($_POST['isi']);

    // insert to db
    $edit = mysqli_query($con, "UPDATE semua SET isi='$isi' WHERE id='2'");

    if ($edit) {
        echo '
        <script>
            alert("Data berhasil disimpan !");
            window.location.href="lainnya.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal disimpan.");
            window.location.href="lainnya.php";
        </script>
        ';
    }
}

// edit salam pembuka
if (isset($_POST['pembuka_text'])) {
    $judul = $con->real_escape_string($_POST['judul']);
    $isi = $con->real_escape_string($_POST['isi']);

    // insert to db
    $edit = mysqli_query($con, "UPDATE semua SET judul='$judul', isi='$isi' WHERE id='2'");

    if ($edit) {
        echo '
        <script>
            alert("Data berhasil disimpan !");
            window.location.href="head.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal disimpan.");
            window.location.href="head.php";
        </script>
        ';
    }
}

// edit salam pembuka type file
if (isset($_POST['pembuka_file'])) {
    
    $nama=$_FILES["image"]["name"];
	$lokasi=$_FILES["image"]["tmp_name"];
	$temp = explode(".",$nama);
	$round = "pembuka_file_".round(microtime(true)).'.'. end($temp);
    $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `semua` WHERE `id`='8'"));
    if(move_uploaded_file($lokasi,"../img/".$round)){
        $target = $lawas['judul'];
        if($target == "img/kosong.jpg"){

        }else{
            $filePath = "../". $target; // sesuaikan folder
    
            // Cek apakah file ada
            if (file_exists($filePath) && is_file($filePath)) {
                if (unlink($filePath)) {
                    
                }
            }
        }
    }
    
    // insert to db
    $edit = mysqli_query($con, "UPDATE semua SET judul='img/$round' WHERE id='8'");

    if ($edit) {
        echo '
        <script>
            alert("Data berhasil disimpan !");
            window.location.href="head.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal disimpan.");
            window.location.href="head.php";
        </script>
        ';
    }

}

// sosmed
if (isset($_POST['kontak'])) {
    $alamat = $con->real_escape_string($_POST['alamat']);
    $nomor = $con->real_escape_string($_POST['nomor']);
    $email = $con->real_escape_string($_POST['email']);
    $youtube = $con->real_escape_string($_POST['youtube']);
    $twitter = $con->real_escape_string($_POST['twitter']);
    $facebook = $con->real_escape_string($_POST['facebook']);
    $instagram = $con->real_escape_string($_POST['instagram']);
    $tiktok = $con->real_escape_string($_POST['tiktok']);
    $pesan_whatsapp = rawurlencode($_POST['pesan_whatsapp']);
    
    // Update the database
    $edit = mysqli_query($con, "
        UPDATE semua 
        SET 
            isi = CASE WHEN judul = 'alamat' THEN '$alamat'
                      WHEN judul = 'telephone' THEN '$nomor'
                      WHEN judul = 'email' THEN '$email'
                      WHEN judul = 'twitter' THEN '$twitter'
                      WHEN judul = 'facebook' THEN '$facebook'
                      WHEN judul = 'instagram' THEN '$instagram'
                      WHEN judul = 'youtube' THEN '$youtube'
                      WHEN judul = 'tiktok' THEN '$tiktok'
                      WHEN judul = 'pesan_whatsapp' THEN '$pesan_whatsapp'
                 END
        WHERE judul IN ('alamat','telephone','email','twitter','facebook','instagram','youtube','tiktok','pesan_whatsapp')
    ");

    $whatsapp = $con->real_escape_string($_POST['whatsapp']);
    $isi_whatsapp = $con->real_escape_string($_POST['isi_whatsapp']);

    $edit2 = mysqli_query($con,"UPDATE semua SET `isi`='$whatsapp', `tambahan`='$isi_whatsapp' WHERE judul='whatsapp'");
    

    if ($edit && $edit2) {
        echo '
        <script>
            alert("Berhasil disimpan !");
            window.location.href="kontak.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal disimpan.");
            window.location.href="kontak.php";
        </script>
        ';
    }
}

// tambah program
if (isset($_POST['tambah_program'])) {
    
    $nama = $con->real_escape_string($_POST['nama']);

    // Buat slug URL dari judul
    $url = strtolower($nama);
    $url = preg_replace('/[^a-z0-9\-]+/', '_', $url);
    $url = preg_replace('/_+/', '_', $url); // hilangkan underscore ganda
    $url = trim($url, '_'); // hilangkan underscore di awal/akhir

    $tambah = mysqli_query($con, "INSERT INTO program VALUES ('','$nama','$url')");
    
    if ($tambah) {
        echo '
        <script>
            alert("Berhasil ditambahkan !");
            window.location.href="programe.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal ditambahkan.");
            window.location.href="programe.php";
        </script>
        ';
    }
}

// tambah sub program
if (isset($_POST['tambah_sub_program'])) {

    $nama = $con->real_escape_string($_POST['nama']);
    $isi = $con->real_escape_string($_POST['isi']);
    
    $tambah = mysqli_query($con, "INSERT INTO sub_program VALUES ('','$_POST[id_program]','$nama','$isi')");
    
    if ($tambah) {
        echo '
        <script>
            alert("Berhasil ditambahkan !");
            window.location.href="sub_program.php?id='.$_POST['id_program'].'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal ditambahkan.");
            window.location.href="sub_program.php?id='.$_POST['id_program'].'";
        </script>
        ';
    }
}

// edit program
if (isset($_POST['edit_program'])) {

    $nama = $con->real_escape_string($_POST['nama']);
    $url = $con->real_escape_string($_POST['url']);

    // Buat slug URL dari judul
    $url = strtolower($nama);
    $url = preg_replace('/[^a-z0-9\-]+/', '_', $url);
    $url = preg_replace('/_+/', '_', $url); // hilangkan underscore ganda
    $url = trim($url, '_'); // hilangkan underscore di awal/akhir

    $update = mysqli_query($con, "UPDATE program SET nama='$nama', `url`='$url' WHERE id='$_POST[id]'");
    
    if ($update) {
        echo '
        <script>
            alert("Berhasil disimpan !");
            window.location.href="edit_programe.php?id='.$_POST['id'].'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal disimpan.");
            window.location.href="edit_programe.php?id='.$_POST['id'].'";
        </script>
        ';
    }
}

// edit sub program
if (isset($_POST['edit_sub_program'])) {

    $nama = $con->real_escape_string($_POST['nama']);
    $isi = $con->real_escape_string($_POST['isi']);

    $update = mysqli_query($con, "UPDATE `sub_program` SET `nama`='$nama', `isi`='$isi' WHERE `id`='$_POST[id]'");
    
    if ($update) {
        echo '
        <script>
            alert("Berhasil disimpan !");
            window.location.href="edit_sub_program.php?id='.$_POST['id'].'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal disimpan.");
            window.location.href="edit_sub_program.php?id='.$_POST['id'].'";
        </script>
        ';
    }
}

// tambah user
if (isset($_POST['tambah_user'])) {

    $email = $con->real_escape_string($_POST['email']);
    $nama = $con->real_escape_string($_POST['nama']);
    $epassword = $con->real_escape_string($_POST['password']);
    $cabang = $con->real_escape_string($_POST['cabang']);

    $user = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");
    $num = mysqli_num_rows($user);

    if($num > 0){
        echo '
        <script>
            alert("GAGAL !, Email sudah terdaftar.");
            window.location.href="user.php";
        </script>
        ';    
    }else{

        mysqli_query($con,"INSERT INTO user VALUES (
        '',
        '$email',
        '$nama',
        '$epassword',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '$cabang'
        )");
    
        echo '
        <script>
            alert("Berhasil disimpan !");
            window.location.href="tambah_user_2.php?email='.$email.'";
        </script>
        ';    

    }

}

// tambah user
if (isset($_POST['tambah_cabang'])) {

    $nama = $con->real_escape_string($_POST['nama']);

    $tambah = mysqli_query($con,"INSERT INTO `cabang` VALUES ('','$nama')");

    if($tambah){
        echo '
        <script>
            alert("Berhasil disimpan !");
            window.location.href="cabang.php";
        </script>
        ';    
    }else{
        echo '
        <script>
            alert("Gagal Menambah Cabang !");
            window.location.href="cabang.php";
        </script>
        ';    
    }

}

// tambah user
if (isset($_POST['edit_cabang'])) {

    $id = $_POST['id'];
    $nama = $con->real_escape_string($_POST['nama']);

    $edit = mysqli_query($con,"UPDATE `cabang` SET `nama`='$nama' WHERE `id`='$id'");

    if($edit){
        echo '
        <script>
            alert("Berhasil disimpan !");
            window.location.href="cabang.php";
        </script>
        ';    
    }else{
        echo '
        <script>
            alert("Gagal Menambah Cabang !");
            window.location.href="cabang.php";
        </script>
        ';    
    }

}

// tambah detail user
if (isset($_POST['tambah_isi_user'])) {
    
    $email              = $con->real_escape_string($_POST['email']);
    $gender             = $con->real_escape_string($_POST['gender']);
    $kelas              = $con->real_escape_string($_POST['kelas']);
    $asal_sekolah       = $con->real_escape_string($_POST['asal_sekolah']);
    $tempat_lahir_anak  = $con->real_escape_string($_POST['tempat_lahir_anak']);
    $tgl_lahir_anak     = $con->real_escape_string($_POST['tgl_lahir_anak']);
    $alamat             = $con->real_escape_string($_POST['alamat']);
    $anak_ke            = $con->real_escape_string($_POST['anak_ke']);
    $nama_ibu           = $con->real_escape_string($_POST['nama_ibu']);
    $pendidikan_terakhir= $con->real_escape_string($_POST['pendidikan_terakhir']);
    $pekerjaan_ibu      = $con->real_escape_string($_POST['pekerjaan_ibu']);
    $medsos             = $con->real_escape_string($_POST['medsos']);
    $medsos_ibu         = $con->real_escape_string($_POST['medsos_ibu']);
    $nama_ayah          = $con->real_escape_string($_POST['nama_ayah']);
    $tempat_lahir_ayah  = $con->real_escape_string($_POST['tempat_lahir_ayah']);
    $tgl_lahir_ayah     = $con->real_escape_string($_POST['tgl_lahir_ayah']);
    $pekerjaan_ayah     = $con->real_escape_string($_POST['pekerjaan_ayah']);

    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){

        $nama=$_FILES["image"]["name"];
        $lokasi=$_FILES["image"]["tmp_name"];
        $temp = explode(".",$nama);
        $round = "user_".$email."_".round(microtime(true)).'.'. end($temp);
        move_uploaded_file($lokasi,"../img/".$round);

    }else{
        $round= "kosong.jpg";
    }

    $update = mysqli_query($con, "UPDATE `user` SET
    foto='img/$round',
    jenis_kelamin='$gender',
    kelas='$kelas',
    asal_sekolah='$asal_sekolah',
    tempat_lahir_anak='$tempat_lahir_anak',
    tgl_lahir_anak='$tgl_lahir_anak',
    alamat='$alamat',
    anak_ke='$anak_ke',
    nama_ibu='$nama_ibu',
    pendidikan_terakhir='$pendidikan_terakhir',
    pekerjaan_ibu='$pekerjaan_ibu',
    medsos='$medsos',
    medsos_ibu='$medsos_ibu',
    nama_ayah='$nama_ayah',
    tempat_lahir_ayah='$tempat_lahir_ayah',
    tgl_lahir_ayah='$tgl_lahir_ayah',
    pekerjaan_ayah='$pekerjaan_ayah'
        WHERE
        email='$email'
    ");

    if ($update) {
        echo '
            <script>
                alert("User Siswa berhasil dibuat!");
                window.location.href="user.php";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal terhapus.");
                window.location.href="user.php";
            </script>
            ';
    
        }    
    
}

// edit user
if (isset($_POST['edit_user'])) {

    $id                 = $con->real_escape_string($_POST['id']);
    $nama               = $con->real_escape_string($_POST['nama']);
    $email              = $con->real_escape_string($_POST['email']);
    $password           = $con->real_escape_string($_POST['password']);
    $genderx = isset($_POST['gender']) ? $_POST['gender'] : "";
    $gender             = $con->real_escape_string($genderx);
    $kelas              = $con->real_escape_string($_POST['kelas']);
    $asal_sekolah       = $con->real_escape_string($_POST['asal_sekolah']);
    $tempat_lahir_anak  = $con->real_escape_string($_POST['tempat_lahir_anak']);
    $tgl_lahir_anak     = $con->real_escape_string($_POST['tgl_lahir_anak']);
    $alamat             = $con->real_escape_string($_POST['alamat']);
    $anak_ke            = $con->real_escape_string($_POST['anak_ke']);
    $nama_ibu           = $con->real_escape_string($_POST['nama_ibu']);
    $pendidikan_terakhir= $con->real_escape_string($_POST['pendidikan_terakhir']);
    $pekerjaan_ibu      = $con->real_escape_string($_POST['pekerjaan_ibu']);
    $medsos             = $con->real_escape_string($_POST['medsos']);
    $medsos_ibu         = $con->real_escape_string($_POST['medsos_ibu']);
    $nama_ayah          = $con->real_escape_string($_POST['nama_ayah']);
    $tempat_lahir_ayah  = $con->real_escape_string($_POST['tempat_lahir_ayah']);
    $tgl_lahir_ayah     = $con->real_escape_string($_POST['tgl_lahir_ayah']);
    $pekerjaan_ayah     = $con->real_escape_string($_POST['pekerjaan_ayah']);
    $cabang     = $con->real_escape_string($_POST['cabang']);

    if(isset($_POST['cek']) && $_POST['cek'] == "ada"){

        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){

            $nama=$_FILES["image"]["name"];
            $lokasi=$_FILES["image"]["tmp_name"];
            $temp = explode(".",$nama);
            $round = "user_".$email."_".round(microtime(true)).'.'. end($temp);
            $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `user` WHERE `id`='$id'"));
            if(move_uploaded_file($lokasi,"../img/".$round)){
                $target = $lawas['gambar'];
                if($target == "img/kosong.jpg"){

                }else{
                    $filePath = "../". $target; // sesuaikan folder
            
                    // Cek apakah file ada
                    if (file_exists($filePath) && is_file($filePath)) {
                        if (unlink($filePath)) {
                            
                        }
                    }
                }
            }
            
        }else{
            $round= "kosong.jpg";
        }
    
    $update = mysqli_query($con,"UPDATE `user` SET 
    nama='$nama',
    `password`='$password',
    foto='img/$round',
    jenis_kelamin='$gender',
    kelas='$kelas',
    asal_sekolah='$asal_sekolah',
    tempat_lahir_anak='$tempat_lahir_anak',
    tgl_lahir_anak='$tgl_lahir_anak',
    alamat='$alamat',
    anak_ke='$anak_ke',
    nama_ibu='$nama_ibu',
    pendidikan_terakhir='$pendidikan_terakhir',
    pekerjaan_ibu='$pekerjaan_ibu',
    medsos='$medsos',
    medsos_ibu='$medsos_ibu',
    nama_ayah='$nama_ayah',
    tempat_lahir_ayah='$tempat_lahir_ayah',
    tgl_lahir_ayah='$tgl_lahir_ayah',
    pekerjaan_ayah='$pekerjaan_ayah',
    cabang='$cabang'
        WHERE
        id='$_POST[id]'
    ");
    
    if ($update) {
        if(isset($_POST['cek_email']) && $_POST['cek_email'] == "ada"){
            $num_email = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user WHERE email='$email'"));
            if($num_email > 0){
                echo '
                <script>
                    alert("Perubahan Berhasil disimpan , namun gagal mengubah Email.");
                    window.location.href="edit_user.php?id='.$_POST['id'].'";
                </script>
                ';    
            }else{
                mysqli_query($con, "UPDATE `user` SET email='$email' WHERE id='$_POST[id]'");
            }
        }
        echo '
        <script>
        alert("Perubahan Berhasil disimpan !");
        window.location.href="edit_user.php?id='.$_POST['id'].'";
        </script>
        ';
        }else{
            echo '
            <script>
                alert("Gagal menyimpan.");
                window.location.href="edit_user.php?id='.$_POST['id'].'";
            </script>
            ';
        }

    }else{
    
        $update = mysqli_query($con,"UPDATE `user` SET 
        nama='$nama',
        `password`='$password',
        jenis_kelamin='$gender',
        kelas='$kelas',
        asal_sekolah='$asal_sekolah',
        tempat_lahir_anak='$tempat_lahir_anak',
        tgl_lahir_anak='$tgl_lahir_anak',
        alamat='$alamat',
        anak_ke='$anak_ke',
        nama_ibu='$nama_ibu',
        pendidikan_terakhir='$pendidikan_terakhir',
        pekerjaan_ibu='$pekerjaan_ibu',
        medsos='$medsos',
        medsos_ibu='$medsos_ibu',
        nama_ayah='$nama_ayah',
        tempat_lahir_ayah='$tempat_lahir_ayah',
        tgl_lahir_ayah='$tgl_lahir_ayah',
        pekerjaan_ayah='$pekerjaan_ayah',
        cabang='$cabang'
            WHERE
            id='$_POST[id]'
        ");
        
        if ($update) {
            if(isset($_POST['cek_email']) && $_POST['cek_email'] == "ada"){
                $num_email = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user WHERE email='$email'"));
                if($num_email > 0){
                    echo '
                    <script>
                        alert("Perubahan Berhasil disimpan , namun gagal mengubah Email.");
                        window.location.href="edit_user.php?id='.$_POST['id'].'";
                    </script>
                    ';    
                }else{
                    mysqli_query($con, "UPDATE `user` SET email='$email' WHERE id='$_POST[id]'");
                }
            }
            echo '
            <script>
            alert("Perubahan Berhasil disimpan !");
            window.location.href="edit_user.php?id='.$_POST['id'].'";
            </script>
            ';
            }else{
                echo '
                <script>
                    alert("Gagal menyimpan.");
                    window.location.href="edit_user.php?id='.$_POST['id'].'";
                </script>
                ';
                }
    }

}

// edit user
if (isset($_POST['pilih_paket'])){

// Pastikan $_POST['id'] dan $_POST['paket'] aman untuk digunakan
$id_user = isset($_POST['id']) ? $_POST['id'] : null;

// Validasi jika id_user tidak kosong
if ($id_user) {
    // Menggunakan prepared statement untuk mengecek akses
    $cekAksesQuery = $con->prepare("SELECT * FROM pilih WHERE id_user = ?");
    $cekAksesQuery->bind_param('i', $id_user);  // Menyiapkan parameter sebagai integer
    $cekAksesQuery->execute();
    $cekAksesQuery->store_result();  // Mengambil hasil query untuk menghitung jumlah
    $cekAkses = $cekAksesQuery->num_rows;

    // Jika ada akses sebelumnya, hapus
    if ($cekAkses > 0) {
        $deleteQuery = $con->prepare("DELETE FROM pilih WHERE id_user = ?");
        $deleteQuery->bind_param('i', $id_user);  // Menggunakan parameter untuk mencegah SQL Injection
        $deleteQuery->execute();
        $deleteQuery->close();
    }

    // Menangani input paket yang dipilih
    if (isset($_POST['paket']) && is_array($_POST['paket'])) {
        $selected_paket = $_POST['paket'];  // Array ID paket yang dipilih
    } else {
        $selected_paket = [];
    }

    // Langkah 2: Insert paket yang dipilih
    if (!empty($selected_paket)) {
        // Menyiapkan query insert dengan parameter bind untuk mencegah SQL injection
        $sql_insert = "INSERT INTO pilih (id_user, parent_id) VALUES (?, ?)";
        $stmt = $con->prepare($sql_insert);

        if ($stmt) {
            // Loop melalui paket yang dipilih dan lakukan insert
            foreach ($selected_paket as $id_paket) {
                $stmt->bind_param('ii', $id_user, $id_paket);  // Bind parameter untuk mencegah SQL Injection
                $stmt->execute();  // Eksekusi per insert
            }
            $stmt->close();  // Tutup prepared statement
        }
    }
}

    echo '
    <script>
        alert("Perubahan berhasil disimpan!");
        window.location.href="akses_soal.php?id='.$_POST['id'].'";
    </script>
    ';
}
    
// hapus user
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus_user"){
    // insert to db
    $delete = mysqli_query($con, "DELETE FROM `user` WHERE `id`='$_GET[id]'");

    if ($delete) {
        echo '
        <script>
            alert("User berhasil dihapus!");
            window.location.href="user.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="user.php";
        </script>
        ';

    }    
}
    
// hapus video
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus_video"){
    $id = $_GET['id'];
    $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `video` WHERE `id`='$id'"));
    $target = $lawas['filename'];
    $filePath = "../". $target; // sesuaikan folder
    
    $delete = mysqli_query($con, "DELETE FROM `video` WHERE `id`='$id'");

    if ($delete) {
        // Cek apakah file ada
        if (file_exists($filePath) && is_file($filePath)) {
            if (unlink($filePath)) {
                
            }
        }
        echo '
        <script>
            alert("Data berhasil dihapus!");
            window.location.href="video.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="video.php";
        </script>
        ';

    }    
}

// tambah paket
if (isset($_POST['tambah_paket'])) {

    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){

        $nama=$_FILES["image"]["name"];
        $lokasi=$_FILES["image"]["tmp_name"];
        $temp = explode(".",$nama);
        $round = "paket_".round(microtime(true)).'.'. end($temp);
        move_uploaded_file($lokasi,"../img/".$round);

    $tambah = mysqli_query($con, "INSERT INTO paket VALUES(
        '',
        '$_POST[id_kategori]',
        '$_POST[paket]',
        '$_POST[menit]',
        '$_POST[ket]',
        'img/$round'
        )");
    
        if ($tambah) {
            echo '
            <script>
                alert("Data berhasil dibuat !");
                window.location.href="paket_soal.php?id='.$_POST['id_kategori'].'";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal disimpan.");
            </script>
            ';
        }

    }else{
        $tambah = mysqli_query($con, "INSERT INTO paket VALUES(
            '',
            '$_POST[id_kategori]',
            '$_POST[paket]',
            '$_POST[menit]',
            '$_POST[ket]',
            'img/kosong.jpg'
            )");
        
            if ($tambah) {
                echo '
                <script>
                    alert("Data berhasil dibuat !");
                    window.location.href="paket_soal.php?id='.$_POST['id_kategori'].'";
                </script>
                ';
            } else {
                echo '
                <script>
                    alert("Gagal disimpan.");
                </script>
                ';
            }
    }
}

// tambah kategori
if (isset($_POST['tambah_categories'])) {

    $nama = $con->real_escape_string($_POST['nama']);

    $tambah = mysqli_query($con, "INSERT INTO `kategori` (`nama`,`gambar`,`keterangan`) VALUES(
            '$nama',
            'img/kosong.jpg',
            ''
            )");
        
            if ($tambah) {
                echo '
                <script>
                    alert("Data berhasil dibuat !");
                    window.location.href="semua_soal.php";
                </script>
                ';
            } else {
                echo '
                <script>
                    alert("Gagal disimpan.");
                </script>
                ';
            }

    }

// tambah sub-kategori / paket
if (isset($_POST['tambah_sub_kategori'])) {

    $nama = $con->real_escape_string($_POST['nama']);
    $tipe = $con->real_escape_string($_POST['tipe']);
    $id_induk = $con->real_escape_string($_POST['id_induk']);
    $menit = $con->real_escape_string($_POST['menit']);
    $isi = $con->real_escape_string($_POST['isi']);
    $back = $con->real_escape_string($_POST['back']);
    
    $round = "kosong.jpg";
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
        $name=$_FILES["image"]["name"];
        $lokasi=$_FILES["image"]["tmp_name"];
        $temp = explode(".",$name);
        $round = "kategori_".round(microtime(true)).'.'. end($temp);
        move_uploaded_file($lokasi,"../img/".$round);
    }
    
    if($tipe == "paket"){
        $tambah = mysqli_query($con, "INSERT INTO paket VALUES(
            '',
            '$id_induk',
            '$nama',
            '$menit',
            '$isi',
            'img/$round'
            )");
    }else{
        $tambah = mysqli_query($con, "INSERT INTO kategori VALUES(
            '',
            '$nama',
            'img/$round',
            '$isi'
            )");
    }

    if($back == "semua_soal"){
        $links = "semua_soal.php";
    }else{
        $links = "paket_soal.php?id=".$id_induk;
    }
    
    if ($tambah) {
        echo '
        <script>
            window.location.href="'.$links.'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal disimpan.");
            window.location.href="'.$links.'";
        </script>
        ';
    }

    }

// hapus paket
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus_paket"){
    $id = $con->real_escape_string($_GET['id']);
    $id_kategori = isset($_GET['id_k']) ? $con->real_escape_string($_GET['id_k']) : '';
    $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `paket` WHERE `id`='$id'"));

    $delete = mysqli_query($con, "DELETE FROM `paket` WHERE `id`='$id'");
    $delete1 = mysqli_query($con, "DELETE FROM `pertanyaan` WHERE `id_paket`='$id'");
    $delete2 = mysqli_query($con, "DELETE FROM `jawaban` WHERE `id_paket`='$id'");
    $delete3 = mysqli_query($con, "DELETE FROM `nilai` WHERE `id_paket`='$id'");

    if ($delete && $delete1 && $delete2 && $delete3) {
        $target = $lawas['gambar'];
        $filePath = "../".$target;
        if($target != "img/kosong.jpg" && file_exists($filePath) && is_file($filePath)){
            unlink($filePath);
        }
        echo '
        <script>
            alert("Data berhasil dihapus!");
            window.location.href="paket_soal.php?id='.$id_kategori.'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="paket_soal.php?id='.$id_kategori.'";
        </script>
        ';

    }    
}
    
// tambah soal
if (isset($_POST['tambah_soal'])) {
    $pertanyaan = $_POST['pertanyaan'];
    $isi = $con->real_escape_string($pertanyaan);
    $nomor = $con->real_escape_string($_POST['nomor']);
    $type = $con->real_escape_string($_POST['type']);
    $parent_id = $con->real_escape_string($_POST['parent_id']);
    if($type == "ganda" || $type == "essay"){
    
    }else{
        echo '
        <script>
            alert("Tipe soal tidak valid.");
            window.location.href="tambah_soal.php?id='.$parent_id.'";
        </script>
        ';
    }
    $tambah = mysqli_query($con, "INSERT INTO `soal` (`parent_id`,`nomor`,`pertanyaan`,`type`) VALUES ('$parent_id','$nomor','$isi','$type')");
 
     if($tambah){
         $insert = $con->insert_id;
         if($type == "ganda"){
            mysqli_query($con,"INSERT INTO `answer` VALUE 
            ('','$insert','$parent_id','','0'),
            ('','$insert','$parent_id','','0'),
            ('','$insert','$parent_id','','0'),
            ('','$insert','$parent_id','','0')
            ");
            echo '
            <script>
                window.location.href="edit_pembahasan.php?id='.$parent_id.'&id_s='.$insert.'";
            </script>
            ';
         }else{
            mysqli_query($con,"INSERT INTO `answer` VALUE 
            ('','$insert','$parent_id','','0')
            ");
            echo '
            <script>
                window.location.href="edit_pembahasan.php?id='.$parent_id.'&id_s='.$insert.'";
            </script>
            ';
         }
     }
 
 }

// tambah soal
if (isset($_POST['edit_soal'])) {
    $id = $_POST['id'];
    $id_s = $_POST['id_s'];
    $nomor = $_POST['nomor'];
    $pertanyaan = $_POST['pertanyaan'];
    $isi = $con->real_escape_string($pertanyaan);
     $tambah = mysqli_query($con, "UPDATE `soal` SET `nomor`='$nomor',`pertanyaan`='$isi' WHERE `id`='$id_s'");
 
     if($tambah){
         echo '
         <script>
            alert("Data berhasil disimpan.");
            window.location.href="edit_soal.php?id='.$id.'&id_s='.$id_s.'";
         </script>
         ';
     }
 
 }
 
// edit soal
if (isset($_POST['edit_pembahasan'])) {
    
    $id = $_POST['id'];
    $id_s = $_POST['id_s'];
    $skor = $_POST['skor'];
    if($skor == 0){
         echo '
         <script>
            alert("Skor tidak valid.");
            window.location.href="edit_pembahasan.php?id='.$id.'&id_s='.$id_s.'";
         </script>
         ';
    }
    $pembahasan = $_POST['pembahasan'];
    $isi = $con->real_escape_string($pembahasan);
    $benar_id = $con->real_escape_string($_POST['id_benar']);
    $salah1_id = $con->real_escape_string($_POST['id_salah1']);
    $salah2_id = $con->real_escape_string($_POST['id_salah2']);
    $salah3_id = $con->real_escape_string($_POST['id_salah3']);
    $benar = $con->real_escape_string($_POST['benar']);
    $salah1 = $con->real_escape_string($_POST['salah1']);
    $salah2 = $con->real_escape_string($_POST['salah2']);
    $salah3 = $con->real_escape_string($_POST['salah3']);
     $update = mysqli_query($con, "UPDATE `soal` SET `pembahasan`='$isi', `id_jawaban`='$_POST[id_benar]' WHERE `id`='$id_s'");
     $update = mysqli_query($con, "UPDATE `answer`
SET isi = CASE 
               WHEN id = '$benar_id' THEN '$benar'
               WHEN id = '$salah1_id' THEN '$salah1'
               WHEN id = '$salah2_id' THEN '$salah2'
               WHEN id = '$salah3_id' THEN '$salah3'
           END,
    skor = CASE 
               WHEN id = '$benar_id' THEN '$skor'  -- Set skor for correct answer
               WHEN id = '$salah1_id' THEN '0' -- Set skor for wrong answers
               WHEN id = '$salah2_id' THEN '0'
               WHEN id = '$salah3_id' THEN '0'
           END
WHERE id IN ('$benar_id', '$salah1_id', '$salah2_id', '$salah3_id');
");
 
     if($update){
         echo '
         <script>
             alert("Data berhasil disimpan.");
             window.location.href="edit_pembahasan.php?id='.$id.'&id_s='.$id_s.'";
         </script>
         ';
     }else{
         echo '
         <script>
             alert("Gagal menyimpan.");
             window.location.href="edit_pembahasan.php?id='.$id.'&id_s='.$id_s.'";
         </script>
         ';  
         }
 
}

// hapus artikel
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus_soal"){
    // insert to db
    $delete = mysqli_query($con, "DELETE FROM pertanyaan WHERE id='$_GET[id]'");
    $delete2 = mysqli_query($con, "DELETE FROM jawaban WHERE id_pertanyaan='$_GET[id]'");

    if ($delete && $delete2) {
        echo '
        <script>
            alert("Soal berhasil dihapus!");
            window.location.href="tabel_soal.php?id_k='.$_GET['id_k'].'&id_p='.$_GET['id_p'].'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="artikel.php";
        </script>
        ';

    }    
}

// tambah gambar
if (isset($_POST['tambah_gambar'])) {
    $nama=$_FILES["image"]["name"];
    $lokasi=$_FILES["image"]["tmp_name"];
    $temp = explode(".",$nama);
    $round = "gambar_".round(microtime(true)).'.'. end($temp);
    move_uploaded_file($lokasi,"../img/".$round);

    $tambah = mysqli_query($con, "INSERT INTO gambar VALUES(
        '',
        'img/$round'
        )");
    
        if ($tambah) {
            echo '
            <script>
                alert("Data berhasil dibuat !");
                window.location.href="galeri.php";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal disimpan.");
            </script>
            ';
        }
    }

// Edit gambar
if (isset($_POST['ubah_gambar_jumlah'])) {
    $nama=$_FILES["image"]["name"];
    $lokasi=$_FILES["image"]["tmp_name"];
    $temp = explode(".",$nama);
    $round = "semua_21_".round(microtime(true)).'.'. end($temp);
    $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `semua` WHERE `id`='21'"));
    if(move_uploaded_file($lokasi,"../img/".$round)){
        $target = $lawas['isi'];
        if($target == "img/kosong.jpg"){

        }else{
            $filePath = "../". $target; // sesuaikan folder
    
            // Cek apakah file ada
            if (file_exists($filePath) && is_file($filePath)) {
                if (unlink($filePath)) {
                    
                }
            }
        }
    }
    
    $edit = mysqli_query($con, "UPDATE semua SET isi='img/$round' WHERE id='21'");
    
        if ($edit) {
            echo '
            <script>
                alert("Data berhasil disimpan !");
                window.location.href="jumlah.php";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal disimpan.");
            </script>
            ';
        }
    }
    
// hapus galeri
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus_galeri"){
    // insert to db
    $delete = mysqli_query($con, "DELETE FROM `gambar` WHERE `id`='$_GET[id]'");

    if ($delete) {
        echo '
        <script>
            alert("Gambar berhasil dihapus!");
            window.location.href="galeri.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="galeri.php";
        </script>
        ';

    }    
}

// tambah kegiatan
if (isset($_POST['tambah_kegiatan'])) {
    $nama=$_FILES["image"]["name"];
    $lokasi=$_FILES["image"]["tmp_name"];
    $temp = explode(".",$nama);
    $round = "galeri_".round(microtime(true)).'.'. end($temp);
    move_uploaded_file($lokasi,"../img/".$round);

    $tambah = mysqli_query($con, "INSERT INTO galeri VALUES(
        '',
        'img/$round',
        '0',
        ''
        )");
    
        if ($tambah) {
            echo '
            <script>
                alert("Data berhasil dibuat !");
                window.location.href="kegiatan.php";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal disimpan.");
            </script>
            ';
        }
    }
    

// ubah header
if (isset($_POST['ubah_header'])) {

    $nav = $_POST['nav'];
    $tabel = $_POST['tabel'];

    $nama=$_FILES["image"]["name"];
    $lokasi=$_FILES["image"]["tmp_name"];
    $temp = explode(".",$nama);
    $round = "galeri_".$nav."_".round(microtime(true)).'.'. end($temp);
    $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `galeri` WHERE `judul`='$nav'"));
    if(move_uploaded_file($lokasi,"../img/".$round)){
        $target = $lawas['gambar'];
        if($target == "img/kosong.jpg"){

        }else{
            $filePath = "../". $target; // sesuaikan folder
    
            // Cek apakah file ada
            if (file_exists($filePath) && is_file($filePath)) {
                if (unlink($filePath)) {
                    
                }
            }
        }
    }

    $edit = mysqli_query($con, "UPDATE galeri SET gambar='img/$round' WHERE judul='$nav'");
    
        if ($edit) {
            echo '
            <script>
                alert("Data berhasil disimpan !");
                window.location.href="ubah_header.php?nav='.$nav.'&tabel='.$tabel.'";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal disimpan.");
            </script>
            ';
        }
    }
    

// ubah header
if (isset($_POST['ubah_header_video'])) {
    $nama=$_FILES["image"]["name"];
    $lokasi=$_FILES["image"]["tmp_name"];
    $temp = explode(".",$nama);
    $round = "header_video_".round(microtime(true)).'.'. end($temp);
    $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `galeri` WHERE `judul`='$nav'"));
    if(move_uploaded_file($lokasi,"../img/".$round)){
        $target = $lawas['gambar'];
        if($target == "img/kosong.jpg"){

        }else{
            $filePath = "../". $target; // sesuaikan folder
    
            // Cek apakah file ada
            if (file_exists($filePath) && is_file($filePath)) {
                if (unlink($filePath)) {
                    
                }
            }
        }
    }

    $nav = $_POST['nav'];
    $tabel = $_POST['tabel'];

    $edit = mysqli_query($con, "UPDATE galeri SET gambar='img/$round' WHERE judul='$nav'");
    
        if ($edit) {
            echo '
            <script>
                alert("Data berhasil disimpan !");
                window.location.href="ubah_header_video.php";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal disimpan.");
            </script>
            ';
        }
    }
    

// ubah header page
if (isset($_POST['ubah_header_page'])) {

    $id = $_POST['id'];
    $tabel = $_POST['tabel'];

    $nama=$_FILES["image"]["name"];
    $lokasi=$_FILES["image"]["tmp_name"];
    $temp = explode(".",$nama);
    $round = "header_page_".round(microtime(true)).'.'. end($temp);
    $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `$tabel` WHERE `id`='$id'"));
    if(move_uploaded_file($lokasi,"../img/".$round)){
        $target = $lawas['header'];
        if($target == "img/kosong.jpg"){

        }else{
            $filePath = "../". $target; // sesuaikan folder
    
            // Cek apakah file ada
            if (file_exists($filePath) && is_file($filePath)) {
                if (unlink($filePath)) {
                    
                }
            }
        }
    }

    $nav = $_POST['nav'];

    $edit = mysqli_query($con, "UPDATE `$tabel` SET header='img/$round' WHERE id='$_POST[id]'");
    
        if ($edit) {
            echo '
            <script>
                alert("Data berhasil disimpan !");
                window.location.href="ubah_header_page.php?nav='.$nav.'&tabel='.$tabel.'&id='.$_POST['id'].'";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal disimpan.");
            </script>
            ';
        }
    }

// ubah gambar admin
if (isset($_POST['gambar_admin'])) {
    $nama=$_FILES["image"]["name"];
    $lokasi=$_FILES["image"]["tmp_name"];
    $temp = explode(".",$nama);
    $round = "gambar_admin_".round(microtime(true)).'.'. end($temp);
    $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `semua` WHERE `id`='8'"));
    if(move_uploaded_file($lokasi,"../img/".$round)){
        $target = $lawas['isi'];
        if($target == "img/kosong.jpg"){

        }else{
            $filePath = "../". $target; // sesuaikan folder
    
            // Cek apakah file ada
            if (file_exists($filePath) && is_file($filePath)) {
                if (unlink($filePath)) {
                    
                }
            }
        }
    }

    $edit = mysqli_query($con, "UPDATE `semua` SET isi='img/$round' WHERE id='8'");
    
        if ($edit) {
            echo '
            <script>
                alert("Data berhasil disimpan !");
                window.location.href="akun.php";
            </script>
            ';
        } else {
            echo '
            <script>
                alert("Gagal disimpan.");
                window.location.href="akun.php";
            </script>
            ';
        }
    }
    
// hapus galeri
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus_kegiatan"){
    // insert to db
    $delete = mysqli_query($con, "DELETE FROM `galeri` WHERE `id`='$_GET[id]'");

    if ($delete) {
        echo '
        <script>
            alert("Gambar berhasil dihapus!");
            window.location.href="kegiatan.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="kegiatan.php";
        </script>
        ';

    }    
}
    
// hapus program
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus_program"){
    // insert to db
    $delete = mysqli_query($con, "DELETE FROM program WHERE `id`='$_GET[id]'");

    if ($delete) {
        echo '
        <script>
            alert("Data berhasil dihapus!");
            window.location.href="programe.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="programe.php";
        </script>
        ';

    }    
}
    
    
// hapus sub program
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus_sub_program"){
    // insert to db
    $delete = mysqli_query($con, "DELETE FROM sub_program WHERE `id`='$_GET[id_sub]'");

    if ($delete) {
        echo '
        <script>
            alert("Data berhasil dihapus!");
            window.location.href="sub_program.php?id='.$_GET['id_p'].'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="sub_program.php?id='.$_GET['id_p'].'";
        </script>
        ';

    }    
}
    
    
// hapus sub program
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus_inbox"){
    // insert to db
    $delete = mysqli_query($con, "DELETE FROM inbox WHERE `id`='$_GET[id]'");

    if ($delete) {
        echo '
        <script>
            alert("Data berhasil dihapus!");
            window.location.href="inbox.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="inbox.php";
        </script>
        ';

    }    
}
    
    
// hapus sub program
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus_nilai"){
    // insert to db
    $nilai = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `nilai` WHERE `id`='$_GET[id]'"));

    $delete1 = mysqli_query($con, "DELETE FROM `aktif` WHERE `parent_id`='$nilai[parent_id]' AND `id_user`='$nilai[id_user]'");
    $delete2 = mysqli_query($con, "DELETE FROM `jawab` WHERE `parent_id`='$nilai[parent_id]' AND `id_user`='$nilai[id_user]'");
    $delete3 = mysqli_query($con, "DELETE FROM `nilai` WHERE `id`='$_GET[id]'");

    if ($delete1 && $delete2 && $delete3) {
        echo '
        <script>
            window.location.href="buka_nilai.php?parent_id='.$nilai['parent_id'].'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="rekap_nilai.php";
        </script>
        ';

    }    
}
    
// hapus sub program
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus_cabang"){
    // insert to db
    $delete = mysqli_query($con, "DELETE FROM `cabang` WHERE `id`='$_GET[id]'");

    if ($delete) {
        echo '
        <script>
            alert("Data berhasil dihapus!");
            window.location.href="cabang.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="cabang.php";
        </script>
        ';

    }    
}
    
    
// hapus tandai belum
if (isset($_GET['aksi']) && $_GET['aksi'] == "tandai"){
    // insert to db
    $update = mysqli_query($con, "UPDATE inbox SET `level`='0' WHERE `id`='$_GET[id]'");

    if ($update) {
        echo '
        <script>
            alert("Perubahan Berhasil disimpan!");
            window.location.href="inbox.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="inbox.php";
        </script>
        ';

    }    
}
    
// hapus tandai sudah
if (isset($_GET['aksi']) && $_GET['aksi'] == "tandai_dilihat"){
    // insert to db
    $update = mysqli_query($con, "UPDATE inbox SET `level`='1' WHERE `id`='$_GET[id]'");

    if ($update) {
        echo '
        <script>
            window.location.href="isi_kotak_masuk.php?id='.$_GET['id'].'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal.");
            window.location.href="inbox.php";
        </script>
        ';

    }    
}
    
// hapus komentar ke dua
if (isset($_GET['aksi']) && $_GET['aksi'] == "hapus"){

    $tabel = $_GET['tabel'];
    $nav = $_GET['nav'];

    // insert to db
    $delete = mysqli_query($con, "DELETE FROM `$tabel` WHERE `id`='$_GET[id]'");

    if ($delete) {
        echo '
        <script>
            alert("Data berhasil dihapus!");
            window.location.href="tabel.php?nav='.$nav.'&tabel='.$tabel.'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="tabel.php?nav='.$nav.'&tabel='.$tabel.'";
        </script>
        ';

    }    
}
    
// hapus kategori
if (isset($_GET['aksi']) && $_GET['aksi'] == "delete_category"){
    $id = $con->real_escape_string($_GET['id']);

    mysqli_query($con, "DELETE FROM `jawaban` WHERE `id_paket` IN (SELECT id FROM paket WHERE id_kategori='$id')");
    mysqli_query($con, "DELETE FROM `pertanyaan` WHERE `id_paket` IN (SELECT id FROM paket WHERE id_kategori='$id')");
    mysqli_query($con, "DELETE FROM `nilai` WHERE `id_paket` IN (SELECT id FROM paket WHERE id_kategori='$id')");
    mysqli_query($con, "DELETE FROM `paket` WHERE `id_kategori`='$id'");
    $delete = mysqli_query($con, "DELETE FROM `kategori` WHERE `id`='$id'");

    if ($delete) {
        echo '
        <script>
            alert("Data berhasil dihapus!");
            window.location.href="semua_soal.php";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="semua_soal.php";
        </script>
        ';

    }    
}
    
// hapus
if (isset($_GET['aksi']) && $_GET['aksi'] == "delete_soal"){

    $delete = mysqli_query($con, "DELETE FROM `soal` WHERE `id`='$_GET[id_s]'");
    $delete2 = mysqli_query($con, "DELETE FROM `answer` WHERE `id_pertanyaan`='$_GET[id_s]'");
    $delete3 = mysqli_query($con, "DELETE FROM `jawab` WHERE `id_pertanyaan`='$_GET[id_s]'");

    if ($delete && $delete2 && $delete3) {
        echo '
        <script>
            alert("Data berhasil dihapus!");
            window.location.href="sub-category.php?id='.$_GET['id'].'";
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal terhapus.");
            window.location.href="sub-category.php?id='.$_GET['id'].'";
        </script>
        ';

    }    
}
    
// edit kategori
if (isset($_POST['edit_category'])) {

    $id = $con->real_escape_string($_POST['id_induk']);
    $nama = $con->real_escape_string($_POST['nama']);
    $isi = isset($_POST['isi']) ? $con->real_escape_string(nl2br($_POST['isi'])) : null;
    $menit = isset($_POST['menit']) ? $con->real_escape_string($_POST['menit']) : 0;
    $lawas = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `kategori` WHERE `id`='$id'"));
    if ($isi === null) {
        $isi = isset($lawas['keterangan']) ? $lawas['keterangan'] : '';
    }
    
    if(isset($_POST['cek']) && $_POST['cek'] == "ganti"){
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
            $name=$_FILES["image"]["name"];
            $lokasi=$_FILES["image"]["tmp_name"];
            $temp = explode(".",$name);
            $round = "kategori_".round(microtime(true)).'.'. end($temp);
            if(move_uploaded_file($lokasi,"../img/".$round)){
                $target = isset($lawas['gambar']) ? $lawas['gambar'] : 'img/kosong.jpg';
                if($target != "img/kosong.jpg"){
                    $filePath = "../". $target; // sesuaikan folder
            
                    // Cek apakah file ada
                    if (file_exists($filePath) && is_file($filePath)) {
                        unlink($filePath);
                    }
                }
            }
        }else{
            $round = isset($lawas['gambar']) ? basename($lawas['gambar']) : 'kosong.jpg';
        }
        
        $update = mysqli_query($con, "UPDATE `kategori` SET `nama`='$nama',`gambar`='img/$round',`keterangan`='$isi' WHERE `id`='$id'");
    }else{
        $update = mysqli_query($con, "UPDATE `kategori` SET `nama`='$nama',`keterangan`='$isi' WHERE `id`='$id'");
    }

    if ($update) {
        echo '
        <script>
            alert("Data berhasil disimpan !");
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal menyimpan .");
        </script>
        ';

    }    
}
?>
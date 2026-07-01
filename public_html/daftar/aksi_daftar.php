<?php
include "../penghubung.php";

$email = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user WHERE email='$_POST[email]'"));

if($email > 0){

    echo'
    <script>
        alert("Form Pendaftaran GAGAL Terkirim ! Email Sudah Terdaftar");
        window.location.href="terima_kasih.php";
    </script>
    ';
}else{

    
    $daftar = mysqli_query($con, "INSERT INTO inbox VALUES ('','$_POST[id_p]','$_POST[id_sub]','$_POST[nama]','$_POST[email]','','$_POST[wa]','0')");

if($daftar){
echo'
<script>
    alert("Form Pendaftaran Berhasil Terkirim !");
    window.location.href="terima_kasih.php";
</script>
';
}else{
    echo'
    <script>
        alert("Form Pendaftaran GAGAL Terkirim !");
        window.location.href="terima_kasih.php";
    </script>
    ';
    }
}
?>
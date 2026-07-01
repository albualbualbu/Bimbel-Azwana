<?php
session_start();
include "../penghubung.php";

if(isset($_POST['cek']) && $_POST['cek'] == "ada"){

    $epassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($con,"UPDATE `login` SET username='$_POST[username]', password='$epassword' WHERE id='1'");
    $_SESSION['admin'] = "admin";
    
    echo '
    <script>
        alert("Perubahan Berhasil disimpan !");
        window.location.href="logout.php";
    </script>
    ';
    
}else{
    
    mysqli_query($con,"UPDATE `login` SET username='$_POST[username]' WHERE id='1'");
    $_SESSION['admin'] = "admin";
    
    echo '
    <script>
        alert("Perubahan Berhasil disimpan !");
        window.location.href="logout.php";
    </script>
    ';
    
}

?>
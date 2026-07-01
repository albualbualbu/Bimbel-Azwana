<?php
session_start();

include "../penghubung.php";

$u = $_POST['username'];
$p = $_POST['password'];
$query = mysqli_query($con,"select * from `login` where username='$u'");
$fetch = mysqli_fetch_array($query);
$name = isset($fetch['username']) ? $fetch['username'] : "";
$pass = isset($fetch['password']) ? $fetch['password'] : "";
$ketemu = mysqli_num_rows($query);
if ($ketemu == 0){
    echo '
    <script>
        alert("Akun tidak ditemukan !");
        window.location.href="./";
    </script>
    ';
    }else{

        if (password_verify($p, $pass)) {
            $_SESSION['admin']= $name ;
            header("location:admin.php");
        }else{
            echo '
            <script>
                alert("Password Salah !");
                window.location.href="./";
            </script>
            ';
        }
    }
?>
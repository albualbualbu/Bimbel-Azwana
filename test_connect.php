<?php
$con = mysqli_connect('127.0.0.1','root','','database bimbel azwana 2026_05_01');
if(!$con){
    echo 'connect fail: '.mysqli_connect_error();
    exit(1);
}
echo 'ok';
mysqli_close($con);
?>
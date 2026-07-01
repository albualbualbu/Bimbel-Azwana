<?php
$con = mysqli_connect('localhost','root','','database bimbel azwana 2026_05_01');
if (!$con) {
    echo 'localhost fail: '.mysqli_connect_error();
} else {
    echo 'localhost ok';
    mysqli_close($con);
}
$con = mysqli_connect('127.0.0.1','root','','database bimbel azwana 2026_05_01');
if (!$con) {
    echo "\n127.0.0.1 fail: ".mysqli_connect_error();
} else {
    echo "\n127.0.0.1 ok";
    mysqli_close($con);
}
?>

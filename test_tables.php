<?php
$con = new mysqli('localhost','root','','database bimbel azwana 2026_05_01');
if($con->connect_error){echo 'connect fail: '.$con->connect_error; exit(1);} 
$res = $con->query('SHOW TABLES');
if(!$res){echo 'query fail: '.$con->error; exit(1);} 
while($row = $res->fetch_array(MYSQLI_NUM)){ echo $row[0]."\n"; }
?>

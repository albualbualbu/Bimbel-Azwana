<?php
$con = new mysqli('localhost','root','','database bimbel azwana 2026_05_01');
if($con->connect_error){echo 'connect fail: '.$con->connect_error; exit(1);} 
$res = $con->query('DESCRIBE `categories`');
if(!$res){echo 'query fail: '.$con->error; exit(1);} 
while($row = $res->fetch_assoc()){ echo $row['Field'].' '.$row['Type'].' '.$row['Null'].' '.$row['Key'].'\n'; }
?>

<?php
$con = mysqli_connect('127.0.0.1','root','','database bimbel azwana 2026_05_01');
if (!$con) { echo 'connect failed: '.mysqli_connect_error(); exit(1); }
$ids = [9,10,11,12,21];
foreach ($ids as $id) {
    $res = mysqli_query($con, "SELECT id, judul, isi, tambahan FROM semua WHERE id='".$id."'");
    if (!$res) {
        echo "ERROR id=$id: ".mysqli_error($con)."\n";
        continue;
    }
    $row = mysqli_fetch_assoc($res);
    if (!$row) {
        echo "ROW MISSING id=$id\n";
    } else {
        echo "id={$row['id']} judul=".trim($row['judul'])." tambahan=".trim($row['tambahan'])." isi=".trim($row['isi'])."\n";
    }
}
mysqli_close($con);
?>
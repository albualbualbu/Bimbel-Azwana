<?php
error_reporting(0);
include "../penghubung.php";

$idSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='1'"));

$program = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM program WHERE `url`='$_GET[url]'"))

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Daftar - <?= $idSatu['judul'];?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../<?= $idSatu['isi'];?>">  

    <!-- CSS FILES -->        
    <link href="../css/bootstrap2.min.css" rel="stylesheet">


    <script>
  </script>

</head>
<style>
    body{
        background:radial-gradient(circle, #ff0084, #ff0020);
    }
	.input{
	width:100%;
	padding:12px 20px;
	margin:1px 0;
	box-sizing:border-box;
	}
</style>
<body>
<center>
<div class="p-2" style="width:350px; background-color:white; display:block; top:50%; left:50%; height:auto;border-radius:15px; font-family:Arial; color:#7a7a7a; ">
	<img style="height:100px; margin-top:10px; border-radius:15px 15px 0 0;" src="../img/logo wm 2.png" />
    <br>
    <h3><a style="text-decoration:none;" href="./">&nbsp;&#10094;&nbsp;</a><?= $program['nama'];?></h3>
    <form action="registrasi.php" method="post">
    <?php
        $program_q = mysqli_query($con, "SELECT * FROM sub_program WHERE id_program='$program[id]'");
        while($sub_program = mysqli_fetch_array($program_q)){
        ?>
        <div class="selectable-card m-1 p-1" style="cursor: pointer; border:1px solid #ffecff; border-radius:5px; background:#ffecff;">
            <input type="radio" name="sub_program" value="<?= $sub_program['id'];?>" id=""> <b><?= $sub_program['nama'];?></b>
            <?= $sub_program['isi'];?>
        </div>
    <?php } ?>
    <input type="hidden" name="id_p" value="<?= $program['id'];?>">
    <input type="submit" value="Daftar" id="submit-btn" disabled style="background-color:#ff0084; border:none; border-radius:5px; color:white; padding:13px 27px;
		text-decoration:none; margin:4px 2px; cursor:pointer;">
    </form>

</div>
<center>
<script>
  // 1. Gunakan class yang ada pada elemen HTML (misal: .selectable-card)
const cards = document.querySelectorAll('.selectable-card'); 
const submitButton = document.getElementById('submit-btn');

cards.forEach(card => {
  card.addEventListener('click', function() {
    const radio = this.querySelector('input[type="radio"]');
    
    if (radio) {
      radio.checked = true; 
      
      // Jalankan fungsi styling
      clearActiveClasses();
      this.style.borderColor = '#d669d6';
      this.style.backgroundColor = '#ffdbff';

      // PENTING: Panggil fungsi pengecekan tombol karena perubahan manual .checked = true 
      // tidak memicu event 'change' pada input secara otomatis.
      toggleSubmitButton();
    }
  });
});

function clearActiveClasses() {
  cards.forEach(c => {
    c.style.borderColor = '#ffecff';
    c.style.backgroundColor = '#ffecff';
  });
}

function toggleSubmitButton() {
  const radioButtons = document.querySelectorAll('input[type="radio"]');
  // Pastikan element submit-btn ada sebelum memanipulasi .disabled
  if (submitButton) {
    submitButton.disabled = !Array.from(radioButtons).some(radio => radio.checked);
  }
}

// Inisialisasi saat DOM siap
document.addEventListener('DOMContentLoaded', function() {
  const radioButtons = document.querySelectorAll('input[type="radio"]');
  
  radioButtons.forEach(radio => {
    // Tetap pantau event change jika user klik langsung pada bulatan radio-nya
    radio.addEventListener('change', toggleSubmitButton);
  });

  toggleSubmitButton();
});
</script>
</body>
</html>
<?php

include "../header2.php";


track_pengunjung($con, $id, 'Program');
  

$array_header = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM galeri WHERE judul='program'"));
$header = $array_header['gambar'];
?>

        <main>

            <section class="news-detail-header-section text-center" style="background-image: url('../<?= $header;?>');">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h1 class="text-white">Program</h1>
                        </div>

                    </div>
                </div>
            </section>

            <section class="news-section section-padding">
                <div class="container">
                    <div class="row">

<?php
$images = mysqli_query($con, "SELECT * FROM galeri WHERE judul='0' ORDER BY id DESC");
while ($image = mysqli_fetch_array($images)) {
    echo "
        <div class='col-lg-3 col-md-6 col-12 mb-4 mt-4 mb-lg-0'>
            <img src='../$image[gambar]' style='width:100%; cursor:pointer;' alt='' onclick='openModal(\"../" . $image['gambar'] . "\")'>
        </div>
    ";
}
?>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <img class="modal-content" id="modalImage">
        <center>
            <span class="close" onclick="closeModal()">&times;</span>
        </center>
    </div>

<script>
function openModal(imageSrc) {
    document.getElementById('myModal').style.display = 'block';
    document.getElementById('modalImage').src = imageSrc;
}

function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}
</script>

                    </div>
                </div>
            </section>

        </main>
             
<?php
include "../footer2.php"
?>
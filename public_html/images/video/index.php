<?php

include "../header2.php";

track_pengunjung($con, $id, 'Video Pembelajaran');
  
$array_header = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM galeri WHERE judul='video'"));
$header = $array_header['gambar'];
?>

        <main>

            <section class="news-detail-header-section text-center" style="background-image: url('../<?= $header;?>');">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h1 class="text-white">Video Pembelajaran</h1>
                        </div>

                    </div>
                </div>
            </section>

            <section class="news-section section-padding">
                <div class="container">
                    <div class="row">

                    <?php
                    $query_video = mysqli_query($con, "SELECT * FROM video ORDER BY id DESC");
                    while($isi_video = mysqli_fetch_array($query_video)){
                    ?>
                    
                    <div class="col-lg-4 col-md-6 col-12 mb-4 mt-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                            <div class="custom-block-wrap">

<?php

echo "<video width='100%' height='240' controls>
<source src='../" . $isi_video["filename"] . "' type='video/mp4'>
Your browser does not support the video tag.
</video>";

?>

                                <div class="custom-block">
                                    <div class="custom-block-body">
                                        <h5 class="mb-3"><?= $isi_video['judul'];?></h5>

                                    </div>
                                </div>
                            </div>
                        </div> <!-- End item-->
                        <?php } ?>

                    </div>
                </div>
            </section>

        </main>
        
<?php
include "../footer2.php"
?>
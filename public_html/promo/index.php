<?php

include "../header2.php";

track_pengunjung($con, $id, 'Promo');
  
$array_header = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM galeri WHERE judul='promo'"));
$header = $array_header['gambar'];
?>

        <main>

            <section class="news-detail-header-section text-center" style="background-image: url('../<?= $header;?>');">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h1 class="text-white">Promo</h1>
                        </div>

                    </div>
                </div>
            </section>

            <section class="news-section section-padding">
                <div class="container">
                    <div class="row">

                    <?php
                    $query_promo = mysqli_query($con, "SELECT * FROM prestasi");
                    while($isi_promo = mysqli_fetch_array($query_promo)){
                        $isi_p = substr($isi_promo['isi'], 0, 50);
                        $isi_p2 = strip_tags($isi_p);
                    ?>
                    
                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                            <div class="custom-block-wrap">
                                <img src="../<?= $isi_promo['gambar'];?>" class="custom-block-image img-fluid" alt="">

                                <div class="custom-block">
                                    <div class="custom-block-body">
                                        <h5 class="mb-3"><?= $isi_promo['judul'];?></h5>

                                        <p><?= $isi_p2;?></p>

                                        <div class="progress mt-4" hidden >
                                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div>
                                        </div>

                                        <div class="d-flex align-items-center my-2">
                                            <p class="mb-0"></p>

                                            <p class="ms-auto mb-0"></p>
                                        </div>
                                    </div>

                                    <a href="../<?= $isi_promo['url'];?>" class="custom-btn btn">Read more</a>
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
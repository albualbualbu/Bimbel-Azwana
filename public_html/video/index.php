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

            <section class="news-section section-padding" style="background-color:rgba(000, 000, 000, 0.1);">
                <div class="container">
                    <div id="data-container" class="row mb-4"></div>
      
                    <div id="sentinel" class="" style=""></div>  
                </div>
            </section>

        </main>
        
<script>
let page = 1;
let isFetching = false; // Kunci agar tidak double request
const container = document.querySelector('#data-container');
const sentinel = document.querySelector('#sentinel');

const loadMoreData = async () => {
  if (isFetching) return; // Jika sedang loading, batalkan request baru
  isFetching = true;

  try {
    const response = await fetch(`get-data.php?page=${page}`);
    
    // Cek apakah response oke (status 200)
    if (!response.ok) throw new Error("Gagal mengambil data");

    const data = await response.json();
    
    if (data && data.length > 0) {
      data.forEach(item => {
        const col = document.createElement('div');
        col.className = 'col-lg-4 col-md-6 col-12 mb-4 mt-4 mb-lg-0';
        col.innerHTML = `
          <div class="custom-block-wrap">
            <video width='100%' height='240' controls>
                <source src='../${item.filename}' type='video/mp4'>
                Your browser does not support the video tag.
            </video>
            <div class="custom-block">
                <div class="custom-block-body">
                    <h5 class="mb-3">${item.judul}</h5>
                </div>
            </div>
        `;
        container.appendChild(col);
      });
      page++; 
    } else {
      // Jika data habis, matikan sentinel
      sentinel.innerHTML = "Semua Video telah ditampilkan.";
      sentinel.classList = "success-box";
      observer.unobserve(sentinel);
    }
  } catch (error) {
    console.error("Error:", error);
  } finally {
    isFetching = false; // Buka kembali kunci setelah selesai
  }
};

const observer = new IntersectionObserver((entries) => {
  // Jika elemen sentinel muncul di layar, ambil data baru
  if (entries[0].isIntersecting) {
    loadMoreData();
  }
});

observer.observe(sentinel);
</script>

<?php
include "../footer2.php"
?>
<?php

include "../header2.php";

track_pengunjung($con, $id, 'Program');
  

$array_header = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM galeri WHERE judul='kegiatan'"));
$header = $array_header['gambar'];
?>

        <main>
<style>
.bg{
    background-position:center;
    background-size:cover;
    height:200px;
    width: 100%;
}
</style>

            <section class="news-detail-header-section text-center" style="background-image: url('../<?= $header;?>');">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h1 class="text-white">Kegiatan</h1>
                        </div>

                    </div>
                </div>
            </section>

            <section class="news-section section-padding" style="background-color:rgba(000, 000, 000, 0.05);">
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
            col.className = 'col-lg-4 mt-4';
            col.innerHTML = `
                <div class="col-12 shadow bg-white" style="border-radius:20px;">
                    <div class="bg" style="background-image:url('../${item.gambar}'); border-radius:20px 20px 0 0;">

                    </div>
                    <div class="p-2">
                        <h4><a href="../${item.url}">${item.judul}</a></h4>
                        <p>${item.isi}</p>
                    </div>
                </div>
            `;
            container.appendChild(col);
        });
        page++; 
        } else {
        // Jika data habis, matikan sentinel
        sentinel.innerHTML = "Semua Kegiatan telah ditampilkan.";
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
<?php
session_start();
include "penghubung.php";
$id = session_id();

header('Content-Type: text/html; charset=UTF-8');
$url = $_GET['url'];

// Query untuk mencari data di tabel 'berita'
$urlPertama = mysqli_query($con, "SELECT * FROM berita WHERE `url`='$url'");

// Query untuk mencari data di tabel 'page'
$urlKedua = mysqli_query($con, "SELECT * FROM `page` WHERE `url`='$url'");

// Query untuk mencari data di tabel 'prestasi'
$urlKetiga = mysqli_query($con, "SELECT * FROM `prestasi` WHERE `url`='$url'");

if ($urlPertama && mysqli_num_rows($urlPertama) > 0) { 
    // Jika query berhasil dan ada data yang ditemukan
    $isi = mysqli_fetch_array($urlPertama);
    $tabel = "Kegiatan";
} elseif ($urlKedua && mysqli_num_rows($urlKedua) > 0) { 
    // Jika query kedua berhasil dan ada data yang ditemukan
    $isi = mysqli_fetch_array($urlKedua);
    $tabel = $isi['nama'];
} elseif ($urlKetiga && mysqli_num_rows($urlKetiga) > 0) { 
    // Jika query kedua berhasil dan ada data yang ditemukan
    $isi = mysqli_fetch_array($urlKetiga);
    $tabel = "Promo";
} else {
    // Jika kedua query tidak mengembalikan data
    $hasil = "Data tidak ditemukan.";
}

$idSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='1'"));
$idDua = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='2'"));

$metaJudul = $isi['judul'];
$metaGambar = $isi['gambar'];
$isi_deskripsi = strip_tags($isi['isi']);

include "header.php";

track_pengunjung($con, $id, $isi['judul']);
  
 
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action']; // Ambil aksi yang dipilih
  
    if ($action === 'whatsapp') {
        // Cek apakah user sudah pernah klik
        $existingClick = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM whatsapp WHERE `session` = '$id' AND id_artikel='$isi[id]' AND tabel='$tabel'"));
  
        if (!$existingClick) {
            // Jika user belum klik, tambahkan ke database
            mysqli_query($con, "INSERT INTO whatsapp VALUES ('$id','$isi[id]','1','$tabel')");
        }
    } elseif ($action === 'click') {
        // Cek apakah user sudah pernah klik
        $existingClick = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `copy` WHERE `session` = '$id' AND id_artikel='$isi[id]' AND tabel='$tabel'"));
  
        if (!$existingClick) {
            // Jika user belum klik, tambahkan ke database
            mysqli_query($con, "INSERT INTO `copy` VALUES ('$id','$isi[id]','1','$tabel')");
          }
    }
    exit;
  }

?>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

        <main>

            <section class="news-detail-header-section text-center" style="background-image: url('<?= $isi['header'];?>');">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h1 class="text-white"><?= $tabel;?></h1>
                        </div>

                    </div>
                </div>
            </section>
            
<?php
$numWhatsapp = mysqli_num_rows(mysqli_query($con,"SELECT * FROM whatsapp WHERE id_artikel='$isi[id]' AND tabel='$tabel'"));
$numCopy = mysqli_num_rows(mysqli_query($con,"SELECT * FROM `copy` WHERE id_artikel='$isi[id]' AND tabel='$tabel'"));
?>

            <section class="news-section section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-7 col-12">
                            <div class="news-block">
                                    <div class="news-block-title mb-2">
                                        <h4><?= $isi['judul'];?></h4>
                                    </div>

                                    <div class="d-flex">
                                        <p>Share :&nbsp;&nbsp;</p>
                                        <!-- Your share button code -->
                                        <div class="fb-share-button" 
                                        data-href="<?= $url_artikel;?><?= $url;?>" 
                                        data-layout="button_count">
                                        </div>
                                        <a href="https://api.whatsapp.com/send?text=<?= $url_artikel;?><?= $url;?>" target="_blank"><button id="whatsappButton" style="display:inline-block; margin:4px; background:green; padding-left:5px; padding-right:5px; padding-bottom:3px; border:none; font-size:12px; color:white; border-radius:3px;"><i class="bi bi-whatsapp"></i> Whatsapp <?= $numWhatsapp;?></button></a>
                                        <button onclick="copyText()" id="clickButton" style="border:1px solid grey; height:23px; border-radius:3px; margin-top:4px; font-size:12px; background:transparent;"><i class='fas fa-fw fa-copy'></i> Copy URL <?= $numCopy;?> </button>
                                        <div id="textToCopy" hidden ><?= $url_artikel;?><?= $url;?></div>
                                    </div>
                                </div>
                                <div class="news-block-top">
                                    <img src="<?= $isi['gambar'];?>" class="news-image img-fluid" alt="">

                                    <div class="news-category-block" hidden >
                                    </div>
                                </div>

                                <div class="news-block-info">
                                    <div class="d-flex mt-2" >
                                        <div class="news-block-date" hidden >
                                            <p>
                                                <i class="bi-calendar4 custom-icon me-1"></i>
                                                October 12, 2036
                                            </p>
                                        </div>

                                        <div class="news-block-author mx-5" hidden >
                                            <p>
                                                <i class="bi-person custom-icon me-1"></i>
                                                By Admin
                                            </p>
                                        </div>

                                        <div class="news-block-comment" hidden >
                                            <p>
                                                <i class="bi-chat-left custom-icon me-1"></i>
                                                48 Comments
                                            </p>
                                        </div>
                                    </div>

                                <div class="news-block-info">
                                    <div class="news-block-body">
                                        <?= $isi['isi'];?>
                                    </div>

    <script>
        window.onload = function() {
            // Ambil semua elemen <oembed> yang ada di dalam <figure> dengan class 'media'
            const oembeds = document.querySelectorAll('figure.media oembed');

            // Loop untuk setiap elemen <oembed>
            oembeds.forEach(function(oembed) {
                // Ambil URL dari atribut 'url' dalam tag <oembed>
                const videoUrl = oembed.getAttribute('url');

                // Cek jika URL ada
                if (videoUrl) {
                    // Ubah URL untuk digunakan dalam iframe (contoh: youtube embed URL)
                    const embedUrl = videoUrl.replace('watch?v=', 'embed/');

                    // Buat elemen <iframe>
                    const iframe = document.createElement('iframe');
                    iframe.setAttribute('width', '100%');
                    iframe.setAttribute('height', '315');
                    iframe.setAttribute('src', embedUrl);
                    iframe.setAttribute('frameborder', '0');
                    iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
                    iframe.setAttribute('allowfullscreen', true);

                    // Ganti <oembed> dengan <iframe>
                    oembed.replaceWith(iframe);
                }
            });
        };
    </script>

                                    <div class="social-share border-top mt-5 py-4 d-flex flex-wrap align-items-center">
                                        <div class="tags-block me-auto" hidden >
                                            <a href="#" class="tags-block-link">
                                                Donation
                                            </a>

                                            <a href="#" class="tags-block-link">
                                                Clothing
                                            </a>

                                            <a href="#" class="tags-block-link">
                                                Food
                                            </a>
                                        </div>

                                        <div class="d-flex">
                                            <a href="#" class="social-icon-link bi-facebook" hidden ></a>

                                            <a href="#" class="social-icon-link bi-twitter" hidden ></a>

                                            <a href="#" class="social-icon-link bi-printer" hidden ></a>

                                            <a href="#" class="social-icon-link bi-envelope" hidden ></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 mx-auto mt-4 mt-lg-0">

                        <h5 class="mb-3" data-aos="zoom-in" data-aos-delay="100"><a href="kegiatan/">Kegiatan Lainnya</a></h5>

                            <div class="shadow" style="height:500px; overflow:auto; border-radius:10px;" data-aos="fade-up" data-aos-delay="200">

<?php
$news = mysqli_query($con, "SELECT * FROM `berita` ORDER BY `id` DESC");
while($new = mysqli_fetch_array($news)){
    $isiNew = substr($new['isi'], 0, 100);
    $isiBerita = strip_tags($isiNew);
    echo "
    <div class='news-block news-block-two-col mt-4 p-3'>
        <div class='news-block-two-col-image-wrap'>
            <img src='$new[gambar]' class='news-image img-fluid' alt=''>
        </div>

        <div class='news-block-two-col-info'>
            <div class='news-block-title mb-2'>
                <h6><a href='$new[url]' class='news-block-title-link'>$new[judul]</a></h6>
            </div>

            <div class='news-block-date'>
                <p>$isiBerita</p>
            </div>
        </div>
        </div>    
        <div class='m-2' style='border:1px solid #e3e3e3;'></div>
    ";
}
?>

                            </div>

                        </div>

                    </div>
                </div>
            </section>

        </main>
    
<script>
  function copyText() {
      const text = document.getElementById("textToCopy").innerText;
      navigator.clipboard.writeText(text).then(() => {
          alert("Copied : " + text);
      }).catch(err => {
          console.error("Gagal menyalin: ", err);
      });


        // Kirim permintaan ke server untuk memperbarui database
        fetch('<?= $isi['url'];?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({ action: 'click' }) // Kirim aksi untuk tombol Klik Saya
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('message').innerText += '\n' + data; // Tampilkan pesan dari server
        })
        .catch(error => console.error('Error:', error));

  }
</script>

  <script>
    document.getElementById('whatsappButton').onclick = function() {
        fetch('<?= $isi['url'];?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({ action: 'whatsapp' }) // Kirim aksi untuk tombol WhatsApp
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('message').innerText = data; // Tampilkan pesan di div
        })
        .catch(error => console.error('Error:', error));
    };
    </script>

        <?php
include "footer.php";
?>
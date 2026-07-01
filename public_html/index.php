<?php
session_start();
include "penghubung.php";
$id = session_id();

$idSatu = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='1'"));
$metaJudul = $idSatu['judul'];
$metaGambar = $idSatu['isi'];
$idDua = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='2'"));
$isi_deskripsi = strip_tags($idDua['isi']);

include "header.php";

track_pengunjung($con, $id, 'Home');
  
?>

        <main>
<?php
$school_programs = mysqli_query($con, "SELECT * FROM program ORDER BY id ASC LIMIT 8");
$program_icons = [
    ['icon' => 'bi-book', 'color' => ''],
    ['icon' => 'bi-translate', 'color' => 'az-entry-icon--blue'],
    ['icon' => 'bi-house-heart', 'color' => 'az-entry-icon--green'],
    ['icon' => 'bi-person-badge', 'color' => ''],
    ['icon' => 'bi-mortarboard', 'color' => 'az-entry-icon--blue'],
    ['icon' => 'bi-tree', 'color' => 'az-entry-icon--green'],
    ['icon' => 'bi-clock', 'color' => ''],
    ['icon' => 'bi-car-front', 'color' => 'az-entry-icon--blue'],
];

function az_program_logo($program_name) {
    $name = strtolower($program_name);
    $program_logos = [
        'online' => 'kelas-online.png',
        'privat' => 'kelas-privat.png',
        'tka' => 'tka.png',
        'smp' => 'bimbel-smp.png',
        'sd' => 'bimbel-sd.png',
        'english' => 'english-for-kids.png',
        'calistung' => 'calistung.png',
        'islamic' => 'islamic-learning.png',
    ];

    foreach ($program_logos as $keyword => $filename) {
        if (strpos($name, $keyword) !== false) {
            return 'img/program-logo/' . $filename;
        }
    }

    return '';
}
?>
            <div class="az-entry-overlay" id="azEntryPath" aria-hidden="true">
                <div class="az-entry-panel" role="dialog" aria-modal="true" aria-labelledby="azEntryPathTitle">
                    <button class="az-entry-close" type="button" data-az-entry-close aria-label="Tutup">&times;</button>
                    <div class="az-entry-header">
                        <h2 class="az-entry-title" id="azEntryPathTitle">Pilih Jalur Belajar</h2>
                    </div>
                    <p class="az-entry-subtitle">Tentukan metode yang paling sesuai dengan kebutuhan buah hati Anda</p>

                    <div class="az-path-grid">
                        <button class="az-path-card" type="button" id="azChooseSchool">
                            <span class="az-path-logo"><img src="img/azwana-school.png" alt="Azwana School"></span>
                            <h3>School</h3>
                            <p>Pendampingan akademik intensif mengikuti kurikulum sekolah nasional. Fokus pada pemahaman konsep dan persiapan ujian.</p>
                        </button>

                        <a class="az-path-card" href="preschool/">
                            <span class="az-path-logo"><img src="img/azwana-preschool.png" alt="Azwana Preschool"></span>
                            <h3>Preschool</h3>
                            <p>Pendekatan kreatif berbasis minat bakat (self-directed learning). Membangun karakter, kemandirian, dan eksplorasi tanpa batas.</p>
                        </a>
                    </div>

                    <p class="az-entry-help">Bingung memilih? <a href="https://api.whatsapp.com/send?phone=<?= $whatsapp['isi'];?>&text=Halo%20Admin%20Azwana,%20saya%20ingin%20konsultasi%20program" target="_blank">Konsultasi Gratis Sekarang</a></p>
                </div>
            </div>

            <div class="az-entry-overlay" id="azSchoolPrograms" aria-hidden="true">
                <div class="az-entry-panel az-entry-panel--program" role="dialog" aria-modal="true" aria-labelledby="azSchoolProgramsTitle">
                    <button class="az-entry-close" type="button" data-az-entry-close aria-label="Tutup">&times;</button>
                    <div class="az-entry-header">
                        <h2 class="az-entry-title" id="azSchoolProgramsTitle">Pilih Program Belajar</h2>
                    </div>

                    <div class="az-program-grid">
                        <?php
                        $program_index = 0;
                        while ($school_program = mysqli_fetch_array($school_programs)) {
                            $icon_config = $program_icons[$program_index % count($program_icons)];
                            $program_logo = az_program_logo($school_program['nama']);
                            $program_index++;
                        ?>
                            <div class="az-program-card">
                                <?php if ($program_logo) { ?>
                                    <span class="az-program-logo"><img src="<?= $program_logo; ?>" alt="<?= htmlspecialchars($school_program['nama']); ?>"></span>
                                <?php } else { ?>
                                    <span class="az-entry-icon <?= $icon_config['color']; ?>"><i class="bi <?= $icon_config['icon']; ?>"></i></span>
                                <?php } ?>
                                <h3><?= $school_program['nama']; ?></h3>
                                <a class="az-program-button" href="daftar/<?= $school_program['url']; ?>">Pilih</a>
                            </div>
                        <?php } ?>
                    </div>

                    <p class="az-entry-help">Butuh konsultasi? <a href="https://api.whatsapp.com/send?phone=<?= $whatsapp['isi'];?>&text=Halo%20Admin%20Azwana,%20saya%20ingin%20konsultasi%20program" target="_blank">Hubungi Admin Kami</a></p>
                </div>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function () {
                var pathModal = document.getElementById('azEntryPath');
                var programModal = document.getElementById('azSchoolPrograms');
                var chooseSchool = document.getElementById('azChooseSchool');
                var closeButtons = document.querySelectorAll('[data-az-entry-close]');
                var hasSeenPopup = sessionStorage.getItem('azwana_entry_popup_seen') === '1';

                function openEntryModal(modal) {
                    if (!modal) return;
                    modal.classList.add('is-visible');
                    modal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                }

                function closeEntryModal(modal) {
                    if (!modal) return;
                    modal.classList.remove('is-visible');
                    modal.setAttribute('aria-hidden', 'true');
                    if (!document.querySelector('.az-entry-overlay.is-visible')) {
                        document.body.style.overflow = '';
                    }
                }

                if (!hasSeenPopup) {
                    openEntryModal(pathModal);
                    sessionStorage.setItem('azwana_entry_popup_seen', '1');
                }

                if (chooseSchool) {
                    chooseSchool.addEventListener('click', function () {
                        closeEntryModal(pathModal);
                        openEntryModal(programModal);
                    });
                }

                closeButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        closeEntryModal(button.closest('.az-entry-overlay'));
                    });
                });

                [pathModal, programModal].forEach(function (modal) {
                    if (!modal) return;
                    modal.addEventListener('click', function (event) {
                        if (event.target === modal) {
                            closeEntryModal(modal);
                        }
                    });
                });

                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        closeEntryModal(pathModal);
                        closeEntryModal(programModal);
                    }
                });
            });
            </script>
<?php

$berita = mysqli_query($con, "SELECT * FROM berita ORDER BY id DESC LIMIT 3");

// Menginisialisasi variabel
$berita1gambar = $berita2gambar = $berita3gambar = null;
$berita1judul = $berita2judul = $berita3judul = null;
$berita1 = $berita2 = $berita3 = null;

// Mengambil hasil
$count = 0;
while ($row = mysqli_fetch_assoc($berita)) {
    if ($count == 0) {
        $berita1gambar = $row['gambar'];
        $berita1judul = $row['judul'];
        $berita1 = $row['isi'];
        $berita1url = $row['url'];
        $isi_str1 = substr($berita1, 0, 150);
        $isi1 = strip_tags($isi_str1);
    } elseif ($count == 1) {
        $berita2gambar = $row['gambar'];
        $berita2judul = $row['judul'];
        $berita2 = $row['isi'];
        $berita2url = $row['url'];
        $isi_str2 = substr($berita2, 0, 150);
        $isi2 = strip_tags($isi_str2);
    } elseif ($count == 2) {
        $berita3gambar = $row['gambar'];
        $berita3judul = $row['judul'];
        $berita3 = $row['isi'];
        $berita3url = $row['url'];
        $isi_str3 = substr($berita3, 0, 150);
        $isi3 = strip_tags($isi_str3);
    } 
    $count++;
}
?>
            <section class="hero-section section-padding" id="section_1">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <span class="hero-label">Promo Pendaftaran</span>
                            <h1 class="hero-title">Membangun Masa Depan dengan Cinta.</h1>
                            <p class="hero-copy">Daftarkan segera buah hati Anda di Azwana School. Dapatkan promo pendaftaran gratis dan pengalaman belajar penuh kasih sayang.</p>
                            <div class="hero-buttons">
                                <a href="promo/" class="btn btn-primary">Ambil Promo</a>
                                <a href="program/" class="btn btn-secondary">Lihat Program</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-preview-card" data-aos="fade-left" data-aos-delay="100">
                                <div class="hero-preview-badge">Back To School</div>
                                <div class="hero-preview-image">
                                    <img src="<?= $berita1gambar;?>" alt="Back to School" />
                                </div>
                                <div class="hero-preview-meta">
                                    <h5><?= $berita1judul;?></h5>
                                    <p><?= $isi1;?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding section-hero-alt" id="section_2">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-12" data-aos="fade-right" data-aos-delay="100">
                            <span class="hero-label">Spesial Bulan Juli: Biaya Pendaftaran GRATIS!</span>
                            <h2 class="hero-alt-title">Membangun Masa Depan dengan Cinta.</h2>
                            <p class="hero-alt-copy">Azwana hadir untuk membantu anak belajar dengan suasana yang nyaman, terarah, dan penuh kasih sayang.</p>
                            <div class="hero-buttons">
                                <a href="promo/" class="btn btn-light btn-lg">Ambil Promo</a>
                                <a href="program/" class="btn btn-secondary btn-lg">Lihat Program</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12" data-aos="fade-left" data-aos-delay="150">
                            <div class="hero-alt-card">
                                <?php if (!empty($idDuaSatu['isi'])): ?>
                                    <img src="<?= $idDuaSatu['isi'];?>" alt="Azwana Feature" />
                                <?php else: ?>
                                    <div class="hero-alt-placeholder"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding section-shell">
                <div class="container">
                    <div class="row g-4">
                        <?php
                        $jumlah_items = [
                            ['value' => $idSembilan['tambahan'], 'label' => $idSembilan['judul']],
                            ['value' => $idSepuluh['tambahan'], 'label' => $idSepuluh['judul']],
                            ['value' => $idSebelas['tambahan'], 'label' => $idSebelas['judul']],
                            ['value' => $idDuabelas['tambahan'], 'label' => $idDuabelas['judul']],
                        ];
                        foreach ($jumlah_items as $index => $item) {
                        ?>
                            <div class="col-lg-3 col-md-6 col-12" data-aos="zoom-in" data-aos-delay="<?= 100 + ($index * 100); ?>">
                                <div class="stats-card counter-thumb">
                                    <span class="counter-number" data-from="1" data-to="<?= $item['value'];?>" data-speed="3000"><?= $item['value'];?></span>
                                    <span class="counter-number-text"><?= $item['label'];?></span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>

            <section class="section-padding section-shell" id="section_3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 text-center mb-4" data-aos="zoom-in" data-aos-delay="100">
                            <span class="section-eye">Promo</span>
                            <h2 class="section-heading">Program dan promo menarik untuk orang tua dan anak</h2>
                        </div>

                        <?php
                        $prestasi = mysqli_query($con, "SELECT * FROM prestasi ORDER BY id DESC LIMIT 3");
                        while ($row = mysqli_fetch_array($prestasi)) {
                            $deskripsi = substr($row['isi'], 0, 110);
                            $isi_des = strip_tags($deskripsi);
                        ?>
                            <div class="col-lg-4 col-md-6 col-12 mb-4" data-aos="fade-up" data-aos-delay="100">
                                <div class="promo-card">
                                    <img alt="bimbel azwana" src="<?= $row['gambar'];?>" class="img-fluid" alt="">
                                    <div class="promo-card-body">
                                        <h5><?= $row['judul'];?></h5>
                                        <p><?= $isi_des;?></p>
                                        <a href="<?= $row['url'];?>" class="text-link">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>

                        <div class="col mt-4" data-aos="zoom-in" data-aos-delay="50">
                            <div class="text-center">
                                <a href="promo/" class="btn btn-primary">Promo Lain</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding section-shell" id="section_4" style="background: linear-gradient(180deg, #f7fbfb 0%, #ffffff 100%);">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 text-center mb-4" data-aos="zoom-in" data-aos-delay="100">
                            <span class="section-eye">Program</span>
                            <h2 class="section-heading">Pilih program yang sesuai dengan kebutuhan belajar anak</h2>
                        </div>

                        <div class="row g-4">
                            <?php
                            $images = mysqli_query($con, "SELECT * FROM galeri WHERE judul='0' ORDER BY id DESC LIMIT 4");
                            $delay = 100;
                            while ($image = mysqli_fetch_array($images)) {
                                echo "
                                    <div class='col-lg-3 col-md-6 col-12' style='z-index:2;' data-aos='fade-up' data-aos-delay='$delay'>
                                        <div class='program-card' onclick='openModal(\"" . $image['gambar'] . "\")' style='cursor:pointer;'>
                                            <img alt='bimbel azwana' src='$image[gambar]' alt=''>
                                            <div class='program-content'>
                                                <h5>Program Unggulan</h5>
                                                <p>Temukan pilihan terbaik untuk belajar</p>
                                            </div>
                                        </div>
                                    </div>
                                ";
                                $delay += 100;
                            }
                            ?>
                        </div>

                        <div class="col mt-4" data-aos="zoom-in" data-aos-delay="50">
                            <div class="text-center">
                                <a href="program/" class="btn btn-primary">Program Lain</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <img alt="bimbel azwana" class="modal-content" id="modalImage">
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

            <section class="section-padding section-shell" id="section_5">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-lg-12 col-12 mb-3" data-aos="zoom-in" data-aos-delay="100">
                            <span class="section-eye">Kegiatan</span>
                            <h2 class="section-heading">Kegiatan terbaru yang sedang berlangsung</h2>
                        </div>

                        <div class="col-lg-7 col-12" data-aos="fade-up" data-aos-delay="100">
                            <div class="activity-card" style="padding:0; overflow:hidden; flex-direction:column; align-items:stretch;">
                                <img alt="bimbel azwana" src="<?= $berita1gambar;?>" class="img-fluid" style="width:100%; height:320px; border-radius:0;">
                                <div class="p-4">
                                    <h4><a href="<?= $berita1url;?>" class="news-block-title-link"><?= $berita1judul;?></a></h4>
                                    <p><?= $isi1;?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-12">
                            <div class="d-flex justify-content-between align-items-center mb-3" data-aos="zoom-in" data-aos-delay="100">
                                <h5 class="mb-0">Kegiatan Lainnya</h5>
                                <a href="kegiatan/" class="text-link">Lihat Semua</a>
                            </div>

                            <div data-aos="fade-up" data-aos-delay="200">
                                <div class="activity-card mb-3">
                                    <img alt="bimbel azwana" src="<?= $berita2gambar;?>" alt="">
                                    <div>
                                        <h6><a href="<?= $berita2url;?>" class="news-block-title-link"><?= $berita2judul;?></a></h6>
                                        <p><?= $isi2;?></p>
                                    </div>
                                </div>

                                <div class="activity-card">
                                    <img alt="bimbel azwana" src="<?= $berita3gambar;?>" alt="">
                                    <div>
                                        <h6><a href="<?= $berita3url;?>" class="news-block-title-link"><?= $berita3judul;?></a></h6>
                                        <p><?= $isi3;?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>
<?php
include "footer.php";
?>

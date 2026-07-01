from pathlib import Path

index_path = Path('index.php')
header_path = Path('header.php')

index_text = index_path.read_text(encoding='utf-8')
start = index_text.find('        <main>')
end = index_text.find('        </main>', start)
if start == -1 or end == -1:
    raise RuntimeError('Could not locate <main> block in index.php')
end += len('        </main>')

new_main = '''        <main>
<?php

$berita = mysqli_query($con, "SELECT * FROM berita ORDER BY id DESC LIMIT 3");

$berita1gambar = $berita2gambar = $berita3gambar = 'images/default-hero.jpg';
$berita1judul = $berita2judul = $berita3judul = 'Azwana School';
$berita1 = $berita2 = $berita3 = 'Temukan berita terbaru dan kegiatan kami di Azwana School.';
$berita1url = $berita2url = $berita3url = '#';
$isi1 = $isi2 = $isi3 = '';

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
                        <div class="col-lg-6" data-aos="fade-right">
                            <span class="hero-label">Promo Pendaftaran</span>
                            <h1 class="hero-title">Membangun Masa Depan dengan Cinta.</h1>
                            <p class="hero-copy">Daftarkan segera buah hati Anda di Azwana School. Dapatkan promo pendaftaran gratis dan pengalaman belajar penuh kasih sayang.</p>
                            <div class="hero-buttons">
                                <a href="promo/" class="btn btn-primary">Ambil Promo</a>
                                <a href="program/" class="btn btn-outline-secondary">Lihat Program</a>
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-left">
                            <div class="hero-preview-card">
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

            <section class="section-padding section-bg section-shell" id="section_2">
                <div class="container">
                    <div class="row align-items-center gy-5">
                        <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">
                            <span class="section-eye">Kenapa Kami</span>
                            <h2 class="section-heading">Belajar penuh kasih, percaya diri, dan hasil maksimal.</h2>
                            <p class="section-copy">Azwana School menawarkan suasana pembelajaran yang hangat, guru profesional, dan program terstruktur untuk mendukung perkembangan anak secara akademis dan emosional.</p>
                            <a href="program/" class="btn btn-primary mt-3">Lihat Program</a>
                        </div>
                        <div class="col-lg-7" data-aos="fade-up" data-aos-delay="150">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="feature-card">
                                        <div class="feature-icon"><i class="bi bi-lightbulb"></i></div>
                                        <h5>Metode Belajar Interaktif</h5>
                                        <p>Materi disampaikan dengan cara yang mudah dipahami dan menyenangkan bagi siswa.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-card">
                                        <div class="feature-icon"><i class="bi bi-people"></i></div>
                                        <h5>Guru Ramah & Terlatih</h5>
                                        <p>Tim pengajar kami berpengalaman dalam membimbing anak secara personal.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-card">
                                        <div class="feature-icon"><i class="bi bi-award"></i></div>
                                        <h5>Prestasi Nyata</h5>
                                        <p>Hasil belajar anak terus dipantau dan ditingkatkan secara berkala.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-card">
                                        <div class="feature-icon"><i class="bi bi-heart"></i></div>
                                        <h5>Lingkungan Peduli</h5>
                                        <p>Setiap siswa didukung dengan perhatian penuh dan suasana yang aman.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding section-shell">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-lg-10 col-12 text-center mx-auto" data-aos="fade-up">
                            <span class="section-eye">Angka Keberhasilan</span>
                            <h2 class="section-heading">Angka-angka yang menunjukkan komitmen kami terhadap kualitas pendidikan.</h2>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="stats-card">
                                <span class="stats-number"><?= $idSembilan['tambahan'];?></span>
                                <p><?= $idSembilan['judul'];?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="150">
                            <div class="stats-card">
                                <span class="stats-number"><?= $idSepuluh['tambahan'];?></span>
                                <p><?= $idSepuluh['judul'];?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="stats-card">
                                <span class="stats-number"><?= $idSebelas['tambahan'];?></span>
                                <p><?= $idSebelas['judul'];?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="250">
                            <div class="stats-card">
                                <span class="stats-number"><?= $idDuabelas['tambahan'];?></span>
                                <p><?= $idDuabelas['judul'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding section-bg section-shell" id="section_3">
                <div class="container">
                    <div class="row align-items-end mb-4">
                        <div class="col-lg-8" data-aos="fade-up">
                            <span class="section-eye">Promo</span>
                            <h2 class="section-heading">Program dan promo menarik untuk orang tua dan anak.</h2>
                        </div>
                        <div class="col-lg-4 text-lg-end text-start" data-aos="fade-up" data-aos-delay="100">
                            <a href="promo/" class="btn btn-primary">Lihat Semua Promo</a>
                        </div>
                    </div>
                    <div class="row g-4">
                        <?php
                        $prestasi = mysqli_query($con, "SELECT * FROM prestasi ORDER BY id DESC LIMIT 3");
                        while ($row = mysqli_fetch_array($prestasi)) {
                            $deskripsi = substr($row['isi'], 0, 110);
                            $isi_des = strip_tags($deskripsi);
                        ?>
                            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                                <div class="promo-card">
                                    <img src="<?= $row['gambar'];?>" alt="<?= $row['judul'];?>">
                                    <div class="promo-card-body">
                                        <h5><?= $row['judul'];?></h5>
                                        <p><?= $isi_des;?></p>
                                        <a href="<?= $row['url'];?>" class="text-link">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>

            <section class="section-padding section-shell" id="section_4">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-lg-12 text-center" data-aos="fade-up">
                            <span class="section-eye">Program</span>
                            <h2 class="section-heading">Program unggulan untuk semua jenjang usia.</h2>
                        </div>
                    </div>
                    <div class="row g-4">
                        <?php
                        $images = mysqli_query($con, "SELECT * FROM galeri WHERE judul='0' ORDER BY id DESC LIMIT 4");
                        $delay = 100;
                        while ($image = mysqli_fetch_array($images)) {
                            echo "\n                            <div class='col-lg-3 col-md-6 col-12' data-aos='fade-up' data-aos-delay='$delay'>\n                                <div class='program-card'>\n                                    <img src='" . $image['gambar'] . "' alt='Program Unggulan'>\n                                    <div class='program-content'>\n                                        <h5>Program Unggulan</h5>\n                                        <p>Temukan pilihan terbaik untuk belajar.</p>\n                                        <a href='program/' class='text-link'>Selengkapnya</a>\n                                    </div>\n                                </div>\n                            </div>\n                            ";
                            $delay += 100;
                        }
                        ?>
                    </div>
                </div>
            </section>

            <section class="section-padding section-bg section-shell" id="section_5">
                <div class="container">
                    <div class="row align-items-start mb-4">
                        <div class="col-lg-8" data-aos="fade-up">
                            <span class="section-eye">Kegiatan</span>
                            <h2 class="section-heading">Kegiatan terbaru yang sedang berlangsung.</h2>
                        </div>
                        <div class="col-lg-4 text-lg-end text-start mt-3 mt-lg-0" data-aos="fade-up" data-aos-delay="75">
                            <a href="kegiatan/" class="btn btn-outline-secondary">Lihat Semua Kegiatan</a>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-7" data-aos="fade-up">
                            <div class="kegiatan-main-card">
                                <img src="<?= $berita1gambar;?>" alt="<?= $berita1judul;?>">
                                <div class="kegiatan-main-body">
                                    <h3><a href="<?= $berita1url;?>"><?= $berita1judul;?></a></h3>
                                    <p><?= $isi1;?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="row g-4">
                                <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                                    <div class="kegiatan-small-card">
                                        <img src="<?= $berita2gambar;?>" alt="<?= $berita2judul;?>">
                                        <div class="kegiatan-small-body">
                                            <h6><a href="<?= $berita2url;?>"><?= $berita2judul;?></a></h6>
                                            <p><?= $isi2;?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" data-aos="fade-up" data-aos-delay="150">
                                    <div class="kegiatan-small-card">
                                        <img src="<?= $berita3gambar;?>" alt="<?= $berita3judul;?>">
                                        <div class="kegiatan-small-body">
                                            <h6><a href="<?= $berita3url;?>"><?= $berita3judul;?></a></h6>
                                            <p><?= $isi3;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding section-shell" id="section_6">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-lg-12 text-center" data-aos="fade-up">
                            <span class="section-eye">Testimoni</span>
                            <h2 class="section-heading">Pengalaman positif keluarga Azwana School.</h2>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-4" data-aos="fade-up">
                            <div class="testimonial-card">
                                <p>“Anak saya jadi lebih percaya diri dan senang sekolah. Guru-gurunya ramah dan sabar sekali.”</p>
                                <strong>- Ibu Siti, Orang Tua Siswa SD</strong>
                            </div>
                        </div>
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="testimonial-card">
                                <p>“Proses belajarnya terstruktur dan mudah dipahami. Kegiatan tambah seru dengan pendekatan penuh kasih.”</p>
                                <strong>- Bp. Ahmad, Orang Tua Siswa TKA</strong>
                            </div>
                        </div>
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                            <div class="testimonial-card">
                                <p>“Hasilnya terasa setelah beberapa minggu, anak saya lebih fokus dan berkembang secara emosional.”</p>
                                <strong>- Ibu Maya, Orang Tua Siswa SMP</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding section-cta-alt">
                <div class="container">
                    <div class="cta-alt" data-aos="zoom-in">
                        <h2>Mari Bergabung Bersama Keluarga Besar Azwana</h2>
                        <p>Dapatkan informasi lengkap mengenai program, biaya, dan jadwal belajar yang paling sesuai untuk buah hati Anda.</p>
                        <a href="https://api.whatsapp.com/send?phone=<?= $whatsapp['isi'];?>&text=Halo%20Saya%20mau%20Daftar%20Bimbel%20di%20AZWANA" class="btn btn-primary">Chat dengan Customer Service</a>
                    </div>
                </div>
            </section>

            <section class="section-padding section-shell" id="section_7">
                <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6" data-aos="fade-up">
                            <span class="section-eye">Formulir Minat Cepat</span>
                            <h2 class="section-heading">Siap Bergabung Bersama Keluarga Azwana?</h2>
                            <p class="section-copy">Isi data singkat untuk tim kami menghubungi Anda dan membantu menentukan program yang paling sesuai.</p>
                            <ul class="form-benefits">
                                <li>Kurikulum Berbasis Nasional</li>
                                <li>Guru Profesional & Ramah Anak</li>
                                <li>Fasilitas Belajar Nyaman</li>
                            </ul>
                        </div>
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="form-box">
                                <form action="#" method="post" onsubmit="event.preventDefault(); alert('Terima kasih! Tim Azwana akan menghubungi Anda segera.');">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama lengkap Anda" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Usia Anak</label>
                                        <input type="text" name="usia" class="form-control" placeholder="Usia anak" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor WhatsApp</label>
                                        <input type="text" name="whatsapp" class="form-control" placeholder="Nomor WhatsApp aktif" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Pesan</label>
                                        <textarea name="pesan" class="form-control" rows="4" placeholder="Tulis pesan singkat..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim Permintaan Informasi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>
'''

index_path.write_text(index_text[:start] + new_main + index_text[end:], encoding='utf-8')
print('index.php updated')

header_text = header_path.read_text(encoding='utf-8')
header_text = header_text.replace(
    '<a class="nav-link click-scroll dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Selengkapnya</a>',
    '<a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Selengkapnya</a>'
)
header_text = header_text.replace(
    "<li><a class='dropdown-item' href='video/' class='footer-menu-link'>Video Pembelajaran</a></li>",
    "<li><a class='dropdown-item footer-menu-link' href='video/'>Video Pembelajaran</a></li>"
)
header_text = header_text.replace(
    "<li><a class='dropdown-item' href='./detail.php?url=$selengkap[url]' class='footer-menu-link'>$selengkap[nama]</a></li>",
    "<li><a class='dropdown-item footer-menu-link' href='./detail.php?url=$selengkap[url]'>$selengkap[nama]</a></li>"
)

if '.hero-label {' not in header_text:
    insert_after = '  .hero-card li + li {
    margin-top: 0.45rem;
  }
'
    css_block = '''

  .hero-label {
    display: inline-block;
    margin-bottom: 1rem;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    color: var(--primary-color);
    text-transform: uppercase;
  }

  .hero-title {
    font-size: clamp(2.5rem, 4vw, 3.4rem);
    line-height: 1.05;
    margin-bottom: 1rem;
  }

  .hero-copy {
    color: var(--muted-color);
    font-size: 1.05rem;
    line-height: 1.8;
    max-width: 580px;
    margin-bottom: 1.75rem;
  }

  .hero-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
  }

  .hero-preview-card {
    background: #fff;
    border: 1px solid rgba(255, 93, 162, 0.18);
    box-shadow: 0 20px 50px rgba(255, 93, 162, 0.12);
    border-radius: 32px;
    padding: 1.5rem;
  }

  .hero-preview-badge {
    display: inline-flex;
    padding: 0.5rem 0.9rem;
    border-radius: 999px;
    background: rgba(255, 93, 162, 0.08);
    color: var(--primary-color);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 0.9rem;
  }

  .hero-preview-image {
    border-radius: 24px;
    overflow: hidden;
    margin-bottom: 1rem;
  }

  .hero-preview-image img {
    width: 100%;
    display: block;
    object-fit: cover;
    min-height: 300px;
  }

  .hero-preview-meta h5 {
    font-size: 1.05rem;
    margin-bottom: 0.5rem;
  }

  .hero-preview-meta p {
    color: var(--muted-color);
    line-height: 1.8;
    margin: 0;
  }

  .testimonial-card,
  .kegiatan-main-card,
  .kegiatan-small-card,
  .form-box,
  .cta-alt {
    background: #fff;
    border: 1px solid var(--border-color);
    border-radius: 24px;
  }

  .testimonial-card {
    padding: 2rem;
    min-height: 220px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .testimonial-card p {
    font-size: 1rem;
    line-height: 1.8;
    color: var(--muted-color);
    margin-bottom: 1.25rem;
  }

  .testimonial-card strong {
    color: var(--text-color);
    font-size: 0.95rem;
  }

  .kegiatan-main-card {
    overflow: hidden;
    border-radius: 24px;
  }

  .kegiatan-main-card img {
    width: 100%;
    height: auto;
    display: block;
  }

  .kegiatan-main-body {
    padding: 1.5rem;
  }

  .kegiatan-main-body h3 {
    margin-bottom: 0.75rem;
  }

  .kegiatan-small-card {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    align-items: flex-start;
  }

  .kegiatan-small-card img {
    width: 120px;
    height: 100px;
    object-fit: cover;
    border-radius: 18px;
  }

  .kegiatan-small-body h6 {
    margin-bottom: 0.5rem;
    font-size: 1rem;
  }

  .kegiatan-small-body p {
    color: var(--muted-color);
    font-size: 0.95rem;
    margin: 0;
  }

  .section-cta-alt {
    background: #fff7fb;
  }

  .cta-alt {
    padding: 2.2rem;
    border-radius: 28px;
    background: linear-gradient(180deg, rgba(255, 93, 162, 0.12), rgba(255, 93, 162, 0.03));
    border: 1px solid rgba(255, 93, 162, 0.12);
    text-align: center;
  }

  .cta-alt h2 {
    font-size: 2rem;
    margin-bottom: 0.8rem;
  }

  .cta-alt p {
    color: var(--muted-color);
    margin-bottom: 1.25rem;
  }

  .form-box {
    padding: 2rem;
  }

  .form-benefits {
    list-style: none;
    padding-left: 0;
    margin-top: 1.3rem;
  }

  .form-benefits li {
    position: relative;
    padding-left: 1.6rem;
    margin-bottom: 0.85rem;
    color: var(--muted-color);
  }

  .form-benefits li::before {
    content: '\2022';
    position: absolute;
    left: 0;
    top: 0;
    color: var(--primary-color);
    font-size: 1.15rem;
    line-height: 1;
  }

  .text-link {
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
  }

  .text-link:hover {
    color: var(--primary-dark);
  }

  .btn-outline-secondary {
    color: var(--text-color);
    border: 1px solid rgba(58, 43, 53, 0.12);
    background: #fff;
  }

  .btn-outline-secondary:hover {
    background: rgba(255, 93, 162, 0.08);
    color: var(--primary-color);
  }

  .cta-alt a.btn {
    margin-top: 0.5rem;
  }

  .program-card .program-content {
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    right: 1rem;
    z-index: 1;
    color: #fff;
  }

  .program-card h5 {
    font-size: 1.1rem;
    margin-bottom: 0.45rem;
  }

  .program-card p {
    font-size: 0.95rem;
    margin-bottom: 0.75rem;
  }

  .program-card a.text-link {
    color: #fff;
  }

  .program-card a.text-link:hover {
    color: rgba(255,255,255,0.9);
  }

  .program-card::after {
    background: linear-gradient(180deg, transparent 10%, rgba(0,0,0,0.55) 100%);
  }

  .hero-buttons .btn {
    min-width: 170px;
  }

  @media (max-width: 768px) {
    .hero-preview-card {
      padding: 1.25rem;
    }

    .hero-preview-image img {
      min-height: 220px;
    }

    .hero-buttons {
      flex-direction: column;
      align-items: stretch;
    }
  }
'''
    header_text = header_text.replace(insert_after, insert_after + css_block)

header_path.write_text(header_text, encoding='utf-8')
print('header.php updated')

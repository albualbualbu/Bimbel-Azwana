<style>
    .az-footer {
        background: #eef8fb;
        border-top: 1px solid rgba(207, 0, 84, 0.12);
        color: #6e535d;
        font-family: 'Inter', sans-serif;
    }

    .az-footer-main {
        padding: 4.3rem 0 3.7rem;
    }

    .az-footer-title {
        color: #1f2528;
        font-size: clamp(1.65rem, 2.4vw, 2.35rem);
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 2rem;
    }

    .az-footer-brand {
        color: #cf0054;
    }

    .az-footer-copy {
        max-width: 560px;
        color: #6d515c;
        font-size: 1.08rem;
        font-weight: 600;
        line-height: 1.65;
        margin-bottom: 2rem;
    }

    .az-footer-social {
        display: flex;
        flex-wrap: wrap;
        gap: 1.15rem;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .az-footer-social a {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: #fff;
        color: #cf0054;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.45rem;
        box-shadow: 0 8px 18px rgba(48, 34, 41, 0.08);
        transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
    }

    .az-footer-social a:hover {
        color: #fff;
        background: #cf0054;
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(207, 0, 84, 0.2);
    }

    .az-footer-links {
        display: grid;
        gap: 1.45rem;
    }

    .az-footer-links a {
        color: #6d515c;
        font-size: 1.08rem;
        font-weight: 700;
    }

    .az-footer-links a:hover {
        color: #cf0054;
    }

    .az-footer-map {
        position: relative;
        min-height: 220px;
        border-radius: 24px;
        overflow: hidden;
        background: #d7f4e4;
        box-shadow: 0 0 0 16px rgba(255, 255, 255, 0.45);
    }

    .az-footer-map iframe {
        width: 100%;
        height: 220px;
        display: block;
        border: 0;
        filter: saturate(0.95) contrast(0.95);
    }

    .az-footer-map-label {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: min(78%, 420px);
        padding: 0.9rem 1.4rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.94);
        color: #cf0054;
        text-align: center;
        font-size: 1rem;
        font-weight: 900;
        box-shadow: 0 12px 28px rgba(61, 40, 48, 0.18);
    }

    .az-footer-bottom {
        border-top: 1px solid rgba(207, 0, 84, 0.12);
        padding: 2rem 0;
        text-align: center;
    }

    .az-footer-bottom p {
        color: #6d515c;
        font-size: 1.05rem;
        font-weight: 700;
        margin: 0;
    }

    @media (max-width: 991px) {
        .az-footer-main {
            padding: 3rem 0;
        }

        .az-footer-title {
            margin-bottom: 1.2rem;
        }

        .az-footer-map {
            margin-top: 1rem;
        }
    }

    @media (max-width: 576px) {
        .az-footer-social a {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }

        .az-footer-map-label {
            font-size: 0.82rem;
            padding: 0.75rem 1rem;
        }
    }
</style>

<footer class="az-footer">
    <div class="az-footer-main">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6 col-12">
                    <h2 class="az-footer-title az-footer-brand">Bimbel Azwana</h2>
                    <p class="az-footer-copy">Menumbuhkan potensi melalui kasih sayang dan pengalaman belajar yang personal. Membangun masa depan gemilang bersama anak bangsa.</p>

                    <ul class="az-footer-social">
                        <li><a href="../" aria-label="Website"><i class="bi bi-globe"></i></a></li>
                        <li><a href="mailto:<?= $email['isi'];?>" aria-label="Email"><i class="bi bi-at"></i></a></li>
                        <li><a href="tel:<?= preg_replace('/[^+\d]/', '', $telephone['isi']);?>" aria-label="Telepon"><i class="bi bi-telephone"></i></a></li>
                        <li><a href="<?= $facebook['isi'];?>" aria-label="Facebook"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="<?= $instagram['isi'];?>" aria-label="Instagram"><i class="bi bi-instagram"></i></a></li>
                        <li><a href="<?= $youtube['isi'];?>" aria-label="YouTube"><i class="bi bi-youtube"></i></a></li>
                        <li><a href="<?= $tiktok['isi'];?>" aria-label="TikTok"><i class="bi bi-tiktok"></i></a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <h2 class="az-footer-title">Tautan Cepat</h2>
                    <nav class="az-footer-links" aria-label="Tautan cepat footer">
                        <a href="https://api.whatsapp.com/send?phone=<?= $whatsapp['isi'];?>&text=<?= $pesan_whatsapp['isi'];?>">Hubungi Kami</a>
                        <a href="../detail.php?url=kebijakan-privasi">Kebijakan Privasi</a>
                        <a href="../detail.php?url=syarat-ketentuan">Syarat &amp; Ketentuan</a>
                        <a href="../detail.php?url=jam-operasional">Jam Operasional</a>
                    </nav>
                </div>

                <div class="col-lg-5 col-12">
                    <h2 class="az-footer-title">Lokasi Kami</h2>
                    <div class="az-footer-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31777.059715494794!2d105.22301430323405!3d-5.396779427454895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40db44796264cf%3A0x87c870ab0dd6ddf!2sBimbel%20Azwana!5e0!3m2!1sid!2sjp!4v1733455898129!5m2!1sid!2sjp" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div class="az-footer-map-label">Segala Mider, Bandar Lampung</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="az-footer-bottom">
        <div class="container">
            <p>&copy; 2024 Bimbel Azwana. Learning by Loving.</p>
        </div>
    </div>
</footer>

<div class="modal fade" id="daftarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Program</h5>
            </div>
            <div class="modal-body">
                <?php
                $program_q = mysqli_query($con, "SELECT * FROM program");
                while($program = mysqli_fetch_array($program_q)){
                ?>
                <a class="btn btn-primary d-grid mb-2" href="../daftar/<?= $program['url'];?>"><?= $program['nama'];?></a>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 1000,
                offset: 200,
            });
        </script>
        

        <!-- JAVASCRIPT FILES -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.sticky.js"></script>
        <script src="../js/click-scroll.js"></script>
        <script src="../js/counter.js"></script>
        <script src="../js/custom.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>
</html>

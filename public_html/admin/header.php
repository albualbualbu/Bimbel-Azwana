
<?php
session_start();
include "../penghubung.php";
if(isset($_GET['x']) && $_GET['x'] == "x"){
    echo'
    <script>
        alert("Maaf, Halaman Belum Siap untuk diakses !");
    </script>
    ';
}
$nama = mysqli_query($con,"SELECT * FROM semua WHERE id='1'");
$namaPerusahaan = mysqli_fetch_array($nama);

if(!isset($_SESSION["admin"])){

    echo '<script>window.location.href="./";</script>';
   
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - <?= $namaPerusahaan['judul']; ?></title>
    <link rel="shortcut icon" href="../<?= $namaPerusahaan['isi']; ?>" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>

    <!-- Custom styles for this template-->
    <link href="../main-assets/css/sb-admin-3.min.css" rel="stylesheet">
    <link href="../assets/css/main2.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
    <script>
    window.OneSignalDeferred = window.OneSignalDeferred || [];
    OneSignalDeferred.push(async function(OneSignal) {
        await OneSignal.init({
        appId: "c6700fc7-5b79-406d-b1fb-e9248cc643a3",
        safari_web_id: "web.onesignal.auto.5f0d689b-f65a-4365-8770-a9853d53b981",
        notifyButton: {
            enable: true,
        },
        });
    });
    </script>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
                <div>
                    <img src="../<?= $namaPerusahaan['isi']; ?>" alt="logo" width=50>
                </div>
                <div class="sidebar-brand-text mx-3"><?= $namaPerusahaan['judul']; ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
<?php
$num_inbox = mysqli_num_rows(mysqli_query($con, "SELECT * FROM inbox WHERE `level`='0'"));
if($num_inbox > 0){
    $notif = "";
}else{
    $notif = " hidden ";
}
?>

            <li class="nav-item">
                <a class="nav-link" href="inbox.php">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Kotak Masuk <i id='blink'<?= $notif;?> class='fas fa-fw fa-circle'></i></span>
                </a>
            </li>
            <script type="text/javascript">
                var blink = document.getElementById('blink');
                setInterval(function() {
                blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
                }, 500);
            </script>
            
            <li class="nav-item">
                <a class="nav-link" href="user.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>User Siswa</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="semua_soal.php">
                    <i class="fas fa-fw fa-th-list"></i>
                    <span>Semua Soal</span>
                </a>
            </li>
            
            <li class="nav-item" >
                <a class="nav-link" href="rekap_nilai.php">
                    <i class="fas fa-fw fa-globe-americas"></i>
                    <span>Rekap Nilai</span>
                </a>
            </li>
            
            <li class="nav-item" >
                <a class="nav-link" href="cabang.php">
                    <i class="fas fa-fw fa-globe-americas"></i>
                    <span>Cabang</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Halaman
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="video.php">
                    <i class="fas fa-fw fa-th-list"></i>
                    <span>Video Pembelajaran</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tabel.php?nav=kegiatan&tabel=berita">
                    <i class="fas fa-fw fa-th-list"></i>
                    <span>Kegiatan</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="program.php">
                    <i class="fas fa-fw fa-th-list"></i>
                    <span>Program</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tabel.php?nav=promo&tabel=prestasi">
                    <i class="fas fa-fw fa-th-list"></i>
                    <span>Promo</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tabel.php?nav=selengkapnya&tabel=page">
                    <i class="fas fa-fw fa-th-list"></i>
                    <span>Selengkapnya</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="galeri.php">
                    <i class="fas fa-fw fa-th-large"></i>
                    <span>Penyimpanan Gambar</span>
                </a>
            </li>
                        
            <li class="nav-item" >
                <a class="nav-link" href="jumlah.php">
                    <i class="fas fa-fw fa-globe-americas"></i>
                    <span>Jumlah</span>
                </a>
            </li>
            
            <li class="nav-item" >
                <a class="nav-link" href="kontak.php">
                    <i class="fas fa-fw fa-globe-americas"></i>
                    <span>Kontak</span>
                </a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small span" style="text-transform:capitalize;"><?php echo $_SESSION["admin"];?></span>
                                <img class="img-profile rounded-circle" src="../main-assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="akun.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray"></i>
                                    Akun
                                </a>
                                <a class="dropdown-item" href="lainnya.php">
                                    <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray"></i>
                                    Lainnya
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->
                
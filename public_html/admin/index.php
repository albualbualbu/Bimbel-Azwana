<?php
session_start();
include "../penghubung.php";
$nama = mysqli_query($con,"SELECT * FROM semua WHERE id='1'");
$namaPerusahaan = mysqli_fetch_array($nama);
$idDelapan = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM semua WHERE id='8'"));

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login - <?= $namaPerusahaan['judul']; ?></title>
  <link rel="shortcut icon" href="../<?= $namaPerusahaan['isi']; ?>" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../login-assets/css/login.css">
</head>

<body>

<?php
if(isset($_SESSION['admin'])){
    header("location:admin.php");
}
?>

  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <p><img src="../<?= $namaPerusahaan['isi']; ?>" alt="logo" class="logo"> <a style="text-decoration:underline;text-underline-offset: 5px;" href="../"><?= $namaPerusahaan['judul']; ?></a></p>
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Login <b style="color:red;">Admin</b></h1>
            <form method="post" action="login.php">
              <div class="form-group">
                <label for="username">Username</label>
                <input required type="text" name="username" id="username" class="form-control" placeholder="Enter Your Username">
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input required type="password" name="password" id="password" class="form-control" placeholder="Enter Your Passsword">
              </div>
              <button type="submit" class="btn btn-block login-btn">Login</button>
            </form>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="../<?= $idDelapan['isi'];?>" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
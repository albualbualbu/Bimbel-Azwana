<?php
// Mulai session
session_start();

include "../penghubung.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['video'])) {

    $judul = $con->real_escape_string($_POST['judul']);
    // Buat slug URL dari judul
    $url = strtolower($judul);
    $url = preg_replace('/[^a-z0-9\-]+/', '_', $url);
    $url = preg_replace('/_+/', '_', $url); // hilangkan underscore ganda
    $url = trim($url, '_'); // hilangkan underscore di awal/akhir

    $videoName = $_FILES['video']['name'];
    $videoTmpName = $_FILES['video']['tmp_name'];
    $temp = explode(".", $videoName);
    $round = $url."_".round(microtime(true)) . '.' . end($temp);
    $videoSize = $_FILES['video']['size'];
    $videoError = $_FILES['video']['error'];

    // Menangani error file upload
    if ($videoError !== UPLOAD_ERR_OK) {
        $errorMessages = [
            UPLOAD_ERR_INI_SIZE => "File terlalu besar (melebihi batas upload_max_filesize di php.ini)",
            UPLOAD_ERR_FORM_SIZE => "File terlalu besar (melebihi batas yang ditentukan di form HTML)",
            UPLOAD_ERR_PARTIAL => "File hanya ter-upload sebagian.",
            UPLOAD_ERR_NO_FILE => "Tidak ada file yang di-upload.",
            UPLOAD_ERR_NO_TMP_DIR => "Tidak ada folder sementara.",
            UPLOAD_ERR_CANT_WRITE => "Gagal menulis file ke disk.",
            UPLOAD_ERR_EXTENSION => "Upload file dibatalkan oleh ekstensi PHP."
        ];

        $_SESSION['error'] = "Error saat upload video: " . (isset($errorMessages[$videoError]) ? $errorMessages[$videoError] : "Terjadi kesalahan yang tidak diketahui.");
        exit;
    }

    // Cek ukuran file sebelum upload
    if ($videoSize > 41943040) { // 40MB dalam bytes
        $_SESSION['error'] = "Ukuran file video melebihi batas 40MB.";
        exit;
    }

    if (move_uploaded_file($videoTmpName, "../uploads/" . $round)) {
        // Sanitasi input 'judul' untuk mencegah SQL Injection

        // Menyimpan informasi video ke database
        $sql = "INSERT INTO video VALUES ('','$judul', 'uploads/$round')";
        if ($con->query($sql)) {
            $_SESSION['error'] = "Video berhasil diupload.";
        } else {
            $_SESSION['error'] = "Gagal menyimpan data ke database.";
        }
    } else {
        $_SESSION['error'] = "Gagal mengupload video.";
    }
} else {
    $_SESSION['error'] = "Tidak ada file yang diupload.";
}

$con->close();

// Redirect ke halaman index
echo '
<script>
alert("' . $_SESSION['error'] . '");
window.location.href="tambah_video.php";
</script>
';

exit;
?>

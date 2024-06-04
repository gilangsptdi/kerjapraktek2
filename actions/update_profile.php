<?php
require_once('../include/config.php');
require_once('../actions/MySQLSessionHandler.php');

session_set_save_handler(new MySQLSessionHandler($conn), true);
session_start();

if (!isset($_SESSION['kode_user'])) {
    header('Location: ../?status=loginGagal');
    exit;
}

$kodeProfil = $_SESSION['kode_user'];
$nama = $_POST['nama'];
$username = $_POST['username'];

// Handle file upload
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto = file_get_contents($_FILES['foto']['tmp_name']);
    $foto = mysqli_real_escape_string($conn, $foto);
    $sql = "UPDATE user SET namauser='$nama', username='$username', foto='$foto' WHERE kode_user='$kodeProfil'";
} else {
    $sql = "UPDATE user SET namauser='$nama', username='$username',' WHERE kode_user='$kodeProfil'";
}

if (mysqli_query($conn, $sql)) {
    header('Location: ../profile/?status=updateSuccess');
} else {
    error_log("Error updating profile: " . mysqli_error($conn));
    header('Location: ../profile/?status=updateFailed');
}
?>

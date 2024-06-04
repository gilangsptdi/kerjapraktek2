<?php
include ('../include/config.php');
include('../actions/MySQLSessionHandler.php');

session_set_save_handler(new MySQLSessionHandler($conn), true);
session_start();

if (!isset($_SESSION['kode_user'])) {
    header('Location: ../?status=loginGagal');
    exit;
}

if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];
    $sql = "SELECT * FROM data_pasien WHERE no_registrasi = '$kode'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);
}
?>
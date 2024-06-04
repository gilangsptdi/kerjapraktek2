<?php
include('../include/config.php');
if (isset($_POST['simpan'])) {
    $noreg = $_POST['noreg'];
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];
    $jeniskelamin = $_POST['jeniskelamin'];

    $sql = "INSERT INTO data_pasien(no_registrasi, nama, umur, alamat, jenis_kelamin, tanggal_pemeriksaan) VALUE('$noreg', '$nama', '$umur', '$alamat', '$jeniskelamin', '$tanggal')";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../addpasien/?status=sukses');
    } else {
        header('Location: ../addpasien/?status=gagal');
    }
} else {
    die('akses dilarang');
}

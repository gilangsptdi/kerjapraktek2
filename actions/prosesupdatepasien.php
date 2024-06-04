<?php
include ('../include/config.php');

if (isset($_POST['update'])) {
    $noreg = $_POST['noreg'];
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $alamat = $_POST['alamat'];

    $sql = "UPDATE data_pasien SET 
            tanggal_pemeriksaan = '$tanggal', 
            nama = '$nama', 
            umur = '$umur', 
            jenis_kelamin = '$jeniskelamin', 
            alamat = '$alamat' 
            WHERE no_registrasi = '$noreg'";

    if (mysqli_query($conn, $sql)) {
        header('Location: ../?status=updateBerhasil');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

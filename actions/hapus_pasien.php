<?php
include("../include/config.php");

if(isset($_GET['kode'])){
    $kode = $_GET['kode'];

    $sql = 'DELETE FROM data_pasien WHERE no_registrasi="'.$kode.'"';
    $query = mysqli_query($conn, $sql);

    if($query){
        header('Location: ../datapasien/?status=hapussukses');
    } else {
        header('Location: ../datapasien/?status=hapusgagal');
    }
}else{
    die("Akses Dilarang");
}
?>
<?php
include("../include/config.php");

if(isset($_GET['kode'])){
    $kode = $_GET['kode'];

    $sql = 'DELETE FROM laporan_lab WHERE kode_laporan="'.$kode.'"';
    $query = mysqli_query($conn, $sql);

    if($query){
        header('Location: ../datalaporan/?status=hapussukses');
    } else {
        header('Location: ../datalaporan/?status=hapusgagal');
    }
}else{
    die("Akses Dilarang");
}
?>
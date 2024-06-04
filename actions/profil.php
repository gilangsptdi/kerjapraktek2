<?php
include('../include/config.php');

$kodeProfil = 'some_user_code'; // pastikan variabel ini didefinisikan dengan benar

$sql = "SELECT * FROM user WHERE kode_user='$kodeProfil'";
$query = mysqli_query($conn, $sql);

$foto_base64 = '';
if(mysqli_num_rows($query) > 0){
    while($data = mysqli_fetch_array($query)){
        $foto = $data['foto'];
        
        // Debugging: Periksa apakah foto diambil dengan benar
        if ($foto !== null && $foto !== '') {
            $foto_base64 = base64_encode($foto);
        } else {
            error_log("Foto tidak ditemukan atau kosong untuk user dengan kode: $kodeProfil");
        }
        
        $nama = $data['namauser'];
        $username = $data['username'];
        $password = $data['password'];
    }
} else {
    error_log("User dengan kode $kodeProfil tidak ditemukan.");
}
?>

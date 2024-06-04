<?php
include ('../include/config.php');
$username = $_POST ['username'];
$namauser = $_POST ['nama'];
$foto = $_FILES ['foto']['tmp_name'];


$password = password_hash('admin123', PASSWORD_DEFAULT);
$sql = "INSERT INTO user (username, password, namauser ,foto) VALUES ('$username','$password','$namauser','$foto')";

if(mysqli_query($conn,$sql)){
header('Location: ./?status=sukses');
}
else{
    header('Location: ./?status=gagal');
}
?>

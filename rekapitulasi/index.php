<?php
require_once('../include/config.php');
require_once('../actions/MySQLSessionHandler.php');

// Start the session and check if user is logged in
session_set_save_handler(new MySQLSessionHandler($conn), true);
session_start();

if (!isset($_SESSION['kode_user'])) {
    header('Location: ../?status=loginGagal');
    exit;
}

$kodeProfil = $_SESSION['kode_user'];
$sql = "SELECT * FROM user WHERE kode_user='$kodeProfil'";
$query = mysqli_query($conn, $sql);

$foto = '';
$nama = '';
$username = '';


if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_array($query);
    $foto = $data['foto'];
    $foto = base64_encode($foto);
    $nama = $data['namauser'];
    $username = $data['username'];
} else {
    error_log("User dengan kode $kodeProfil tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/cetak.css">
    <link rel="stylesheet" href="../assets/css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body id="dashboard">
    <aside>
        <nav>
            <b>Laporan Laboratorium</b>
            <i class="bi bi-list"></i>
        </nav>
        <a class="profile dropdown">
            <img src="data:image/jpeg;base64,<?php echo $foto ?>" alt="profile" />
            <div class="card-profile">
                <b><?php echo $nama ?></b>
                <?php echo $username ?>
            </div>
            <i class="bi bi-caret-down-fill "></i>
        </a>
        <div class="show">
            <a href="../profile/" class=" menu">
                <i class="bi bi-person-circle"></i>
                <p>Akun Saya</p>
            </a>
        </div>

        <hr>
        <a href="../dashboard/" class="menu">
            <i class="bi bi-house"></i>
            <p>Home</p>

        </a>
        <a class="menu dropdown">
            <i class="bi bi-hospital"></i>
            <p>Tambah Data</p>
            <i class="bi bi-caret-down-fill "></i>
        </a>
        <div class="show">
            <a href="../addpasien/" class="menu ">
                <i class="bi bi-person-fill-add"></i>
                <p>Tambah Pasien</p>
            </a>
            <a href="../addlaporan/" class="menu">
                <i class="bi bi-person-fill-add"></i>
                <p>Tambah Laporan Pasien</p>
            </a>
        </div>

        <a class="menu dropdown">
            <i class="bi bi-hospital"></i>
            <p>Hasil</p>
            <i class="bi bi-caret-down-fill "></i>
        </a>
        <div class="show aktif">
            <a href="../datapasien/index.php" class="menu">
                <i class="bi bi-person-lines-fill"></i>
                <p>Daftar Pasien</p>
            </a>
            <a href="../datalaporan/" class="menu">
                <i class="bi bi-person-fill-add"></i>
                <p>Daftar Laporan</p>
            </a>
            <a href="../laporanpasien/index.php" class="menu">
                <i class="bi bi-person-fill-add"></i>
                <p>Daftar Laporan Bulanan</p>
            </a>
            <a href="../rekapitulasi/" class="menu active">
                <i class="bi bi-person-fill-add"></i>
                <p>Rekapitulasi</p>
            </a>
        </div>
        <a href="../actions/logout.php" class="menu">
            <i class="bi bi-box-arrow-left"></i>
            <p>Log Out</p>
        </a>
    </aside>
    <main id="home">
        <header>
            <nav>
                <a href="../dashboard/" class="navbrand">
                    <img src="../assets/img/puskesmas logo.png" alt="logo puskesmas" />
                    <h2 class="judul">PUSKESMAS SINDANGKASIH</h2>
                </a>
            </nav>
        </header>
        <div class="formlap-container">
            <h2 class="lab">REKAPITULASI</h2>
            <form action="./cetak.php" method="GET">
                <p>Pilih Bulan
                <input type="month" name="bulan" id="bulan" value="<?php echo (isset($_GET["bulan"]))? $_GET['bulan']:''?>">
                <button type="submit" style="padding:4px; margin-left:8px"><i class="bi bi-search"></i></button>
                </p>
            </form>
            <!-- <button onclick="printPage('tes.html')">Cetak</button> -->
        </div>

</body>
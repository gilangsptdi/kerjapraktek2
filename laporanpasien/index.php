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
            <a href="../addpasien/" class="menu">
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
            <a href="../datapasien/" class="menu">
                <i class="bi bi-person-lines-fill"></i>
                <p>Daftar Pasien</p>
            </a>
            <a href="../datalaporan/index.php" class="menu">
                <i class="bi bi-person-fill-add"></i>
                <p>Daftar Laporan</p>
            </a>
            <a href="../laporanpasien/index.php" class="menu active">
                <i class="bi bi-person-fill-add"></i>
                <p>Daftar Laporan Bulanan</p>
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
            <h2 class="lab">HASIL LAPORAN BULANAN</h2>
            <form action="" method="get" style="flex-direction: row">
                <input type="month" name="date">
                <button type="submit" class="cari">Cari</button>
                <?php
                include('../include/config.php');
                if (isset($_GET['date'])){
                    $date = ($_GET['date']=='') ? $date = date('Y-m') : $_GET['date'];
                }else{
                    $date = date('Y-m');
                }
                list($year, $month) = explode('-', $date);
                $sql = "SELECT tanggal, 
                    COUNT(*) AS total_records, 
                    SUM(CASE WHEN hemoglobin IS NOT NULL AND hemoglobin <> '' THEN 1 ELSE 0 END) AS filled_hemoglobin, 
                    SUM(CASE WHEN leukosit IS NOT NULL AND leukosit <> '' THEN 1 ELSE 0 END) AS filled_leukosit,
                    SUM(CASE WHEN trombosit IS NOT NULL AND trombosit <> '' THEN 1 ELSE 0 END) AS filled_trombosit,
                    SUM(CASE WHEN eritrosit IS NOT NULL AND eritrosit <> '' THEN 1 ELSE 0 END) AS filled_eritrosit,
                    SUM(CASE WHEN hematokrit IS NOT NULL AND hematokrit <> '' THEN 1 ELSE 0 END) AS filled_hematokrit,
                    SUM(CASE WHEN limfosit IS NOT NULL AND limfosit <> '' THEN 1 ELSE 0 END) AS filled_limfosit,
                    SUM(CASE WHEN monosit IS NOT NULL AND monosit <> '' THEN 1 ELSE 0 END) AS filled_monosit,
                    SUM(CASE WHEN granulosit IS NOT NULL AND granulosit <> '' THEN 1 ELSE 0 END) AS filled_granulosit,
                    SUM(CASE WHEN led IS NOT NULL AND led <> '' THEN 1 ELSE 0 END) AS filled_led,
                    SUM(CASE WHEN golongandarah IS NOT NULL AND golongandarah <> '' THEN 1 ELSE 0 END) AS filled_golongandarah,
                    SUM(CASE WHEN warna IS NOT NULL AND warna <> '' THEN 1 ELSE 0 END) AS filled_warna,
                    SUM(CASE WHEN kejernihan IS NOT NULL AND kejernihan <> '' THEN 1 ELSE 0 END) AS filled_kejernihan,
                    SUM(CASE WHEN ph IS NOT NULL AND ph <> '' THEN 1 ELSE 0 END) AS filled_ph,
                    SUM(CASE WHEN beratjenis IS NOT NULL AND beratjenis <> '' THEN 1 ELSE 0 END) AS filled_beratjenis,
                    SUM(CASE WHEN protein IS NOT NULL AND protein <> '' THEN 1 ELSE 0 END) AS filled_protein,
                    SUM(CASE WHEN glukosa IS NOT NULL AND glukosa <> '' THEN 1 ELSE 0 END) AS filled_glukosa,
                    SUM(CASE WHEN bilirubin IS NOT NULL AND bilirubin <> '' THEN 1 ELSE 0 END) AS filled_bilirubin,
                    SUM(CASE WHEN urobilinogen IS NOT NULL AND urobilinogen <> '' THEN 1 ELSE 0 END) AS filled_urobilinogen,
                    SUM(CASE WHEN keton IS NOT NULL AND keton <> '' THEN 1 ELSE 0 END) AS filled_keton,
                    SUM(CASE WHEN nitrit IS NOT NULL AND nitrit <> '' THEN 1 ELSE 0 END) AS filled_nitrit,
                    SUM(CASE WHEN leukosittt IS NOT NULL AND leukosittt <> '' THEN 1 ELSE 0 END) AS filled_leukosittt,
                    SUM(CASE WHEN eritrosittt IS NOT NULL AND eritrosittt <> '' THEN 1 ELSE 0 END) AS filled_eritrosittt,
                    SUM(CASE WHEN eritrositt IS NOT NULL AND eritrositt <> '' THEN 1 ELSE 0 END) AS filled_eritrositt,
                    SUM(CASE WHEN leukositt IS NOT NULL AND leukositt <> '' THEN 1 ELSE 0 END) AS filled_leukositt,
                    SUM(CASE WHEN epitel IS NOT NULL AND epitel <> '' THEN 1 ELSE 0 END) AS filled_epitel,
                    SUM(CASE WHEN kristal IS NOT NULL AND kristal <> '' THEN 1 ELSE 0 END) AS filled_kristal,
                    SUM(CASE WHEN silinder IS NOT NULL AND silinder <> '' THEN 1 ELSE 0 END) AS filled_silinder,
                    SUM(CASE WHEN teskehamilan IS NOT NULL AND teskehamilan <> '' THEN 1 ELSE 0 END) AS filled_teskehamilan,
                    SUM(CASE WHEN pagi IS NOT NULL AND pagi <> '' THEN 1 ELSE 0 END) AS filled_pagi,
                    SUM(CASE WHEN sewaktu IS NOT NULL AND sewaktu <> '' THEN 1 ELSE 0 END) AS filled_sewaktu,
                    SUM(CASE WHEN antihiv IS NOT NULL AND antihiv <> '' THEN 1 ELSE 0 END) AS filled_antihiv,
                    SUM(CASE WHEN sifilistprapid IS NOT NULL AND sifilistprapid <> '' THEN 1 ELSE 0 END) AS filled_sifilistprapid,
                    SUM(CASE WHEN hbsag IS NOT NULL AND hbsag <> '' THEN 1 ELSE 0 END) AS filled_hbsag,
                    SUM(CASE WHEN antihivr2 IS NOT NULL AND antihivr2 <> '' THEN 1 ELSE 0 END) AS filled_antihivr2,
                    SUM(CASE WHEN antihivr3 IS NOT NULL AND antihivr3 <> '' THEN 1 ELSE 0 END) AS filled_antihivr3,
                    SUM(CASE WHEN styphio IS NOT NULL AND styphio <> '' THEN 1 ELSE 0 END) AS filled_styphio,
                    SUM(CASE WHEN sparatyphiao IS NOT NULL AND sparatyphiao <> '' THEN 1 ELSE 0 END) AS filled_sparatyphiao,
                    SUM(CASE WHEN sparatyphibo IS NOT NULL AND sparatyphibo <> '' THEN 1 ELSE 0 END) AS filled_sparatyphibo,
                    SUM(CASE WHEN sparatyphico IS NOT NULL AND sparatyphico <> '' THEN 1 ELSE 0 END) AS filled_sparatyphico,
                    SUM(CASE WHEN styphih IS NOT NULL AND styphih <> '' THEN 1 ELSE 0 END) AS filled_styphih,
                    SUM(CASE WHEN sparatyphiah IS NOT NULL AND sparatyphiah <> '' THEN 1 ELSE 0 END) AS filled_sparatyphiah,
                    SUM(CASE WHEN sparatyphibh IS NOT NULL AND sparatyphibh <> '' THEN 1 ELSE 0 END) AS filled_sparatyphibh,
                    SUM(CASE WHEN sparatyphich IS NOT NULL AND sparatyphich <> '' THEN 1 ELSE 0 END) AS filled_sparatyphich,
                    SUM(CASE WHEN ns1dbd IS NOT NULL AND ns1dbd <> '' THEN 1 ELSE 0 END) AS filled_ns1dbd,
                    SUM(CASE WHEN iggdbd IS NOT NULL AND iggdbd <> '' THEN 1 ELSE 0 END) AS filled_iggdbd,
                    SUM(CASE WHEN igmdbd IS NOT NULL AND igmdbd <> '' THEN 1 ELSE 0 END) AS filled_igmdbd,
                    SUM(CASE WHEN guladarahsewaktu IS NOT NULL AND guladarahsewaktu <> '' THEN 1 ELSE 0 END) AS filled_guladarahsewaktu,
                    SUM(CASE WHEN guladarahpuasa IS NOT NULL AND guladarahpuasa <> '' THEN 1 ELSE 0 END) AS filled_guladarahpuasa,
                    SUM(CASE WHEN guladarah2jamp IS NOT NULL AND guladarah2jamp <> '' THEN 1 ELSE 0 END) AS filled_guladarah2jamp,
                    SUM(CASE WHEN kolesteroltotal IS NOT NULL AND kolesteroltotal <> '' THEN 1 ELSE 0 END) AS filled_kolesteroltotal,
                    SUM(CASE WHEN asamurat IS NOT NULL AND asamurat <> '' THEN 1 ELSE 0 END) AS filled_asamurat
                    FROM laporan_lab 
                    WHERE YEAR(tanggal) = $year AND MONTH(tanggal) = $month
                    GROUP BY tanggal 
                    ORDER BY hemoglobin, leukosit, trombosit";
                echo "<td class='btn-center'><a class='cetak' href='./cetakPerbulan.php?date=" . $date . "'>Cetak</a>";
                ?>
            </form>
            
            <table id="mytable" class="display print">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah Pasien</th>
                        <th>Jumlah Pemeriksaan</th>
                        <th>Aksi</th>
                    </tr>
                <tbody>
                    <?php
                    include('../include/config.php');
                    if (isset($_GET['date'])){
                        $date = ($_GET['date']=='') ? $date = date('Y-m') : $_GET['date'];
                    }else{
                        $date = date('Y-m');
                    }
                    list($year, $month) = explode('-', $date);
                    $sql = "SELECT tanggal, 
                    COUNT(*) AS total_records, 
                    SUM(CASE WHEN hemoglobin IS NOT NULL AND hemoglobin <> '' THEN 1 ELSE 0 END) AS filled_hemoglobin,  
                    SUM(CASE WHEN leukosit IS NOT NULL AND leukosit <> '' THEN 1 ELSE 0 END) AS filled_leukosit,
                    SUM(CASE WHEN trombosit IS NOT NULL AND trombosit <> '' THEN 1 ELSE 0 END) AS filled_trombosit,
                    SUM(CASE WHEN eritrosit IS NOT NULL AND eritrosit <> '' THEN 1 ELSE 0 END) AS filled_eritrosit,
                    SUM(CASE WHEN hematokrit IS NOT NULL AND hematokrit <> '' THEN 1 ELSE 0 END) AS filled_hematokrit,
                    SUM(CASE WHEN limfosit IS NOT NULL AND limfosit <> '' THEN 1 ELSE 0 END) AS filled_limfosit,
                    SUM(CASE WHEN monosit IS NOT NULL AND monosit <> '' THEN 1 ELSE 0 END) AS filled_monosit,
                    SUM(CASE WHEN granulosit IS NOT NULL AND granulosit <> '' THEN 1 ELSE 0 END) AS filled_granulosit,
                    SUM(CASE WHEN led IS NOT NULL AND led <> '' THEN 1 ELSE 0 END) AS filled_led,
                    SUM(CASE WHEN golongandarah IS NOT NULL AND golongandarah <> '' THEN 1 ELSE 0 END) AS filled_golongandarah,
                    SUM(CASE WHEN warna IS NOT NULL AND warna <> '' THEN 1 ELSE 0 END) AS filled_warna,
                    SUM(CASE WHEN kejernihan IS NOT NULL AND kejernihan <> '' THEN 1 ELSE 0 END) AS filled_kejernihan,
                    SUM(CASE WHEN ph IS NOT NULL AND ph <> '' THEN 1 ELSE 0 END) AS filled_ph,
                    SUM(CASE WHEN beratjenis IS NOT NULL AND beratjenis <> '' THEN 1 ELSE 0 END) AS filled_beratjenis,
                    SUM(CASE WHEN protein IS NOT NULL AND protein <> '' THEN 1 ELSE 0 END) AS filled_protein,
                    SUM(CASE WHEN glukosa IS NOT NULL AND glukosa <> '' THEN 1 ELSE 0 END) AS filled_glukosa,
                    SUM(CASE WHEN bilirubin IS NOT NULL AND bilirubin <> '' THEN 1 ELSE 0 END) AS filled_bilirubin,
                    SUM(CASE WHEN urobilinogen IS NOT NULL AND urobilinogen <> '' THEN 1 ELSE 0 END) AS filled_urobilinogen,
                    SUM(CASE WHEN keton IS NOT NULL AND keton <> '' THEN 1 ELSE 0 END) AS filled_keton,
                    SUM(CASE WHEN nitrit IS NOT NULL AND nitrit <> '' THEN 1 ELSE 0 END) AS filled_nitrit,
                    SUM(CASE WHEN leukosittt IS NOT NULL AND leukosittt <> '' THEN 1 ELSE 0 END) AS filled_leukosittt,
                    SUM(CASE WHEN eritrosittt IS NOT NULL AND eritrosittt <> '' THEN 1 ELSE 0 END) AS filled_eritrosittt,
                    SUM(CASE WHEN eritrositt IS NOT NULL AND eritrositt <> '' THEN 1 ELSE 0 END) AS filled_eritrositt,
                    SUM(CASE WHEN leukositt IS NOT NULL AND leukositt <> '' THEN 1 ELSE 0 END) AS filled_leukositt,
                    SUM(CASE WHEN epitel IS NOT NULL AND epitel <> '' THEN 1 ELSE 0 END) AS filled_epitel,
                    SUM(CASE WHEN kristal IS NOT NULL AND kristal <> '' THEN 1 ELSE 0 END) AS filled_kristal,
                    SUM(CASE WHEN silinder IS NOT NULL AND silinder <> '' THEN 1 ELSE 0 END) AS filled_silinder,
                    SUM(CASE WHEN teskehamilan IS NOT NULL AND teskehamilan <> '' THEN 1 ELSE 0 END) AS filled_teskehamilan,
                    SUM(CASE WHEN pagi IS NOT NULL AND pagi <> '' THEN 1 ELSE 0 END) AS filled_pagi,
                    SUM(CASE WHEN sewaktu IS NOT NULL AND sewaktu <> '' THEN 1 ELSE 0 END) AS filled_sewaktu,
                    SUM(CASE WHEN antihiv IS NOT NULL AND antihiv <> '' THEN 1 ELSE 0 END) AS filled_antihiv,
                    SUM(CASE WHEN sifilistprapid IS NOT NULL AND sifilistprapid <> '' THEN 1 ELSE 0 END) AS filled_sifilistprapid,
                    SUM(CASE WHEN hbsag IS NOT NULL AND hbsag <> '' THEN 1 ELSE 0 END) AS filled_hbsag,
                    SUM(CASE WHEN antihivr2 IS NOT NULL AND antihivr2 <> '' THEN 1 ELSE 0 END) AS filled_antihivr2,
                    SUM(CASE WHEN antihivr3 IS NOT NULL AND antihivr3 <> '' THEN 1 ELSE 0 END) AS filled_antihivr3,
                    SUM(CASE WHEN styphio IS NOT NULL AND styphio <> '' THEN 1 ELSE 0 END) AS filled_styphio,
                    SUM(CASE WHEN sparatyphiao IS NOT NULL AND sparatyphiao <> '' THEN 1 ELSE 0 END) AS filled_sparatyphiao,
                    SUM(CASE WHEN sparatyphibo IS NOT NULL AND sparatyphibo <> '' THEN 1 ELSE 0 END) AS filled_sparatyphibo,
                    SUM(CASE WHEN sparatyphico IS NOT NULL AND sparatyphico <> '' THEN 1 ELSE 0 END) AS filled_sparatyphico,
                    SUM(CASE WHEN styphih IS NOT NULL AND styphih <> '' THEN 1 ELSE 0 END) AS filled_styphih,
                    SUM(CASE WHEN sparatyphiah IS NOT NULL AND sparatyphiah <> '' THEN 1 ELSE 0 END) AS filled_sparatyphiah,
                    SUM(CASE WHEN sparatyphibh IS NOT NULL AND sparatyphibh <> '' THEN 1 ELSE 0 END) AS filled_sparatyphibh,
                    SUM(CASE WHEN sparatyphich IS NOT NULL AND sparatyphich <> '' THEN 1 ELSE 0 END) AS filled_sparatyphich,
                    SUM(CASE WHEN ns1dbd IS NOT NULL AND ns1dbd <> '' THEN 1 ELSE 0 END) AS filled_ns1dbd,
                    SUM(CASE WHEN iggdbd IS NOT NULL AND iggdbd <> '' THEN 1 ELSE 0 END) AS filled_iggdbd,
                    SUM(CASE WHEN igmdbd IS NOT NULL AND igmdbd <> '' THEN 1 ELSE 0 END) AS filled_igmdbd,
                    SUM(CASE WHEN guladarahsewaktu IS NOT NULL AND guladarahsewaktu <> '' THEN 1 ELSE 0 END) AS filled_guladarahsewaktu,
                    SUM(CASE WHEN guladarahpuasa IS NOT NULL AND guladarahpuasa <> '' THEN 1 ELSE 0 END) AS filled_guladarahpuasa,
                    SUM(CASE WHEN guladarah2jamp IS NOT NULL AND guladarah2jamp <> '' THEN 1 ELSE 0 END) AS filled_guladarah2jamp,
                    SUM(CASE WHEN kolesteroltotal IS NOT NULL AND kolesteroltotal <> '' THEN 1 ELSE 0 END) AS filled_kolesteroltotal,
                    SUM(CASE WHEN asamurat IS NOT NULL AND asamurat <> '' THEN 1 ELSE 0 END) AS filled_asamurat
                    FROM laporan_lab 
                    WHERE YEAR(tanggal) = $year AND MONTH(tanggal) = $month
                    GROUP BY tanggal 
                    ORDER BY hemoglobin, leukosit, trombosit";
                    
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        $no = 1;
                        while ($data = mysqli_fetch_array($query)) {
                            $total_filled = $data['filled_hemoglobin'] + $data['filled_leukosit'] + $data['filled_trombosit'] + $data['filled_eritrosit'] +
                            $data['filled_hematokrit'] + $data['filled_limfosit'] + $data['filled_monosit'] + $data['filled_granulosit'] +
                            $data['filled_led'] + $data['filled_golongandarah'] + $data['filled_warna'] + $data['filled_kejernihan'] + 
                            $data['filled_ph'] + $data['filled_beratjenis'] + $data['filled_protein'] + $data['filled_glukosa'] + 
                            $data['filled_bilirubin'] + $data['filled_urobilinogen'] + $data['filled_keton'] + $data['filled_nitrit'] +
                            $data['filled_leukosittt'] + $data['filled_eritrosittt'] + $data['filled_eritrositt'] + $data['filled_leukositt'] +
                            $data['filled_epitel'] + $data['filled_kristal'] + $data['filled_silinder'] + $data['filled_teskehamilan'] + 
                            $data['filled_pagi'] + $data['filled_sewaktu'] + $data['filled_antihiv'] + $data['filled_sifilistprapid'] +
                            $data['filled_hbsag'] + $data['filled_antihivr2'] + $data['filled_antihivr3'] + $data['filled_styphio'] + 
                            $data['filled_sparatyphiao'] + $data['filled_sparatyphibo'] + $data['filled_sparatyphico'] + $data['filled_styphih'] + 
                            $data['filled_sparatyphiah'] + $data['filled_sparatyphibh'] + $data['filled_sparatyphich'] + $data['filled_ns1dbd'] + 
                            $data['filled_iggdbd'] + $data['filled_igmdbd'] + $data['filled_guladarahsewaktu'] + $data['filled_guladarahpuasa'] + 
                            $data['filled_guladarah2jamp'] + $data['filled_kolesteroltotal'] + $data['filled_asamurat'];
                            echo "<tr>";
                            echo "<th>" . $no . "</th>";
                            echo "<td>" . $data['tanggal'] . "</td>";
                            echo "<td>" . $data['total_records'] . "</td>";
                            echo "<td>" . $total_filled . "</td>";                            
                            echo "</td>";
                            echo "<td class='btn-center'><a class='cetak' href='./cetak.php?date=" . $data['tanggal'] . "'>Cetak</a>";
                            echo "</tr>";                   
                            $no++;
                        }
                    }
                    ?>
                </tbody>
                </thead>
            </table>
            <!-- <button onclick="printPage('tes.html')">Cetak</button> -->
        </div>
        <script src="../assets/js/script.js"></script>
        <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script>
    //    tes
        new DataTable('#mytable');

        function printPage(url) {
            // Buka jendela baru dengan URL yang diberikan
            var printWindow = window.open(url, '_blank');
            // Tunggu hingga halaman sepenuhnya dimuat
            printWindow.onload = function() {
                // Cetak halaman dan tutup jendela setelah selesai mencetak
                printWindow.print();
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            };
        }
    </script>
</body>
</html>
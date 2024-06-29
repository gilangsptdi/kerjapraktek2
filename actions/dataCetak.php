<?php
include('../include/config.php');
$kode = $_GET['kode'];
$sql = "SELECT * FROM laporan_lab WHERE kode_laporan='" . $kode . "'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_array($query)) {
    $hemoglobin = $data['hemoglobin'];
    $leukosit = $data['leukosit'];
    $trombosit = $data['trombosit'];
    $eritrosit = $data['eritrosit'];
    $hematokrit = $data['hematokrit'];
    $limfosit = $data['limfosit'];
    $monosit = $data['monosit'];
    $granulosit = $data['granulosit'];
    $led = $data['led'];
    $golongandarah = $data['golongandarah'];
    $warna = $data['warna'];
    $kejernihan = $data['kejernihan'];
    $ph = $data['ph'];
    $beratjenis = $data['beratjenis'];
    $protein = $data['protein'];
    $glukosa = $data['glukosa'];
    $bilirubin = $data['bilirubin'];
    $urobilinogen = $data['urobilinogen'];
    $keton = $data['keton'];
    $nitrit = $data['nitrit'];
    $leukosittt = $data['leukosittt'];
    $eritrosittt = $data['eritrosittt'];
    $eritrositt = $data['eritrositt'];
    $leukositt = $data['leukositt'];
    $epitel = $data['epitel'];
    $kristal = $data['kristal'];
    $silinder = $data['silinder'];
    $teskehamilan = $data['teskehamilan'];
    $pagi = $data['pagi'];
    $sewaktu = $data['sewaktu'];
    $antihiv = $data['antihiv'];
    $sifilistprapid = $data['sifilistprapid'];
    $hbsag = $data['hbsag'];
    $antihivr2 = $data['antihivr2'];
    $antihivr3 = $data['antihivr3'];
    $styphio = $data['styphio'];
    $sparatyphiao = $data['sparatyphiao'];
    $sparatyphibo = $data['sparatyphibo'];
    $sparatyphico = $data['sparatyphico'];
    $styphih = $data['styphih'];
    $sparatyphiah = $data['sparatyphiah'];
    $sparatyphibh = $data['sparatyphibh'];
    $sparatyphich = $data['sparatyphich'];
    $ns1dbd = $data['ns1dbd'];
    $iggdbd = $data['iggdbd'];
    $igmdbd = $data['igmdbd'];
    $guladarahsewaktu = $data['guladarahsewaktu'];
    $guladarahpuasa = $data['guladarahpuasa'];
    $guladarah2jamp = $data['guladarah2jamp'];
    $kolesteroltotal = $data['kolesteroltotal'];
    $asamurat = $data['asamurat'];
    }
}

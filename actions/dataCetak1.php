<?php
include('../include/config.php');
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
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
        WHERE tanggal = '$date'
        GROUP BY tanggal";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_array($query)) {
    $hemoglobin = $data['filled_hemoglobin'];
    $leukosit = $data['filled_leukosit'];
    $trombosit = $data['filled_trombosit'];
    $eritrosit = $data['filled_eritrosit'];
    $hematokrit = $data['filled_hematokrit'];
    $limfosit = $data['filled_limfosit'];
    $monosit = $data['filled_monosit'];
    $granulosit = $data['filled_granulosit'];
    $led = $data['filled_led'];
    $golongandarah = $data['filled_golongandarah'];
    $warna = $data['filled_warna'];
    $kejernihan = $data['filled_kejernihan'];
    $ph = $data['filled_ph'];
    $beratjenis = $data['filled_beratjenis'];
    $protein = $data['filled_protein'];
    $glukosa = $data['filled_glukosa'];
    $bilirubin = $data['filled_bilirubin'];
    $urobilinogen = $data['filled_urobilinogen'];
    $keton = $data['filled_keton'];
    $nitrit = $data['filled_nitrit'];
    $leukosittt = $data['filled_leukosittt'];
    $eritrosittt = $data['filled_eritrosittt'];
    $eritrositt = $data['filled_eritrositt'];
    $leukositt = $data['filled_leukositt'];
    $epitel = $data['filled_epitel'];
    $kristal = $data['filled_kristal'];
    $silinder = $data['filled_silinder'];
    $teskehamilan = $data['filled_teskehamilan'];
    $pagi = $data['filled_pagi'];
    $sewaktu = $data['filled_sewaktu'];
    $antihiv = $data['filled_antihiv'];
    $sifilistprapid = $data['filled_sifilistprapid'];
    $hbsag = $data['filled_hbsag'];
    $antihivr2 = $data['filled_antihivr2'];
    $antihivr3 = $data['filled_antihivr3'];
    $styphio = $data['filled_styphio'];
    $sparatyphiao = $data['filled_sparatyphiao'];
    $sparatyphibo = $data['filled_sparatyphibo'];
    $sparatyphico = $data['filled_sparatyphico'];
    $styphih = $data['filled_styphih'];
    $sparatyphiah = $data['filled_sparatyphiah'];
    $sparatyphibh = $data['filled_sparatyphibh'];
    $sparatyphich = $data['filled_sparatyphich'];
    $ns1dbd = $data['filled_ns1dbd'];
    $iggdbd = $data['filled_iggdbd'];
    $igmdbd = $data['filled_igmdbd'];
    $guladarahsewaktu = $data['filled_guladarahsewaktu'];
    $guladarahpuasa = $data['filled_guladarahpuasa'];
    $guladarah2jamp = $data['filled_guladarah2jamp'];
    $kolesteroltotal = $data['filled_kolesteroltotal'];
    $asamurat = $data['filled_asamurat'];
    }
}

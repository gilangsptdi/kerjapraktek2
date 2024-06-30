<?php
include('../include/config.php');
$sql = "SELECT 
    COUNT(hemoglobin) AS total_hemoglobin,
    COUNT(led) AS total_led,
    COUNT(golongandarah) AS total_golongandarah,
    COUNT(leukosittt) + COUNT(eritrosittt) AS total_urin_lengkap,
    COUNT(protein) AS total_protein,
    COUNT(teskehamilan) AS total_teskehamilan,
    COUNT(antihiv) AS total_antihiv,
    COUNT(sifilistprapid) AS total_sifilistprapid,
    COUNT(hbsag) AS total_hbsag,
    COUNT(antihivr2) AS total_antihivr2,
    COUNT(antihivr3) AS total_antihivr3,
    COUNT(styphio) + COUNT(sparatyphiao) + COUNT(sparatyphibo) + COUNT(sparatyphico) + 
    COUNT(styphih) + COUNT(sparatyphiah) + COUNT(sparatyphibh) + COUNT(sparatyphich) AS total_widal,
    COUNT(ns1dbd) AS total_ns1dbd,
    COUNT(igmdbd) AS total_igmdbd,
    COUNT(iggdbd) AS total_iggdbd,
    COUNT(guladarahsewaktu) + COUNT(guladarahpuasa) + COUNT(guladarah2jamp) AS total_guladarah,
    COUNT(kolesteroltotal) AS total_kolesteroltotal,
    COUNT(asamurat) AS total_asamurat
FROM laporan_lab
WHERE tanggal = '$tgl';";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_array($query)) {
        $total_hemoglobin = $data['total_hemoglobin'];
        $total_led = $data['total_led'];
        $total_golongandarah = $data['total_golongandarah'];
        $total_urin_lengkap = $data['total_urin_lengkap'];
        $total_protein = $data['total_protein'];
        $total_teskehamilan = $data['total_teskehamilan'];
        $total_antihiv = $data['total_antihiv'];
        $total_sifilistprapid = $data['total_sifilistprapid'];
        $total_hbsag = $data['total_hbsag'];
        $total_antihivr2 = $data['total_antihivr2'];
        $total_antihivr3 = $data['total_antihivr3'];
        $total_widal = $data['total_widal'];
        $total_ns1dbd = $data['total_ns1dbd'];
        $total_igmdbd = $data['total_igmdbd'];
        $total_iggdbd = $data['total_iggdbd'];
        $total_guladarah = $data['total_guladarah'];
        $total_kolesteroltotal = $data['total_kolesteroltotal'];
        $total_asamurat = $data['total_asamurat'];
    }
}
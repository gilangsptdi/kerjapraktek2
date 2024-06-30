<?php
include('../include/config.php');
$sql = "SELECT 
    COUNT(DISTINCT CASE WHEN hemoglobin IS NOT NULL THEN no_registrasi END) AS total_hemoglobin,
    COUNT(DISTINCT CASE WHEN led IS NOT NULL THEN no_registrasi END) AS total_led,
    COUNT(DISTINCT CASE WHEN golongandarah IS NOT NULL THEN no_registrasi END) AS total_golongandarah,
    COUNT(DISTINCT CASE WHEN (warna IS NOT NULL OR kejernihan IS NOT NULL OR ph IS NOT NULL OR beratjenis IS NOT NULL OR protein IS NOT NULL OR glukosa IS NOT NULL OR bilirubin IS NOT NULL OR urobilinogen IS NOT NULL OR keton IS NOT NULL OR nitrit IS NOT NULL OR leukosittt IS NOT NULL OR eritrosittt IS NOT NULL OR epitel IS NOT NULL OR kristal IS NOT NULL OR silinder IS NOT NULL) THEN no_registrasi END) AS total_urin_lengkap,
    COUNT(DISTINCT CASE WHEN protein IS NOT NULL THEN no_registrasi END) AS total_protein,
    COUNT(DISTINCT CASE WHEN teskehamilan IS NOT NULL THEN no_registrasi END) AS total_teskehamilan,
    COUNT(DISTINCT CASE WHEN antihiv IS NOT NULL THEN no_registrasi END) AS total_antihiv,
    COUNT(DISTINCT CASE WHEN sifilistprapid IS NOT NULL THEN no_registrasi END) AS total_sifilistprapid,
    COUNT(DISTINCT CASE WHEN hbsag IS NOT NULL THEN no_registrasi END) AS total_hbsag,
    COUNT(DISTINCT CASE WHEN antihivr2 IS NOT NULL THEN no_registrasi END) AS total_antihivr2,
    COUNT(DISTINCT CASE WHEN antihivr3 IS NOT NULL THEN no_registrasi END) AS total_antihivr3,
    COUNT(DISTINCT CASE WHEN (styphio IS NOT NULL OR sparatyphiao IS NOT NULL OR sparatyphibo IS NOT NULL OR sparatyphico IS NOT NULL OR styphih IS NOT NULL OR sparatyphiah IS NOT NULL OR sparatyphibh IS NOT NULL OR sparatyphich IS NOT NULL) THEN no_registrasi END) AS total_widal,
    COUNT(DISTINCT CASE WHEN ns1dbd IS NOT NULL THEN no_registrasi END) AS total_ns1dbd,
    COUNT(DISTINCT CASE WHEN iggdbd IS NOT NULL THEN no_registrasi END) AS total_iggdbd,
    COUNT(DISTINCT CASE WHEN igmdbd IS NOT NULL THEN no_registrasi END) AS total_igmdbd,
    COUNT(DISTINCT CASE WHEN guladarahsewaktu IS NOT NULL THEN no_registrasi END) AS total_guladarahsewaktu,
    COUNT(DISTINCT CASE WHEN guladarahpuasa IS NOT NULL THEN no_registrasi END) AS total_guladarahpuasa,
    COUNT(DISTINCT CASE WHEN guladarah2jamp IS NOT NULL THEN no_registrasi END) AS total_guladarah2jamp,
    COUNT(DISTINCT CASE WHEN kolesteroltotal IS NOT NULL THEN no_registrasi END) AS total_kolesteroltotal,
    COUNT(DISTINCT CASE WHEN asamurat IS NOT NULL THEN no_registrasi END) AS total_asamurat,
    COUNT(DISTINCT CASE WHEN (pagi IS NOT NULL OR sewaktu IS NOT NULL) THEN no_registrasi END) AS total_bta
    -- COUNT(DISTINCT CASE WHEN trigliserida IS NOT NULL THEN no_registrasi END) AS total_trigliserida,
    -- COUNT(DISTINCT CASE WHEN hdl IS NOT NULL THEN no_registrasi END) AS total_hdl
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
        $total_guladarahsewaktu = $data['total_guladarahsewaktu'];
        $total_guladarahpuasa = $data['total_guladarahpuasa'];
        $total_guladarah2jamp = $data['total_guladarah2jamp'];
        $total_kolesteroltotal = $data['total_kolesteroltotal'];
        $total_asamurat = $data['total_asamurat'];
        $total_bta = $data['total_bta'];
        // $total_trigliserida = $data['total_trigliserida'];
        // $total_hdl = $data['total_hdl'];
    }
}
?>

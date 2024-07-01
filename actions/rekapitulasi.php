<?php
include('../include/config.php');
$sql = "SELECT 
    COUNT(DISTINCT CASE WHEN hemoglobin !='' THEN no_registrasi END) AS total_hemoglobin,
    COUNT(DISTINCT CASE WHEN led !='' THEN no_registrasi END) AS total_led,
    COUNT(DISTINCT CASE WHEN golongandarah !='' THEN no_registrasi END) AS total_golongandarah,
    COUNT(DISTINCT CASE WHEN (warna !='' OR kejernihan !='' OR ph !='' OR beratjenis !='' OR protein !='' OR glukosa !='' OR bilirubin !='' OR urobilinogen !='' OR keton !='' OR nitrit !='' OR leukosittt !='' OR eritrosittt !='' OR epitel !='' OR kristal !='' OR silinder !='') THEN no_registrasi END) AS total_urin_lengkap,
    COUNT(DISTINCT CASE WHEN protein !='' THEN no_registrasi END) AS total_protein,
    COUNT(DISTINCT CASE WHEN teskehamilan !='' THEN no_registrasi END) AS total_teskehamilan,
    COUNT(DISTINCT CASE WHEN antihiv !='' THEN no_registrasi END) AS total_antihiv,
    COUNT(DISTINCT CASE WHEN sifilistprapid !='' THEN no_registrasi END) AS total_sifilistprapid,
    COUNT(DISTINCT CASE WHEN hbsag !='' THEN no_registrasi END) AS total_hbsag,
    COUNT(DISTINCT CASE WHEN antihivr2 !='' THEN no_registrasi END) AS total_antihivr2,
    COUNT(DISTINCT CASE WHEN antihivr3 !='' THEN no_registrasi END) AS total_antihivr3,
    COUNT(DISTINCT CASE WHEN (styphio !='' OR sparatyphiao !='' OR sparatyphibo !='' OR sparatyphico !='' OR styphih !='' OR sparatyphiah !='' OR sparatyphibh !='' OR sparatyphich !='') THEN no_registrasi END) AS total_widal,
    COUNT(DISTINCT CASE WHEN ns1dbd !='' THEN no_registrasi END) AS total_ns1dbd,
    COUNT(DISTINCT CASE WHEN iggdbd !='' THEN no_registrasi END) AS total_iggdbd,
    COUNT(DISTINCT CASE WHEN igmdbd !='' THEN no_registrasi END) AS total_igmdbd,
    COUNT(DISTINCT CASE WHEN guladarahsewaktu !='' THEN no_registrasi END) AS total_guladarahsewaktu,
    COUNT(DISTINCT CASE WHEN guladarahpuasa !='' THEN no_registrasi END) AS total_guladarahpuasa,
    COUNT(DISTINCT CASE WHEN guladarah2jamp !='' THEN no_registrasi END) AS total_guladarah2jamp,
    COUNT(DISTINCT CASE WHEN kolesteroltotal !='' THEN no_registrasi END) AS total_kolesteroltotal,
    COUNT(DISTINCT CASE WHEN asamurat !='' THEN no_registrasi END) AS total_asamurat,
    COUNT(DISTINCT CASE WHEN pagi !='' OR sewaktu !='' THEN no_registrasi END) AS total_bta
    -- COUNT(DISTINCT CASE WHEN trigliserida !='' THEN no_registrasi END) AS total_trigliserida,
    -- COUNT(DISTINCT CASE WHEN hdl !='' THEN no_registrasi END) AS total_hdl
FROM laporan_lab
WHERE tanggal = '$tgl';";

$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_array($query)) {
        $total_hemoglobin = $data['total_hemoglobin'] == '0' ? '' : $data['total_hemoglobin'];
        $total_led = $data['total_led'] == '0' ? '' : $data['total_led'];
        $total_golongandarah = $data['total_golongandarah'] == '0' ? '' : $data['total_golongandarah'];
        $total_urin_lengkap = $data['total_urin_lengkap'] == '0' ? '' : $data['total_urin_lengkap'];
        $total_protein = $data['total_protein'] == '0' ? '' : $data['total_protein'];
        $total_teskehamilan = $data['total_teskehamilan'] == '0' ? '' : $data['total_teskehamilan'];
        $total_antihiv = $data['total_antihiv'] == '0' ? '' : $data['total_antihiv'];
        $total_sifilistprapid = $data['total_sifilistprapid'] == '0' ? '' : $data['total_sifilistprapid'];
        $total_hbsag = $data['total_hbsag'] == '0' ? '' : $data['total_hbsag'];
        $total_antihivr2 = $data['total_antihivr2'] == '0' ? '' : $data['total_antihivr2'];
        $total_antihivr3 = $data['total_antihivr3'] == '0' ? '' : $data['total_antihivr3'];
        $total_widal = $data['total_widal'] == '0' ? '' : $data['total_widal'];
        $total_ns1dbd = $data['total_ns1dbd'] == '0' ? '' : $data['total_ns1dbd'];
        $total_igmdbd = $data['total_igmdbd'] == '0' ? '' : $data['total_igmdbd'];
        $total_iggdbd = $data['total_iggdbd'] == '0' ? '' : $data['total_iggdbd'];
        $total_guladarahsewaktu = $data['total_guladarahsewaktu'] == '0' ? '' : $data['total_guladarahsewaktu'];
        $total_guladarahpuasa = $data['total_guladarahpuasa'] == '0' ? '' : $data['total_guladarahpuasa'];
        $total_guladarah2jamp = $data['total_guladarah2jamp'] == '0' ? '' : $data['total_guladarah2jamp'];
        $total_kolesteroltotal = $data['total_kolesteroltotal'] == '0' ? '' : $data['total_kolesteroltotal'];
        $total_asamurat = $data['total_asamurat'] == '0' ? '' : $data['total_asamurat'];
        $total_bta = $data['total_bta'] == '0' ? '' : $data['total_bta'];
        // $total_trigliserida = $data['total_trigliserida'];
        // $total_hdl = $data['total_hdl'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    @media print {
        @page {
            size: A4 landscape;
            margin:32px;
        }
    }


    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    table{
        width: 100%;
    }
    table, tr, td, th{
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td{
        padding: 0 4px;
    }
    #second-row th {
    writing-mode: vertical-rl;
    white-space: wrap;
    height: 80px;
}

    </style>
</head>
<body>
    <h3 style="text-align: center;">REKAPITULASI PEMERIKSAAN LABORATORIUM</h3>
    <p>Bulan : 
    <?php
    // Tanggal dalam format YYYY-MM
    $date = $_GET['bulan'];

    // Mengubah string menjadi objek DateTime
    $dateTime = DateTime::createFromFormat('Y-m', $date);

    // Mengubah format tanggal menjadi "F Y" (Bulan Penuh Tahun)
    $formattedDate = $dateTime->format('F Y');

    // Mengganti nama bulan ke dalam Bahasa Indonesia
    $bulanInggris = array(
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    );

    $bulanIndonesia = array(
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    );

    $formattedDate = str_replace($bulanInggris, $bulanIndonesia, $formattedDate);

    echo $formattedDate;
    ?>

    </p>
    <table id="mytable" class="display print">
        <thead>
            <tr>
                <th rowspan="2">Tanggal</th>
                <th id="jenis-pemeriksaan">Jenis Pemeriksaan</th>
                <th rowspan="2">Jumlah</th>
            </tr>
            <tr id="second-row">
                <th>Hb</th>
                <th>Hematologi rutin</th>
                <th>LED</th>
                <th>Golongan Darah</th>
                <th>Urin Lengkap</th>
                <th>Protein</th>
                <th>Tes Kehamilan</th>
                <th>BTA</th>
                <th>Faeces</th>
                <th>Anti HIV</th>
                <th>Sifilis/TP Rapid</th>
                <th>HBsAg</th>
                <th>Anti HIV (R2)</th>
                <th>Anti HIV (R3)</th>
                <th>Widal</th>
                <th>NS1</th>
                <th>IgM DBD</th>
                <th>IgG DBD</th>
                <th>Gula Darah Sewaktu</th>
                <th>Gula Darah Puasa</th>
                <th>Gula Darah 2 Jam PP</th>
                <th>Kolesterol Total</th>
                <th>Asam Urat</th>
                <th>Trigliserida</th>
                <th>HDL</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_GET['tanggal'])){
            $tanggal = ($_GET['tanggal']=='') ? $tanggal = date('Y-m') : $_GET['tanggal'];
        }else{
            $tanggal = date('Y-m');
        }
        // $tanggal=(isset($_GET["bulan"]))? $_GET['bulan']:'';

        list($year, $month) = explode('-', $tanggal);

        // Mengubah ke integer
        $year = intval($year);
        $month = intval($month);
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = DateTime::createFromFormat('Y-m-d', "$year-$month-$day");
            $hariIni = $date->format('Y-m-d');
            include('../include/config.php');
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
            WHERE tanggal = '$hariIni'
            GROUP BY tanggal 
            ORDER BY hemoglobin, leukosit, trombosit";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {

                }
            }
            echo "<tr>";
            echo "<th style='text-align:center;'>".$date->format('d') . "</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "</tr>";
        }
        echo "<tr>";
        echo "<th style='text-align:center'>Jumlah</th>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
        ?>
        </tbody>
        </thead>
    </table>
    <script>
    const jenisPemeriksaanTh = document.getElementById('jenis-pemeriksaan');
    const secondRowThCount = document.getElementById('second-row').getElementsByTagName('th').length;
    console.log(secondRowThCount);
    // Perbarui atribut colspan dengan nilai yang dihitung
    jenisPemeriksaanTh.colSpan = secondRowThCount;
    // window.onload = function() {
    //   window.print();
    //   window.onafterprint = function() {
    //     window.close();
    //   };
    // };
  </script>
</body>
</html>
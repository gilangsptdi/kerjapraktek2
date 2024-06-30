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
        text-align: center;
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
            $tgl = $_GET['bulan']."-".$date->format('d');
            include('../include/config.php');
            include('../actions/rekapitulasi.php');
            
            echo "<tr>";
            echo "<th style='text-align:center;'>".$date->format('d') . "</th>";
            echo "<td>".$total_hemoglobin."</td>";
            echo "<td></td>";
            echo "<td>".$total_led."</td>";
            echo "<td>".$total_golongandarah."</td>";
            echo "<td>".$total_urin_lengkap."</td>";
            echo "<td>".$total_protein."</td>";
            echo "<td>".$total_teskehamilan."</td>";
            echo "<td>".$total_bta."</td>";
            echo "<td></td>";
            echo "<td>".$total_antihiv."</td>";
            echo "<td>".$total_sifilistprapid."</td>";
            echo "<td>".$total_hbsag."</td>";
            echo "<td>".$total_antihivr2."</td>";
            echo "<td>".$total_antihivr3."</td>";
            echo "<td>".$total_widal."</td>";
            echo "<td>".$total_ns1dbd."</td>";
            echo "<td>".$total_igmdbd."</td>";
            echo "<td>".$total_iggdbd."</td>";
            echo "<td>".$total_guladarahsewaktu."</td>";
            echo "<td>".$total_guladarahpuasa."</td>";
            echo "<td>".$total_guladarah2jamp."</td>";
            echo "<td>".$total_kolesteroltotal."</td>";
            echo "<td>".$total_asamurat."</td>";
            echo "<td></td>";
            echo "<td></td>";
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
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
        font-size: 11pt;
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
        $jumlah_hemoglobin = 0;
        $jumlah_led = 0;
        $jumlah_golongandarah = 0;
        $jumlah_urin_lengkap = 0;
        $jumlah_protein = 0;
        $jumlah_teskehamilan = 0;
        $jumlah_bta = 0;
        $jumlah_antihiv = 0;
        $jumlah_sifilistprapid = 0;
        $jumlah_hbsag = 0;
        $jumlah_antihivr2 = 0;
        $jumlah_antihivr3 = 0;
        $jumlah_widal = 0;
        $jumlah_ns1dbd = 0;
        $jumlah_igmdbd = 0;
        $jumlah_iggdbd = 0;
        $jumlah_guladarahsewaktu = 0;
        $jumlah_guladarahpuasa = 0;
        $jumlah_guladarah2jamp = 0;
        $jumlah_kolesteroltotal = 0;
        $jumlah_asamurat = 0;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = DateTime::createFromFormat('Y-m-d', "$year-$month-$day");
            $tgl = $_GET['bulan']."-".$date->format('d');
            include('../include/config.php');
            include('../actions/rekapitulasi.php');
            $totals = [
                $total_hemoglobin,
                $total_led,
                $total_golongandarah,
                $total_urin_lengkap,
                $total_protein,
                $total_teskehamilan,
                $total_bta,
                $total_antihiv,
                $total_sifilistprapid,
                $total_hbsag,
                $total_antihivr2,
                $total_antihivr3,
                $total_widal,
                $total_ns1dbd,
                $total_igmdbd,
                $total_iggdbd,
                $total_guladarahsewaktu,
                $total_guladarahpuasa,
                $total_guladarah2jamp,
                $total_kolesteroltotal,
                $total_asamurat
            ];
            
            $jumlah_total = 0;
            
            foreach ($totals as $total) {
                if ($total != '') {
                    $jumlah_total += $total;
                }
            }
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
            echo "<td>".$jumlah_total."</td>";
            echo "</tr>";
            $jumlah_hemoglobin += ($total_hemoglobin != '') ? $total_hemoglobin : 0;
            $jumlah_led += ($total_led != '') ? $total_led : 0;
            $jumlah_golongandarah += ($total_golongandarah != '') ? $total_golongandarah : 0;
            $jumlah_urin_lengkap += ($total_urin_lengkap != '') ? $total_urin_lengkap : 0;
            $jumlah_protein += ($total_protein != '') ? $total_protein : 0;
            $jumlah_teskehamilan += ($total_teskehamilan != '') ? $total_teskehamilan : 0;
            $jumlah_bta += ($total_bta != '') ? $total_bta : 0;
            $jumlah_antihiv += ($total_antihiv != '') ? $total_antihiv : 0;
            $jumlah_sifilistprapid += ($total_sifilistprapid != '') ? $total_sifilistprapid : 0;
            $jumlah_hbsag += ($total_hbsag != '') ? $total_hbsag : 0;
            $jumlah_antihivr2 += ($total_antihivr2 != '') ? $total_antihivr2 : 0;
            $jumlah_antihivr3 += ($total_antihivr3 != '') ? $total_antihivr3 : 0;
            $jumlah_widal += ($total_widal != '') ? $total_widal : 0;
            $jumlah_ns1dbd += ($total_ns1dbd != '') ? $total_ns1dbd : 0;
            $jumlah_igmdbd += ($total_igmdbd != '') ? $total_igmdbd : 0;
            $jumlah_iggdbd += ($total_iggdbd != '') ? $total_iggdbd : 0;
            $jumlah_guladarahsewaktu += ($total_guladarahsewaktu != '') ? $total_guladarahsewaktu : 0;
            $jumlah_guladarahpuasa += ($total_guladarahpuasa != '') ? $total_guladarahpuasa : 0;
            $jumlah_guladarah2jamp += ($total_guladarah2jamp != '') ? $total_guladarah2jamp : 0;
            $jumlah_kolesteroltotal += ($total_kolesteroltotal != '') ? $total_kolesteroltotal : 0;
            $jumlah_asamurat += ($total_asamurat != '') ? $total_asamurat : 0;
        }
        $jmlBaris = $jumlah_hemoglobin +
            $jumlah_led +
            $jumlah_golongandarah +
            $jumlah_urin_lengkap +
            $jumlah_protein +
            $jumlah_teskehamilan +
            $jumlah_bta +
            $jumlah_antihiv +
            $jumlah_sifilistprapid +
            $jumlah_hbsag +
            $jumlah_antihivr2 +
            $jumlah_antihivr3 +
            $jumlah_widal +
            $jumlah_ns1dbd +
            $jumlah_igmdbd +
            $jumlah_iggdbd +
            $jumlah_guladarahsewaktu +
            $jumlah_guladarahpuasa +
            $jumlah_guladarah2jamp +
            $jumlah_kolesteroltotal +
            $jumlah_asamurat;

        echo "<tr>";
        echo "<th style='text-align:center'>Jumlah</th>";
        echo "<td>".$jumlah_hemoglobin."</td>";
        echo "<td></td>";
        echo "<td>".$jumlah_led."</td>";
        echo "<td>".$jumlah_golongandarah."</td>";
        echo "<td>".$jumlah_urin_lengkap."</td>";
        echo "<td>".$jumlah_protein."</td>";
        echo "<td>".$jumlah_teskehamilan."</td>";
        echo "<td>".$jumlah_bta."</td>";
        echo "<td></td>";
        echo "<td>".$jumlah_antihiv."</td>";
        echo "<td>".$jumlah_sifilistprapid."</td>";
        echo "<td>".$jumlah_hbsag."</td>";
        echo "<td>".$jumlah_antihivr2."</td>";
        echo "<td>".$jumlah_antihivr3."</td>";
        echo "<td>".$jumlah_widal."</td>";
        echo "<td>".$jumlah_ns1dbd."</td>";
        echo "<td>".$jumlah_igmdbd."</td>";
        echo "<td>".$jumlah_iggdbd."</td>";
        echo "<td>".$jumlah_guladarahsewaktu."</td>";
        echo "<td>".$jumlah_guladarahpuasa."</td>";
        echo "<td>".$jumlah_guladarah2jamp."</td>";
        echo "<td>".$jumlah_kolesteroltotal."</td>";
        echo "<td>".$jumlah_asamurat."</td>";
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
    jenisPemeriksaanTh.colSpan = secondRowThCount;

    function calculateTotals() {
            const table = document.getElementById('mytable');
            const tbody = table.querySelector('tbody');
            const tfoot = table.querySelector('tfoot tr');

            const totals = Array.from({ length: 26 }, () => 0);

            for (let row of tbody.rows) {
                for (let i = 1; i < row.cells.length; i++) {
                    totals[i - 1] += parseInt(row.cells[i].textContent);
                }
            }

            for (let i = 1; i < tfoot.cells.length; i++) {
                tfoot.cells[i].textContent = totals[i - 1];
            }
        }

        // Panggil fungsi saat halaman selesai dimuat
        window.onload = calculateTotals;

    window.onload = function() {
      window.print();
      window.onafterprint = function() {
        window.close();
      };
    };
  </script>
</body>
</html>
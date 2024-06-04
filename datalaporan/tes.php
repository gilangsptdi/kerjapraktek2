<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <style>
    @media print {
      @page {
        size: B5;
        margin: 0;
      }
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      padding: 24px;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
      border: 1px solid black;
    }

    .header {
      display: flex;
      flex-direction: row;
    }

    .header div {
      border: 1px solid black;
      width: calc(100% / 3);
      height: 100px;
      padding: 8px;
    }

    div.header-dokter {
      /* border: 1px solid black; */
      height: 100px;
      padding: 4px;
    }

    .dokter {
      border: 1px solid black;
      width: calc(100% / 3);
      height: 100%;
      margin-left: auto;
    }

    .column {
      display: flex;
    }

    .col {
      /* border: 1px solid black; */
      display: flex;
      width: calc(100% / 2);
      /* height: 500px; */
    }

    table {
      border-collapse: collapse;
      margin: 4px;
      width: 100%;
    }

    table,
    th,
    td {
      border: 1px solid black;
      font-size: 10px;
    }

    th,
    td {
      padding: 0 8px;
    }

    tr td:nth-child(1) {
      text-align: center;
    }

    th {
      font-weight: bold;
    }

    .brand,
    .title {
      display: flex;
      gap: 4px;
      text-align: center;
      align-items: center;
    }

    div.brand {
      border-top: none;
      border-left: none;
      border-right: none;
    }

    div.title {
      border-top: none;
    }

    div .logo {
      width: 80px;
      height: 80px;
      border: none;
    }

    div .logo img {
      width: 50px;
      height: 50px;
      object-fit: contain;
      filter: grayscale(100%);
    }

    div.jalan,
    div.text {
      border: none;
    }

    div.text {
      width: 100%;
      height: 100%;
      padding: 0;
    }

    div.jalan {
      font-size: 8px;
      width: 100%;
      height: 100%;
      padding: 0;
    }

    div.form-pasien {
      padding: 8px;
      display: flex;
      align-items: flex-start;
      border-top: none;
      border-right: none;
      border-left: none;
      /* justify-content: center; */
    }

    div.form-pasien table,
    div.form-pasien tr,
    div.form-pasien td {
      border: none;
      /* display: flex; */
      text-align: start;
    }

    div.form-pasien td:nth-child(1) {
      width: 80px;
    }

    div.form-pasien td {
      padding: 0;
      font-size: 10px;
      font-weight: 500;
    }

    div.form-sample {
      padding: 8px;
      display: flex;
      align-items: flex-start;
      border-top: none;
      border-right: none;
      border-left: none;
      /* justify-content: center; */
    }

    div.form-sample table,
    div.form-sample tr,
    div.form-sample td {
      border: none;
      /* display: flex; */
      text-align: start;
    }

    div.form-sample td:nth-child(1) {
      width: 150px;
    }

    div.form-sample td {
      padding: 0;
      font-size: 10px;
      font-weight: 500;
    }

    .footer {
      display: flex;
    }

    .footer .form-sample {
      width: 70%;
    }

    .ttd table,
    .ttd tr,
    .ttd td {
      border: none;
    }

    .kotak-ttd {
      height: 50px;
    }

    .kotak-ttd td:nth-child(3) {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <div class="brand">
        <div class="logo">
          <img src="../assets/img/puskesmas logo.png" alt="">
        </div>
        <div class="text">
          <h5>UPTD</h5>
          <h5>PUSKESMAS SINDANGKASIH</h5>
          <div class="jalan">
            Jl. Lorem ipsum, dolor sit amet consectetur adipisicing elit.
          </div>
        </div>
      </div>
      <div class="title">
        <h4>FORMULIR HASIL PEMERIKSAAN LABORATORIUM</h4>
      </div>
      <div class="form-pasien">
        <table>
          <tr>
            <td>No. Register Lab</td>
            <td>:</td>
            <td><?php
                include('../include/config.php');
                $kode = $_GET['kode'];
                $sql = "SELECT * FROM laporan_lab WHERE kode_laporan='" . $kode . "'";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                  while ($data = mysqli_fetch_array($query)) {
                    echo $data['no_registrasi'];
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Tanggal</td>";
                    echo "<td>:</td>";
                    $sql2 = "SELECT * FROM data_pasien WHERE no_registrasi='" . $data['no_registrasi'] . "'";
                    $query2 = mysqli_query($conn, $sql2);
                    if (mysqli_num_rows($query2) > 0) {
                      while ($data2 = mysqli_fetch_array($query2)) {
                        echo "<td>" . date("d-m-Y", strtotime($data2['tanggal_pemeriksaan'])) . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Nama</td>";
                        echo "<td>:</td>";
                        echo "<td>" . $data2['nama'] . "</td>";
                        echo "</tr>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Umur</td>";
                        echo "<td>:</td>";
                        echo "<td>" . $data2['umur'] . " Tahun</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Alamat</td>";
                        echo "<td>:</td>";
                        echo "<td>" . $data2['alamat'] . "</td>";
                        echo "</tr>";
                      }
                    }
                  }
                }
                ?>
        </table>
      </div>
    </div>
    <div class="form-pasien">
      <div class="dokter">
        <table>
          <tr>
            <td>Dokter Pengirim</td>
            <td>:</td>
            <td></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td></td>
          </tr>
          <tr>
            <td>Unit Pelayanan</td>
            <td>:</td>
            <td></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="column">
      <div class="col">
        <table>
          <thead>
            <th>NO</th>
            <th>JENIS PEMERIKSAAN</th>
            <th>HASIL</th>
            <th>NILAI RUJUKAN</th>
            <th>SATUAN</th>
          </thead>
          <tbody>
            <tr>
              <th>1</th>
              <td><b>HEMATOLOGI</b></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Hemoglobin</td>
              <?php
              include('../actions/dataCetak.php');
              ?>
              <td><?php echo $hemoglobin ?></td>
              <td>12-17.4</td>
              <td>g/dl</td>
            </tr>
            <tr>
              <th></th>
              <td>Leukosit</td>
              <td><?php echo $leukosit ?></td>
              <td>5-10</td>
              <td>10 <sup>9</sup>/l</td>
            </tr>
            <tr>
              <th></th>
              <td>Trombosit</td>
              <td><?php echo $trombosit ?></td>
              <td>150-400</td>
              <td>10 <sup>9</sup>/l</td>
            </tr>
            <tr>
              <th></th>
              <td>Eritrosit</td>
              <td><?php echo $eritrosit ?></td>
              <td>4-5.5</td>
              <td>10 <sup>12</sup>/l</td>
            </tr>
            <tr>
              <th></th>
              <td>Hematokrit</td>
              <td><?php echo $hematokrit ?></td>
              <td>36-52</td>
              <td>%</td>
            </tr>
            <tr>
              <th></th>
              <td>Limfosit</td>
              <td><?php echo $limfosit ?></td>
              <td>25-40</td>
              <td>%</td>
            </tr>
            <tr>
              <th></th>
              <td>Monosit</td>
              <td><?php echo $monosit ?></td>
              <td>1.8-17</td>
              <td>%</td>
            </tr>
            <tr>
              <th></th>
              <td>Granulosit</td>
              <td><?php echo $granulosit ?></td>
              <td>50-70</td>
              <td>%</td>
            </tr>
            <tr>
              <th></th>
              <td>LED</td>
              <td><?php echo $led ?></td>
              <td>0-20</td>
              <td>mm/jam</td>
            </tr>
            <tr>
              <th></th>
              <td>Golongan Darah</td>
              <td><?php echo $golongandarah ?></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th>2</th>
              <td><b>URINE</b></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Microskopis:</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Warna</td>
              <td><?php echo $warna ?></td>
              <td>Kuning</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Kejernihan</td>
              <td><?php echo $kejernihan ?></td>
              <td>Jernih</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>pH</td>
              <td><?php echo $ph ?></td>
              <td>5.0-9.0</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Berat Jenis</td>
              <td><?php echo $beratjenis ?></td>
              <td>1.002-1.035</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>protein</td>
              <td><?php echo $protein ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Glukosa</td>
              <td><?php echo $glukosa ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Bilirubin</td>
              <td><?php echo $bilirubin ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Urobilinogen</td>
              <td><?php echo $urobilinogen ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Keton</td>
              <td><?php echo $keton ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Nitrit</td>
              <td><?php echo $nitrit ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Leukosit</td>
              <td><?php echo $leukosittt ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Eritrosit</td>
              <td><?php echo $eritrosittt ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Sedimen:</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Eritrosit</td>
              <td><?php echo $eritrositt ?></td>
              <td>0-2</td>
              <td>/lp</td>
            </tr>
            <tr>
              <th></th>
              <td>-Leukosit</td>
              <td><?php echo $leukositt ?></td>
              <td>0-2</td>
              <td>/lp</td>
            </tr>
            <tr>
              <th></th>
              <td>-Epitel</td>
              <td><?php echo $epitel ?></td>
              <td>5-15</td>
              <td>/lp</td>
            </tr>
            <tr>
              <th></th>
              <td>-Kristal</td>
              <td><?php echo $kristal ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Silinder</td>
              <td><?php echo $silinder ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Tes Kehamilan</td>
              <td><?php echo $teskehamilan ?></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col">
        <table>
          <thead>
            <th>NO</th>
            <th>JENIS PEMERIKSAAN</th>
            <th>HASIL</th>
            <th>NILAI RUJUKAN</th>
          </thead>
          <tbody>
            <tr>
              <th>3.</th>
              <td><b>MICROBIOLOGI</b></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>BTA</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Pagi</td>
              <td><?php echo $pagi ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>-Sewaktu</td>
              <td><?php echo $sewaktu ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th>4</th>
              <td><b>IMUNOSEROLOGI</b></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Anti HIV</td>
              <td><?php echo $antihiv ?></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Sifilis/TP Rapid</td>
              <td><?php echo $sifilistprapid ?></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>HBSAg</td>
              <td><?php echo $hbsag ?></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Anti HIV (R2)</td>
              <td><?php echo $antihivr2 ?></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Anti HIV (R3)</td>
              <td><?php echo $antihivr3 ?></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Widal :</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. typhi O</td>
              <td><?php echo $styphio ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi AO</td>
              <td><?php echo $sparatyphiao ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi BO</td>
              <td><?php echo $sparatyphibo ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi CO</td>
              <td><?php echo $sparatyphico ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. typhi H</td>
              <td><?php echo $styphih ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi AH</td>
              <td><?php echo $sparatyphiah ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi BH</td>
              <td><?php echo $sparatyphibh ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>- S. paratyphi CH</td>
              <td><?php echo $sparatyphich ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>NS1 DBD</td>
              <td><?php echo $ns1dbd ?></td>
              <td>Negatif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>IgG/DBD</td>
              <td><?php echo $iggdbd ?></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Igm/DBD</td>
              <td><?php echo $igmdbd ?></td>
              <td>Non reaktif</td>
              <td></td>
            </tr>
            <tr>
              <th>5</th>
              <td><b>KIMIA KLINIK</b></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th></th>
              <td>Gula darah sewaktu</td>
              <td><?php echo $guladarahsewaktu ?></td>
              <td>
                < 200</td>
              <td>mg/dl</td>
            </tr>
            <tr>
              <th></th>
              <td>Gula darah puasa</td>
              <td><?php echo $guladarahpuasa ?></td>
              <td>70 - 100</td>
              <td>mg/dl</td>
            </tr>
            <tr>
              <th></th>
              <td>Gula darah 2 jam PP</td>
              <td><?php echo $guladarah2jamp ?></td>
              <td>
                < 160</td>
              <td>mg/dl</td>
            </tr>
            <tr>
              <th></th>
              <td>Kolesterol Total</td>
              <td><?php echo $kolesteroltotal ?></td>
              <td>
                < 200</td>
              <td>mg/dl</td>
            </tr>
            <tr>
              <th></th>
              <td>Asam Urat</td>
              <td><?php echo $asamurat ?></td>
              <td>L: 3.4 - 7</td>
              <td>mg/dl</td>
            </tr>
            <tr>
              <th></th>
              <td></td>
              <td></td>
              <td>P: 2.4 - 6</td>
              <td>mg/dl</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="footer">
      <div class="form-sample">
        <table>
          <tr>
            <td>Tgl/Jam pengambilan sample</td>
            <td>:</td>
            <td>..../..../....</td>
          </tr>
          <tr>
            <td>Tgl/Jam pemeriksaan selesai</td>
            <td>:</td>
            <td>..../..../....</td>
          </tr>
        </table>
      </div>
      <div class="ttd">
        <table>
          <tr>
            <td>Pemeriksa</td>
          </tr>
          <tr>
            <td class="kotak-ttd"></td>
          </tr>
          <tr>
            <td>Heni Ekasari</td>
          </tr>
          <tr>
            <td>NIP. 129043175919</td>
          </tr>
        </table>
      </div>
    </div>
  </div>

  <script>
    window.onload = function() {
      window.print();
      window.onafterprint = function() {
        window.close();
      };
    };
  </script>
</body>

</html>
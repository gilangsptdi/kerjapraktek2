<?php
include('../include/config.php');
function bulanRomawi($bulan)
{
    $bulanRomawiArray = [
        1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
        5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
        9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
    ];
    return $bulanRomawiArray[$bulan];
}
// Mendapatkan bulan dan tahun saat ini
$currentMonth = bulanRomawi (date('n')); // Format bulan dengan dua digit (01-12)
$currentYear = date('Y');  // Format tahun dengan empat digit (YYYY)

// Menyiapkan pola pencarian
$pattern = "pum-lab/{$currentMonth}/{$currentYear}";

// Query untuk mencari data yang sesuai dengan pola
$sql = "SELECT no_registrasi FROM data_pasien WHERE no_registrasi LIKE '%$pattern' ORDER BY no_registrasi DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mengambil data terakhir yang ditemukan
    $row = $result->fetch_assoc();
    // Mengambil angka dari no_registrasi terakhir
    preg_match('/^(\d+)\//', $row['no_registrasi'], $matches);
    $lastNumber = $matches[1];
    // Menambah 1 pada angka terakhir
    $newNumber = $lastNumber + 1;
} else {
    // Jika tidak ada data yang sesuai, mulai dari 128
    $newNumber = 1;
}

// Membuat no_registrasi baru
$noreg= "{$newNumber}/pum-lab/{$currentMonth}/{$currentYear}";

// Awal Kode Lapor
$sqlLapor = "SELECT kode_laporan FROM laporan_lab ORDER BY kode_laporan DESC LIMIT 1";
$resultLapor = $conn->query($sqlLapor);

if ($resultLapor->num_rows > 0) {
    $rowLapor = $resultLapor->fetch_assoc();
    $last_codeLapor = $rowLapor['kode_laporan'];
    
    $last_numberLapor = (int)substr($last_codeLapor, 1);
} else {
    $last_numberLapor = 0;
}

$new_numberLapor = $last_numberLapor + 1;

$kode_laporan = 'LP' . str_pad($new_numberLapor, 3, '0', STR_PAD_LEFT);
// Akhir Kode Lapor
?>
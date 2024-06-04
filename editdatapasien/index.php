<?php
include('../include/config.php');
include('../actions/MySQLSessionHandler.php');

session_set_save_handler(new MySQLSessionHandler($conn), true);
session_start();

if (!isset($_SESSION['kode_user'])) {
    header('Location: ../?status=loginGagal');
    exit;
}

if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];
    $sql = "SELECT * FROM data_pasien WHERE no_registrasi = '$kode'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Biodata Pasien</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <!-- Content -->
    <div class="form-container">
        <div class="row">
            <div class="card">
                <div class="">
                    <h2 class="bio">Update Biodata Pasien</h2>
                    <form action="../actions/updatepasien.php" method="POST" onsubmit="return validateForm(event);">
                        <div class="row">
                            <label for="noreg">No. Registrasi Lab</label>
                            <input type="text" value="<?php echo $data['no_registrasi']; ?>" disabled>
                            <input type="hidden" name="noreg" value="<?php echo $data['no_registrasi']; ?>">
                        </div>
                        <div class="row">
                            <label for="tanggal">Tanggal Pemeriksaan</label>
                            <input type="date" id="tanggal" name="tanggal" value="<?php echo $data['tanggal_pemeriksaan']; ?>">
                        </div>
                        <div class="row">
                            <label for="nama">Nama</label>
                            <input name="nama" type="text" value="<?php echo $data['nama']; ?>">
                        </div>
                        <div class="row">
                            <label for="umur">Umur</label>
                            <input name="umur" type="number" value="<?php echo $data['umur']; ?>">
                        </div>
                        <div class="row center">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                            <input id="lakilaki" value="laki-laki" type="radio" name="jeniskelamin" <?php if ($data['jenis_kelamin'] == 'laki-laki') echo 'checked'; ?>>
                            <label for="lakilaki">Laki-laki</label>
                            <input id="perempuan" value="perempuan" type="radio" name="jeniskelamin" <?php if ($data['jenis_kelamin'] == 'perempuan') echo 'checked'; ?>>
                            <label for="perempuan">Perempuan</label>
                        </div>
                        <div class="row">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" rows="3"><?php echo $data['alamat']; ?></textarea>
                        </div>
                        <input type="submit" name="update" value="Update" class="simpan">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content -->
    <?php include('../actions/cekStatus.php'); ?>
    <script src="../assets/js/script.js"></script>
    <script>
        function validateForm(event) {
            var tanggal = document.getElementById('tanggal').value;
            var nama = document.querySelector('input[name="nama"]').value;
            var umur = document.querySelector('input[name="umur"]').value;
            var jeniskelamin = document.querySelector('input[name="jeniskelamin"]:checked');
            var alamat = document.querySelector('textarea[name="alamat"]').value;

            if (!tanggal || !nama || !umur || !jeniskelamin || !alamat) {
                alert("Semua harus diisi.");
                event.preventDefault();
                return false;
            }
            return true;
        }

        document.addEventListener("DOMContentLoaded", function() {
            var form = document.querySelector('form');
            form.addEventListener('submit', validateForm);
        });
    </script>
</body>

</html>
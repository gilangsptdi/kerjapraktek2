<?php
include ('../include/config.php');
include('../actions/MySQLSessionHandler.php');

// Initialize session handler and start session
session_set_save_handler(new MySQLSessionHandler($conn), true);
session_start();

// Check if user is logged in
if (!isset($_SESSION['kode_user'])) {
    header('Location: ../?status=loginGagal');
    exit;
}

$success = false; // Variable to track update status

if (isset($_POST['update'])) {
    // Retrieve form data
    $noreg = $_POST['noreg'];
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $alamat = $_POST['alamat'];

    // Update query
    $sql = "UPDATE data_pasien SET 
            tanggal_pemeriksaan = ?, 
            nama = ?, 
            umur = ?, 
            jenis_kelamin = ?, 
            alamat = ? 
            WHERE no_registrasi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisss", $tanggal, $nama, $umur, $jeniskelamin, $alamat, $noreg);

    // Execute the query
    if ($stmt->execute()) {
        $success = true; // Set success to true if the update was successful
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch data for the given registration code
if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];
    $sql = "SELECT * FROM data_pasien WHERE no_registrasi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $kode);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Biodata Pasien</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="form-container">
        <div class="row">
            <div class="card">
                <div class="">
                    <h2 class="bio">Update Biodata Pasien</h2>
                    <form action="" method="POST">
                        <div class="row">
                            <label for="noreg">No. Registrasi Lab</label>
                            <input type="text" value="<?php echo $data['no_registrasi'] ?>" disabled>
                            <input type="hidden" name="noreg" value="<?php echo $data['no_registrasi'] ?>">
                        </div>
                        <div class="row">
                            <label for="tanggal">Tanggal Pemeriksaan</label>
                            <input type="date" id="tanggal" name="tanggal" value="<?php echo $data['tanggal_pemeriksaan'] ?>">
                        </div>
                        <div class="row">
                            <label for="nama">Nama</label>
                            <input name="nama" type="text" value="<?php echo $data['nama'] ?>">
                        </div>
                        <div class="row">
                            <label for="umur">Umur</label>
                            <input name="umur" type="number" value="<?php echo $data['umur'] ?>">
                        </div>
                        <div class="row center">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                            <input id="lakilaki" value="laki-laki" type="radio" name="jeniskelamin" <?php echo ($data['jenis_kelamin'] == 'laki-laki') ? 'checked' : '' ?>>
                            <label for="lakilaki">Laki-laki</label>
                            <input id="perempuan" value="perempuan" type="radio" name="jeniskelamin" <?php echo ($data['jenis_kelamin'] == 'perempuan') ? 'checked' : '' ?>>
                            <label for="perempuan">Perempuan</label>
                        </div>
                        <div class="row">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" rows="3"><?php echo $data['alamat'] ?></textarea>
                        </div>

                        <input type="submit" name="update" value="Update" class="simpan">
                    </form>
                </div>
                <a href="#" type="button" class="btn btn-success" style="width: 20%;">Edit Data</a>
            </div>
        </div>
    </div>

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

        <?php if ($success) { ?>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data pasien berhasil diperbarui.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../datapasien/index.php'; // Redirect to the desired page
                }
            });
        <?php } ?>
    </script>
</body>

</html>

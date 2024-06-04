<?php
    if(isset($_GET['status'])){
        if ($_GET['status'] == 'sukses'){
            echo "<script>
            Swal.fire({  
                title: 'SUKSES!',
                text: 'Data Berhasil ditambahkan.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            </script>";
        }
        if ($_GET['status'] == 'hapussukses'){
            echo "<script>
            Swal.fire({  
                title: 'SUKSES!',
                text: 'Data Berhasil Dihapus.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            </script>";
        }
    }
    ?>
<?php

$bukuid = $_GET['bukuid'];


include '../koneksi.php';

$sql = "DELETE FROM buku WHERE bukuid = '$bukuid'";
$query = mysqli_query($koneksi, $sql);
if ($query) {
    echo "<script>
    document.location.href = 'fiksi.php';
    </script>";
} else {
    echo "<script>
    alert('Maaf Data Tidak Terhapus');
    document.location.href = 'fiksi.php';
    </script>";
}

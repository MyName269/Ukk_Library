<?php

$kategoriid = $_GET['kategoriid'];


include '../koneksi.php';

$sql = "DELETE FROM kategoribuku WHERE kategoriid = '$kategoriid'";
$query = mysqli_query($koneksi, $sql);
if ($query) {
    echo "<script>
    document.location.href = 'kategori.php';
    </script>";
} else {
    echo "<script>
    alert('Maaf Data Tidak Terhapus');
    document.location.href = 'kategori.php';
    </script>";
}

<?php

$peminjamanid = $_GET['peminjamanid'];


include '../koneksi.php';

$sql = "DELETE FROM peminjam WHERE peminjamanid = '$peminjamanid'";
$query = mysqli_query($koneksi, $sql);
if ($query) {
    echo "<script>
    document.location.href = 'peminjaman.php';
    </script>";
} else {
    echo "<script>
    alert('Maaf Data Tidak Terhapus');
    document.location.href = 'peminjaman.php';
    </script>";
}

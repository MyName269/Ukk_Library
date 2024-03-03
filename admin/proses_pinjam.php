<?php

$userid = $_POST['userid'];
$bukuid = $_POST['bukuid'];
$tanggalpeminjaman = $_POST['tanggalpeminjaman'];
$tanggalpengembalian = $_POST['tanggalpengembalian'];
$statuspeminjaman = $_POST['statuspeminjaman'];

include '../koneksi.php';
$sql = "INSERT INTO peminjam (userid,bukuid,tanggalpeminjaman,tanggalpengembalian,statuspeminjaman) VALUES('$userid', '$bukuid', '$tanggalpeminjaman', '$tanggalpengembalian', '$statuspeminjaman')";
$query = mysqli_query($koneksi, $sql);
if($query){
    echo "<script>
    document.location.href = 'peminjaman.php';
    </script>";
} else {
    echo "<script>
    alert('Maaf Data Tidak Tersimpan');
    document.location.href = 'peminjaman.php';
    </script>";
}

?>
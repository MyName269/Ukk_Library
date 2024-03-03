<?php
// koneksi database
include '../koneksi.php';

// failed file

// mengambil data yg akan dikirm ke database
$userid = $_POST['userid'];
$bukuid = $_POST['bukuid'];
$tanggalpeminjaman = $_POST['tanggalpeminjaman'];
$tanggalpengembalian = $_POST['tanggalpengembalian'];
$statuspeminjaman = $_POST['statuspeminjaman'];

mysqli_query($koneksi, "INSERT INTO peminjam (bukuid,userid,tanggalpeminjaman,tanggalpengembalian,statuspeminjaman) VALUES('$userid','$bukuid','$tanggalpeminjaman','$tanggalpengembalian','$statuspeminjaman')");

// mengalihkan halaman buku
header("location:pinjam1.php");
?>
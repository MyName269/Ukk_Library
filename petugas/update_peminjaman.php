<?php
// Koneksi ke database (gantilah nilai-nilai ini sesuai dengan pengaturan database Anda)
include '../koneksi.php';

// Ambil data dari formulir
$peminjamanid = $_POST['peminjamanid'];
$tanggalpeminjaman = $_POST['tanggalpeminjaman'];
$tanggalpengembalian = $_POST['tanggalpengembalian'];
$statuspeminjaman = $_POST['statuspeminjaman'];

// Query SQL untuk memperbarui data anggota
$sql = "UPDATE peminjam SET tanggalpeminjaman='$tanggalpeminjaman', tanggalpengembalian='$tanggalpengembalian', statuspeminjaman='$statuspeminjaman' WHERE peminjamanid=$peminjamanid";

if ($koneksi->query($sql) === TRUE) {
    echo "<script>
    document.location.href = 'peminjaman.php';
    </script>";
} else {
    echo "<script>
    document.location.href = 'peminjaman.php';
    </script>";
}
?>
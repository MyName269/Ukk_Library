<?php
// Koneksi ke database (gantilah nilai-nilai ini sesuai dengan pengaturan database Anda)
include '../koneksi.php';

// Ambil data dari formulir
$peminjamanid = $_POST['peminjamanid'];
$userid = $_POST['userid'];
$bukuid = $_POST['bukuid'];
$tanggalpeminjaman = $_POST['tanggalpeminjaman'];
$tanggalpengembalian = $_POST['tanggalpengembalian'];
$statuspeminjaman = $_POST['statuspeminjaman'];

// Query SQL untuk memperbarui data anggota
$sql_peminjaman = "UPDATE peminjam SET userid='$userid', bukuid='$bukuid', tanggalpeminjaman='$tanggalpeminjaman', tanggalpengembalian='$tanggalpengembalian', statuspeminjaman='2' WHERE peminjamanid=$peminjamanid";

if ($koneksi->query($sql_peminjaman) === TRUE) {
    // proses penyimpanan riwayat peminjam
    echo '<script language="javascript" type="text/javascript">
              alert("Berhasil dikembalikan.");</script>';
    echo "<meta http-equiv='refresh' content='0; url=buku1.php'>";
} else {
    echo "Gagal menyimpan data pengembalian: " . $koneksi->error;
}

$sql_riwayat ="DELETE FROM riwayat_peminjam WHERE peminjamanid = '$peminjamanid'";
    if ($koneksi->query($sql_riwayat) === TRUE) {
        echo "<meta http-equiv='refresh' content='0; url=buku1.php'>";
    } else {
        echo "Gagal menyimpan riwayat pengembalian: " . $koneksi->error;
    }

// Tutup Koneksi
$koneksi->close();
?>
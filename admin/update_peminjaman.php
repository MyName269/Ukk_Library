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
    alert('Maaf Data Tidak Diubah');
    document.location.href = 'peminjaman.php';
    </script>";
}

$sql_riwayat = "UPDATE riwayat_peminjam SET tanggalpeminjaman='$tanggalpeminjaman', tanggalpengembalian='$tanggalpengembalian', statuspeminjaman='3' WHERE peminjamanid=$peminjamanid";
if ($koneksi->query($sql_riwayat) === TRUE) {
    echo '<script language="javascript" type="text/javascript">
          alert("Data peminjaman berhasil disimpan.");</script>';
    echo "<meta http-equiv='refresh' content='0; url=peminjaman.php'>";
} else {
    echo "Gagal menyimpan riwayat peminjaman: " . $koneksi->error;
}
?>
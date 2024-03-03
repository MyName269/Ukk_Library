<?php
// Koneksi ke database (gantilah nilai-nilai ini sesuai dengan pengaturan database Anda)
include '../koneksi.php';

// Ambil data dari formulir
$userid = $_POST['userid'];
$password = $_POST['password'];

// Query SQL untuk memperbarui data anggota
$sql = "UPDATE user SET password='$password' WHERE userid=$userid";

if ($koneksi->query($sql) === TRUE) {
    echo "<script>
    document.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
    alert('Maaf Data Tidak Terhapus');
    document.location.href = 'index.php';
    </script>";
}
?>
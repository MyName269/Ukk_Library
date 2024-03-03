<?php
session_start();
$userid = $_SESSION['userid'];
$bukuid = $_POST['bukuid'];
$tanggalpeminjaman = date('Y-m-d');
$tanggal_pengembalian_otomatis = date('Y-m-d', strtotime($tanggalpeminjaman . ' + 7 days'));

include'../koneksi.php';
$sql = "SELECT * FROM peminjam WHERE bukuid = '$bukuid' AND userid = '$userid'";
$query = mysqli_num_rows(mysqli_query($koneksi, $sql));
if($query > 0 ){
    echo"<script>
    alert('Buku telah tersedia di Koleksi');
    document.location.href = 'buku1.php';
    </script>";
}else{
    mysqli_query($koneksi, "INSERT INTO peminjam VALUES('', '$userid', '$bukuid', '$tanggalpeminjaman', '$tanggal_pengembalian_otomatis', '1')");
    header("Location:buku1.php");
}
?>
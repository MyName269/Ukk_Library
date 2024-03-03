<?php
session_start();
$userid = $_SESSION['userid'];
$bukuid = $_POST['bukuid'];

include'../koneksi.php';
$sql = "SELECT * FROM koleksipribadi WHERE bukuid = '$bukuid' AND userid = '$userid'";
$query = mysqli_num_rows(mysqli_query($koneksi, $sql));
if($query > 0 ){
    echo"<script>
    alert('Buku telah tersedia di Favorit');
    document.location.href = 'koleksipribadi.php';
    </script>";
}else{
    mysqli_query($koneksi, "INSERT INTO koleksipribadi VALUES('', '$userid', '$bukuid')");
    header("Location:koleksipribadi.php");
}
?>
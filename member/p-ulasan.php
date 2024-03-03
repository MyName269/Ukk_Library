<?php
session_start();
$userid = $_SESSION['userid'];
$bukuid = $_POST['bukuid'];
$ulasan = htmlspecialchars(addslashes($_POST['ulasan']));
$rating = $_POST['rating'];

include'../koneksi.php';
$sql = "SELECT * FROM ulasanbuku WHERE bukuid = '$bukuid' AND userid = '$userid'";
$query = mysqli_num_rows(mysqli_query($koneksi, $sql));
if($query > 0 ){
    echo"<script>
    alert('Review already Exist');
    document.location.href = 'buku1.php';
    </script>";
}else{
    mysqli_query($koneksi, "INSERT INTO ulasanbuku VALUES('', '$userid', '$bukuid', '$ulasan', '$rating')");
    header("Location:buku1.php");
}
?>
<?php
include '../koneksi.php';

$kategoriid = $_POST['kategoriid'];
$namakategori = htmlspecialchars(addslashes($_POST['namakategori']));

$sql = "SELECT * FROM kategoribuku WHERE namakategori = '$namakategori'";
$query = mysqli_num_rows(mysqli_query($koneksi, $sql));
if($query > 0 ){
    echo"<script>
    alert('Category already Exist');
    document.location.href = 'kategori.php';
    </script>";
}else{
    mysqli_query($koneksi, "UPDATE kategoribuku SET namakategori='$namakategori' WHERE kategoriid=$kategoriid");
    header("Location:kategori.php");
}
?>
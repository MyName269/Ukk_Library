<?php
$namakategori = $_POST['namakategori'];

include'../koneksi.php';
$sql = "SELECT * FROM kategoribuku WHERE namakategori = '$namakategori'";
$query = mysqli_num_rows(mysqli_query($koneksi, $sql));
if($query > 0 ){
    echo"<script>
    alert('Category already Exist');
    document.location.href = 'kategori.php';
    </script>";
}else{
    mysqli_query($koneksi, "INSERT INTO kategoribuku VALUES('', '$namakategori')");
    header("Location:kategori.php");
}
?>
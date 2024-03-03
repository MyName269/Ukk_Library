<?php
include 'koneksi.php';

$userid = $_POST['userid'];
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

$password = password_hash($password, PASSWORD_DEFAULT);
$sql = "UPDATE user SET password='$password' WHERE userid='$userid'";
$query = mysqli_query($koneksi, $sql);

if($query){
    header("Location:index.php");
}else{
    echo "<script>
    alert('Failed saving');
    document.location.href = 'forgot-password2.php';
    </script>";
}
?>
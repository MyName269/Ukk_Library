<?php

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];
$stat = $_POST['stat'];

include '../koneksi.php';
$sql = "INSERT INTO user (username,password,email,namalengkap,alamat,stat) VALUES('$username', '$password', '$email', '$namalengkap', '$alamat', '$stat')";
$query = mysqli_query($koneksi, $sql);
if($query){
    echo "<script>
    document.location.href = 'user.php';
    </script>";
} else {
    echo "<script>
    alert('Maaf Data Tidak Terhapus');
    document.location.href = 'user.php';
    </script>";
}

?>
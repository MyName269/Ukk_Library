<?php

include 'koneksi.php';

$username = htmlspecialchars($_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);
$email = htmlspecialchars($_POST['email']);
$namalengkap = htmlspecialchars(addslashes($_POST['namalengkap']));
$alamat = htmlspecialchars($_POST['alamat']);
$gambar = htmlspecialchars($_POST['gambar']);

$sql = "SELECT * FROM user WHERE username = '$username'";
$query = mysqli_num_rows(mysqli_query($koneksi, $sql));

$password = password_hash($password, PASSWORD_DEFAULT);
    if($query > 0 ){
        echo"<script>
        alert('Username already Exist');
        document.location.href = 'register.php';
        </script>";
    }else{
        mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$password', '$email', '$namalengkap', '$alamat', 'Member', '$gambar')");
        header("Location:index.php?pesan=info_daftar");
    }
?>
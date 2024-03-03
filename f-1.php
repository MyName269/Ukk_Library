<?php

$username = $_POST['username'];

include'koneksi.php';
$sql = "SELECT * FROM user WHERE username='$username'";
$query = mysqli_query($koneksi, $sql);
if(mysqli_num_rows($query)>0){
    session_start();
    $data = mysqli_fetch_array($query);
    $_SESSION['userid'] = $data['userid'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['username'] = $data['username'];

    header('Location:forgot-password2.php');
}else{
    echo "<script>
    alert('Maaf Login Gagal, Silahkan Ulangi Lagi');
    document.location.href = 'forgot-password.php';
    </script>";
}
?>
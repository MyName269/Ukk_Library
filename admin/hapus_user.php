<?php

$userid = $_GET['userid'];


include '../koneksi.php';

$sql = "DELETE FROM user WHERE userid = '$userid'";
$query = mysqli_query($koneksi, $sql);
if ($query) {
    echo "<script>
    document.location.href = 'user.php';
    </script>";
} else {
    echo "<script>
    alert('Maaf Data Tidak Terhapus');
    document.location.href = 'user.php';
    </script>";
}

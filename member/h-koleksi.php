<?php

$koleksiid = $_GET['koleksiid'];


include '../koneksi.php';

$sql = "DELETE FROM koleksipribadi WHERE koleksiid = '$koleksiid'";
$query = mysqli_query($koneksi, $sql);
if ($query) {
    echo "<script>
    document.location.href = 'koleksipribadi.php';
    </script>";
} else {
    echo "<script>
    alert('Maaf Data Tidak Terhapus');
    document.location.href = 'koleksipribadi.php';
    </script>";
}

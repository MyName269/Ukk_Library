<?php
$host = "localhost";
$username = "root";
$password = "";
$database_name = "library";
$connection = mysqli_connect($host, $username, $password, $database_name);

// === FUNCTION KHUSUS ADMIN START ===

// MENAMPILKAN DATA KATEGORI BUKU
function queryReadData($dataKategori) {
  global $connection;
  $result = mysqli_query($connection, $dataKategori);
  $items = [];
  while($item = mysqli_fetch_assoc($result)) {
    $items[] = $item;
  }     
  return $items;
}

function pinjam($dataBuku) {
    global $connection;
    
    $bukuid = $dataBuku["bukuid"];
    $tglPinjam = $dataBuku["tanggalpeminjaman"];
    $tglKembali = $dataBuku["tanggalpengembalian"];
    
    $queryPinjam = "INSERT INTO peminjam(bukuid,tanggalpeminjaman,tanggalpengembalian) VALUES('$bukuid', '$tglPinjam', '$tglKembali')";
    mysqli_query($connection, $queryPinjam);
    return mysqli_affected_rows($connection);
  }
?>
<?php

include '../koneksi.php';
// Menangkap input tanggal
$tanggalAwal = $_POST['tanggalpeminjaman'];
$tanggalAkhir = $_POST['tanggalpengembalian'];

// Membangun query SQL dengan filter tanggal
$query = "SELECT * FROM peminjam WHERE tanggalpeminjaman BETWEEN '$tanggalAwal' AND '$tanggalAkhir'";

// Menjalankan query dan mendapatkan data
$data = query($query);

// Mencetak data
foreach ($data as $row) {
  echo "<tr>";
  echo "<td>" . $row['peminjamanid'] . "</td>";
  echo "<td>" . $row['tanggalpeminjaman'] . "</td>";
  echo "<td>" . $row['tanggalpengembalian'] . "</td>";
  echo "</tr>";
}

?>

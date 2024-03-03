<?php
//panggil koneksi ke database
include '../koneksi.php';
$tanggal_sekarang = date("Y-m-d"); // Tanggal sekarang

$query = "SELECT * FROM peminjam, buku, user WHERE peminjam.bukuid=buku.bukuid AND peminjam.userid=user.userid AND tanggalpengembalian < '$tanggal_sekarang'";
$result = mysqli_query($koneksi, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $judul = $row['judul'];
    $nama = $row['namalengkap'];
    $status = $row['statuspeminjaman'];

    if ($status == 1) {
        $pesan = "Peminjaman buku $judul dengan buku atas nama $nama telat dalam pengembalian.";
        echo '<div class="alert alert-danger" role="alert">
            <i class="fa fa-bell"></i> ' . $pesan . '
         </div>';
    } elseif ($status == 3) {
        $pesan = "Peminjaman buku $judul dengan buku atas nama $nama telat dalam pengembalian.";
        echo '<div class="alert alert-danger" role="alert">
            <i class="fa fa-bell"></i> ' . $pesan . '
         </div>';
    }
}
?>
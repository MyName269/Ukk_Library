<?php
// Buat koneksi ke database (gantilah dengan informasi koneksi yang sesuai)
include '../koneksi.php';

// Periksa tanggal pengembalian buku yang lewat
$tanggal_sekarang = date('Y-m-d');
$sql = "SELECT * FROM peminjam, buku, user WHERE peminjam.bukuid=buku.bukuid AND peminjam.userid=user.userid AND  tanggalpengembalian < '$tanggal_sekarang'";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $judul = $row['judul'];
        $namalengkap = $row['namalengkap'];
        $status = $row['statuspeminjaman'];

        // Tampilkan notifikasi
        if ($status == 1) {
            echo '<a class="list-group-item">';
            echo '<div class="media">';
            echo '<div class="media-img">';
            echo '<span class="badge badge-danger badge-big"><i class="fa fa-bell"></i></span>';
            echo '</div>';
            echo '<div class="media-body">';
            echo '<div class="font-13">';
            echo "Peminjaman buku $judul atas nama $namalengkap dipinjam.";
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
        } elseif ($status == 3) {
            echo '<a class="list-group-item">';
            echo '<div class="media">';
            echo '<div class="media-img">';
            echo '<span class="badge badge-danger badge-big"><i class="fa fa-bell"></i></span>';
            echo '</div>';
            echo '<div class="media-body">';
            echo '<div class="font-13">';
            echo "Peminjaman buku $judul atas nama $namalengkap telat dalam pengembalian.";
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
        }
    }
}
?>
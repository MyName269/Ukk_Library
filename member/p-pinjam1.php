<?php
session_start();
$userid = $_SESSION['userid'];
$bukuid = $_POST['bukuid'];
$tanggalpeminjaman = date('Y-m-d');
$tanggal_pengembalian_otomatis = date('Y-m-d', strtotime($tanggalpeminjaman . ' + 7 days'));

// koneksi
include '../koneksi.php';

// periksa duplikasi data buku dari userid
$sql = "SELECT * FROM riwayat_peminjam WHERE bukuid = '$bukuid' AND userid = '$userid'";
$query = mysqli_num_rows(mysqli_query($koneksi, $sql));
if ($query > 0) {
    echo "<script>
    alert('Buku telah tersedia di Koleksi kamu');
    document.location.href = 'buku1.php';
    </script>";
} else {
    
        $sql_peminjaman = "INSERT INTO peminjam(userid,bukuid,tanggalpeminjaman,tanggalpengembalian,statuspeminjaman) VALUES('$userid', '$bukuid', '$tanggalpeminjaman', '$tanggal_pengembalian_otomatis', '1')";

        if ($koneksi->query($sql_peminjaman) === TRUE) {
            // proses penyimpanan riwayat peminjam
            $peminjamanid = $koneksi->insert_id;
            // mendapatkan ID peminjaman yang baru saja dimasukkan

            $sql_riwayat = "INSERT INTO riwayat_peminjam(peminjamanid,userid,bukuid,tanggalpeminjaman,tanggalpengembalian,statuspeminjaman) VALUES('$peminjamanid', '$userid', '$bukuid', '$tanggalpeminjaman', '$tanggal_pengembalian_otomatis', '1')";
            if ($koneksi->query($sql_riwayat) === TRUE) {
                echo '<script language="javascript" type="text/javascript">
                      alert("Berhasil dipinjam.");</script>';
                echo "<meta http-equiv='refresh' content='0; url=buku1.php'>";
            } else {
                echo "Gagal menyimpan riwayat peminjaman: " . $koneksi->error;
            }
        } else {
            echo "Gagal menyimpan data peminjaman: " . $koneksi->error;
        }
    }
}





// Tutup koneksi
$koneksi->close();
?>

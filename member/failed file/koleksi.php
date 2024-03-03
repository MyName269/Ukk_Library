<?php
include '../koneksi.php';

session_start();
if( !isset($_SESSION['userid'])){
    header("Location: ../logout.php");
    exit;
}
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$data = mysqli_query($koneksi, "SELECT peminjam.peminjamanid, peminjam.bukuid, buku.judul, buku.gambar, peminjam.userid, user.namalengkap,peminjam.tanggalpeminjaman, peminjam.tanggalpengembalian, peminjam.statuspeminjaman
FROM peminjam
INNER JOIN buku ON peminjam.bukuid = buku.bukuid
INNER JOIN user ON peminjam.userid = user.userid
WHERE peminjam.userid = $userid");
?>
<!-- ada gambarnya, tapi tidak rapi -->
<div class="container-fluid">
<!-- Content Row -->
<div class="row">
<?php foreach($data as $d): ?>
    <div class="col text-center">
                    <img src="img/<?php echo $d['gambar']; ?>" width="400">
                </div>
   <div class="card shadow mb-3" style="width: 15rem;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $d['namalengkap']; ?></h5>
            <p class="card-text"><?php echo $d['tanggalpeminjaman']; ?></p>
            <p class="card-text"><?php echo $d['tanggalpengembalian']; ?></p>
            <p class="card-text"><?php echo $d['statuspeminjaman']; ?></p>
            <a href="detail.php?peminjamanid=<?php echo $d['peminjamanid']; ?>" class="btn btn-primary">Detail</a>
            <a href="baca.php?peminjamanid=<?php echo $d['peminjamanid']; ?>" class="btn btn-warning">Baca</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
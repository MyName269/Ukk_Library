<?php
include '../koneksi.php';

session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../logout.php");
    exit;
}
if ($_SESSION['stat'] != 'Member') {
    echo "<script>
    alert('Maaf Anda BUKAN Member');
    document.location.href = '../index.php?pesan=info_login';
    </script>";
}
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$data = mysqli_query($koneksi, "SELECT riwayat_peminjam.peminjamanid, riwayat_peminjam.bukuid, buku.judul, buku.gambar, riwayat_peminjam.userid, user.namalengkap, riwayat_peminjam.tanggalpeminjaman, riwayat_peminjam.tanggalpengembalian, riwayat_peminjam.statuspeminjaman
FROM riwayat_peminjam
INNER JOIN buku ON riwayat_peminjam.bukuid = buku.bukuid
INNER JOIN user ON riwayat_peminjam.userid = user.userid
WHERE riwayat_peminjam.userid = $userid");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- link icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        :root {
            --light: #ebe8e8;
        }

        .bi-star-fill {
            color: orange;
        }

        textarea {
            width: 100%;
            background: var(--light);
            padding: 1rem;
            border-radius: .5rem;
            border: none;
            outline: none;
            resize: none;
            margin-bottom: .5rem;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="profile.php"><b>Digital <sup>Library</sup></b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" aria-current="page" href="member.php">Home</a>
                    <a class="nav-link active" href="buku0.php">Buku</a>
                    <a class="nav-link active" href="buku1.php">Koleksi</a>
                    <a class="nav-link active" href="koleksipribadi.php">⭐</a>
                    <a class="nav-link" href="../logout.php" tabindex="-1" aria-disabled="true">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top: 1rem;">

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Koleksi</h6>
                    </div>
                    <br>
                    <!-- Card Body -->
                    <div class="column mb-4" style="max-width: 980px;">
                        <div class="row row-cols-1 row-cols-md-3 g-4">

                            <?php foreach ($data as $d):
                                $status = $d['statuspeminjaman'];
                                if ($status == 1) {
                                    $icon = "fa fa-spinner";
                                    $btn = "btn-warning";
                                } elseif ($status == 2) {
                                    $icon = "fa fa-history";
                                    $btn = "btn-success";
                                } elseif ($status == 3) {
                                    $icon = "fa fa-times";
                                    $btn = "btn-danger";
                                }
                                $tanggalpengembalian = strtotime($d['tanggalpengembalian']);
                                $tanggal_sekarang = strtotime(date('Y-m-d'));
                                if ($tanggalpengembalian < $tanggal_sekarang && $d['statuspeminjaman'] != '2') {
                                    // Jika tanggal pengembalian telah lewat dan status belum 2, maka status diubah menjadi "3"
                                    mysqli_query($koneksi, "UPDATE peminjam SET statuspeminjaman = '3' WHERE peminjamanid = '" . $d['peminjamanid'] . "'");
                                    mysqli_query($koneksi, "UPDATE riwayat_peminjam SET statuspeminjaman = '3' WHERE peminjamanid = '" . $d['peminjamanid'] . "'");
                                    $d['statuspeminjaman'] = '3'; // Update status peminjam untuk ditampilkan
                                    $color = "text-bg-danger"; // Update warna
                                }
                                ?>
                                <div class="col-md-2 text-center">
                                    <?php if ($status == 1) { ?>
                                        <a href="baca.php?peminjamanid=<?= $d['peminjamanid']; ?>">
                                            <img src="../admin/img/<?php echo $d['gambar']; ?>" class="img-fluid rounded-start"
                                                width="150">
                                        </a>
                                        <h6 class="text-center">
                                            <b>
                                                <?= $d['judul']; ?>
                                            </b>
                                        </h6>
                                        <span class="badge badge-primary">Dipinjam</span>
                                        <form action="p-koleksi.php" method="post">
                                            <input type="text" name="bukuid" value="<?= $d['bukuid']; ?>" hidden>
                                            <input type="text" value="<?= $_SESSION['username'] ?>" name="userid" hidden>
                                            <button type="submit" class="btn btn-success btn-circle btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    <?php } elseif ($status == 3) { ?>
                                        <img src="../admin/img/<?php echo $d['gambar']; ?>" class="img-fluid rounded-start"
                                            width="150">
                                        <h6 class="text-center">
                                            <b>
                                                <?= $d['judul']; ?>
                                            </b>
                                        </h6>
                                        <span class="badge badge-danger">Telat</span>

                                        <form action="p-kembali.php" method="post">
                                            <input type="text" name="peminjamanid" value="<?= $d['peminjamanid']; ?>"
                                                hidden>
                                            <input type="text" name="bukuid" value="<?= $d['bukuid']; ?>" hidden>
                                            <input type="text" name="userid" value="<?= $d['userid']; ?>" hidden>
                                            <input type="text" name="tanggalpeminjaman"
                                                value="<?= $d['tanggalpeminjaman']; ?>" hidden>
                                            <input type="text" name="tanggalpengembalian"
                                                value="<?= $d['tanggalpengembalian']; ?>" hidden>
                                            <input type="text" name="statuspeminjaman"
                                                value="<?= $d['statuspeminjaman']; ?>" hidden>
                                            <button type="submit" class="btn btn-warning btn-circle btn-sm">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </button>
                                        </form>
                                    <?php } ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Ulasan BukuKu</h6>
                    </div>

                    <?php
                    include '../koneksi.php';
                    $userid = $_SESSION['userid'];
                    $data = mysqli_query($koneksi, "SELECT * FROM ulasanbuku, buku, user WHERE ulasanbuku.bukuid=buku.bukuid AND ulasanbuku.userid=user.userid AND ulasanbuku.userid='$userid' ORDER BY ulasanid DESC");

                    while ($d = mysqli_fetch_array($data)) {
                        $bukuid = $d['bukuid']; // Ambil bukuid untuk digunakan dalam query rating
                    
                        // Query untuk mengambil rating hanya untuk buku tertentu
                        $queryRating = "SELECT rating FROM ulasanbuku WHERE bukuid = $bukuid";
                        $resultRating = mysqli_query($koneksi, $queryRating);

                        $totalRating = 0;
                        $jumlahRating = 0;

                        // Loop untuk menghitung jumlah total rating dan jumlah rating
                        while ($rowRating = mysqli_fetch_assoc($resultRating)) {
                            $totalRating += $rowRating['rating'];
                            $jumlahRating++;
                        }

                        // Hitung rata-rata rating
                        if ($jumlahRating > 0) {
                            $rataRata = $totalRating / $jumlahRating;
                        } else {
                            $rataRata = 0; // Menghindari pembagian oleh nol
                        }
                        ?>
                        <!-- Card Body -->
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $d['judul']; ?>

                                <div class="small">
                                    <?php
                                    $rating = $d['rating'];
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="bi bi-star-fill"></i>';
                                        } else {
                                            echo '<i class="bi bi-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                            </h5>
                            <div class="row">
                                <b>
                                    <?php echo $d['email']; ?>
                                </b>
                            </div><textarea cols="47" rows="3" readonly><?= $d['ulasan']; ?></textarea>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; UKK Manda 2024</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
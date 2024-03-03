<?php
include '../koneksi.php';

session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../logout.php");
    exit;
}
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$data = mysqli_query($koneksi, "SELECT peminjam.peminjamanid, peminjam.bukuid, buku.judul, buku.deskripsi, buku.gambar, peminjam.userid, user.namalengkap, peminjam.tanggalpeminjaman, peminjam.tanggalpengembalian, peminjam.statuspeminjaman
FROM peminjam
INNER JOIN buku ON peminjam.bukuid = buku.bukuid
INNER JOIN user ON peminjam.userid = user.userid
WHERE peminjam.userid = $userid");
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
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="profile.php"><img src="img/b1.png" width="45"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="admin1.php">Home</a>
                    <a class="nav-link active" href="buku-admin.php">Buku</a>
                    <a class="nav-link active" href="koleksi2.php">Koleksi</a>
                    <a class="nav-link" href="../logout.php" tabindex="-1" aria-disabled="true">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 1rem;">

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-10 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Buku</h6>
                    </div>
                    <br>
                    <!-- Card Body -->
                    <div class="card mb-3" style="max-width: 850px;">
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
                                ?>
                                <div class="col-md-4">
                                    <img src="img/<?php echo $d['gambar']; ?>" class="img-fluid rounded-start" width="300">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $d['judul']; ?>
                                            <!-- status peminjaman -->
                                            <?php if ($status == 1) { ?>
                                                <span class="badge badge-primary">Dipinjam</span>
                                            <?php } elseif ($status == 2) { ?>
                                                <span class="badge badge-success">Dikembalikan</span>
                                            <?php } elseif ($status == 3) { ?>
                                                <span class="badge badge-danger">Telat</span>
                                            <?php } ?>
                                        </h5>
                                        <hr>
                                        <?= $d['deskripsi']; ?>
                                        <table>
                                            <tr>
                                                <th>Tanggal Peminjaman : </th>
                                                <td>
                                                    <?= $d['tanggalpeminjaman']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Pengembalian : </th>
                                                <td>
                                                    <?= $d['tanggalpengembalian']; ?>
                                                </td>
                                            </tr>
                                        </table>
                                        <a href="detail2.php?bukuid=<?php echo $d['bukuid']; ?>"
                                            class="btn btn-outline-primary">Detail</a>
                                        <a href="baca.php?bukuid=<?php echo $d['bukuid']; ?>"
                                            class="btn btn-outline-dark">Baca</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-2 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Kategori Buku</h6>
                    </div>
                    <?php
                    include '../koneksi.php';
                    $no = 1;
                    $data = "SELECT * FROM kategoribuku WHERE kategoriid";
                    $result = mysqli_query($koneksi, $data);
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <!-- Card Body -->
                        <div class="card-body">
                            <a href="" class="btn btn-primary">
                                <?= $row['namakategori']; ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
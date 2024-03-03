<?php
session_start();
if ($_SESSION['stat'] != 'Admin') {
    header("location:../index.php?pesan=info_login");
}
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ms-auto">
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
                            <?php
                            include '../koneksi.php';
                            $data = mysqli_query($koneksi, "SELECT * FROM buku, kategoribuku WHERE buku.kategoriid=kategoribuku.kategoriid ORDER BY bukuid ASC");

                            while ($d = mysqli_fetch_assoc($data)) {
                                ?>
                                <div class="col-md-4">
                                    <img src="img/<?php echo $d['gambar']; ?>" class="img-fluid rounded-start" width="300">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $d['judul']; ?>
                                        </h5>
                                        <hr>
                                        <p class="card-text">
                                            <?php echo $d['deskripsi']; ?>
                                        </p>
                                        <p class="card-text">
                                            <?php echo $d['namakategori']; ?>
                                        </p>
                                        <a href="detailbuku.php?bukuid=<?php echo $d['bukuid']; ?>"
                                            class="btn btn-primary">Detail</a>
                                        <a href="cobapinjam.php?bukuid=<?php echo $d['bukuid']; ?>"
                                            class="btn btn-warning">Pinjam</a>
                                    </div>
                                </div>
                            <?php } ?>
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
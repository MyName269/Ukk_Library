<?php
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
?>

<!-- failed file -->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpus Rpl1</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="profile.php"><b>Digital <sup>Library</sup></b></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                            aria-expanded="false" aria-label="Toggle navigation">
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="margin-top: 1rem;">
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-10 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Ulasan Buku</h6>
                                </div>
                                <br>
                                <!-- Card Body -->
                                <div class="column mb-4" style="max-width: 980px;">
                                    <div class="row row-cols-1 row-cols-md-3 g-4">
                                        <?php
                                        include '../koneksi.php';
                                        if (isset($_GET['bukuid'])) {
                                            $bukuid = $_GET['bukuid'];
                                        } else {
                                            die("Error, Data Tidak Ditemukan");
                                        }
                                        $data = mysqli_query($koneksi, "SELECT * FROM ulasanbuku, buku, user WHERE ulasanbuku.bukuid=buku.bukuid AND ulasanbuku.userid=user.userid AND ulasanbuku.bukuid= '$bukuid' ");
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
                                            <div class="column">
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
                                                </div>
                                                <textarea cols="47" rows="3" readonly><?= $d['ulasan']; ?></textarea>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                        $dataA = "SELECT * FROM buku WHERE bukuid";
                        $result = mysqli_query($koneksi, $dataA);
                        while ($rowA = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="modal fade" id="anggotaeditModal<?php echo $rowA['bukuid']; ?>" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Yakin Pinjam <b>
                                                    <?php echo $rowA['judul']; ?>
                                                </b> ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="p-pinjam1.php" method="post">
                                                <button type="submit" class="btn btn-primary">Ya</button>
                                                <table>
                                                    <tr>
                                                        <input type="text" class="form-control" id="bukuid" name="bukuid"
                                                            value="<?php echo $rowA['bukuid']; ?>" hidden>
                                                        <input readonly value="<?= $_SESSION['username'] ?>" name="userid"
                                                            class="form-control" hidden>
                                                    </tr>
                                                    <tr>
                                                        <input type="date" class="form-control" id="tanggalpeminjaman"
                                                            name="tanggalpeminjaman" hidden>
                                                        <input type="date" name="tanggalpengembalian"
                                                            id="tanggalpengembalian" class="form-control" hidden>
                                                        <input type="text" name="statuspeminjaman" id="statuspeminjaman"
                                                            class="form-control" hidden>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Pie Chart -->
                        <div class="col-xl-2 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Kategori Buku</h6>
                                </div>
                                <?php
                                include '../koneksi.php';
                                $no = 1;
                                $data = "SELECT * FROM kategoribuku";
                                $result = mysqli_query($koneksi, $data);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <a href="kategori.php?namakategori=<?php echo $row['namakategori']; ?>"
                                            class="btn btn-primary">
                                            <?= $row['namakategori']; ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- End of Content Wrapper -->
                </div>

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; UKK Manda 2024</span>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- End of Page Wrapper -->

            <!-- Bootstrap core JavaScript-->
            <script src="../vendor/jquery/jquery.min.js"></script>
            <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="../vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="../js/demo/chart-area-demo.js"></script>
            <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
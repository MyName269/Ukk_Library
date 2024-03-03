<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../logout.php");
    exit;
}
if ($_SESSION['stat'] != 'Petugas') {
    echo "<script>
    alert('Maaf Anda BUKAN Petugas');
    document.location.href = '../index.php?pesan=info_login';
    </script>";
}
include '../koneksi.php';
$userid = $_SESSION['userid'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE userid='$userid' ");
$g = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpus Rpl1 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- link icons for rating -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- link icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .bi-star-fill {
            color: orange;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="petugas.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Perpus <sup>
                        <?php echo $_SESSION['username']; ?>
                    </sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="petugas.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="fiksi.php">
                    <i class="fas fa-solid fa-book-open"></i>
                    <span>Books</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="user.php">User</a>
                        <a class="collapse-item" href="peminjaman.php">Peminjam</a>
                        <a class="collapse-item" href="ulasan.php">Daftar Ulasan</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Laporan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- notification -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <div class="status-indicator bg-success"></div>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">
                                        <?php include 'notif.php'; ?>
                                    </div>
                                </div>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $_SESSION['username']; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/<?= $g['foto']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Ulasan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Buku diulas</th>
                                            <th>Ulasan</th>
                                            <th>Rating</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../koneksi.php';
                                        $no = 1;
                                        $data = mysqli_query($koneksi, "SELECT * FROM ulasanbuku, buku, user WHERE ulasanbuku.bukuid=buku.bukuid AND ulasanbuku.userid=user.userid ORDER BY ulasanid ASC");

                                        while ($row = mysqli_fetch_array($data)) {
                                            $bukuid = $row['bukuid']; // Ambil bukuid untuk digunakan dalam query rating
                                        
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
                                            <tr>
                                                <td>
                                                    <?= $no++; ?>
                                                </td>
                                                <td>
                                                    <?= $row['username']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['judul']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['ulasan']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $rating = $row['rating'];
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $rating) {
                                                            echo '<i class="bi bi-star-fill"></i>';
                                                        } else {
                                                            echo '<i class="bi bi-star"></i>';
                                                        }
                                                    }
                                                    ?>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal"
                                                        data-target="#bukudetailModal<?php echo $row['bukuid']; ?>"><i
                                                            class="bi bi-eye-fill"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Detail -->
                    <?php
                    $datab = "SELECT * FROM peminjam,buku,user WHERE peminjam.userid=user.userid AND  peminjam.bukuid=buku.bukuid ORDER BY tanggalpeminjaman ASC";
                    ;
                    $resultb = mysqli_query($koneksi, $datab);
                    while ($result = mysqli_fetch_assoc($resultb)) {
                        $status = $result['statuspeminjaman'];
                        ?>
                        <div class="modal fade" id="bukudetailModal<?php echo $result['bukuid']; ?>" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="container">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="row m-4">
                                                <div class="col text-center">
                                                    <img src="../admin/img/<?php echo $result['gambar']; ?>" width="300">
                                                </div>
                                                <div class="col" style="margin-top: 2rem;">
                                                    <b>
                                                        <h3>Detail Buku</h3>
                                                    </b>
                                                    <hr>
                                                    <form method="POST">
                                                        <div class="input-group mb-3 mt-3">
                                                            <span class="input-group-text" id="basic-addon1">Buku</span>
                                                            <input type="text" class="form-control" aria-label="bukuid"
                                                                value="<?php echo $result['judul']; ?>" readonly>
                                                        </div>
                                                        <div class="input-group mb-3 mt-3">
                                                            <span class="input-group-text" id="basic-addon1">Siapa
                                                                pinjam</span>
                                                            <input type="text" class="form-control" aria-label="userid"
                                                                value="<?php echo $result['username']; ?>"
                                                                aria-describedby="basic-addon1" disabled>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="input-group mb-3 mt-3">
                                                                    <span class="input-group-text" id="basic-addon1">Tanggal
                                                                        pinjam</span>
                                                                    <input type="text" class="form-control"
                                                                        value="<?php echo $result['tanggalpeminjaman']; ?>"
                                                                        aria-label="peminjaman"
                                                                        aria-describedby="basic-addon1" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="input-group mb-3 mt-3">
                                                                    <span class="input-group-text" id="basic-addon1">Tanggal
                                                                        kembali</span>
                                                                    <input type="text" class="form-control"
                                                                        value="<?php echo $result['tanggalpengembalian']; ?>"
                                                                        aria-label="tanggalpengembalian"
                                                                        aria-describedby="basic-addon1" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="input-group mb-3 mt-3">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon1">
                                                                        <?php if ($status == 1) { ?>
                                                                        <span class="badge badge-primary">Dipinjam</span>
                                                                    <?php } elseif ($status == 2) { ?>
                                                                        <span class="badge badge-success">Dikembalikan</span>
                                                                    <?php } elseif ($status == 3) { ?>
                                                                        <span class="badge badge-danger">Telat</span>
                                                                    <?php } ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="ulasan.php" class="btn btn-outline-primary">Kembali</a>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

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
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Exit the session. Are you sure?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Done using this application? Click the 'Logout' button to end the login session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>
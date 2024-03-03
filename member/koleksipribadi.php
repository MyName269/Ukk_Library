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
$data = mysqli_query($koneksi, "SELECT koleksipribadi.koleksiid, koleksipribadi.bukuid, buku.judul, buku.gambar, koleksipribadi.userid, user.namalengkap, user.foto
FROM koleksipribadi
INNER JOIN buku ON koleksipribadi.bukuid = buku.bukuid
INNER JOIN user ON koleksipribadi.userid = user.userid
WHERE koleksipribadi.userid = $userid");
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
</head>
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

            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">MyFavorite</h6>
                </div>
                <br>
                <!-- Card Body -->
                <div class="column mb-4" style="max-width: 1000px;">
                    <div class="row row-cols-2 row-cols-md-3 g-4">
                        <?php foreach ($data as $d): ?>
                            <div class="col-md-2 text-center">
                                <a onclick="return confirm('Anda Yakin ingin Menghapus <?php echo $d['judul']; ?> ?')"
                                    href="h-koleksi.php?koleksiid=<?php echo $d['koleksiid']; ?>"><img
                                        src="../admin/img/<?php echo $d['gambar']; ?>" class="img-fluid rounded-start"
                                        width="150"></a>
                                <h7 class="text-center">
                                    <b>
                                        <?= $d['judul']; ?>
                                    </b>
                                </h7>

                            </div>
                        <?php endforeach; ?>
                    </div>
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
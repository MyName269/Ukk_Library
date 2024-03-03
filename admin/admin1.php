<?php
session_start();
if( !isset($_SESSION['userid'])){
    header("Location: ../logout.php");
    exit;
}
if($_SESSION['stat']!='Admin'){
    echo "<script>
    alert('Maaf Anda BUKAN Admin');
    document.location.href = '../index.php?pesan=info_login';
    </script>";
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

    <div class="container">
        <div class="row" style="margin-top: 2rem;">
            <div class="col-sm-5" style="margin-top: 6rem;">
                <h3>Welcome <sup>
                        <?php echo $_SESSION['username']; ?>
                    </sup></h3>
                <samp>Baca!! Membaca adalah <b>Jendela Dunia</b></samp>
            </div>
            <div class="col-sm-1">
                <img src="../assets/img/buku2.avif" width="450">
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
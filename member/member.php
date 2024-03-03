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
include '../koneksi.php';
$userid = $_SESSION['userid'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE userid='$userid' ");
$g = mysqli_fetch_array($query);
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

    <style>
        body {
            background-color: #fcfcfc;
            color: #333;
            transition: .5s;
        }

        input[type="checkbox"] {
            position: relative;
            width: 40px;
            height: 20px;
            appearance: none;
            background-color: #434343;
            outline: none;
            border-radius: 10px;
            transition: .5s ease;
            cursor: pointer;
        }

        input[type="checkbox"]:checked {
            background-color: #fcfcfc;
        }

        input[type="checkbox"]::before {
            content: '';
            position: absolute;
            width: 16px;
            background-color: #fcfcfc;
            border-radius: 50%;
            top: 2px;
            left: 2px;
            transition: .5s ease;
        }

        input[type="checkbox"]:checked::before {
            transform: translateX(20px);
        }

        .dark {
            background-color: #333;
            color: #fcfcfc;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="member.php"><b>Digital <sup>Library</sup></b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" aria-current="page" href="member.php">Home</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Daftar Buku
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="buku0.php">Buku</a></li>
                            <li><a class="dropdown-item" href="buku1.php">KoleksiSaya</a></li>
                            <li><a class="dropdown-item" href="koleksipribadi.php">Favorite</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <!-- <input type="checkbox" onclick="ubahMode()"> -->
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row" style="margin-top: 2rem;">
            <div class="col-sm-6" style="margin-top: 8rem;">
                <h3>Welcome <sup>
                        <?php echo $g['namalengkap']; ?>
                    </sup></h3>
                <samp>Baca!! Membaca adalah <b>Jendela Dunia</b></samp>
            </div>
            <div class="col-sm-4">
               <a href="profile.php"><img src="img/<?= $g['foto']; ?>" class="rounded-circle img-thumbnail" width="450"></a>
            </div>
        </div>
        <br>

        <!-- Footer -->
        <div class="justify-content-center">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; UKK Manda 2024</span>
                </div>
            </div>
        </div>
        <!-- End of Footer -->
    </div>

    <script>
        function ubahMode() {
            const ubah = document.body;
            ubah.classList.toggle("dark");
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

</body>

</html>
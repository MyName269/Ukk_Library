<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpus Rpl1 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-1">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"><img src="assets/img/b1.png"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php
                                    if (isset($_GET['pesan'])) {
                                        if ($_GET['pesan'] == "gagal") {
                                            echo "<div class='alert alert-danger '>Username dan Password tidak sesuai !</div>";
                                        }
                                    }
                                    if (isset($_GET['pesan'])) {
                                        if ($_GET['pesan'] == "info_logout") {
                                            echo "<div class='alert alert-info '>Anda telah Berhasil Keluar !</div>";
                                        }
                                    }
                                    if (isset($_GET['pesan'])) {
                                        if ($_GET['pesan'] == "info_login") {
                                            echo "<div class='alert alert-warning'>Maaf Anda belum Login !</div>";
                                        }
                                    }
                                    if (isset($_GET['pesan'])) {
                                        if ($_GET['pesan'] == "info_daftar") {
                                            echo "<div class='alert alert-primary'>Anda Telah Terdaftar !</div>";
                                        }
                                    }
                                    ?>
                                    <form action="cek-login.php" method="post" class="user">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                aria-describedby="emailHelp" placeholder="Enter Your Username...">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control form-control-user"
                                                placeholder="Password" name="password" id="password"
                                                aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="button-addon2"><i class="fa fa-eye"></i></button>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-user btn-block"
                                                name="login">Login</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- show password -->
    <script>
        $("#button-addon2").mousedown(function () {
            $('#password').prop('type', 'text');
        });
        $("#button-addon2").mouseup(function () {
            $('#password').prop('type', 'password');
        });
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpus Rpl1 - Register</title>

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

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-1">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block"><img src="assets/img/b1.png"></div>
                    <div class="col-lg-6">
                        <div class="p-3">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="proses-daftar.php" method="post" class="user">
                                <div class="form-group row">
                                    <input type="text" class="form-control form-control-user" id="username"
                                        name="username" placeholder="Username" maxlength="10" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        aria-describedby="emailHelp" name="email" placeholder="Enter Email Address..."
                                        required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="namalengkap" class="form-control form-control-user"
                                            id="namalengkap" name="namalengkap" placeholder="Full Name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="alamat" class="form-control form-control-user" id="alamat"
                                            name="alamat" placeholder="Your Address" required>
                                    </div>
                                    
                                    <input type="text" class="form-control form-control-user" name="gambar" hidden>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control form-control-user"
                                        placeholder="Enter your Password.." name="password" id="password"
                                        aria-label="Recipient's username" aria-describedby="button-addon2" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Register</button>
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.php">Already have an account? Login!</a>
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

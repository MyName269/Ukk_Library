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
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --light: #ebe8e8;
        }

        input {
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

    <div class="container" style="margin-top: 1rem;">
        <div class="card">
            <div class="row m-4">
                <?php
                include '../koneksi.php';
                if (isset($_GET['userid'])) {
                    $userid = $_GET['userid'];
                } else {
                    die("Error, Data Tidak Ditemukan");
                }
                $query = mysqli_query($koneksi, "SELECT * FROM user WHERE userid='$userid' ");
                $result = mysqli_fetch_array($query);
                ?>
                <form method="POST" action="e-p.php" enctype="multipart/form-data">
                    <input type="hidden" name="userid" value="<?php echo $result['userid']; ?>">
                    <input type="hidden" name="gambarLama" value="<?php echo $result['foto']; ?>">
                    <div class="col text-center">
                        <img src="img/<?php echo $result['foto']; ?>" class="rounded-circle img-thumbnail"
                            width="400">
                    </div>
                    <div class="col" style="margin-top: 1rem;">
                        <h3>Edit Profile</h3>
                        <hr>
                        <table>
                            <input type="file" class="custom-file-input" id="inputGroupFile04"
                                aria-describedby="inputGroupFileAddon04" name="foto" value="<?php echo $result['foto']; ?>">
                            <div class="row">
                                <div class="col">
                                    <div class="input-group mb-3 mt-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            Username
                                        </span>
                                        <input type="text" class="form-control" name="userid"
                                            value="<?php echo $result['userid']; ?>" hidden>
                                        <input type="text" class="form-control" name="username"
                                            value="<?php echo $result['username']; ?>" readonly>
                                        <input type="text" class="form-control" name="password"
                                            value="<?php echo $result['password']; ?>" hidden>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group mb-3 mt-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            Nama Lengkap
                                        </span>
                                        <input type="text" class="form-control" name="namalengkap"
                                            value="<?php echo $result['namalengkap']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-group mb-3 mt-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            Email
                                        </span>
                                        <input type="text" class="form-control" name="email"
                                            value="<?php echo $result['email']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group mb-3 mt-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            Alamat
                                        </span>
                                        <input type="text" class="form-control" name="alamat"
                                            value="<?php echo $result['alamat']; ?>">
                                        <input type="text" class="form-control" name="stat"
                                            value="<?php echo $result['stat']; ?>" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="update">Update</button>
                            </div>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
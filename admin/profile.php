<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../logout.php");
    exit;
}
if ($_SESSION['stat'] != 'Admin') {
    echo "<script>
    alert('Maaf Anda BUKAN Admin');
    document.location.href = '../index.php?pesan=info_login';
    </script>";
}
include '../koneksi.php';
$userid = $_SESSION['userid'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE userid='$userid' ");
$result = mysqli_fetch_array($query);
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
                <div class="col text-center">
                    <img src="img/<?php echo $result['foto']; ?>" class="rounded-circle img-thumbnail" width="400">
                </div>
                <div class="col" style="margin-top: 1rem;">
                    <h3>Profile <a href="e-profile.php?userid=<?= $result['userid']; ?>" class="btn btn-sm btn-primary">Edit Profile</a>
                    <a href="admin.php" class="btn btn-sm btn-warning">Kembali</a></h3>
                    <hr>
                    <table>
                        <tr>
                            <td><label>Username</label><input type="text" class="form-control" value="<?= $_SESSION['username']; ?>" readonly></td>
                            <td><label>Email</label><input type="text" class="form-control" value="<?= $result['email']; ?>" readonly></td>
                        </tr>
                        <tr>
                            <td><label>Nama Lengkap</label><input type="text" class="form-control" value="<?= $result['namalengkap']; ?>" readonly></td>
                            <td><label>Alamat</label><input type="text" class="form-control" value="<?= $result['alamat']; ?>" readonly></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
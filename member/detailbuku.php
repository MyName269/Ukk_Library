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
</head>

<body>

    <div class="container" style="margin-top: 1rem;">
        <div class="content">
            <div class="card">
                <div class="row m-4">
                    <?php
                    include '../koneksi.php';
                    if (isset($_GET['bukuid'])) {
                        $bukuid = $_GET['bukuid'];
                    } else {
                        die("Error, Data Tidak Ditemukan");
                    }
                    $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE bukuid='$bukuid' ");
                    $result = mysqli_fetch_array($query);
                    ?>
                    <div class="col text-center">
                        <img src="img/<?php echo $result['gambar']; ?>" width="400">
                    </div>
                    <div class="col" style="margin-top: 5rem;">
                        <h3>Detail Buku</h3>
                        <hr>
                        <table>
                            <tr>
                                <th>
                                    <h6>Judul Buku </h6>
                                </th>
                                <td>:
                                    <?php echo $result['judul']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <h6>Penulis </h6>
                                </th>
                                <td>:
                                    <?php echo $result['penulis']; ?>
                                    </h5>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <h6>Penerbit </h6>
                                </th>
                                <td>:
                                    <?php echo $result['penerbit']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <h6>Tahun Terbit </h6>
                                </th>
                                <td>:
                                    <?php echo $result['tahunterbit']; ?>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <a href="buku0.php" class="btn btn-outline-danger">Kembali</a>
                        <a href="pinjam.php?bukuid=<?php echo $result['bukuid']; ?>"
                            class="btn btn-outline-primary">Pinjam</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
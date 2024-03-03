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
        <div class="content">
            <div class="card">
                <div class="row m-4">
                    <?php
                    include '../koneksi.php';
                    if (isset($_GET['peminjamanid'])) {
                        $peminjamanid = $_GET['peminjamanid'];
                    } else {
                        die("Error, Data Tidak Ditemukan");
                    }
                    $query = mysqli_query($koneksi, "SELECT * FROM riwayat_peminjam,buku WHERE riwayat_peminjam.bukuid=buku.bukuid AND riwayat_peminjam.peminjamanid='$peminjamanid' ");
                    $result = mysqli_fetch_array($query);
                    ?>
                    <div class="col text-center">
                        <a href="../admin/img/<?php echo $result['gambar']; ?>"><img
                                src="../admin/img/<?php echo $result['gambar']; ?>" width="370"></a>
                        <h3>
                            <?php echo $result['judul']; ?>
                        </h3>
                        <h8>
                            <td>
                                Penulis :
                            </td>
                            <?php echo $result['penulis']; ?>
                        </h8>
                        <hr>
                        <div class="row justify-content-center fs-5 text-center">
                            <p>
                                <?php echo $result['deskripsi']; ?>
                            </p>
                        </div>
                        <form action="p-kembali.php" method="post">
                            <input type="text" name="peminjamanid" value="<?= $result['peminjamanid']; ?>" hidden>
                            <input type="text" name="bukuid" value="<?= $result['bukuid']; ?>" hidden>
                            <input type="text"  name="userid" value="<?= $result['userid']; ?>" hidden>
                            <input type="text" name="tanggalpeminjaman" value="<?= $result['tanggalpeminjaman']; ?>"
                                hidden>
                            <input type="text" name="tanggalpengembalian" value="<?= $result['tanggalpengembalian']; ?>"
                                hidden>
                            <input type="text" name="statuspeminjaman" value="<?= $result['statuspeminjaman']; ?>" hidden>
                            <button type="submit" class="btn btn-outline-danger">
                                Kembalikan
                            </button>
                            <a href="ulasan.php?bukuid=<?php echo $result['bukuid']; ?>"
                                class="btn btn-outline-warning">Tulis Ulasan</a>
                        </form>
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
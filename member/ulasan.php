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

    <div class="container" style="margin-top: 0rem;">
        <div class="card">
            <form action="p-ulasan.php" method="post">
                <div class="row m-4">
                    <?php
                    if (isset($_GET['bukuid'])) {
                        $bukuid = $_GET['bukuid'];
                    } else {
                        die("Error, Data Tidak Ditemukan");
                    }
                    include '../koneksi.php';
                    $buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE bukuid='$bukuid'");
                    foreach ($buku as $result) {
                        ?>
                        <div class="col text-center">
                            <img src="../admin/img/<?php echo $result['gambar']; ?>" width="350">
                        </div>
                        <div class="col" style="margin-top: 0rem;">
                            <h5><b>Ulasan</b> "<?php echo $result['judul']; ?>"</h5>
                            <hr>
                            <table>
                                <div class="rating">
                                    <input type="number" name="rating" hidden>
                                    <i class='bx bx-star star' style="--i: 0;"></i>
                                    <i class='bx bx-star star' style="--i: 1;"></i>
                                    <i class='bx bx-star star' style="--i: 2;"></i>
                                    <i class='bx bx-star star' style="--i: 3;"></i>
                                    <i class='bx bx-star star' style="--i: 4;"></i>
                                </div>
                                    <input type="text" class="form-control" id="bukuid" name="bukuid"
                                        value="<?php echo $result['bukuid']; ?>" hidden>
                                <?php } ?>
                                    <input readonly value="<?= $_SESSION['username'] ?>" name="userid"
                                        class="form-control" hidden>
                            <textarea name="ulasan" cols="30" rows="5" placeholder="Your opinion..."></textarea>
                    </div>
                    </table>
                    <div class="modal-footer">
                        <a href="buku1.php" class="btn btn-secondary">Tutup</a>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="script.js" type="text/javascript"></script>
</body>

</html>
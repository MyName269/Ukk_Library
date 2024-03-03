<?php
session_start();
if(empty($_SESSION['username'])){
    echo "<script>
    document.location.href = '../logout.php';
    </script>";
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container" style="margin-top: 3rem;">
        <div class="card">
            <div class="row m-4">
                <?php 
                if (isset($_GET['bukuid'])) {
                    $bukuid = $_GET['bukuid'];
                }
                else{
                    die ("Error, Data Tidak Ditemukan");
                }
                include '../koneksi.php';
                $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE bukuid='$bukuid' ");
                $result = mysqli_fetch_array($query);
                ?>
                <div class="col text-center">
                    <img src="img/<?php echo $result['gambar']; ?>" width="400">
                </div>
                <div class="col" style="margin-top: 2rem;">
                    <h3>Form Peminjaman</h3>
                    <hr>
                    <form action="proses_pinjam.php" method="POST">
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text" id="basic-addon1">Buku</span>
                            <input type="text" name="bukuid" id="bukuid" class="form-control" aria-label="bukuid" value="<?php echo $result['bukuid']; ?>" readonly>
                        </div>
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text" id="basic-addon1">Siapa pinjam</span>
                            <input type="text" name="userid" id="userid" class="form-control" aria-label="userid" aria-describedby="basic-addon1" required>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3 mt-3">
                                    <span class="input-group-text" id="basic-addon1">Tanggal pinjam</span>
                                    <input type="date" name="tanggalpeminjaman" id="tanggalpeminjaman" class="form-control" placeholder="id buku" aria-label="tanggalpeminjaman" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3 mt-3">
                                    <span class="input-group-text" id="basic-addon1">Tanggal kembali</span>
                                    <input type="date" name="tanggalpengembalian" id="tanggalpengembalian" class="form-control" placeholder="id buku" aria-label="tanggalpengembalian" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text" id="basic-addon1">Status pinjam</span>
                            <select name="statuspeminjaman" class="form-select">
                                <option value="proses">Proses</option>
                                <option value="dikembalikan">Dikembalikan</option>
                                <option value="telat">Terlambat</option>
                            </select>
                        </div>
                        <a href="proses_pinjam.php" method="POST" class="btn btn-warning">Pinjam</a>
                        <button type="button" class="btn btn-primary">Pinjam</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
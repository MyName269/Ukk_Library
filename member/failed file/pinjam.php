<?php
session_start();
if(empty($_SESSION['username'])){
    echo "<script>
    document.location.href = '../logout.php';
    </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pinjam Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container" style="margin-top: 2rem;">
        <div class="card">
            <div class="row m-4">
                <?php 
                if (isset($_GET['bukuid'])) {
                    $bukuid = $_GET['bukuid'];
                }else{
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
                    <h3>Peminjaman Buku</h3>
                    <hr>
                    <form action="proses_pinjam.php" method="POST">
                    <div class="mb-3">
                        <label for="bukuid" class="form-label">Buku</label>
                        <input type="text" name="bukuid" class="form-control" value="<?php echo $result['judul']; ?>" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="userid" class="form-label">Peminjam</label>
                        <input type="text" name="userid" class="form-control" value="<?php echo htmlentities($_SESSION["username"]); ?>">
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label for="tanggalpeminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="tanggalpeminjaman" class="form-control" required>
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-3">
                            <label for="tanggalpengembalian">Tanggal Kembali</label>
                            <input type="date" name="tanggalpengembalian" class="form-control" required>
                          </div>
                        </div>
                      </div>
                        <div class="mb-3">
                          <label for="statuspeminjaman">Status</label>
                                                    <select name="statuspeminjaman" id="statuspeminjaman" class="form-control" required>
                                                        <option value="proses">Proses</option>
                                                        <option value="dikembalikan">Dikembalikan</option>
                                                        <option value="telat">Telat</option>
                                                    </select>
                      </div>
                      <a href="proses_pinjam.php" class="btn btn-primary">Pinjam</a>
                    </form>
              </div>
              </div>
              </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
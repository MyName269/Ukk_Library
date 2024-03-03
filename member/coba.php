<?php
session_start();
// Periksa apakah 'username' sudah diatur
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
// Gunakan variabel $username pada formulir

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peminjam</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="bootstrap.min.css">

  <!-- style -->
  <style>
    .bi-star-fill {
      color: orange;
    }
  </style>

</head>

<body>

  <div class="container">
    <div class="content mt-3">
      <div class="card bg-secondary bg-gradient">
        <div class="card-body">
          <a href="index.php" class="btn text-light">Dashboard</a>
          <a href="buku.php" class="btn text-light">Buku</a>
          <a href="koleksi.php" class="btn text-light">Koleksi</a>
          <a href="../logout.php" class="btn text-light">Logout</a>
        </div>
      </div>
    </div>
    <div class="container" style="margin-top: 3rem;">
      <div class="row">
        <h4>Pilihan Buku</h4>
        <?php
        include '../koneksi.php';
        $data = mysqli_query($koneksi, "SELECT * FROM buku Order By bukuid asc");

        while ($d = mysqli_fetch_array($data)) {
          $bukuid = $d['bukuid']; // Ambil bukuid untuk digunakan dalam query rating

          // Query untuk mengambil rating hanya untuk buku tertentu
          $queryRating = "SELECT rating FROM ulasanbuku WHERE bukuid = $bukuid";
          $resultRating = mysqli_query($koneksi, $queryRating);

          $totalRating = 0;
          $jumlahRating = 0;

          // Loop untuk menghitung jumlah total rating dan jumlah rating
          while ($rowRating = mysqli_fetch_assoc($resultRating)) {
            $totalRating += $rowRating['rating'];
            $jumlahRating++;
          }

          // Hitung rata-rata rating
          if ($jumlahRating > 0) {
            $rataRata = $totalRating / $jumlahRating;
          } else {
            $rataRata = 0; // Menghindari pembagian oleh nol
          }
        ?>
          <div class="card" style="width: 15rem;">
            <img src="../img/<?= $d['gambar'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title"><?= $d['judul']; ?></h4>
              <p class="fw-semibold">Rating:
                <?php
                for ($i = 1; $i <= 5; $i++) {
                  if ($i <= $rataRata) {
                    echo '<span class="bi bi-star-fill"></span>';
                  } else {
                    echo '<span class="bi bi-star"></span>';
                  }
                }
                ?>
              </p>
              <p class="fw-semibold">Tahun terbit : <?= $d['tahunterbit']; ?></p>
              <div>
                <a href="ulasan_buku_detail.php?bukuid=<?= $d['bukuid']; ?>" class="btn btn-sm btn-secondary text-dark">Ulasan</a>
                <a href="detail.php?bukuid=<?= $d['bukuid']; ?>" class="btn btn-sm btn-primary text-white">Detail</a>
                <a href="" data-bs-toggle="modal" data-bs-target="#modalEditBuku<?= $d['bukuid']; ?>"
                                    class="btn btn-info">Pinjam</a>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
      <!-- pinjam buku -->

<?php

$data = "SELECT * FROM buku, kategoribuku WHERE buku.kategoriid=kategoribuku.kategoriid ORDER BY bukuid ASC";
$result = mysqli_query($koneksi, $data);
while ($row = mysqli_fetch_array($result)) {
?>
<div class="modal fade" id="modalEditBuku<?= $row['bukuid']; ?>" tabindex="-1" aria-labelledby="modalEditBukuLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalEditBukuLabel">Yakin ingin meminjam?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="proses/tambah_pinjam.php" method="post">
            <div class="modal-body">
                <div class="form-group mt-2">
                    <input type="text" name="bukuid" id="bukuid" class="form-control" value="<?= $row['bukuid']; ?>" hidden>
                </div>
                <div class="form-group mt-2">
                    <input type="text" name="userid" id="userid" class="form-control"
                        placeholder="Masukkan Nama userid Buku" value="<?= $_SESSION['username']; ?>" hidden>
                </div>
                <div class="form-group mt-2">
                    <input type="date" name="tanggalpeminjaman" id="tanggalpeminjaman" class="form-control" hidden>
                </div>

                <div class="form-group mt-2">
                    <input type="text" name="tanggalpengembalian" id="tanggalpengembalian" class="form-control" hidden>
                </div>
                <div class="form-group mt-2">
                    <input type="text" name="statuspeminjaman" class="form-control" value="dipinjam" hidden>
                </div>
                
                <button type="submit" class="btn btn-primary">Pinjam</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<?php } ?>
    </div>
  </div>

  <!-- footer -->
  <div class="content mt-3 bg-white">
    <p class="text-center"> Aplikasi Perpustakaan Digital | 2024 </p>
  </div>

  <script src="bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
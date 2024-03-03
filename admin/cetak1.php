<?php
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Peminjaman Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 14px;
        }

        table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-4" align="center">Laporan Peminjaman Buku</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Peminjaman Buku -->
                <?php
                $peminjamanid = $_GET['peminjamanid'];
                $tanggalp = $_GET['tanggalpeminjaman'];
                $tanggalk = $_GET['tanggalpengembalian'];

                $no = 1;
                $data = mysqli_query($koneksi, "SELECT * FROM peminjam, user, buku WHERE peminjam.userid=user.userid AND  peminjam.bukuid=buku.bukuid AND tanggalpeminjaman >= '$tanggalp' AND (tanggalpengembalian <= '$tanggalk') AND peminjamanid = '$peminjamanid'");
                while ($row = mysqli_fetch_assoc($data)) {
                    $status = $row['statuspeminjaman'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $no++; ?>.
                        </td>
                        <td>
                            <?php echo $row['namalengkap']; ?>
                        </td>
                        <td>
                            <?php echo $row['judul']; ?>
                        </td>
                        <td>
                            <?php echo $row['tanggalpeminjaman']; ?>
                        </td>
                        <td>
                            <?php echo $row['tanggalpengembalian']; ?>
                        </td>
                        <td>
                            <?php if ($status == 1) { ?>
                                <span>Proses</span>
                            <?php } elseif ($status == 2) { ?>
                                <span>Dikembalikan</span>
                            <?php } elseif ($status == 3) { ?>
                                <span>Telat</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and Popper.js (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.print();
    </script>
</body>

</html>
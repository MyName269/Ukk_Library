<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan-Peminjaman.xls");
?>
<center>
    <h2>Laporan Peminjaman</h2>
</center>
<table border="2" class="table table-striped table-bordered">
    <tr>
        <th>No</th>
        <th>Peminjam</th>
        <th>Buku</th>
        <th>Tanggal Peminjaman</th>
        <th>Tanggal Pengembalian</th>
        <th>Status</th>
    </tr>
    <?php
    include '../koneksi.php';
    $no = 1;
    $data = "SELECT * FROM peminjam,buku,user WHERE peminjam.userid=user.userid AND  peminjam.bukuid=buku.bukuid ORDER BY tanggalpeminjaman ASC";
    // ASC = kolom tanggalpeminjaman yang terbaru teratas.
    // DESC = kolom tanggalpeminjaman yang paling lama teratas.
    $result = mysqli_query($koneksi, $data);
    while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td>
                <?= $no++; ?>
            </td>
            <td>
                <?= $row['namalengkap']; ?>
            </td>
            <td>
                <?= $row['judul']; ?>
            </td>
            <td>
                <?= $row['tanggalpeminjaman']; ?>
            </td>
            <td>
                <?= $row['tanggalpengembalian']; ?>
            </td>
            <td>
                <?= $row['statuspeminjaman']; ?>
            </td>
        </tr>
    <?php } ?>
</table>
<?php
$username = $_SESSION['username'];
?>
<!-- berupa kolom tabel -->
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Peminjam</th>
            <th>Buku</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../koneksi.php';
        $no = 1;
        $data = "SELECT * FROM peminjam,buku,user WHERE peminjam.userid=user.userid AND  peminjam.bukuid=buku.bukuid ORDER BY tanggalpeminjaman ASC";
        // ASC = kolom tanggalpeminjaman yang terbaru teratas.
        // DESC = kolom tanggalpeminjaman yang paling lama teratas.
        $result = mysqli_query($koneksi, $data);
        while ($row = mysqli_fetch_assoc($result)) {
            $statuspeminjaman = mysqli_query($koneksi, "SELECT * FROM peminjam WHERE statuspeminjaman = 'dikembalikan'");
            $status1 = mysqli_fetch_array($statuspeminjaman);
            $status = $status1['statuspeminjaman'];
            ?>
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
                    <!-- query untuk melihat jika sudah lunas maka akan ada tulisa lunas -->
                    <?php
                    if ($status == 1) {
                        echo "<span class='badge text-bg-success'> Dikembalikan </span>";
                    } else { ?>
                        <a class="btn btn-sm btn-primary" href="" data-toggle="modal"
                            data-target="#bukudetailModal<?php echo $row['bukuid']; ?>"><i class="fa fa-eye"></i></a>
                    <?php } ?>
                </td>
                <!-- <td>
                                                    <a href="detail2.php?bukuid=" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                </td> -->
            </tr>
        <?php } ?>
    </tbody>
</table>


<!-- Modal Detail -->

<div class="container">
    <?php
    $datab = "SELECT * FROM buku WHERE bukuid";
    $resultb = mysqli_query($koneksi, $datab);
    while ($result = mysqli_fetch_assoc($resultb)) {
        ?>
        <div class="modal fade" id="bukudetailModal<?php echo $result['bukuid']; ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <div class="row m-4">
                            <div class="col text-center">
                                <img src="img/<?php echo $result['gambar']; ?>" width="200">
                            </div>
                            <div class="col" style="margin-top: 2rem;">
                                <h3>Detail Buku</h3>
                                <a href="koleksisaya.php" class="btn btn-danger">Kembali</a>
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
                                    <tr>
                                        <th>
                                            <h6>Deskripsi </h6>
                                        </th>
                                        <td>:
                                            <?php echo $result['deskripsi']; ?>
                                        </td>
                                    </tr>
                                </table>
                                <a href="ulasan.php?bukuid=<?php echo $result['bukuid']; ?>" class="btn btn-warning">Tulis
                                    Ulasan</a>
                                <a href="#" class="btn btn-success my-4">Baca Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div>
</div>
</div>
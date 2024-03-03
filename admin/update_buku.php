<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $bukuid = $_POST["bukuid"];
    $judul = htmlspecialchars(addslashes($_POST['judul']));
    $deskripsi = htmlspecialchars(addslashes($_POST['deskripsi']));
    $sinopsis = htmlspecialchars(addslashes($_POST['sinopsis']));
    $penulis = htmlspecialchars(addslashes($_POST['penulis']));
    $penerbit = htmlspecialchars(addslashes($_POST['penerbit']));
    $kategoriid = $_POST['kategoriid'];
    $tahunterbit = htmlspecialchars($_POST['tahunterbit']);

    //koneksi 
    include '../koneksi.php';
 
    // Upload gambar jika ada perubahan gambar
    if ($_FILES["gambar"]["name"]) {
        $gambar = $_FILES["gambar"]["name"];
        $gambar_tmp = $_FILES["gambar"]["tmp_name"];
        $upload_folder = "img/"; // Direktori penyimpanan gambar
        move_uploaded_file($gambar_tmp, $upload_folder . $gambar);
        
        // Update data staff dengan gambar
        $sql = "UPDATE buku SET judul='$judul', deskripsi='$deskripsi', sinopsis='$sinopsis', penulis='$penulis', penerbit='$penerbit', kategoriid='$kategoriid', tahunterbit='$tahunterbit', gambar='$gambar' WHERE bukuid=$bukuid";
    } else {
        // Update data staff tanpa perubahan gambar
        $sql = "UPDATE buku SET judul='$judul', deskripsi='$deskripsi', sinopsis='$sinopsis', penulis='$penulis', penerbit='$penerbit', kategoriid='$kategoriid', tahunterbit='$tahunterbit' WHERE bukuid=$bukuid";
    }

    if (mysqli_query($koneksi, $sql)) {
        echo '<script language="javascript" type="text/javascript">
          alert("Data buku berhasil diupdate.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=fiksi.php'>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>
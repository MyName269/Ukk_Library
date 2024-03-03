<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "library");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;
$judul = htmlspecialchars(addslashes($_POST['judul']));
$penulis = htmlspecialchars(addslashes($_POST['penulis']));
$penerbit = htmlspecialchars(addslashes($_POST['penerbit']));
$namakategori = $_POST['namakategori'];
$tahunterbit = htmlspecialchars($_POST['tahunterbit']);
$deskripsi = htmlspecialchars(addslashes($_POST['deskripsi']));
$sinopsis = htmlspecialchars(addslashes($_POST['sinopsis']));

//upload gambar
$gambar = upload();
if( !$gambar ){
    return false;
}

$query = "INSERT INTO buku (judul,penulis,penerbit,namakategori,tahunterbit,deskripsi,sinopsis,gambar) VALUES('$judul', '$penulis', '$penerbit', '$namakategori', '$tahunterbit', '$deskripsi', '$sinopsis', '$gambar')";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function upload() {

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yg diupload
    if( $error === 4 ) {
        echo "<script>
                alert('Upload gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // cek apakah yg diupload gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!')
              </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran/size gambar terlalu besar!');
              </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru; 
}
?>
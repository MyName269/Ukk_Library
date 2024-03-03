<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $userid = $_POST["userid"];
    $username = htmlspecialchars(addslashes($_POST['username']));
    $password = htmlspecialchars(addslashes($_POST['password']));
    $email = htmlspecialchars(addslashes($_POST['email']));
    $namalengkap = htmlspecialchars(addslashes($_POST['namalengkap']));
    $alamat = htmlspecialchars(addslashes($_POST['alamat']));
    $stat = $_POST['stat'];

    //koneksi
    include '../koneksi.php';
 
    // Upload foto jika ada perubahan foto
    if (addslashes($_FILES["foto"]["name"])) {
        $foto = addslashes($_FILES["foto"]["name"]);
        $foto_tmp = $_FILES["foto"]["tmp_name"];
        $upload_folder = "img/"; // Direktori penyimpanan foto
        move_uploaded_file($foto_tmp, $upload_folder . $foto);
        
        // Update data staff dengan foto
        $sql = "UPDATE user SET username='$username', password='$password', email='$email', namalengkap='$namalengkap', alamat='$alamat', stat='$stat', foto='$foto' WHERE userid=$userid";
    } else {
        // Update data staff tanpa perubahan foto
        $sql = "UPDATE user SET username='$username', password='$password', email='$email', namalengkap='$namalengkap', alamat='$alamat', stat='$stat' WHERE userid=$userid";
    }

    if (mysqli_query($koneksi, $sql)) {
        echo '<script language="javascript" type="text/javascript">
          alert("Data user berhasil diupdate.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=profile.php'>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>
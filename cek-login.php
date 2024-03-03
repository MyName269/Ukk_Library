<?php

$host = "localhost";
$user = "root"; //nama user yang digunakan masuk k database
$password = ""; //password yagn digunakan masuk k database
$database = "library1"; //nama database yang digunakkan
$koneksi = mysqli_connect($host, $user, $password, $database);

//cek koneksi ke database
//jika tidak menampilkan apa-apa artinya koneksi berhasil dilakukan
if (mysqli_connect_errno()) {
    echo "Koneksi gagal : " . mysqli_connect_error();
}


if (isset($_POST["login"])) {
    //mengambil data yang dikirim dari form sebelumnya
    $username = $_POST['username'];
    $password = $_POST["password"];

    //mengambil data user di tabel user
    $user = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");

    // cek apakah username dan password di temukan pada database
    if (mysqli_num_rows($user) === 1) {

        $data = mysqli_fetch_array($user);
        if (password_verify($password, $data["password"])) {

            //mengaktifkan session
            session_start();

            $_SESSION['userid'] = $data['userid'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['stat'] = $data['stat'];
            if ($data['stat'] == 'Admin') {
                header('Location:admin/admin.php');
            } elseif ($data['stat'] == 'Petugas') {
                header('Location:petugas/petugas.php');
            } elseif ($data['stat'] == 'Member') {
                header('Location:member/member.php');
            }
        } else {
            //jika user tidak ditemukan
            header("location:index.php?pesan=gagal");
        }
    }
}
?>
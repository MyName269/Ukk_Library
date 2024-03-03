<?php
 $koneksi = mysqli_connect("localhost", "root", "", "library1");

 if(mysqli_connect_errno()){
    echo "Koneksi database anda gagal :" . mysqli_connect_errno();
 }
?>
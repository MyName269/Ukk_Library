<?php
session_start();
session_destroy(); // Menghapus semua data sesi

header("location:index.php?pesan=info_logout"); // Redirect kembali ke halaman login setelah logout
exit();
?>
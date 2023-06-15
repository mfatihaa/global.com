<?php
include './conn.php';
session_start();

// Update Time Logout
$date = date('Y-m-d h:i:s');
$update = mysqli_query($conn, "UPDATE pelanggan SET time_logout = '$date' WHERE id_pelanggan = '{$_SESSION['id_pelanggan']}' ");

if ($update) {
    session_unset();
    echo "<script>alert('Anda Berhasil Keluar.');document.location.href='./'</script>";
}

session_destroy();
exit;
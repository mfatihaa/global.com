<?php
include './conn.php';
@session_start();

if (isset($_SESSION['keranjang'])) {
    unset($_SESSION['username']);
    echo '<script>alert("Anda Berhasil Logout!");document.location.href="./log-in.php"</script>';
} else {
    echo '<script>alert("Anda Berhasil Logout!");document.location.href="./log-in.php"</script>';
}

$user = $_SESSION['username'];

session_unset();

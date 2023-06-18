<?php
error_reporting(0);
include "./conn.php";
session_start();

$id = $_SESSION['id_user'];
$view = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id'");
$row = mysqli_fetch_assoc($view);
if ($view) {
    $date = date('Y-m-d h:i:s');
    $id_user = $row['id_user'];
    $update = mysqli_query($conn, "UPDATE user SET time_logout = '$date' WHERE id_user = '$id_user'");

    if ($update) {
        echo "<script>alert('Terimakasih!');document.location.href='./'</script>";
    }
    session_unset();
}

session_destroy();
exit();
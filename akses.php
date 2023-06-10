<?php
error_reporting(0);
session_start();
include './conn.php';
if (isset($_POST['masuk'])) {
    $user = htmlspecialchars(addslashes(trim($_POST['username'])));
    $pass = htmlspecialchars(addslashes(trim(md5($_POST['pass']))));

    if (!empty($user) && !empty($pass)) {
        $view = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username='$user' AND password='$pass'");
        $sum = mysqli_num_rows($view);
        if ($sum > 1) {
            $data = mysqli_fetch_assoc($view);
            echo "<script>alert('Mohon Maaf Akun $user Belum Diaktifkan Oleh Superadmin atau Akun $user Belum Terdaftar.');document.location.href='./registration.php'</script>";
        } else {
            $data = mysqli_fetch_assoc($view);

            $_SESSION['id_pelanggan']   = $data['id_pelanggan'];
            $_SESSION['nama']           = $data['nama'];
            $_SESSION['username']       = $data['username'];
            $_SESSION['email']          = $data['email'];
            $_SESSION['password']       = $data['password'];
            $_SESSION['konfirmasi']     = $data['konfirmasi'];

            if ($data['username'] == $user && $data['id_pelanggan']) {
                echo "<script>alert('Welcome To Global Techno $_SESSION[nama] !');document.location.href='./'</script>";
            } else {
                echo "<script>alert('Mohon Maaf Akun $user Anda Belum Tersedia.');document.location.href='./log-in.php'</script>";
            }
        }
    } else {
        echo "<script>alert('Mohon Maaf Anda Tidak Dapat Login! Karena $user Tidak Ditemukan.');document.location.href='./log-in.php'</script>";
    }
}

<?php
// Password Change
include "./conn.php";
if (isset($_POST['pass_change'])) {
    $user_chg = htmlspecialchars(addslashes($_POST['user_change']));
    $pass_chg = htmlspecialchars(addslashes(md5($_POST['password_change'])));
    $konfir_chg = htmlspecialchars(addslashes(md5($_POST['konfirmasi_change'])));

    $view_chg = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user_chg'");
    $row = mysqli_fetch_assoc($view_chg);

    if (mysqli_num_rows($view_chg) === 1) {

        $update_chg = mysqli_query($conn, "UPDATE user SET password = '$pass_chg', konfirmasi = '$konfir_chg' WHERE username = '{$row['username']}' ");
        if ($update_chg) {
            echo "<script>alert('Anda Berhasil Mengganti Kata Sandi.');document.location.href='./log-in.php'</script>";
        } else {
            echo "<script>alert('Anda Tidak Berhasil Mengganti Kata Sandi.');document.location.href='./log-in.php'</script>";
        }
    } else {
        echo "<script>alert('Akun Anda Tidak Ditemukan !');document.location.href='./change-password.php'</script>";
    }
}

// Login
session_start();
include "./conn.php";
if (isset($_POST['masuk'])) {

    $username_login = htmlspecialchars(addslashes($_POST['username']));
    $password_login = htmlspecialchars(addslashes(md5($_POST['password'])));

    $view_login = mysqli_query($conn, "SELECT * FROM user WHERE username = '{$username_login}' AND password = '{$password_login}' AND status = 'ON' ");
    if (mysqli_num_rows($view_login) == 0) {
        echo "<script>alert('Email & Password Anda Masukkan Salah! Atau Status Akun Anda OFF.');document.location.href='./log-in.php'</script>";
    } else {
        $data_login = mysqli_fetch_assoc($view_login);

        $_SESSION['id_user'] = $data_login['id_user'];
        $_SESSION['nama'] = $data_login['nama'];
        $_SESSION['username'] = $data_login['username'];
        $_SESSION['password'] = $data_login['password'];

        if ($data_login['username'] == $username_login && $data_login['password'] == $password_login) {
            // Update Time Login
            $date = date('Y-m-d h:i:s');
            $update_login = mysqli_query($conn, "UPDATE user SET time_login = '$date' WHERE username = '{$username_login}' ");
            if ($update_login) {
                echo "<script>alert('Anda Berhasil Masuk.');document.location.href='./'</script>";
            } else {
                echo "<script>alert('Anda Tidak Berhasil Masuk.');document.location.href='./log-in.php'</script>";
            }
        } else {
            echo "<script>alert('Tidak Ada Akun Yang Cocok.');document.location.href='./log-in.php'</script>";
        }
    }
}
?>
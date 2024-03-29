<?php
// Delete Keranjang List
if (isset($_GET['code'])) {
    session_start();
    $code_product = $_GET['code'];
    unset($_SESSION['cart'][$code_product]);
    echo "<script>alert('Product Atau Service Berhasil Dihapus.')</script>";
    echo "<script>location='./cart'</script>";
}

// Password Change
include "./conn.php";
if (isset($_POST['pass_change'])) {
    $user_chg = htmlspecialchars(addslashes($_POST['user_change']));
    $pass_chg = htmlspecialchars(addslashes(md5($_POST['password_change'])));
    $konfir_chg = htmlspecialchars(addslashes(md5($_POST['konfirmasi_change'])));

    $view_chg = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '$user_chg'");
    $row = mysqli_fetch_assoc($view_chg);

    if (mysqli_num_rows($view_chg) === 1) {

        $update_chg = mysqli_query($conn, "UPDATE pelanggan SET password = '$pass_chg', konfirmasi = '$konfir_chg' WHERE username = '{$row['username']}' ");
        if ($update_chg) {
            echo "<script>alert('Anda Berhasil Mengganti Kata Sandi.');document.location.href='./log-in'</script>";
        } else {
            echo "<script>alert('Anda Tidak Berhasil Mengganti Kata Sandi.');document.location.href='./log-in'</script>";
        }
    } else {
        echo "<script>alert('Akun Anda Tidak Ditemukan !');document.location.href='./change-password'</script>";
    }
}

// Register Admin
error_reporting(0);
session_start();
include "./conn.php";
if (isset($_POST['daftar_admin'])) {
    
    $username_register = htmlspecialchars(addslashes($_POST['username']));
    $nama = htmlspecialchars(addslashes($_POST['nama']));
    $email = htmlspecialchars(addslashes(trim($_POST['email'], FILTER_VALIDATE_EMAIL)));
    $telepon = htmlspecialchars(addslashes($_POST['telepon']));
    $password_register = htmlspecialchars(addslashes(md5($_POST['pass'])));
    $confirm_register = htmlspecialchars(addslashes(md5($_POST['confirm'])));

    $view_regis = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    $data_regis = mysqli_fetch_assoc($view_regis);

    if (mysqli_num_rows($view_regis) == 0) {
        session_start();
        $insert_cus = mysqli_query($conn, "INSERT INTO user (username, nama, email, telepon, password, konfirmasi, status) VALUES ('$username_register', '$nama', '$email', '$telepon', '$password_register', '$confirm_register', 'ON') ");
        if ($insert_cus) {
            echo "<script>alert('Pendaftaran Anda Telah Berhasil.');document.location.href='./users/log-in'</script>";
            unset($_SESSION['create']);
            session_destroy();
        } else {
            echo "<script>alert('Pendaftaran Anda Tidak Berhasil.');document.location.href='./admin'</script>";
        }
    } else {
        echo "<script>alert('Akun Sudah Tersedia.');document.location.href='./admin'</script>";
    }
    unset($_SESSION['create']);
    session_destroy();
}

// Register
error_reporting(0);
include "./conn.php";
if (isset($_POST['daftar'])) {
    $username_register = htmlspecialchars(addslashes($_POST['username']));
    $nama = htmlspecialchars(addslashes($_POST['nama']));
    $email = htmlspecialchars(addslashes(trim($_POST['email'], FILTER_VALIDATE_EMAIL)));
    $telepon = htmlspecialchars(addslashes($_POST['telepon']));
    $password_register = htmlspecialchars(addslashes(md5($_POST['pass'])));
    $confirm_register = htmlspecialchars(addslashes(md5($_POST['confirm'])));

    $view_regis = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY code_pelanggan LIMIT 1");
    $data_regis = mysqli_fetch_assoc($view_regis);

    if (mysqli_num_rows($view_regis) == 0) {
        // Jika Kode Pelanggan Belum Ada 1
        $view_code = mysqli_query($conn, "SELECT max(code_pelanggan) AS kode FROM pelanggan");
        $data_code = mysqli_fetch_assoc($view_code);

        $code = $data_code['kode'];
        $code_urutan = (int) substr($code, 3, 5);
        $code_urutan++;

        $code_huruf = "GT-";
        $code_gabung = $code_huruf . sprintf(
            "%05s",
            $code_urutan
        );

        $insert_cus = mysqli_query($conn, "INSERT INTO pelanggan (code_pelanggan, username, nama, email, telepon, password, konfirmasi, kondisi) VALUES ('$code_gabung','$username_register', '$nama', '$email', '$telepon', '$password_register', '$confirm_register', 'ON') ");
        if ($insert_cus) {
            echo "<script>alert('Pendaftaran Anda Telah Berhasil.');document.location.href='./log-in'</script>";
        } else {
            echo "<script>alert('Pendaftaran Anda Tidak Berhasil.');document.location.href='./registration'</script>";
        }
    } elseif (mysqli_num_rows($view_regis) === 1) {
        // Jika Kode Pelanggan Telah Ada 1
        $view_code = mysqli_query($conn, "SELECT max(code_pelanggan) AS kode FROM pelanggan");
        $data_code = mysqli_fetch_assoc($view_code);

        $code = $data_code['kode'];
        $code_urutan = (int) substr($code, 3, 5);
        $code_urutan++;

        $code_huruf = "GT-";
        $code_gabung = $code_huruf . sprintf(
            "%05s",
            $code_urutan
        );

        $insert_cus = mysqli_query($conn, "INSERT INTO pelanggan (code_pelanggan, username, nama, email, telepon, password, konfirmasi, kondisi) VALUES ('$code_gabung','$username_register', '$nama', '$email', '$telepon', '$password_register', '$confirm_register', 'ON') ");
        if ($insert_cus) {
            echo "<script>alert('Pendaftaran Anda Telah Berhasil.');document.location.href='./log-in'</script>";
        } else {
            echo "<script>alert('Pendaftaran Anda Tidak Berhasil.');document.location.href='./registration'</script>";
        }
    }
}

// Update Settings
error_reporting(0);
include "./conn.php";
if (isset($_POST['update'])) {
    $id = htmlspecialchars(addslashes($_POST['id']));
    $username_update = htmlspecialchars(addslashes($_POST['username']));
    $nama_update = htmlspecialchars(addslashes($_POST['nama']));
    $email_update = htmlspecialchars(addslashes(trim($_POST['email'], FILTER_VALIDATE_EMAIL)));
    $telepon_update = htmlspecialchars(addslashes($_POST['telepon']));

    $view_cus = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '{$id}'");
    $data_cus = mysqli_fetch_assoc($view_cus);

    // Cek Apakah Ada Input Image Baru
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        // Cek Informasi Input Image Unggah
        $image = $_FILES['image'];

        // Pengambilan Ekstensi Image
        $path = pathinfo($image['name'], PATHINFO_EXTENSION);

        // Format Ekstensi Yang Diperbolehkan
        $format = array('jpg', 'jpeg', 'png', 'svg');

        if (!in_array($path, $format)) {
            echo "<script>alert('Hanya Format JPG, JPEG, PNG & SVG Yang Diperbolehkan!');document.location.href='./settings'</script>";
            exit;
        }

        $img = md5_file($nama_update) . "-" . $path;
        $folder = "./vendor/img-customer/" . $img;

        // Hapus Gambar Yang Digunakan Dari Local Storage
        $img_remove = $data_cus['image'];
        if (file_exists("./vendor/img-customer/$img_remove")) {
            unlink("./vendor/img-customer/$img_remove");
        }

        // Memindahkan Image Baru Ke Dalam Folder Yang Telah Disediakan
        if (move_uploaded_file($image['tmp_name'], $folder)) {

            $update = mysqli_query($conn, "UPDATE pelanggan SET username = '$username_update', nama = '$nama_update', email = '$email_update', telepon = '$telepon_update', image = '$img' WHERE id_pelanggan = '{$data_cus['id_pelanggan']}' ");
            if ($update) {
                echo "<script>alert('Data Berhasil Diubah Dengan Gambar');document.location.href='./settings'</script>";
            } else {
                echo "<script>alert('Data Tidak Berhasil Diubah!');document.location.href='./settings'</script>";
            }
        }
    } else {
        $update = mysqli_query($conn, "UPDATE pelanggan SET username = '$username_update', nama = '$nama_update', email = '$email_update', telepon = '$telepon_update' WHERE id_pelanggan = '{$data_cus['id_pelanggan']}' ");
        if ($update) {
            echo "<script>alert('Data Berhasil Diubah Tanpa Gambar');document.location.href='./settings'</script>";
        } else {
            echo "<script>alert('Data Tidak Berhasil Diubah!');document.location.href='./settings'</script>";
        }
    }
}

// Login Account Create Admin
error_reporting(0);
@session_start();
include "./conn.php";
if (isset($_POST['buat'])) {
    $check_user = "root";
    $check_pass = "skripsi2023";

    $user = htmlspecialchars(addslashes($_POST['username']));
    $pass = htmlspecialchars(addslashes($_POST['password']));

    if ($user == $check_user && $pass = $check_pass) {
        session_start();
        $_SESSION['create'] = array(
            $_SESSION['username'] = $check_user,
            $_SESSION['password'] = $check_pass,
        );

        header('Location: ./admin');
    }
}

// Login
error_reporting(0);
@session_start();
include "./conn.php";
if (isset($_POST['masuk'])) {

    $username_login = htmlspecialchars(addslashes($_POST['username']));
    $password_login = htmlspecialchars(addslashes(md5($_POST['password'])));

    $view_login = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '{$username_login}' AND password = '{$password_login}' AND kondisi = 'ON' ");
    if (mysqli_num_rows($view_login) == 0) {
        echo "<script>alert('Email & Password Anda Masukkan Salah! Atau Status Akun Anda OFF.');document.location.href='./log-in'</script>";
    } else {
        $data_login = mysqli_fetch_assoc($view_login);
        $_SESSION['pelanggan'] = $data_login;
        $_SESSION['id_pelanggan'] = $data_login['id_pelanggan'];
        $_SESSION['username'] = $data_login['username'];
        $_SESSION['password'] = $data_login['password'];

        if ($data_login['username'] == $username_login && $data_login['password'] == $password_login) {
            // Update Time Login
            $date = date('Y-m-d h:i:s');

            $update_login = mysqli_query($conn, "UPDATE pelanggan SET time_login = '$date' WHERE username = '{$username_login}' ");
            if ($update_login) {
                echo "<script>alert('Anda Berhasil Masuk.');document.location.href='./'</script>";
            } else {
                echo "<script>alert('Anda Tidak Berhasil Masuk.');document.location.href='./log-in'</script>";
            }
        } else {
            echo "<script>alert('Tidak Ada Akun Yang Cocok.');document.location.href='./log-in'</script>";
        }
    }
}
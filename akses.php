<?php

// Login
if (isset($_POST['masuk'])) {
    session_start();
    include "./conn.php";

    $username_login = htmlspecialchars(addslashes($_POST['username']));
    $password_login = htmlspecialchars(addslashes(md5($_POST['password'])));

    $view_login = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '{$username_login}' AND password = '{$password_login}' AND kondisi = 'ON' ");
    if (mysqli_num_rows($view_login) == 0) {
        echo "<script>alert('Email & Password Anda Masukkan Salah!');document.location.href=''</script>";
    } else {
        $data_login = mysqli_fetch_assoc($view_login);

        $_SESSION['id_pelanggan'] = $data_login['id_pelanggan'];
        $_SESSION['username'] = $data_login['username'];
        $_SESSION['password'] = $data_login['password'];

        echo "<script>alert('Anda Berhasil Masuk.');document.location.href='./'</script>";
    }
} else {
    echo "<script>alert('Akun Anda Belum Terdaftar Atau Belum Aktif. Terimakasih!');document.location.href='./log-in.php'</script>";
}

// Register
if (isset($_POST['daftar'])) {
    $username_register = htmlspecialchars(addslashes($_POST['username']));
    $nama = htmlspecialchars(addslashes($_POST['nama']));
    $email = htmlspecialchars(addslashes($_POST['email']));
    $telepon = htmlspecialchars(addslashes($_POST['telepon']));
    $password_register = htmlspecialchars(addslashes(md5($_POST['pass'])));
    $confirm_register = htmlspecialchars(addslashes(md5($_POST['confirm'])));

    $insert_cus = mysqli_query($conn, "INSERT INTO pelanggan (username, nama, email, telepon, password, konfirmasi, kondisi) VALUES ('$username_register', '$nama', '$email', '$telepon', '$password_register', '$confirm_register', 'OFF') ");
    if ($insert_cus) {
        echo "<script>alert('Pendaftaran Anda Telah Berhasil.');document.location.href='./log-in.php'</script>";
    } else {
        echo "<script>alert('Pendaftaran Anda Tidak Berhasil.');document.location.href='./registration.php'</script>";
    }
}

// Update Settings
if (isset($_POST['update'])) {

    $id = htmlspecialchars(addslashes($_POST['id']));
    $username_update = htmlspecialchars(addslashes($_POST['username']));
    $nama_update = htmlspecialchars(addslashes($_POST['nama']));
    $email_update = htmlspecialchars(addslashes($_POST['email']));
    $telepon_update = htmlspecialchars(addslashes($_POST['telepon']));
    $password_update = htmlspecialchars(addslashes(md5($_POST['pass'])));
    $confirm_update = htmlspecialchars(addslashes(md5($_POST['confirm'])));

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
            echo "<script>alert('Hanya Format JPG, JPEG, PNG & SVG Yang Diperbolehkan!');document.location.href='./settings.php'</script>";
            exit;
        }

        $img = rand() . "-" . $path;

        // Memindahkan Image Ke Dalam Folder Yang Telah Disediakan
        $folder = "./vendor/img-customer/" . $img;
        if (move_uploaded_file($image['tmp_name'], $folder)) {
            $update = mysqli_query($conn, "UPDATE pelanggan SET username = '$username_update', nama = '$nama_update', email = '$email_update', telepon = '$telepon_update', image = '$img', password = '$password_update', konfirmasi = '$confirm_update' WHERE id_pelanggan = '{$data_cus['id_pelanggan']}' ");
            if ($update) {
                echo "<script>alert('Data Berhasil Diubah Dengan Gambar');document.location.href='./settings.php'</script>";
            } else {
                echo "<script>alert('Data Tidak Berhasil Diubah!');document.location.href='./settings.php'</script>";
            }
        }
    } else {
        $update = mysqli_query($conn, "UPDATE pelanggan SET username = '$username_update', nama = '$nama_update', email = '$email_update', telepon = '$telepon_update', password = '$password_update', konfirmasi = '$confirm_update' WHERE id_pelanggan = '{$data_cus['id_pelanggan']}' ");
        if ($update) {
            echo "<script>alert('Data Berhasil Diubah Tanpa Gambar');document.location.href='./settings.php'</script>";
        } else {
            echo "<script>alert('Data Tidak Berhasil Diubah!');document.location.href='./settings.php'</script>";
        }
    }
}
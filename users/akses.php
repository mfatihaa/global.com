<?php
// Add Product
include "./conn.php";
if (isset($_POST['add_produk'])) {
    $nm_produk = htmlspecialchars(addslashes($_POST['nm_produk']));
    $jml_produk = htmlspecialchars(addslashes($_POST['jml_produk']));
    $hrg_produk = htmlspecialchars(addslashes($_POST['hrg_produk']));
   
    $view_produk = mysqli_query($conn, "SELECT * FROM product ORDER BY id_product LIMIT 1 ");
    $data_produk = mysqli_fetch_assoc($view_produk);

    // Cek Apakah Ada Input Image Baru
    if (isset($_FILES['img_produk']) && $_FILES['img_produk']['error'] === UPLOAD_ERR_OK) {

        // Cek Informasi Input Image Unggah
        $image = $_FILES['img_produk'];

        // Pengambilan Ekstensi Image
        $path = pathinfo($image['name'], PATHINFO_EXTENSION);

        // Format Ekstensi Yang Diperbolehkan
        $format = array('jpg', 'jpeg', 'png', 'svg');

        if (!in_array($path, $format)) {
            echo "<script>alert('Hanya Format JPG, JPEG, PNG & SVG Yang Diperbolehkan!');document.location.href='./service_produk.php'</script>";
            exit;
        }

        $img = rand() . "-" . $path;
        $folder = "./vendor/img/" . $img;
        $date = date('Y-m-d h:i:s');
        $status = "Ready";

        // Memindahkan Image Baru Ke Dalam Folder Yang Telah Disediakan
        if (move_uploaded_file($image['tmp_name'], $folder)) {

            $insert_product = mysqli_query($conn, "INSERT INTO product (nama_product, jumlah_product, harga_product, image_product, status_product, tanggal_upload) VAlUES ('$nm_produk', '$jml_produk', '$hrg_produk', '$img', '$status', '$date') ") ;
            if ($insert_product) {
                echo "<script>alert('Data Berhasil Di Tambah!');document.location.href='./service_produk.php'</script>";
            } else {
                echo "<script>alert('Data Tidak Dapat Di Tambah!');document.location.href='./service_produk.php'</script>";
            }
        }
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO product (nama_product, jumlah_product, harga_product, status_product, tanggal_upload) VAlUES ('$nm_produk', '$jml_produk', '$hrg_produk', '$status', '$date') ") ;
        if ($insert_product) {
            echo "<script>alert('Data Berhasil Di Tambahkan Tanpa Gambar');document.location.href='./service_produk.php'</script>";
        } else {
            echo "<script>alert('Data Tidak Berhasil Di Tambahkan!');document.location.href='./service_produk.php'</script>";
        }
    }
}
           
// Add Service
include "./conn.php";
if (isset($_POST['add_service'])) {
    $nama = htmlspecialchars(addslashes($_POST['nm_service']));
    $jumlah = htmlspecialchars(addslashes($_POST['jml_service']));
    $harga = htmlspecialchars(addslashes($_POST['hrg_service']));

    $view_service = mysqli_query($conn, "SELECT * FROM service ORDER BY id_service LIMIT 1");
    $data_service = mysqli_fetch_assoc($view_service);

    // Cek Apakah Ada Input Image Baru
    if (isset($_FILES['img_service']) && $_FILES['img_service']['error'] === UPLOAD_ERR_OK) {

        // Cek Informasi Input Image Unggah
        $image = $_FILES['img_service'];
        // Memindahkan Image Baru Ke Dalam Folder Yang Telah Disediakan
        if (move_uploaded_file($image['tmp_name'], $folder)) {
            $status = "Ready";
            $tgl_upload = date("Y-m-d h:i:s");

            $insert_service = mysqli_query($conn, "INSERT INTO service (nama_service, jumlah_service, harga_service, image_service, status_service, tanggal_upload) VALUES ('$nama', '$jumlah', '$harga', '$img', '$status', '$tgl_upload') ");
            if ($insert_service) {
                echo "<script>alert('Anda Berhasil Mengupload List Service Dengan Image.');document.location.href='./service_produk.php'</script>";
            } else {
                echo "<script>alert('Data Tidak Berhasil Dibuat!');document.location.href='./service_produk.php'</script>";
            }
        }
    } else {
        $insert_service = mysqli_query($conn, "INSERT INTO service (nama_service, jumlah_service, harga_service, status_service, tanggal_upload) VALUES ('$nama', '$jumlah', '$harga', '$status', '$tgl_upload') ");
        if ($insert_service) {
            echo "<script>alert('Anda Berhasil Mengupload List Service Tanpa Image.');document.location.href='./service_produk.php'</script>";
        } else {
            echo "<script>alert('Data Tidak Berhasil Dibuat!');document.location.href='./service_produk.php'</script>";
        }
    }
}

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
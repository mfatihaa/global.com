<?php
// Change Product List
error_reporting(0);
include "./conn.php";
if (isset($_POST['edit_product'])) {
    $id = htmlspecialchars(addslashes($_POST['id']));
    $nm_product = htmlspecialchars(addslashes($_POST['nm_product']));
    $jml_product = htmlspecialchars(addslashes($_POST['jml_product']));
    $hrg_product = htmlspecialchars(addslashes($_POST['hrg_product'],));

    $view_edit_product = mysqli_query($conn, "SELECT * FROM product WHERE id_product = '{$id}'");
    $data_edit_product = mysqli_fetch_assoc($view_edit_product);

    // Cek Apakah Ada Input Image Baru
    if (isset($_FILES['img_product']) && $_FILES['img_product']['error'] === UPLOAD_ERR_OK) {

        // Cek Informasi Input Image Unggah
        $image = $_FILES['img_product'];

        // Pengambilan Ekstensi Image
        $path = pathinfo($image['name'], PATHINFO_EXTENSION);

        // Format Ekstensi Yang Diperbolehkan
        $format = array('jpg', 'jpeg', 'png', 'svg');

        if (!in_array($path, $format)) {
            echo "<script>alert('Hanya Format JPG, JPEG, PNG & SVG Yang Diperbolehkan!');document.location.href='./service_produk'</script>";
            exit;
        }

        $img = "Product" . "-" . rand() . "-" . $path;
        $folder = "./vendor/img/" . $img;
        $date = date('Y-m-d h:i:s');

        // Hapus Gambar Yang Digunakan Dari Local Storage
        $img_remove = $data_edit_product['image_product'];
        if (file_exists("./vendor/img/$img_remove")) {
            unlink("./vendor/img/$img_remove");
        }

        // Memindahkan Image Baru Ke Dalam Folder Yang Telah Disediakan
        if (move_uploaded_file($image['tmp_name'], $folder)) {

            $update_product_list = mysqli_query($conn, "UPDATE product SET nama_product = '$nm_product', jumlah_product = '$jml_product', harga_product = '$hrg_product', image_product = '$img', tanggal_upload = '$date' WHERE id_product = '{$data_edit_product['id_product']}' ");
            if ($update_product_list) {
                echo "<script>alert('Data Berhasil Diubah Dengan Gambar');document.location.href='./service_produk'</script>";
            } else {
                echo "<script>alert('Data Tidak Berhasil Diubah!');document.location.href='./service_produk'</script>";
            }
        }
    } else {
        $update_product_list = mysqli_query($conn, "UPDATE product SET nama_product = '$nm_product', jumlah_product = '$jml_product', harga_product = '$hrg_product', tanggal_upload = '$date' WHERE id_product = '{$data_edit_product['id_product']}' ");
        if ($update_product_list) {
            echo "<script>alert('Data Berhasil Diubah Tanpa Gambar');document.location.href='./service_produk'</script>";
        } else {
            echo "<script>alert('Data Tidak Berhasil Diubah!');document.location.href='./service_produk'</script>";
        }
    }
}

// Change Service List
error_reporting(0);
include "./conn.php";
if (isset($_POST['edit_service'])) {
    $id = htmlspecialchars(addslashes($_POST['id']));
    $nm_service = htmlspecialchars(addslashes($_POST['nm_service']));
    $hrg_service = htmlspecialchars(addslashes($_POST['hrg_service'],));

    $view_edit_service = mysqli_query($conn, "SELECT * FROM service WHERE id_service = '{$id}'");
    $data_edit_service = mysqli_fetch_assoc($view_edit_service);

    // Cek Apakah Ada Input Image Baru
    if (isset($_FILES['img_service']) && $_FILES['img_service']['error'] === UPLOAD_ERR_OK) {

        // Cek Informasi Input Image Unggah
        $image = $_FILES['img_service'];

        // Pengambilan Ekstensi Image
        $path = pathinfo($image['name'], PATHINFO_EXTENSION);

        // Format Ekstensi Yang Diperbolehkan
        $format = array('jpg', 'jpeg', 'png', 'svg');

        if (!in_array($path, $format)) {
            echo "<script>alert('Hanya Format JPG, JPEG, PNG & SVG Yang Diperbolehkan!');document.location.href='./service_produk'</script>";
            exit;
        }

        $img = "Service" . "-" . rand() . "-" . $path;
        $folder = "./vendor/img/" . $img;
        $date = date('Y-m-d h:i:s');

        // Hapus Gambar Yang Digunakan Dari Local Storage
        $img_remove = $data_edit_service['image_service'];
        if (file_exists("./vendor/img/$img_remove")) {
            unlink("./vendor/img/$img_remove");
        }

        // Memindahkan Image Baru Ke Dalam Folder Yang Telah Disediakan
        if (move_uploaded_file($image['tmp_name'], $folder)) {

            $update_service_list = mysqli_query($conn, "UPDATE service SET nama_service = '$nm_service', harga_service = '$hrg_service', image_service = '$img', tanggal_upload = '$date' WHERE id_service = '{$data_edit_service['id_service']}' ");
            if ($update_service_list) {
                echo "<script>alert('Data Berhasil Diubah Dengan Gambar');document.location.href='./service_produk'</script>";
            } else {
                echo "<script>alert('Data Tidak Berhasil Diubah!');document.location.href='./service_produk'</script>";
            }
        }
    } else {
        $update_service_list = mysqli_query($conn, "UPDATE service SET nama_service = '$nm_service', harga_service = '$hrg_service', tanggal_upload = '$date' WHERE id_service = '{$data_edit_service['id_service']}' ");
        if ($update_service_list) {
            echo "<script>alert('Data Berhasil Diubah Tanpa Gambar');document.location.href='./service_produk'</script>";
        } else {
            echo "<script>alert('Data Tidak Berhasil Diubah!');document.location.href='./service_produk'</script>";
        }
    }
}

// Change Status Pelanggan ON
include "./conn.php";
if (isset($_POST['save_on'])) {
    $id = htmlspecialchars(addslashes($_POST['id']));
    $view_change_on = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
    if ($view_change_on) {
        $data_change_on = mysqli_fetch_assoc($view_change_on);
        $id_pelanggan = $data_change_on['id_pelanggan'];

        $update_change_on = mysqli_query($conn, "UPDATE pelanggan SET kondisi = 'ON' WHERE id_pelanggan = '$id_pelanggan'");
        if ($update_change_on) {
            echo "<script>alert('Kondisi Berhasil Menjadi On!');document.location.href='./data_pelanggan.php'</script>";
        } else {
            echo "<script>alert('Kondisi Tidak Berhasil Menjadi On!');document.location.href='./data_pelanggan.php'</script>";
        }
    }
}

// Change Status Pelanggan OFF
include "./conn.php";
if (isset($_POST['save_off'])) {
    $id = htmlspecialchars(addslashes($_POST['id']));
    $view_change_off = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
    if ($view_change_off) {
        $data_change_off = mysqli_fetch_assoc($view_change_off);
        $id_pelanggan = $data_change_off['id_pelanggan'];

        $update_change_off = mysqli_query($conn, "UPDATE pelanggan SET kondisi = 'OFF' WHERE id_pelanggan = '$id_pelanggan'");
        if ($update_change_off) {
            echo "<script>alert('Kondisi Berhasil Menjadi Off!');document.location.href='./data_pelanggan.php'</script>";
        } else {
            echo "<script>alert('Kondisi Tidak Berhasil Menjadi Off!');document.location.href='./data_pelanggan.php'</script>";
        }
    }
}

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
        // Jika Kode Product Belum Ada 1
        $view_code = mysqli_query($conn, "SELECT max(code_product) AS kode FROM product");
        $data_code = mysqli_fetch_assoc($view_code);

        $code = $data_code['kode'];
        $code_urutan = (int) substr($code, 3, 5);
        $code_urutan++;

        $code_huruf = "KP-";
        $code_gabung = $code_huruf . sprintf(
            "%05s",
            $code_urutan
        );

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
            $role = "Product";
            $insert_product = mysqli_query($conn, "INSERT INTO product (code_product, nama_product, jumlah_product, harga_product, image_product, status_product, tanggal_upload, status) VAlUES ('$code_gabung','$nm_produk', '$jml_produk', '$hrg_produk', '$img', '$status', '$date', '$role') ");
            if ($insert_product) {
                echo "<script>alert('Data Berhasil Di Tambah!');document.location.href='./service_produk.php'</script>";
            } else {
                echo "<script>alert('Data Tidak Dapat Di Tambah!');document.location.href='./service_produk.php'</script>";
            }
        }
    } else {
        $role = "Product";
        $insert_product = mysqli_query($conn, "INSERT INTO product (code_product, nama_product, jumlah_product, harga_product, status_product, tanggal_upload, status) VAlUES ('$code_gabung','$nm_produk', '$jml_produk', '$hrg_produk', '$status', '$date', '$role') ");
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
    $nama = htmlspecialchars(addslashes($_POST['nm_produk']));
    $harga = htmlspecialchars(addslashes($_POST['hrg_produk']));
    $view_product = mysqli_query($conn, "SELECT * FROM product ORDER BY id_product LIMIT 1");
    $data_product = mysqli_fetch_assoc($view_product);

    // Cek Apakah Ada Input Image Baru
    if (isset($_FILES['img_produk']) && $_FILES['img_produk']['error'] === UPLOAD_ERR_OK) {
        // Jika Kode service Belum Ada 1
        $view_code = mysqli_query($conn, "SELECT max(code_product) AS kode FROM product");
        $data_code = mysqli_fetch_assoc($view_code);

        $code = $data_code['kode'];
        $code_urutan = (int) substr($code, 3, 5);
        $code_urutan++;

        $code_huruf = "KS-";
        $code_service = $code_huruf . sprintf(
            "%05s",
            $code_urutan
        );

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

        // Memindahkan Image Baru Ke Dalam Folder Yang Telah Disediakan
        if (move_uploaded_file($image['tmp_name'], $folder)) {
            $status = "Ready";
            $tgl_upload = date("Y-m-d h:i:s");
            $role = "Service";
            $insert_service = mysqli_query($conn, "INSERT INTO product (code_product, nama_product, harga_product, image_product, status_product, tanggal_upload, status) VALUES ('$code_service','$nama', '$harga', '$img', '$status', '$tgl_upload', '$role') ");
            if ($insert_service) {
                echo "<script>alert('Anda Berhasil Mengupload List Service Dengan Image.');document.location.href='./service_produk.php'</script>";
            } else {
                echo "<script>alert('Data Tidak Berhasil Dibuat!');document.location.href='./service_produk.php'</script>";
            }
        }
    } else {
        $role = "Service";
        $insert_product = mysqli_query($conn, "INSERT INTO product (code_product, nama_product, harga_product, status_product, tanggal_upload, status) VALUES ('$code_service','$nama', '$harga', '$status', '$tgl_upload', '$role') ");
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

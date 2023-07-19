<?php
error_reporting(0);
session_start();

if (empty($_SESSION['id_user']) && empty($_SESSION['username'])) {
    echo "<script>alert('Mohon Login Terlebih Dahulu!');window.location='./log-in'</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Techno | Service Center</title>
    <!-- Icon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="./vendor/style.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php
    include "./vendor/header.php";
    ?>

    <!-- Content -->
    <div class="container p-5">
        <div class="d-flex justify-content-center align-items-center">
            <?php
            $nama = $_SESSION['nama'];
            ?>
            <h1>Welcome <strong class="text-danger"><?= $nama; ?></strong> </h1>
        </div>
    </div>

    <!-- Content -->
    <div class="container px-4 mt-5">
        <div class="row">
            <div class="col mt-3 border rounded">
                <div class="p-3 d-flex">
                    <img src="./vendor/img/user.jpg" width="100" height="100" class="rounded-circle">
                    <button class="btn shadow-none w-100 text-center mt-2">
                        <?php
                        include "./conn.php";
                        $view = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id_pelanggan");
                        ?>
                        Jumlah Pelanggan : <?= mysqli_num_rows($view); ?>
                    </button>
                </div>
            </div>
            &nbsp;
            &nbsp;
            &nbsp;
            <div class="col mt-3 border rounded">
                <div class="p-3 d-flex">
                    <img src="./vendor/img/barang.jpg" width="100" height="100" class="rounded-circle">
                    <button class="btn shadow-none w-100 text-center mt-2">
                        <?php
                        include "./conn.php";
                        $view = mysqli_query($conn, "SELECT * FROM pembelian ORDER BY id_pembelian");
                        ?>
                        Jumlah Pembelian : <?= mysqli_num_rows($view); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Js -->
    <script src="./vendor/style.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <!-- Boxicons -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</body>

</html>
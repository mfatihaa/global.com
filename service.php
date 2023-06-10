<?php
session_start();
include './conn.php';
if (!isset($_SESSION['id_pelanggan']) && isset($_SESSION['username'])) {
    echo '';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service</title>
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
    <!-- Header -->
    <?php include './vendor/header.php'; ?>

    <!-- Main Content Produk -->
    <div class="container p-4">
        <h1>List Jasa Service</h1>
        <hr>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col-md-3">
                <div class="card">
                    <img src="./Admin/Assets/Img-Product/" class="card-img-top" alt="" width="100">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <h6 class="card-text"> Rp. </h6>

                    </div>
                    <div class="card-header text-justify">
                        <p class="text-danger fw-bold">Deskripsi :</p>
                        <p class="text-muted"></p>
                    </div>
                </div>
            </div>

            <div class="container p-4 mt-4">
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        Stock Jasa Belum Tersedia!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container p-4">
        <h1>List Produk</h1>
        <hr>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col-md-3">
                <div class="card">
                    <img src="./Admin/Assets/Img-Product/" class="card-img-top" alt="" width="100">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <h6 class="card-text"> Rp. </h6>

                    </div>
                    <div class="card-header text-justify">
                        <p class="text-danger fw-bold">Deskripsi :</p>
                        <p class="text-muted"></p>
                    </div>
                </div>
            </div>

            <div class="container p-4 mt-4">
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        Stock Jasa Belum Tersedia!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4 mb-4">
        <a class="btn btn-danger" href="./log-in.php">Masuk</a>
    </div>


    <!-- Footer -->
    <?php include './vendor/footer.php'; ?>
    <!-- Js -->
    <script src="./vendor/style.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <!-- Boxicons -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</body>

</html>
<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['id_pelanggan']) && $_SESSION['username']) {
    echo "<script>alert('Mohon Login Terlebih Dahulu!');document.location.href='./log-in.php'</script>";
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
    <!-- Header -->
    <?php include './vendor/header.php'; ?>

    <!-- Sliding Picture -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./vendor/img/background.png" class="d-block w-100" loading="lazy">
            </div>
            <div class="carousel-item">
                <img src="./vendor/img/background-2.png" class="d-block w-100" loading="lazy">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>

    <!-- Main Content Service -->
    <?php
    if (isset($_SESSION['id_pelanggan']) && $_SESSION['username']) {
    ?>
        <div class="container p-4">
            <h1>List Jasa Service</h1>
            <hr>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                include "./conn.php";
                $view_product = mysqli_query($conn, "SELECT * FROM product ORDER BY id_product");
                while ($data_product = mysqli_fetch_assoc($view_product)) {
                    if ($data_product['status'] == "Service") {
                ?>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="./users/vendor/img/<?= $data_product['image_product']; ?>" class="card-img-top" alt="" width="100">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $data_product['nama_product']; ?></h5>
                                    <h6 class="card-text"> Rp. <?= number_format($data_product['harga_product']); ?> </h6>

                                </div>
                                <div class="card-header text-justify">
                                    <p class="text-danger fw-bold">Deskripsi : <?= $data_product['status_product']; ?></p>
                                    <div class="modal-footer">
                                        <a href="./buy-ing?id=<?php echo $data_product['code_product']; ?>" class="btn btn-warning shadow-none">keranjang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="container p-4">
            <h1>List Jasa Service</h1>
            <hr>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                include "./conn.php";
                $view_product = mysqli_query($conn, "SELECT * FROM product ORDER BY id_product");
                while ($data_product = mysqli_fetch_assoc($view_product)) {
                ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./users/vendor/img/<?= $data_product['image_product']; ?>" class="card-img-top" alt="" width="100">
                            <div class="card-body">
                                <h5 class="card-title"><?= $data_product['nama_product']; ?></h5>
                                <h6 class="card-text"> Rp. <?= number_format($data_product['harga_product']); ?> </h6>

                            </div>
                            <div class="card-header text-justify">
                                <p class="text-danger fw-bold">Deskripsi : <?= $data_product['status_product']; ?></p>
                                <p class="text-muted">
                                </p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Main Content Produk -->
    <?php
    if (isset($_SESSION['id_pelanggan']) && $_SESSION['username']) {
    ?>
        <div class="container p-4">
            <h1>List Produk</h1>
            <hr>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                include "./conn.php";
                $view_product = mysqli_query($conn, "SELECT * FROM product ORDER BY id_product");
                while ($data_product = mysqli_fetch_assoc($view_product)) {
                    if ($data_product['status'] == "Product") {
                ?>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="./users/vendor/img/<?= $data_product['image_product']; ?>" class="card-img-top" alt="" width="100">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $data_product['nama_product']; ?></h5>
                                    <h6 class="card-text"> Rp. <?= number_format($data_product['harga_product']); ?> </h6>

                                </div>
                                <div class="card-header text-justify">
                                    <p class="text-danger fw-bold">Deskripsi : <?= $data_product['status_product']; ?></p>
                                    <p class="text-muted">
                                        Tersedia : <?= $data_product['jumlah_product']; ?>
                                    <div class="modal-footer">
                                        <a href="./buy-ing?id=<?php echo $data_product['code_product']; ?>" class="btn btn-warning shadow-none">Keranjang</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="container p-4">
            <h1>List Produk</h1>
            <hr>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                include "./conn.php";
                $view_product = mysqli_query($conn, "SELECT * FROM product ORDER BY id_product");
                while ($data_product = mysqli_fetch_assoc($view_product)) {
                ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./users/vendor/img/<?= $data_product['image_product']; ?>" class="card-img-top" alt="" width="100">
                            <div class="card-body">
                                <h5 class="card-title"><?= $data_product['nama_product']; ?></h5>
                                <h6 class="card-text"> Rp. <?= number_format($data_product['harga_product']); ?> </h6>

                            </div>
                            <div class="card-header text-justify">
                                <p class="text-danger fw-bold">Deskripsi : <?= $data_product['status_product']; ?></p>
                                <p class="text-muted">

                                </p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>

    <!-- Whatsapp Chat -->
    <div class="container-fluid p-4 d-flex sticky-bottom justify-content-end">
        <button class="btn btn-success shadow-none">
            <a href="https://wa.me/6289677808322?text=Assalamualaikum" class="d-flex align-items-center text-decoration-none text-white">
                <img src="./vendor/img/whatsapp.png" alt="Whatsapp Logo" width="20"> &nbsp; Whatsapp Admin
            </a>
        </button>
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
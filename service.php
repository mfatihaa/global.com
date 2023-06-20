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
                $view_service = mysqli_query($conn, "SELECT * FROM service ORDER BY id_service");
                while ($data_service = mysqli_fetch_assoc($view_service)) {
                ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./users/vendor/img/<?= $data_service['image_service']; ?>" class="card-img-top" alt="" width="100">
                            <div class="card-body">
                                <h5 class="card-title"><?= $data_service['nama_service']; ?></h5>
                                <h6 class="card-text"> Rp. <?= number_format($data_service['harga_service']); ?> </h6>
                            </div>
                            <div class="card-header text-justify">
                                <p class="text-danger fw-bold">Deskripsi : <?= $data_service['status_service']; ?></p>
                                <div class="modal-footer">
                                    <a href="./cart.php?id=<?php echo $data_service['id_service']; ?>" class="btn btn-warning shadow-none">keranjang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    } else {
    ?>
        <main class="container p-5">
            <div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu.
            </div>
        </main>
    <?php
    }
    ?>

    <!-- Main content Produk -->
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
                                </p>
                                <div class="modal-footer">
                                    <a href="./cart.php?id=<?php echo $data_product['id_product']; ?>" class="btn btn-warning shadow-none">keranjang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    } else {
    ?>
        <main class="container p-5">
            <div class="alert alert-danger" role="alert">
                Login Terlebih Dahulu.
            </div>
        </main>
    <?php
    }
    ?>

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
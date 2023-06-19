<?php
error_reporting(0);
session_start();

if (empty($_SESSION['id_user']) && empty($_SESSION['username'])) {
    echo "<script>alert('Mohon Login Terlebih Dahulu!');window.location='./log-in.php'</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Service </title>
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
    <div class="container p-5 mt-3">
        <div class="row">
            <div class="col-md-12">
                <!-- Product -->
                <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#add_product"><i class="bx bx-plus"></i> Add Product</button>
                <!-- Modal Add Product -->
                <div class="modal fade" id="add_product" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Data Product</h5>
                            </div>
                            <form action="./akses.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <label class="form-label fw-bold">Nama Product</label>
                                                <input type="text" name="nm_produk" class="form-control shadow-none">
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="form-label fw-bold">Jumlah Product</label>
                                                <input type="number" name="jml_produk" class="form-control shadow-none">
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="form-label fw-bold">Harga Product</label>
                                                <input type="text" name="hrg_produk" class="form-control shadow-none">
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="form-label fw-bold">Image Product</label>
                                                <input type="file" name="img_produk" class="form-control shadow-none">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger shadow-none" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success shadow-none">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Service -->
                <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#add_service"><i class="bx bx-plus"></i> Add Service</button>
                <!-- Modal Add Service -->
                <div class="modal fade" id="add_service" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Data Service</h5>
                            </div>
                            <form action="./akses.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <label class="form-label fw-bold">Nama Service</label>
                                                <input type="text" name="nm_service" class="form-control shadow-none">
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="form-label fw-bold">Jumlah Service</label>
                                                <input type="number" name="jml_service" class="form-control shadow-none">
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="form-label fw-bold">Harga Service</label>
                                                <input type="text" name="hrg_service" class="form-control shadow-none">
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="form-label fw-bold">Image Service</label>
                                                <input type="file" name="img_service" class="form-control shadow-none">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger shadow-none" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success shadow-none">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <table class="table table-striped">a</table>
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
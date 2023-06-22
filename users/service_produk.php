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
                <button type="button" class="btn btn-warning shadow-none" data-bs-toggle="modal" data-bs-target="#add_product"><i class="bx bx-plus"></i> Add Product</button>
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
                                                <label class="form-label fw-bold">Deskripsi Product</label>
                                                <textarea name="desk_produk" class="form-control shadow-none"></textarea>
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
                                    <button type="submit" name="add_produk" class="btn btn-success shadow-none">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Service -->
                <button type="button" class="btn btn-warning shadow-none" data-bs-toggle="modal" data-bs-target="#add_service"><i class="bx bx-plus"></i> Add Service</button>
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
                                                <label class="form-label fw-bold">Harga Service</label>
                                                <input type="text" name="hrg_service" class="form-control shadow-none">
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="form-label fw-bold">Deskripsi Service</label>
                                                <textarea name="desk_service" class="form-control shadow-none"></textarea>
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
                                    <button type="submit" name="add_service" class="btn btn-success shadow-none">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="product-tab" data-bs-toggle="pill" data-bs-target="#product" type="button" role="tab" aria-controls="product" aria-selected="true">Product List</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="service-tab" data-bs-toggle="pill" data-bs-target="#service" type="button" role="tab" aria-controls="service" aria-selected="false">Service List</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Tanggal Upload</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "./conn.php";
                                $product_view = mysqli_query($conn, "SELECT * FROM product ORDER BY id_product");
                                $no = 1;
                                while ($product_row = mysqli_fetch_assoc($product_view)) {
                                    if ($product_row['status'] == "Product") {
                                ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $product_row['nama_product']; ?></td>
                                            <td><?= $product_row['jumlah_product']; ?></td>
                                            <td>Rp. <?= number_format($product_row['harga_product']); ?></td>
                                            <?php
                                            if (isset($product_row['image_product'])) {
                                            ?>
                                                <td><img src="./vendor/img/product_service/<?= $product_row['image_product']; ?>" width="50" class="rounded-5"></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td><img src="./vendor/img/barang.svg" width="25"></td>
                                            <?php
                                            }
                                            ?>
                                            <td><?= date("l, d F Y", strtotime($product_row['tanggal_upload'])); ?></td>
                                            <td><?= $product_row['status_product']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success shadow-none" data-bs-toggle="modal" data-bs-target="#edit_product<?= $product_row['id_product']; ?>"><i class="bx bx-edit"></i></button>
                                                <!-- Modal Edit Product -->
                                                <div class="modal fade" id="edit_product<?= $product_row['id_product']; ?>" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Data Product</h5>
                                                            </div>
                                                            <form action="./akses.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <div class="row justify-content-center">
                                                                            <input type="text" name="id" value="<?= $product_row['id_product']; ?>" hidden>
                                                                            <div class="col-md-12">
                                                                                <label class="form-label fw-bold">Nama
                                                                                    Product</label>
                                                                                <input type="text" name="nm_product" class="form-control shadow-none" value="<?= $product_row['nama_product']; ?>">
                                                                            </div>
                                                                            <div class="col-md-12 mt-2">
                                                                                <label class="form-label fw-bold">Jumlah
                                                                                    Product</label>
                                                                                <input type="number" name="jml_product" class="form-control shadow-none" value="<?= $product_row['jumlah_product']; ?>">
                                                                            </div>
                                                                            <div class="col-md-12 mt-2">
                                                                                <label class="form-label fw-bold">Harga
                                                                                    Product</label>
                                                                                <input type="text" name="hrg_product" class="form-control shadow-none" value="<?= $product_row['harga_product']; ?>">
                                                                            </div>
                                                                            <div class="col-md-12 mt-2">
                                                                                <label class="form-label fw-bold">Deskripsi
                                                                                    Product</label>
                                                                                <textarea name="desk_product" class="form-control shadow-none"><?= $product_row['desk_product']; ?></textarea>
                                                                            </div>
                                                                            <div class="col-md-12 mt-2">
                                                                                <label class="form-label fw-bold">Image
                                                                                    Product</label>
                                                                                <input type="file" name="img_product" class="form-control shadow-none">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger shadow-none" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" name="edit_product" class="btn btn-success shadow-none">Edit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#delete_product<?= $product_row['id_product']; ?>"><i class="bx bx-trash"></i></button>
                                                <!-- Modal Delete Product -->
                                                <div class="modal fade" id="delete_product<?= $product_row['id_product']; ?>" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Data Product</h5>
                                                            </div>
                                                            <form action="./akses.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <div class="row justify-content-center">
                                                                            <input type="text" name="id" value="<?= $product_row['id_product']; ?>" hidden>
                                                                            Apakah Kamu Yakin Menghapus Data Produk Ini?
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger shadow-none" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" name="delete_product" class="btn btn-success shadow-none">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="service" role="tabpanel" aria-labelledby="service-tab" tabindex="0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Tanggal Upload</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "./conn.php";
                                $product_view = mysqli_query($conn, "SELECT * FROM product ORDER BY id_product");
                                $no = 1;
                                while ($product_row = mysqli_fetch_assoc($product_view)) {
                                    if ($product_row['status'] == "Service") {
                                ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $product_row['nama_product']; ?></td>
                                            <td>Rp. <?= number_format($product_row['harga_product']); ?></td>
                                            <?php
                                            if (isset($product_row['image_product'])) {
                                            ?>
                                                <td><img src="./vendor/img/product_service/<?= $product_row['image_product']; ?>" width="50" class="rounded-5"></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td><img src="./vendor/img/barang.svg" width="25"></td>
                                            <?php
                                            }
                                            ?>
                                            <td><?= date("l, d F Y", strtotime($product_row['tanggal_upload'])); ?></td>
                                            <td><?= $product_row['status_product']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit_service<?= $product_row['id_product']; ?>"><i class="bx bx-edit"></i></button>
                                                <!-- Modal Edit Service -->
                                                <div class="modal fade" id="edit_service<?= $product_row['id_product']; ?>" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Data Service</h5>
                                                            </div>
                                                            <form action="./akses.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <div class="row justify-content-center">
                                                                            <input type="text" name="id" value="<?= $product_row['id_product']; ?>" hidden>
                                                                            <div class="col-md-12">
                                                                                <label class="form-label fw-bold">Nama
                                                                                    Service</label>
                                                                                <input type="text" name="nm_service" class="form-control shadow-none" value="<?= $product_row['nama_product']; ?>">
                                                                            </div>
                                                                            <div class="col-md-12 mt-2">
                                                                                <label class="form-label fw-bold">Harga
                                                                                    Service</label>
                                                                                <input type="text" name="hrg_service" class="form-control shadow-none" value="<?= $product_row['harga_product']; ?>">
                                                                            </div>
                                                                            <div class="col-md-12 mt-2">
                                                                                <label class="form-label fw-bold">Deskripsi
                                                                                    Service</label>
                                                                                <textarea name="desk_service" class="form-control shadow-none"><?= $product_row['desk_product']; ?></textarea>
                                                                            </div>
                                                                            <div class="col-md-12 mt-2">
                                                                                <label class="form-label fw-bold">Image
                                                                                    Service</label>
                                                                                <input type="file" name="img_service" class="form-control shadow-none">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger shadow-none" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" name="edit_service" class="btn btn-success shadow-none">Edit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#delete_service<?= $product_row['id_product']; ?>"><i class="bx bx-trash"></i></button>
                                                <!-- Modal Delete Product -->
                                                <div class="modal fade" id="delete_service<?= $product_row['id_product']; ?>" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Data Service</h5>
                                                            </div>
                                                            <form action="./akses.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <div class="row justify-content-center">
                                                                            <input type="text" name="id" value="<?= $product_row['id_product']; ?>" hidden>
                                                                            Apakah Kamu Yakin Menghapus Data Service Ini?
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger shadow-none" data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" name="delete_service" class="btn btn-success shadow-none">Yes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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
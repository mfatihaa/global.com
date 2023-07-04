<?php
error_reporting(0);
session_start();

if (empty($_SESSION['id_pelanggan']) && empty($_SESSION['username'])) {
    echo "<script>alert('Mohon Login Terlebih Dahulu!');document.location.href='./log-in'</script>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Techno | Waiting List</title>
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
    <?php
    if (isset($_SESSION['id_pelanggan']) && $_SESSION['username']) {
    ?>
        <div class="container p-4">
            <div class="table-responsive">
                <table class="table table striped caption-top">
                    <caption>Daftar Pesanan</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <?php
                            include "./conn.php";
                            $code = $_SESSION['pelanggan']['code_pelanggan'];
                            $view = mysqli_query($conn, "SELECT * FROM pembelian_product WHERE code_pelanggan = '$code'");
                            $row_code = mysqli_fetch_assoc($view);

                            if ($row_code['tgl_kehadiran'] == true) {
                            ?>
                                <th>Tanggal Kedatangan</th>
                            <?php
                            }
                            ?>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $code = $_SESSION['pelanggan']['code_pelanggan'];
                        $no = 1;
                        $view = mysqli_query($conn, "SELECT * FROM pembelian_product JOIN product ON pembelian_product.code_product=product.code_product WHERE pembelian_product.code_pelanggan = '$code'");
                        while ($row = mysqli_fetch_assoc($view)) {
                        ?>
                            <tr>
                                <?php
                                if ($row['action'] == "In Progress" || $row['action'] == "Approved") {
                                ?>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['code_product']; ?></td>
                                    <td><?= $row['nama_product']; ?></td>
                                    <td>Rp. <?= number_format($row['harga']); ?></td>
                                    <td><?= $row['jumlah']; ?></td>
                                    <td>Rp. <?= number_format($row['harga'] * $row['jumlah']); ?></td>

                                    <?php
                                    if ($row['tgl_kehadiran'] == true) {
                                    ?>
                                        <td><?= date("l, d F Y", strtotime($row['tgl_kehadiran'])); ?></td>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if ($row['action'] == "In Progress") {
                                    ?>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" disabled><?= $row['action']; ?></button>
                                        </td>
                                    <?php
                                    } elseif ($row['action'] == "Approved") {
                                    ?>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm" disabled><?= $row['action']; ?></button>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <tfoot>
                    <?php
                    include "./conn.php";
                    $code = $_SESSION['pelanggan']['code_pelanggan'];
                    $view_pembelian = mysqli_query($conn, "SELECT * FROM pembelian_product JOIN pelanggan ON pembelian_product.code_pelanggan=pelanggan.code_pelanggan WHERE pembelian_product.code_pelanggan = '$code'");
                    while ($row_pembelian = mysqli_fetch_assoc($view_pembelian)) {
                        $total += $row_pembelian['harga'];
                    }
                    ?>
                    <div class="d-flex justify-content-center align-items-center">
                        <?php
                        if (isset($row_code['code_pelanggan']) === null) {
                        ?>
                            <button type="button" class="btn btn-white shadow-none btn-sm mt-2" disabled>
                                Total Product Yang Tersimpan Di Keranjang Ada <strong class="text-danger"><?= $total; ?></strong>
                            </button>
                        <?php
                        } else {
                        ?>
                            <?php
                            include "./conn.php";
                            $code = $_SESSION['pelanggan']['code_pelanggan'];
                            $view_product = mysqli_query($conn, "SELECT * FROM pembelian_product WHERE code_pelanggan = '$code' AND action = 'Finish'");
                            while ($row_product = mysqli_fetch_assoc($view_product)) {
                                $minus += $row_product['harga'];
                            }
                            ?>
                            <button type="button" class="btn btn-white shadow-none btn-sm mt-2" disabled>
                                Mohon Siapkan Uang Cash <strong class="text-danger">Rp.
                                    <?= number_format($total - $minus); ?></strong>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    include "./conn.php";
                    $code = $_SESSION['pelanggan']['code_pelanggan'];
                    $view_action_1 = mysqli_query($conn, "SELECT * FROM pembelian_product WHERE code_pelanggan = '$code' AND action = 'In Progress'");
                    $row_action_1 = mysqli_fetch_assoc($view_action_1);
                    if ($row_action_1) {
                    ?>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <button type="button" class="btn btn-warning shadow-none btn-sm" disabled>
                                Mohon Menunggu 1x24 untuk Status Berubah Menjadi <strong> Approved </strong> Untuk Anda
                                Datang
                                Ke
                                Store. Terimakasih!
                            </button>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    include "./conn.php";
                    $code = $_SESSION['pelanggan']['code_pelanggan'];
                    $view_action_2 = mysqli_query($conn, "SELECT * FROM pembelian_product WHERE code_pelanggan = '$code' AND action = 'Approved'");
                    $row_action_2 = mysqli_fetch_assoc($view_action_2);
                    if ($row_action_2) {
                    ?>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <a href="#" class="btn btn-primary btn-sm shadow-none">Download Nota</a>
                        </div>
                    <?php
                    }
                    ?>
                </tfoot>
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
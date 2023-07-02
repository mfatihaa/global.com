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

                            if ($row_code['tgl_kehadiran'] == true && $row_code['status'] == "Finish") {
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
                                <td><?= $no++; ?></td>
                                <td><?= $row['code_product']; ?></td>
                                <td><?= $row['nama_product']; ?></td>
                                <td>Rp. <?= number_format($row['harga_product']); ?></td>
                                <td><?= $row['jumlah']; ?></td>
                                <td>Rp. <?= number_format($row['harga_product'] * $row['jumlah']); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <tfoot>
                    <?php
                    if ($row_code['status'] == "Delivered") {
                    ?>
                        <button type="button" class="btn btn-warning shadow-none btn-sm" disabled>
                            Mohon Menunggu 1x24 untuk Status Berubah Menjadi <strong>Approved</strong> dan akan diberikan
                            <strong>Tanggal Kehadiran</strong> Untuk Anda Datang Ke Store. Terimakasih!
                        </button>
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
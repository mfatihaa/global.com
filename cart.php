<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['id_pelanggan']) && $_SESSION['username']) {
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
    <title>Global Techno | Cart</title>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($_SESSION['cart'])) {
                            $no = 1;
                        ?>
                            <?php
                            foreach ($_SESSION['cart'] as $code => $qty) :
                            ?>
                                <?php
                                include "./conn.php";
                                $view_product = mysqli_query($conn, "SELECT * FROM product WHERE code_product = '$code'");
                                while ($data_product = mysqli_fetch_assoc($view_product)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data_product['code_product']; ?></td>
                                        <td><?php echo $data_product['nama_product']; ?></td>
                                        <td>Rp. <?php echo number_format($data_product['harga_product']); ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td>
                                            Rp. <?php
                                                $sum = $data_product['harga_product'] * $qty;
                                                echo number_format($sum);
                                                ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-success" type="button">
                                                <i class='bx bx-list-check'></i>
                                            </button>
                                            <button class="btn btn-warning" type="button">
                                                <i class='bx bx-edit'></i>
                                            </button>
                                            <button class="btn btn-danger" type="button">
                                                <i class='bx bx-trash-alt'></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            <?php
                            endforeach
                            ?>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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
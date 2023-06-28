<?php
error_reporting(0);
session_start();

if (empty($_SESSION['id_pelanggan']) && empty($_SESSION['username'])) {
    echo "<script>alert('Mohon Login Terlebih Dahulu!');document.location.href='./log-in'</script>";
    exit();
} elseif (empty($_SESSION['cart'])) {
    echo "<script>alert('Keranjang Anda Kosong.');document.location.href='./'</script>";
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
                            $totalbelanja = 0;
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
                                            <a href="akses.php?code=<?php echo $code ?>" class="btn btn-danger"><i class='bx bx-trash'></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <?php
                                $totalbelanja += $sum;
                                ?>
                            <?php
                            endforeach
                            ?>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">Total Harga</th>
                            <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                        </tr>
                    </tfoot>
                </table>
                <a href="service.php?code=<?php echo $code ?>" class="btn btn-secondary shadow-none"><i class='bx bxs-shopping-bags'> Lanjutkan memilih</i></a>
                <a href="stand-in-line.php?code=<?php echo $code ?>" class="btn btn-primary shadow-none"><i class='bx bx-list-check'> checkout</i></a>
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
<?php
error_reporting(0);
session_start();

if (empty($_SESSION['id_pelanggan']) && empty($_SESSION['username'])) {
    echo "<script>alert('Mohon Login Terlebih Dahulu!');document.location.href='./log-in'</script>";
    exit();
} elseif (empty($_SESSION['cart'])) {
    header('location: ./');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
                        <th>Status</th>
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
                                $data_product = mysqli_fetch_assoc($view_product);
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
                            <a href="./akses.php?code=<?= $code; ?>" class="btn btn-danger btn-sm shadow-none"><i
                                    class='bx bx-trash'></i></a>
                        </td>
                    </tr>
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
                        <th colspan="5">Total Keseluruhan</th>
                        <th colspan="2">Rp. <?php echo number_format($totalbelanja); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <form action="./cart.php" method="POST" enctype="multipart/form-data" autocomplete="off" role="form">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control shadow-none" value="<?= $_SESSION['pelanggan']['nama']; ?>"
                        disabled>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control shadow-none" value="<?= $_SESSION['pelanggan']['email']; ?>"
                        disabled>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control shadow-none"
                        value="<?= $_SESSION['pelanggan']['telepon']; ?>" disabled>
                </div>
                <div class="col-md-4 mt-3">
                    <label class="form-label">Pilih Tanggal Kehadiran :</label>
                    <input type="date" class="form-control shadow-none mt-2" name="date" required>
                </div>
            </div>
            <a href="./service" class="btn btn-warning btn-sm shadow-none mt-4">Continue Shopping</a>
            <button type="submit" class="btn btn-danger btn-sm shadow-none mt-4" name="create_order">Create
                Order</button>
        </form>
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

    <?php
    // Create Order
    include "./conn.php";
    if (isset($_POST['create_order'])) {
        $code_pelanggan = $_SESSION['pelanggan']['code_pelanggan'];
        $tgl_pembelian = date("Y-m-d");
        $total_pembelian = $totalbelanja;

        $insert_order = mysqli_query($conn, "INSERT INTO pembelian (code_pelanggan, tgl_pembelian, total_pembelian, action) VALUES ('$code_pelanggan','$tgl_pembelian','$total_pembelian','In Progress')");

        // Pengambilan Data Yang Baru Saja Terjadi
        $id_pembelian =  $conn->insert_id;

        // Pengulangan Data Keranjang
        foreach ($_SESSION['cart'] as $code => $qty) {
            // Mendapatkan Nama Dan Harga Product
            $view_product = mysqli_query($conn, "SELECT * FROM product WHERE code_product = '$code'");
            $row_product = mysqli_fetch_assoc($view_product);
            // Menginialisasi Data Product
            $nama = $row_product['nama_product'];
            $harga = $row_product['harga_product'];
            $sum2 = $qty * $harga;
            $jumlah = $row_product['jumlah_product'];
            // Mendapatkan Date
            $date = $_POST['date'];

            $insert_product = mysqli_query($conn, "INSERT INTO pembelian_product (id_pembelian, code_pelanggan, code_product, jumlah, tgl_kehadiran, name, harga, subtotal, action) VALUES ('$id_pembelian','$code_pelanggan','$code','$qty','$date','$nama','$harga','$sum2','In Progress')");

            $sum = $jumlah - $qty;
            $update_product = mysqli_query($conn, "UPDATE product SET jumlah_product = '$sum' WHERE code_product = '$code'");
        }

        // Menghapus Isi Keranjang Jika Sudah Diinput Kedalam Database
        unset($_SESSION['cart']);

        // Menampilkan Ke Halaman
        echo "<script>document.location.href='./stand-in-line';</script>";
    }
    ?>

    <!-- Footer -->
    <?php include './vendor/footer.php'; ?>
    <!-- Js -->
    <script src="./vendor/style.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <!-- Boxicons -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</body>

</html>
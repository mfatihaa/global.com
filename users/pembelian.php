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
    <title> Pesanan </title>
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

    <div class="container p-3 mt-5">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name Barang</th>
                    <th scope="col">Harga Barang</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Request Date</th>
                    <th scope="col">Tombol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "./conn.php";
                $code = $_GET['id'];
                $view_pelanggan = mysqli_query($conn, "SELECT * FROM pembelian JOIN pembelian_product ON pembelian.id_pembelian = pembelian_product.id_pembelian WHERE pembelian.code_pelanggan = '$code' ORDER BY pembelian.id_pembelian DESC");
                $no = 1;
                while ($data_pelanggan = mysqli_fetch_assoc($view_pelanggan)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data_pelanggan['nama']; ?></td>
                        <td>Rp. <?php echo number_format($data_pelanggan['harga']); ?></td>
                        <td><?php echo $data_pelanggan['jumlah']; ?></td>
                        <td>Rp. <?php echo number_format($data_pelanggan['harga'] * $data_pelanggan['jumlah']); ?></td>
                        <td><?php echo date("d F Y", strtotime($data_pelanggan['tgl_kehadiran'])); ?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#messange<?= $data_pelanggan['id_pembelian']; ?>"><i class='bx bx-message-alt-dots'></i></button>
                            <button type="button" class="btn btn-success btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#check<?= $data_pelanggan['id_pembelian']; ?>"><i class='bx bx-check-circle'></i></button>
                        </td>
                        <div class="modal fade" id="messange<?= $data_pelanggan['id_pembelian']; ?>" tabindex="1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ubah Tanggal Kehadiran</h5>
                                    </div>
                                    <form action="./akses.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        <div class="modal-body">
                                            <div class="floating-input">
                                                <label class="form-label">Pilih Tanggal</label>
                                                <input type="date" class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm shadow-none" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-success btn-sm shadow-none" name="">Ubah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="check<?= $data_pelanggan['id_pembelian']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Status Selesai</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Modal body text goes here.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm shadow-none" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary btn-sm shadow-none">Save
                                            changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <tfoot>
            <?php
            include "./conn.php";
            $code = $_GET['id'];
            $view_pembelian = mysqli_query($conn, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.code_pelanggan=pelanggan.code_pelanggan WHERE pembelian.code_pelanggan = '$code'");
            while ($row_pembelian = mysqli_fetch_assoc($view_pembelian)) {
                $total += $row_pembelian['total_pembelian'];
            }
            ?>

            <?php
            include "./conn.php";
            $code = $_GET['id'];
            $view_pembelian = mysqli_query($conn, "SELECT * FROM pembelian WHERE code_pelanggan = '$code' AND action = 'Finish'");
            while ($row_pembelian = mysqli_fetch_assoc($view_pembelian)) {
                $minus += $row_pembelian['total_pembelian'];
            }
            ?>
            Total Pembayaran <strong class="text-danger">Rp.
                <?= number_format($total - $minus); ?></strong>
        </tfoot>
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
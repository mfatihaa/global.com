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
    <title> Stand In Line </title>
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
                    <th scope="col">Name Customer</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Tombol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "./conn.php";
                $view_pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id_pelanggan");
                $no = 1;
                while ($data_pelanggan = mysqli_fetch_assoc($view_pelanggan)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data_pelanggan['nama']; ?></td>
                        <td><?php echo $data_pelanggan['email']; ?></td>
                        <td><?php echo $data_pelanggan['telepon']; ?></td>
                        <td>
                            <a href="pembelian?id=<?= $data_pelanggan['code_pelanggan']; ?>" class="btn btn-warning btn-sm shadow-none"><i class='bx bx-cart-alt'></i></a>
                            <button type="button" class="btn btn-success btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#check<?= $data_pelanggan['code_pelanggan']; ?>"><i class='bx bx-check-circle'></i></button>
                        </td>
                        <div class="modal fade" id="check<?= $data_pelanggan['code_pelanggan']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Status Prosess</h5>
                                    </div>
                                    <form action="./akses.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        <div class="modal-body">
                                            <?php
                                            $code = $data_pelanggan['code_pelanggan'];
                                            $view_dist = mysqli_query($conn, "SELECT DISTINCT tgl_kehadiran FROM pembelian_product WHERE code_pelanggan = '$code' AND action = 'Approved'");
                                            while ($row_dist = mysqli_fetch_assoc($view_dist)) {
                                                print_r($row_dist);
                                            }
                                            ?>
                                            <input type="text" value="<?= $code; ?>" name="code" hidden>
                                            <input type="text" value="<?= $row_dist['tgl_kehadiran']; ?>" name="tgl" hidden>
                                            <p>Memberikan Nomor Antrian Kehadiran Pelanggan.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm shadow-none" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-success btn-sm shadow-none" name="process">Prosess</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
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
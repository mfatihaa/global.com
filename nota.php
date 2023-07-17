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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Techno | Nota Pelanggan</title>
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
    <!-- Content -->
    <div class="container py-5">
        <div class="d-flex justify-content-center align-items-center mt-3">
            <div class="card">
                <div class="card-body" id="printOut">
                    <div class="card-title fw-bold text-center h2">
                        NOTA PEMESANAN
                    </div>
                    <p class="card-subtitle text-center text-muted h6">
                        <?php
                        include "./conn.php";
                        $code_ = $_GET['page'];
                        $code = substr($code_, 0, 8);
                        $no = 1;
                        $view = mysqli_query($conn, "SELECT * FROM pembelian_product JOIN nota_antrian ON pembelian_product.code_pelanggan = nota_antrian.code_pelanggan WHERE pembelian_product.code_pelanggan = '$code'");
                        $row_view = mysqli_fetch_assoc($view);
                        ?>
                        Nomor Antrian <span class="text-danger"><?= $row_view['nomor_antrian']; ?></span>
                    </p>
                    <hr class="border-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "./conn.php";
                            $code_ = $_GET['page'];
                            $code = substr($code_, 0, 8);
                            $no = 1;
                            $view = mysqli_query($conn, "SELECT * FROM pembelian_product JOIN pelanggan ON pembelian_product.code_pelanggan = pelanggan.code_pelanggan WHERE pembelian_product.code_pelanggan = '$code' AND pembelian_product.action = 'Approved'");
                            while ($row = mysqli_fetch_assoc($view)) {
                                $subtotal += $row['subtotal'];
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['jumlah']; ?></td>
                                    <td>Rp. <?= number_format($row['subtotal']); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-center fw-bold text-danger">Total Pembayaran : Rp.
                                    <?= number_format($subtotal); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="./users/vendor/qrcode/<?= $row_view['qrcode']; ?>">
                    </div>
                </div>
            </div>
        </div>
        <?php

        mysqli_query($conn, "SELECT * FROM nota_antrian WHERE code_pelanggan = ''");
        if ($row_view['nomor_antrian'] > 1) {
        ?>
            <div class="d-flex justify-content-center mt-2">
                <button type="button" class="btn btn-success shadow-none" onclick="generatePDF()">Download</button>
            </div>
        <?php
        } else {
        ?>
            <div class="d-flex justify-content-center mt-2">
                <button type="button" class="btn btn-warning shadow-none" disabled>Menunggu Nomor Antrian
                    Diberikan.</button>
            </div>
        <?php
        }
        ?>
    </div>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <!-- html2PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script type="text/javascript">
        // Print Out Document With jsPDF
        function generatePDF() {
            // Choose the element id which you want to export.
            var element = document.getElementById('printOut');
            element.style.width = 'auto';
            element.style.height = 'auto';
            var opt = {
                margin: 0.3,
                filename: 'my-nota.pdf',
                image: {
                    type: 'png',
                    quality: 5
                },
                html2canvas: {
                    scale: 3
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'A5',
                    orientation: 'portrait',
                    precision: '16'
                }
            };

            // choose the element and pass it to html2pdf() function and call the save() on it to save as pdf.
            html2pdf().set(opt).from(element).save();
        }
    </script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <!-- Boxicons -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>

</html>
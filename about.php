<?php
session_start();
include './conn.php';
if (!isset($_SESSION['id_pelanggan']) && isset($_SESSION['username'])) {
    echo '';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
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
    <div class="container p-4">
        <div class="card mt-3">
            <div class="card-header">
                Sejarah
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p class="fs-6">
                        Global Techno adalah salah satu pelopor pertama dalam bisnis Jasa Service Modern di Indonesia. Global techno Didirikan pada tahun 2022. Bisnis jasa service ini dibentuk oleh mahasiswa - mahasiswa bertalenta yang masih berkuliah di kampus Jakarta Global University. Tentunya jasa service ini berdiri karena mempunyai teknisi - teknisi yang sangat profesional dan handal.
                    </p>
                </blockquote>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                Lokasi
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p class="fs-6">
                        Kampus Jakarta Global University, Lantai 2.
                        Grand Depok City, Jl. Boulevard Raya No.2 Kota Depok 16412, Jawa Barat Indonesia.
                    </p>
                </blockquote>
            </div>
        </div>
    </div>

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
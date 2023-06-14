<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Techno | Registration</title>
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
        <div class="card">
            <div class="card-header">
                Daftar Pelanggan
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <form action="./akses.php" method="POST" enctype="multipart/form-data" role="form" autocomplete="off">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Username :</label>
                                    <input type="text" class="form-control shadow-none" name="username" pattern="[a-z]{5,}" title="Hanya Diperbolehkan Menggunakan Huruf Kecil!" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Lengkap :</label>
                                    <input type="text" class="form-control shadow-none" name="nama" pattern="[a-zA-Z]{5,}" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label fw-bold">Email :</label>
                                    <input type="email" class="form-control shadow-none" name="email" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label fw-bold">No. Telepon :</label>
                                    <input type="tel" class="form-control shadow-none" name="telepon" pattern="[0-9]{12,13}" title="Hanya Diperbolehkan Menggunakan Angka dan Maksimal 13 Angka!" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label fw-bold">Password :</label>
                                    <input type="password" id="pass" class="form-control shadow-none" name="pass" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label fw-bold">Konfirmasi Password :</label>
                                    <input type="password" id="confirm" class="form-control shadow-none" name="confirm" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input shadow-none" id="checkbox" type="checkbox" role="switch" onclick="myPassword()">
                                        <label class=" form-check-label">Show Password.</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-warning shadow-none" type="submit" name="daftar">
                                        Daftar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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
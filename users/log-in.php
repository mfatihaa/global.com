<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin | Log-in</title>
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
                Login Admin
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <form action="./akses.php" method="POST" enctype="multipart/form-data" role="form" autocomplete="off">
                        <div class="container">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Username :</label>
                                <input type="text" id="user" class="form-control shadow-none" name="username" required>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label class="form-label fw-bold">Password :</label>
                                <input type="password" id="pass" class="form-control shadow-none" name="password" required>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input shadow-none" id="checkbox" type="checkbox" role="switch" onclick="myPassword()">
                                    <label class=" form-check-label">Show Password.</label>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <button class="btn btn-success shadow-none" type="submit" name="masuk">
                                    Masuk
                                </button>

                                <button class="btn btn-danger shadow-none" type="button">
                                    <a href="./change-password.php" class="text-decoration-none shadow-none text-white">Ganti Password</a>
                                </button>

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
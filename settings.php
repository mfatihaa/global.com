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
    <title>Document</title>
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

    <!-- content -->
    <div class="container p-2 mt-5">
        <div class="row justify-content-center  ">
            <div class="col-md-4">
                <picture class="ratio ratio-1x1">
                    <img src="./vendor/img-customer/akbar.jpeg" alt="Akbar Naufal" loading="lazy" class="mt-4 border rounded-circle w-auto h-75 object-fit-scale image">
                </picture>
            </div>
            <?php
            include './conn.php';
            $id = $_SESSION['id_pelanggan'];
            $read = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '{$id}'");
            $data = mysqli_fetch_assoc($read);
            ?>
            <div class="col-md-4">
                <form action="./akses.php" method="post">
                    <div class="profile">
                        <h3 class="text-center fw-bold">PROFILE</h3>
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control shadow-none" value="<?php echo $data['nama']; ?>">
                            <label class="form-label fw-bold">NAME</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control shadow-none" value="<?php echo $data['telepon']; ?>">
                            <label class="form-label fw-bold">TELEPHONE</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control shadow-none" value="<?php echo $data['email']; ?>">
                            <label class="form-label fw-bold">EMAIL</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control shadow-none" multiple type="image/">
                            <label class="form-label fw-bold">CHANGE IMAGE</label>
                        </div>
                        <div class="password">
                            <div class="form-floating mb-3 mt-3">
                                <input type="password" class="form-control shadow-none" id="new_pass" value="<?php echo $data['password']; ?>">
                                <label class="form-label fw-bold">NEW PASSWORD</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control shadow-none" id="confirm_new_pass" value="<?php echo $data['konfirmasi']; ?>">
                                <label class="form-label fw-bold">CONFIRM NEW PASSWORD</label>
                            </div>
                            <div class="form-check form-switch d-flex justify-content-end mb-3">
                                <input type="checkbox" class="form-check-input shadow-none me-2" name="" role="switch" onclick="myPasswords()">
                                <label class="form-check-label">Show Password.</label>
                            </div>
                            <div class="form-floating justify-content-center d-flex mb-3 button">
                                <button type="submit" class="btn btn-success shadown-none" name="">SAVE CHANGES</button>
                            </div>
                        </div>
                    </div>
                </form>
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
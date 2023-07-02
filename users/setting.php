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
    <title>Global Techno | Sevice</title>
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
            <?php
            include './conn.php';
            $id = $_SESSION['id_user'];
            $read = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '{$id}'");
            $data = mysqli_fetch_assoc($read);
            ?>
            <div class="col-md-4">
                <?php
                if (isset($data['image'])) {
                ?>
                    <picture class="ratio ratio-1x1">
                        <img src="./vendor/img/<?= $data['image'] ?>" alt="<?= $data['nama']; ?>" loading="lazy" class="mt-4 border rounded-circle w-100 h-100 object-fit-scale image">
                    </picture>
                <?php
                } else {
                ?>
                    <picture class="ratio ratio-1x1">
                        <img src="./vendor/img/profile.svg" alt="<?= $data['nama']; ?>" loading="lazy" class="mt-4 rounded-circle w-100 h-100 object-fit-scale image">
                    </picture>
                <?php
                }
                ?>
            </div>
            <div class="col-md-4">
                <form action="./akses.php" method="POST" enctype="multipart/form-data" role="form">
                    <div class="profile">
                        <h3 class="text-center fw-bold">PROFILE</h3>
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control shadow-none" name="id" value="<?php echo $data['id_user']; ?>" hidden>
                            <label class="form-label fw-bold">ID</label>
                        </div>
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control shadow-none" name="username" value="<?php echo $data['username']; ?>">
                            <label class="form-label fw-bold">USERNAME</label>
                        </div>
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control shadow-none" name="nama" value="<?php echo $data['nama']; ?>">
                            <label class="form-label fw-bold">NAME</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control shadow-none" name="email" value="<?php echo $data['email']; ?>">
                            <label class="form-label fw-bold">EMAIL</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control shadow-none" name="telepon" value="<?php echo $data['telepon']; ?>">
                            <label class="form-label fw-bold">TELEPHONE</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control shadow-none" name="image" multiple type="image/">
                            <label class="form-label fw-bold">CHANGE IMAGE</label>
                        </div>
                        <div class="form-floating justify-content-center d-flex mb-3 button">
                            <button type="submit" class="btn btn-success shadown-none" name="update">UPDATE</button>
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
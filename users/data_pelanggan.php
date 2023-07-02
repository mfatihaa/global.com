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
    <title>Data Pelanggan</title>
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
                    <th scope="col">Code</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Tombol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "./conn.php";
                $view_pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id_pelanggan");
                while ($data_pelanggan = mysqli_fetch_assoc($view_pelanggan)) {
                    $no = 1;
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data_pelanggan['code_pelanggan']; ?></td>
                        <td><?php echo $data_pelanggan['username']; ?></td>
                        <td><?php echo $data_pelanggan['nama']; ?></td>
                        <td><?php echo $data_pelanggan['email']; ?></td>
                        <td><?php echo $data_pelanggan['telepon']; ?></td>
                        <?php
                        if ($data_pelanggan['kondisi'] == "OFF") {
                        ?>
                            <td>
                                <button type="button" class="btn btn-success shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#ON<?php echo $data_pelanggan['id_pelanggan']; ?>"><i class="bx bx-edit"></i></button>
                            </td>
                            <div class="modal fade" id="ON<?php echo $data_pelanggan['id_pelanggan']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Status</h5>
                                        </div>
                                        <form action="./akses.php" enctype="multipart/form-data" method="POST">
                                            <div class="modal-body">
                                                <input type="text" name="id" value="<?php echo $data_pelanggan['id_pelanggan']; ?>" hidden>
                                                <p>Apakah Anda Akan Merubah Status Menjadi ON?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="save_on" class="btn btn-primary shadow-none">Save
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <td>
                                <button type="button" class="btn btn-danger shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#OFF<?php echo $data_pelanggan['id_pelanggan']; ?>"><i class="bx bx-edit"></i></button>
                            </td>
                            <div class="modal fade" id="OFF<?php echo $data_pelanggan['id_pelanggan']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Status</h5>
                                        </div>
                                        <form action="./akses.php" enctype="multipart/form-data" method="POST">
                                            <div class="modal-body">
                                                <input type="text" name="id" value="<?php echo $data_pelanggan['id_pelanggan']; ?>" hidden>
                                                <p>Apakah Anda Akan Merubah Status Menjadi OFF?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="save_off" class="btn btn-primary shadow-none">Save
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
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
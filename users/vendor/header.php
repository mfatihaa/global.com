<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="./">Global Techno</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./"><i class='bx bx-home'></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./service.php"><i class='bx bx-package'></i> Service/Product</a>
                </li>
                <?php
                include "./conn.php";
                if (isset($_SESSION['id_user']) && $_SESSION['username']) {
                    $id = $_SESSION['id_user'];
                    $view = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id' ");
                    $data = mysqli_fetch_assoc($view);
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./cart.php"><i class='bx bx-cart'></i> Cart [0]</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./stand-in-line.php"><i class='bx bx-list-check'></i> Waiting List</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./about.php"><i class='bx bxs-note'></i> About </a>
                    </li>
                <?php
                }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-menu'></i> Menu
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        include "./conn.php";
                        if (isset($_SESSION['id_user']) && $_SESSION['username']) {
                            $id = $_SESSION['id_user'];
                            $view = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id' ");
                            $data = mysqli_fetch_assoc($view);
                        ?>
                            <?php
                            if (isset($data['image'])) {
                            ?>
                                <li class="nav-items">
                                    <div class="row align-items-center">
                                        <div class="col-12 text-center mt-2">
                                            <img src="./vendor/img-customer/<?= $data['image']; ?>" class="rounded-5" width="50" loading="lazy">
                                        </div>
                                        <div class="col-12 text-center mt-2">
                                            <?= $data['nama']; ?></a>
                                        </div>
                                    </div>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="nav-items">
                                    <div class="row align-items-center">
                                        <div class="col-12 text-center mt-2">
                                            <img src="./vendor/img-customer/profile.png" class="rounded-5" width="50" loading="lazy"></a>
                                        </div>
                                        <div class="col-12 text-center mt-2">
                                            <?= $data['nama']; ?></a>
                                        </div>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                            <hr class="border border-bottom">
                            <li class="nav-items">
                                <a class="nav-link" href="./settings.php"><i class='bx bx-cog'></i> Settings</a>
                            </li>
                            <li class="nav-items">
                                <a class="nav-link" href="./log-out.php"><i class='bx bx-log-out-circle'></i> Logout</a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-items">
                                <a class="dropdown-item" href="./log-in.php">Sign In <i class='bx bx-log-in-circle'></i></a>
                            </li>
                            <li class="nav-items">
                                <a class="dropdown-item" href="./registration.php">Registration <i class='bx bx-registered'></i></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
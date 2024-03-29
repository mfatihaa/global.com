<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="../admin">Global Techno</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./"><i class='bx bx-home'></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./data_pelanggan"><i class='bx bxs-user-detail'></i> Data
                        Pelanggan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./service_produk"><i class='bx bx-briefcase'></i> Data
                        Service/Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./stand-in-line"><i class='bx bx-package'></i> Pesanan</a>
                </li>
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
                                            <img src="./vendor/img/<?= $data['image']; ?>" class="rounded-5 mt-2" width="50" loading="lazy">
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
                                            <img src="./vendor/img/profile.svg" class="rounded-5 mt-2" width="50" loading="lazy"></a>
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
                                <a class="nav-link" href="./setting"><i class='bx bx-cog'></i> Settings</a>
                            </li>
                            <li class="nav-items">
                                <a class="nav-link" href="./log-out"><i class='bx bx-log-out-circle'></i> Logout</a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-items">
                                <a class="dropdown-item" href="./log-in">Sign In <i class='bx bx-log-in-circle'></i></a>
                            </li>
                            <li class="nav-items">
                                <a class="dropdown-item" href="../">Pelanggan <i class='bx bx-user'></i></a>
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
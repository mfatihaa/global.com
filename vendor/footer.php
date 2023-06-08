<footer class="bg-light w-100">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <h5 class="text-dark fw-bold mb-3">
                    Global Techno
                </h5>
                <p>
                    Global Techno adalah Wirausaha Mahasiswa dari Universitas Global Jakarta. Global Techno ini sendiri berdiri sejak bulan Maret 2022.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-dark fw-bold mb-3">
                    Link
                </h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1">
                        <a href="./service.php" class="text-decoration-none text-dark">Service/Produk</a>
                    </li>
                    <li class="mb-1">
                        <a href="tentang" class="text-decoration-none text-dark">About</a>
                    </li>
                    <li class="mb-1">
                        <a href="./cart.php" class="text-decoration-none text-dark">Cart</a>
                    </li>
                    <?php
                    if (isset($_SESSION['username'])) {
                        $session = $_SESSION['username'];
                        $view = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE username='$session'");
                        $check = mysqli_fetch_assoc($view);

                        echo '<li class="mb-1">
                                <a href="logout" class="text-decoration-none text-dark">Keluar</a>
                              </li>';
                    } else {
                        echo '<li class="mb-1">
                                <a href="./log-in.php" class="text-decoration-none text-dark">Sign-in</a>
                              </li>
                              <li class="mb-1">
                                <a href="./registration.php" class="text-decoration-none text-dark">Registration</a>
                              </li>';
                    }
                    ?>

                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-dark fw-bold mb-3">
                    Opening Hours
                </h5>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Senin - Jumat</td>
                            <td>08.00 - 16.00</td>
                        </tr>
                        <tr>
                            <td>Sabtu - Minggu</td>
                            <td class="text-danger">Libur</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-center p-3 bg-dark text-warning fw-bold">
        Powered By Akbar Naufal © 2022
    </div>
</footer>
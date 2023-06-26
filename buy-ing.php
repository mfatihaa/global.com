<?php
error_reporting(0);
session_start();

// Mendapatkan ID_Produk
$code_product = $_GET['code'];

// Jika sudah ada di keranjang, mk produk jumlahnya 1
if (isset($_SESSION['cart'][$code_product])) {
    $_SESSION['cart'][$code_product] += 1;
}
//Jika blm ada di keranjang , mk produk di anggap dibeli 1 
else {
    $_SESSION['cart'][$code_product] = 1;
}
echo "<script>alert('Produk/Service telah masuk ke keranjang');</script>";
header("Location: ./cart");

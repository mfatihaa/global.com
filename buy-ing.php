<?php
error_reporting(0);
session_start();

// Mendapatkan Kode Pelanggan
$code_pelanggan = $_SESSION['pelanggan']['code_pelanggan'];

// Mendapatkan ID_Produk
$code_product = $_GET['code'];
include "./conn.php";

// Jika Product Sudah Ada Di Cart, Akan ++1
if (isset($_SESSION['cart'][$code_product])) {
    $_SESSION['cart'][$code_product] += 1;
}
// Jika Product Belum Ada Di Cart, Akan +1 
else {
    $_SESSION['cart'][$code_product] = 1;
}
header("Location: ./cart?page=$code_pelanggan");
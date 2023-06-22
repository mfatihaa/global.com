<?php
error_reporting(0);
session_start();

// Mendapatkan ID_Produk
$id_product = $_GET['id'];

// Jika sudah ada di keranjang, mk produk jumlahnya 1
if (isset($_SESSION['cart'][$id_product])) {
    $_SESSION['cart'][$id_product] += 1;
}
//Jika blm ada di keranjang , mk produk di anggap dibeli 1 
else {
    $_SESSION['cart'][$id_product] = 1;
}


echo "<script>alert('Produk Berhasil Ditambahkan.');window.location='./cart'</script>";
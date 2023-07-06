<?php
error_reporting(0);
session_start();

if (empty($_SESSION['id_pelanggan']) && empty($_SESSION['username'])) {
    echo "<script>alert('Mohon Login Terlebih Dahulu!');document.location.href='./log-in'</script>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Techno | Nota Pelanggan</title>
</head>

<body>

</body>

</html>
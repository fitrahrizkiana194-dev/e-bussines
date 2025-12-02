<?php
session_start();
include 'db_connect.php';
$id = $_GET['id'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesanan Berhasil</title>
</head>

<body>
    <h2>🎉 Pesanan Berhasil!</h2>
    <p>Terima kasih sudah berbelanja di <strong>Toko Lifestyle</strong> 💖</p>
    <p>Nomor pesanan kamu: <strong>#<?= $id; ?></strong></p>
    <a href="index.php">Kembali ke Beranda</a>
</body>

</html>
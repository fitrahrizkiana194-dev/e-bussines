<?php
session_start();
include 'db_connect.php';

// Pastikan user sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

// Ambil data user
$sql_user = "SELECT * FROM users WHERE id = '$user_id'";
$result_user = mysqli_query($conn, $sql_user);
$user = mysqli_fetch_assoc($result_user);

// Ambil riwayat pesanan
$sql_orders = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY tanggal_pesan DESC";
$result_orders = mysqli_query($conn, $sql_orders);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h2>Profil Pengguna</h2>

    <div class="profile-box">
        <p><strong>Nama Pengguna:</strong> <?= htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
        <p><strong>Role:</strong> <?= htmlspecialchars($user['role']); ?></p>
    </div>

    <hr>

    <h3>Riwayat Pesanan</h3>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID Pesanan</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
        </tr>
        <?php if (mysqli_num_rows($result_orders) > 0): ?>
            <?php while ($order = mysqli_fetch_assoc($result_orders)): ?>
                <tr>
                    <td><?= $order['id']; ?></td>
                    <td><?= htmlspecialchars($order['produk']); ?></td>
                    <td><?= $order['jumlah']; ?></td>
                    <td>Rp<?= number_format($order['total_harga'], 0, ',', '.'); ?></td>
                    <td><?= $order['order_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Belum ada pesanan.</td>
            </tr>
        <?php endif; ?>
    </table>

    <br>
    <a href="index.php" class="btn-primary">⬅ Kembali ke Beranda</a>

</body>

</html>
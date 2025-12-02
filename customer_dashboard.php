<?php
session_start();
include 'db_connect.php';

// Pastikan hanya pelanggan yang bisa mengakses halaman ini
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

// Ambil data user dari tabel users
$sql_user = "SELECT * FROM users WHERE id = '$user_id'";
$result_user = $conn->query($sql_user);
$user = $result_user->fetch_assoc();

// Ambil riwayat pesanan dari tabel orders
$sql_orders = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY tanggal_pesan DESC";
$result_orders = $conn->query($sql_orders);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Pelanggan</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <h2>Dashboard Pelanggan</h2>

        <!-- Informasi Akun -->
        <section class="profile">
            <h3>👤 Informasi Akun</h3>
            <p><strong>Nama:</strong> <?= htmlspecialchars($user['nama']); ?></p>
            <p><strong>Username:</strong> <?= htmlspecialchars($user['username']); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>

            <?php if (isset($user['poin'])): ?>
                <p><strong>Poin Anda:</strong> <?= $user['poin']; ?> ⭐</p>
            <?php else: ?>
                <p><strong>Poin Anda:</strong> 0 ⭐</p>
            <?php endif; ?>
        </section>

        <!-- Riwayat Pesanan -->
        <section class="orders">
            <h3>🛍️ Riwayat Pesanan</h3>
            <?php if ($result_orders->num_rows > 0): ?>
                <table border="1" cellpadding="8" cellspacing="0">
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal Pesan</th>
                        <th>Status</th>
                    </tr>
                    <?php while ($row = $result_orders->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= htmlspecialchars($row['produk']); ?></td>
                            <td><?= $row['jumlah']; ?></td>
                            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                            <td><?= $row['tanggal_pesan']; ?></td>
                            <td><?= ucfirst($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>Belum ada pesanan.</p>
            <?php endif; ?>
        </section>

        <a href="logout.php" class="logout">Keluar</a>
    </div>
</body>

</html>
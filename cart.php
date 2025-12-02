<?php
session_start();
include 'db_connect.php';

// Pastikan user sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Hapus item dari keranjang
if (isset($_GET['hapus'])) {
    $hapus_id = $_GET['hapus'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $hapus_id) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // reset index
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="navbar">
        <div class="container">
            <h2><a href="index.php">Toko Lifestyle</a></h2>
            <nav>
                <a href="index.php">Home</a>
                <a href="cart.php" class="active">Keranjang</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <div class="cart-container">
        <h2>🛒 Keranjang Belanja</h2>

        <?php if (empty($_SESSION['cart'])): ?>
            <p>Keranjang kamu masih kosong 😅</p>
        <?php else: ?>
            <table border="1" cellpadding="10">
                <tr>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item):
                    $subtotal = $item['harga'] * $item['jumlah'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><img src="<?= $item['gambar']; ?>" width="80"></td>
                        <td><?= $item['nama']; ?></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                        <td><?= $item['jumlah']; ?></td>
                        <td>Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                        <td><a href="cart.php?hapus=<?= $item['id']; ?>">Hapus</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <h3>Total: Rp <?= number_format($total, 0, ',', '.'); ?></h3>
            <a href="checkout.php" class="btn-checkout">Lanjut ke Checkout</a>
        <?php endif; ?>
    </div>
</body>

</html>
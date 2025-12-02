<?php
session_start();

// Ambil data pesanan terakhir dari session (kalau ada)
$order = $_SESSION['last_order'] ?? [
    'nama_produk' => 'Produk Tidak Diketahui',
    'total_bayar' => 0,
    'metode' => 'Belum Ditetapkan',
];

// Setelah ditampilkan, hapus keranjang
unset($_SESSION['cart']);
unset($_SESSION['last_order']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: #f0fdf4;
            font-family: "Poppins", sans-serif;
            text-align: center;
            padding: 50px;
        }

        .success-box {
            background: white;
            border-radius: 15px;
            padding: 40px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .success-box h1 {
            color: #16a34a;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .success-box p {
            color: #555;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .order-summary {
            text-align: left;
            background: #f9fafb;
            border-radius: 10px;
            padding: 15px 20px;
            margin-top: 20px;
        }

        .order-summary div {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background: #16a34a;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn:hover {
            background: #15803d;
        }
    </style>
</head>

<body>
    <div class="success-box">
        <img src="https://cdn-icons-png.flaticon.com/512/845/845646.png" width="80" alt="success">
        <h1>🎉 Pembayaran Berhasil!</h1>
        <p>Terima kasih telah berbelanja di <strong>Teguk.in</strong></p>

        <div class="order-summary">
            <div><span>Produk:</span> <span><?= htmlspecialchars($order['nama_produk']) ?></span></div>
            <div><span>Metode:</span> <span><?= htmlspecialchars($order['metode']) ?></span></div>
            <div><span>Total Bayar:</span> <span>Rp <?= number_format($order['total_bayar'], 0, ',', '.') ?></span></div>
        </div>

        <a href="index.php" class="btn">Kembali ke Beranda 🏠</a>
    </div>
</body>

</html>
<?php
session_start();

// =======================
// CEK VOUCHER DARI GAME
// =======================
$voucher = $_SESSION['voucher'] ?? null;

// Jika belum punya voucher dari game
if (!$voucher || $voucher['status'] !== 'aktif') {
    echo "<script>alert('Kamu belum memiliki voucher aktif dari game!'); window.location.href='game.php';</script>";
    exit;
}

// =======================
// DATA PRODUK KHUSUS
// (Produk yang bisa pakai voucher)
// =======================
$produk_voucher = [
    'MUG001' => [
        'nama' => 'Mug Keramik Glossy',
        'harga' => 45000,
        'gambar' => 'https://i.pinimg.com/1200x/ac/2b/d0/ac2bd00ad2156e146bd27c062e97575c.jpg',
        'deskripsi' => 'Lapisan glossy premium, hasil cetak tajam, cocok untuk foto dan logo penuh warna.'
    ]
];

$id = $_GET['id'] ?? 'MUG001';
$produk = $produk_voucher[$id] ?? null;

if (!$produk) {
    echo "Produk tidak ditemukan!";
    exit;
}

// =======================
// HITUNG TOTAL
// =======================
$ongkir = 15000;
$voucher_nominal = $voucher['nominal'] ?? 0;
$total = $produk['harga'] + $ongkir - $voucher_nominal;

if ($total < 0) $total = 0;

// Otomatis nonaktifkan voucher setelah digunakan
$_SESSION['voucher']['status'] = 'terpakai';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout Voucher - <?= $produk['nama'] ?></title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f7f8fa;
            padding: 40px;
        }

        .checkout-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .product {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .product img {
            width: 120px;
            border-radius: 10px;
        }

        .product-info h3 {
            margin: 0;
        }

        .summary-item,
        .summary-total {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }

        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }

        .total {
            font-weight: bold;
            color: #2563eb;
        }

        .btn {
            display: block;
            text-align: center;
            background: #2563eb;
            color: white;
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 20px;
        }

        .voucher-box {
            background: #22c55e;
            color: white;
            padding: 8px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="checkout-container">
        <h2>Checkout dengan Voucher 🎁</h2>

        <div class="product">
            <img src="<?= $produk['gambar'] ?>" alt="<?= $produk['nama'] ?>">
            <div class="product-info">
                <h3><?= $produk['nama'] ?></h3>
                <p><?= $produk['deskripsi'] ?></p>
            </div>
        </div>

        <div class="voucher-box">
            Voucher aktif: <strong>Rp<?= number_format($voucher_nominal, 0, ',', '.') ?></strong> <br>
            Berlaku khusus untuk produk Mug Keramik Glossy
        </div>

        <div class="summary-item"><span>Harga Produk</span><span>Rp<?= number_format($produk['harga'], 0, ',', '.') ?></span></div>
        <div class="summary-item"><span>Ongkir</span><span>Rp<?= number_format($ongkir, 0, ',', '.') ?></span></div>
        <div class="summary-item"><span>Potongan Voucher</span><span>-Rp<?= number_format($voucher_nominal, 0, ',', '.') ?></span></div>
        <hr>
        <div class="summary-total"><span>Total Bayar</span><span class="total">Rp<?= number_format($total, 0, ',', '.') ?></span></div>

        <a href="pembayaran_sukses.php" class="btn">Bayar Sekarang 💳</a>
    </div>

</body>

</html>
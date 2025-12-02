<?php
session_start();

// Ambil ID produk dari URL
$id = $_GET['id'] ?? 'TUM001';

// Data contoh (nantinya bisa diambil dari database)
$produkList = [
    'TUM001' => [
        'id' => 'TUM001',
        'nama' => 'Tumbler Vakum Classic 500ml',
        'harga' => 189000,
        'deskripsi' => 'Tumbler berbahan stainless steel 304, tahan panas hingga 6 jam dan dingin 12 jam. Desain elegan, cocok untuk kerja, kuliah, atau traveling.',
        'gambar' => 'https://i.pinimg.com/1200x/de/87/9d/de879d08cc2cc710f2fa1e0840a629a0.jpg'
    ],
    'MUG001' => [
        'id' => 'MUG001',
        'nama' => 'Mug Keramik Glossy (11oz)',
        'harga' => 45000,
        'deskripsi' => 'Lapisan glossy premium, hasil cetak tajam, cocok untuk foto dan logo penuh warna.',
        'gambar' => 'https://i.pinimg.com/1200x/ac/2b/d0/ac2bd00ad2156e146bd27c062e97575c.jpg'
    ]
];

// Ambil produk sesuai ID
$produk = $produkList[$id] ?? $produkList['TUM001'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produk['nama']); ?> - Detail Produk</title>
    <link rel="stylesheet" href="produk_detail.css">
</head>

<body>

    <!-- Navbar -->
    <header class="navbar">
        <div class="container">
            <h2 class="logo"><a href="index.php">Teguk.in</a></h2>
            <nav>
                <a href="index.php">Home</a>
                <a href="cart.php">Keranjang</a>
                <a href="#">Akun</a>
            </nav>
        </div>
    </header>

    <!-- Detail Produk -->
    <div class="product-detail-container">
        <div class="product-image">
            <img src="<?= htmlspecialchars($produk['gambar']); ?>" alt="<?= htmlspecialchars($produk['nama']); ?>">
        </div>

        <div class="product-info">
            <h1><?= htmlspecialchars($produk['nama']); ?></h1>
            <p class="price">Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></p>
            <p class="desc"><?= htmlspecialchars($produk['deskripsi']); ?></p>

            <div class="button-group">
                <button class="btn-cart" onclick="addToCart()">🛒 Masukkan Keranjang</button>
                <button class="btn-buy" onclick="pesanSekarang()">💖 Pesan Sekarang</button>
            </div>

            <div class="review-section">
                <h3>Ulasan (2)</h3>
                <div class="review">
                    <strong>Rani</strong>
                    <p>Warnanya cantik banget! Pengiriman cepat 💕</p>
                </div>
                <div class="review">
                    <strong>Dika</strong>
                    <p>Barang sesuai deskripsi, recommended seller!</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2025 Teguk.in. All rights reserved.</p>
    </footer>

    <script>
        // Ambil data produk dari PHP ke JS
        const produk = {
            id: "<?= $produk['id']; ?>",
            nama: "<?= addslashes($produk['nama']); ?>",
            harga: <?= $produk['harga']; ?>,
            gambar: "<?= $produk['gambar']; ?>"
        };

        function addToCart() {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            const index = cart.findIndex(item => item.id === produk.id);

            if (index >= 0) {
                cart[index].jumlah += 1;
            } else {
                produk.jumlah = 1;
                cart.push(produk);
            }

            localStorage.setItem("cart", JSON.stringify(cart));
            alert("✅ Produk ditambahkan ke keranjang!");
        }

        function pesanSekarang() {
            // Simpan produk yang akan dibeli ke localStorage
            localStorage.setItem("produkCheckout", JSON.stringify(produk));
            window.location.href = "checkout.php";
        }
    </script>

</body>

</html>
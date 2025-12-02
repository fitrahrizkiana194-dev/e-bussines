<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teguk.in – Tumbler Collection</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="navbar">
        <div class="container">
            <div class="logo">
                <img src="image/logo.png" alt="Logo Teguk.in">
                <a href="index.php">teguk.in</a>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="dropdown">
                        <a href="#">Produk</a>
                        <ul class="dropdown-menu">
                            <li><a href="tumbler.html">Tumbler</a></li>
                            <li><a href="mug.php">Mug Custom</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Best Sellers</a></li>
                    <li><a href="#">Kontak</a></li>
                    <li>
                        <a href="keranjang.php" class="cart-link">
                            Keranjang (<span id="cart-count">0</span>)
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <h2>Koleksi Tumbler Terbaik</h2>
        <p class="tagline">Jaga hidrasi Anda dengan gaya dan ramah lingkungan.</p>

        <div class="product-grid">

            <div class="product-card">
                <a href="produk_detail.php?id=TUM001" class="product-link">
                    <img src="https://i.pinimg.com/1200x/de/87/9d/de879d08cc2cc710f2fa1e0840a629a0.jpg" alt="Tumbler Vakum Classic">
                    <div class="product-info">
                        <h3>Tumbler Vakum Classic 500ml</h3>
                        <p>Stainless steel 304, tahan panas 6 jam, dingin 12 jam.</p>
                        <div class="price">Rp 189.000</div>
                    </div>
                </a>
                <button class="btn-cart-add" onclick="addToCart('TUM001', 'Tumbler Vakum Classic', 189000)">
                    <i class="fas fa-cart-plus"></i> Masukkan Keranjang
                </button>

            </div>



            <div class="product-card" data-id="TUM002" data-name="Tumbler Sedotan Trendy" data-price="125000">
                <img src="https://i.pinimg.com/1200x/52/86/50/528650de2c0adad78b2ce1fff0225385.jpg" alt="Tumbler Sedotan Trendy">
                <div class="product-info">
                    <h3>Tumbler Sedotan 750ml</h3>
                    <p class="description">Plastik BPA Free, dilengkapi sedotan reusable. Cocok untuk kopi dan teh dingin.</p>
                    <div class="price">Rp 125.000</div>
                    <button class="add-to-cart-btn"
                        onclick="addToCart('TUM002', 'Tumbler Sedotan Trendy', 125000)">
                        Masukkan Keranjang
                    </button>
                </div>
            </div>

            <div class="product-card" data-id="TUM003" data-name="Tumbler Bambu Eksklusif" data-price="250000">
                <div class="badge new-item">NEW</div>
                <img src="https://i.pinimg.com/736x/9e/b7/36/9eb7365b8f72b5493c7cc4b078c368f5.jpg" alt="Tumbler Bambu Eksklusif">
                <div class="product-info">
                    <h3>Tumbler Bambu Custom</h3>
                    <p class="description">Luar bambu alami, dalam stainless steel. Dapat diukir nama/logo.</p>
                    <div class="price">Rp 250.000</div>
                    <button class="add-to-cart-btn"
                        onclick="addToCart('TUM003', 'Tumbler Bambu Eksklusif', 250000)">
                        Masukkan Keranjang
                    </button>
                </div>
            </div>

        </div>
    </main>

    <script src="script.js"></script>
</body>

</html>
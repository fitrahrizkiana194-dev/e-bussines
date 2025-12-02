<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teguk.in – Mug Custom Collection</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="navbar">
        <div class="container">
            <div class="logo">
                <img src="image/logo.png" alt="Logo Teguk.in">
                <a href="index.html">teguk.in</a>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="dropdown">
                        <a href="#">Produk</a>
                        <ul class="dropdown-menu">
                            <li><a href="tumbler.php">Tumbler</a></li>
                            <li><a href="mug.php">Mug Custom</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Best Sellers</a></li>
                    <li><a href="#">Kontak</a></li>
                    <li>
                        <a href="keranjang.html" class="cart-link">
                            Keranjang (<span id="cart-count">0</span>)
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <h2>Koleksi Mug Custom</h2>
        <p class="tagline">Desain mug impian Anda. Sempurna untuk hadiah atau koleksi pribadi!</p>

        <div class="product-grid">

            <!-- Kartu Produk -->
            <div class="product-card"
                data-id="MUG001"
                data-name="Mug Keramik Glossy"
                data-price="45000">

                <div class="badge new-item">Customable</div>
                <img src="https://i.pinimg.com/1200x/ac/2b/d0/ac2bd00ad2156e146bd27c062e97575c.jpg"
                    alt="Mug Keramik Putih Glossy">

                <div class="product-info">
                    <h3>Mug Keramik Standar (11oz)</h3>
                    <p class="description">
                        Lapisan glossy premium, hasil cetak tajam, cocok untuk foto dan logo penuh warna.
                    </p>
                    <div class="price">Rp 45.000</div>

                    <!-- Tombol menuju halaman produk detail -->
                    <button class="add-to-cart-btn"
                        onclick="event.stopPropagation(); lihatDetail('MUG001')">
                        Pesan & Masukkan Keranjang
                    </button>
                </div>
            </div>

            <script>
                // Fungsi menuju halaman detail produk
                function lihatDetail(productId) {
                    window.location.href = 'produk_detailmug.php?id=' + productId;
                }
            </script>


            <script>
                // Fungsi saat user klik produk
                function buatPesanan(element) {
                    // Ambil data dari atribut produk
                    const id = element.getAttribute('data-id');
                    const name = element.getAttribute('data-name');
                    const price = element.getAttribute('data-price');

                    // Simpan ke localStorage agar bisa dibaca di halaman checkout
                    localStorage.setItem('checkoutProduct', JSON.stringify({
                        id: id,
                        name: name,
                        price: price
                    }));

                    //arahkan ke halaman produk detail
                    window.location.href = "produk_detailmug.php"
                    // Arahkan ke halaman checkout
                    window.location.href = "checkout.php";
                }
            </script>


            <div class="product-card" data-id="MUG002" data-name="mug couple" data-price="75000">
                <div class="badge best-seller">Populer</div>
                <img src="https://i.pinimg.com/1200x/99/df/dc/99dfdcca7cde82435e68d25313d9bc1f.jpg" alt="Mug couple">
                <div class="product-info">
                    <h3>mug couple</h3>
                    <p class="description">desain kali ini cocok untuk pasangan mu! lengkapi kisah kalian dengan tegukan hangat melalui mug kami!</p>
                    <div class="price">Rp 75.000</div>
                    <button class="add-to-cart-btn"
                        onclick="addToCart('MUG002', 'Magic Mug Bunglon', 75000)">
                        Pesan & Masukkan Keranjang
                    </button>
                </div>
            </div>

            <div class="product-card" data-id="MUG003" data-name="Mug tanah liat" data-price="55000">
                <img src="https://i.pinimg.com/736x/17/52/7d/17527d6b0b273501233ebadf051251d8.jpg" alt="Mug tanah liat">
                <div class="product-info">
                    <h3>Mug tanah liat</h3>
                    <p class="description">kami juga menyediakan tempat untuk teman-teman berkreasi membuat mug dari tanah liat, untuk info lebih lengkap nya klik link di bawah ini ya!</p>
                    <div class="price">Rp 55.000</div>
                    <button class="add-to-cart-btn"
                        onclick="addToCart('MUG003', 'Mug Gagang Hati', 55000)">
                        Pesan & Masukkan Keranjang
                    </button>
                </div>
            </div>

        </div>

        <section class="custom-cta">
            <h3>Punya Ide Desain Sendiri?</h3>
            <p>Kami melayani pemesanan mug dalam jumlah besar untuk souvenir kantor, event, atau pernikahan. Hubungi kami untuk penawaran spesial!</p>
            <a href="pemesanan.php" class="cta-button">Hubungi Tim Desain</a>
        </section>

    </main>

    <script src="script.js"></script>
</body>

</html>
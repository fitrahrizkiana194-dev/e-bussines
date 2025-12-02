<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toko Lifestyle – Home</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="navbar">
    <div class="container">
      <div class="logo">
        <img src="image/logo.png" alt="Logo Teguk.in">
        <a href="#">teguk.in</a>
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
          <li><a href="#section-best">Best Sellers</a></li>
          <li><a href="#kontak">Kontak</a></li>
          <li><a href="#tentang-kami">Tentang kami</a></li>
        </ul>
      </nav>

      <div class="nav-extra">
        <input type="text" placeholder="Search...">
        <a href="cart.php" class="btn-cart">Cart (0)</a>

        <?php if (isset($_SESSION['user'])): ?>
          <div class="dropdown">
            <a href="#" class="btn-profile">
              👤 <?= htmlspecialchars($_SESSION['user']['username']); ?>
            </a>
            <ul class="dropdown-menu">
              <li><a href="user_profile.php">Profil Saya</a></li>
              <li><a href="logout.php" class="btn-logout">Logout</a></li>
            </ul>
          </div>
        <?php else: ?>
          <a href="login.php" class="btn-login">Login</a>
        <?php endif; ?>
      </div>

  </header>

  <!-- Pesan Selamat Datang -->
  <section class="welcome">
    <div class="container">
      <?php if (isset($_SESSION['user'])): ?>
        <h2>Selamat datang di toko kami, <strong><?= htmlspecialchars($_SESSION['user']['username']); ?></strong> 👋</h2>
        <p>Selamat berbelanja. Semoga harimu menyenangkan, selalu!</p>
      <?php else: ?>
        <h2>Selamat datang di <strong>Teguk.in</strong> 👋</h2>
        <p>Silakan login untuk mulai berbelanja.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Hero / Banner -->
  <section class="hero">
    <div class="hero-content">
      <h1>Lebih Peduli, Lebih Stylish</h1>
      <p>Pilih Tumbler Eco-Friendly untuk gaya hidup yang berdampak positif!</p>
      <a href="#section-best" class="btn-primary">Belanja Sekarang</a>
    </div>

    <div class="hero-slider">
      <img src="image/poster1.png" alt="Poster 1">
      <img src="image/satulagi.png" alt="Poster 2">
      <img src="https://i.pinimg.com/1200x/c2/c0/5e/c2c05e62a6ccdf5fe98ca23ea1228989.jpg" alt="Poster 3">
    </div>
  </section>

  <!-- Best Sellers Section -->
  <section id="section-best" class="section-products">
    <div class="container">
      <h2>Best Sellers</h2>
      <div class="product-grid">

        <!-- Produk 1 -->
        <div class="product-card">
          <div class="product-img">
            <img src="tumbler 1.jpg" alt="Tumbler Estetik">
            <span class="tag-sale">Sale</span>
          </div>
          <div class="product-info">
            <h3>Stainless Tumbler 500ml</h3>
            <p class="price">Rp 120.000 <span class="old-price">Rp 150.000</span></p>

            <form action="cart.php" method="post">
              <input type="hidden" name="id_produk" value="1">
              <input type="hidden" name="nama_produk" value="Stainless Tumbler 500ml">
              <input type="hidden" name="harga" value="120000">
              <button type="submit">Masukkan ke Keranjang</button>
            </form>
          </div>
        </div>

        <!-- Produk 2 -->
        <div class="product-card">
          <div class="product-img">
            <img src="t rex.jpg" alt="Mug Custom">
          </div>
          <div class="product-info">
            <h3>Mug Custom Nama</h3>
            <p class="price">Rp 85.000</p>

            <form action="cart.php" method="post">
              <input type="hidden" name="id_produk" value="2">
              <input type="hidden" name="nama_produk" value="Mug Custom Nama">
              <input type="hidden" name="harga" value="85000">
              <button type="submit">Masukkan ke Keranjang</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- Game Voucher Section -->
  <section class="game-voucher">
    <div class="container">
      <div class="game-content">
        <h2>🎮 Mainkan Game Seru & Dapatkan Voucher Belanja!</h2>
        <p>Uji keberuntunganmu dan menangkan poin voucher untuk belanja di Teguk.in 💸</p>
        <a href="game.php" class="btn-play">Mainkan Sekarang</a>
      </div>
      <div class="game-img">
        <img src="image/diskon.png" alt="Game Voucher">
      </div>
    </div>
  </section>
  <!-- Tentang Kami -->
  <section id="tentang-kami" class="about-section">
    <div class="container about-container">
      <div class="about-image">
        <img src="https://i.pinimg.com/736x/06/a5/5b/06a55b5918bf4bbfdeff4206e4ca98e2.jpg" alt="Tentang Teguk.in">
      </div>

      <div class="about-content">
        <h2>Tentang Kami ☕</h2>
        <p>
          <strong>Teguk.in</strong> adalah toko lifestyle yang berfokus pada produk ramah lingkungan seperti
          <em>tumbler</em> dan <em>mug custom</em> dengan desain estetik dan berkualitas tinggi.
        </p>
        <p>
          Kami percaya bahwa gaya hidup modern bisa berjalan seiring dengan kepedulian terhadap lingkungan.
          Setiap pembelian di Teguk.in membantu mengurangi penggunaan plastik sekali pakai dan mendukung
          gerakan hidup berkelanjutan 🌿.
        </p>
        <p>
          Visi kami adalah menjadi brand lokal yang inspiratif, mendorong masyarakat untuk “<strong>lebih peduli, lebih stylish</strong>” dalam setiap tegukan.
        </p>

        <a href="#section-best" class="btn-learn">Lihat Produk Kami</a>
      </div>
    </div>
  </section>
  <!-- Workshop Pembuatan Mug -->
  <section id="workshop" class="workshop-section">
    <div class="container workshop-container">
      <div class="workshop-text">
        <h2>✨ Workshop Membuat Mug dari Tanah Liat ✨</h2>
        <p>
          Di <strong>Teguk.in</strong>, kamu tidak hanya bisa membeli mug cantik —
          tetapi juga <em>membuatnya sendiri</em> dari awal menggunakan tanah liat alami! 🎨
        </p>
        <p>
          Rasakan pengalaman unik membentuk, mengukir, dan memberi warna pada mug kreasimu sendiri
          dengan bimbingan pengrajin profesional kami. Setiap hasil karya akan dibakar dan
          siap kamu bawa pulang — menjadi mug pribadi yang penuh makna ☕💛.
        </p>
        <ul class="workshop-points">
          <li>🧱 Menggunakan tanah liat alami berkualitas tinggi</li>
          <li>🎨 Bebas berkreasi dengan warna dan bentuk</li>
          <li>📦 Hasil karya bisa langsung dibawa pulang</li>
        </ul>
        <a href="pendaftaran_workshop.php" class="btn-learn">Daftar Workshop Sekarang</a>
      </div>

      <div class="workshop-image">
        <img src="https://i.pinimg.com/1200x/63/52/fb/6352fb7e83d346629995341e65069ce3.jpg" alt="Workshop Membuat Mug Tanah Liat">
      </div>
    </div>
  </section>



  <!-- Newsletter -->
  <section class="newsletter">
    <div class="container">
      <h3>Berlangganan Untuk Info Promo</h3>
      <form>
        <input type="email" placeholder="Masukkan email">
        <button type="submit">Subscribe</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer id="kontak" class="footer">
    <div class="container">
      <div class="footer-col">
        <h4>Kontak</h4>
        <p>Alamat: limbangan, garut jawa barat</p>
        <p>Email: info@tokolife.com</p>
      </div>
      <div class="footer-col">
        <h4>Informasi</h4>
        <ul>
          <li><a href="#">Tentang Kami</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Kebijakan Privasi</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Media Sosial</h4>
        <ul>
          <li><a href="#">Instagram</a></li>
          <li><a href="#">Facebook</a></li>
        </ul>
      </div>
    </div>
  </footer>

  <script src="script.js"></script>
</body>

</html>
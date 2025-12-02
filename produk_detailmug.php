<?php
// Ambil ID dari URL (default MUG001)
$id = $_GET['id'] ?? 'MUG001';

// Data produk (bisa kamu ganti dengan data dari database)
$produk = [
    'MUG001' => [
        'nama' => 'Mug Keramik Standar (11oz)',
        'harga' => 45000,
        'gambar' => 'https://i.pinimg.com/1200x/ac/2b/d0/ac2bd00ad2156e146bd27c062e97575c.jpg',
        'deskripsi' => 'Lapisan glossy premium, hasil cetak tajam, cocok untuk foto dan logo penuh warna.'
    ]
];

// Ambil data produk sesuai ID
$data = $produk[$id] ?? null;

if (!$data) {
    echo "Produk tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['nama']) ?></title>
    <link rel="stylesheet" href="produk_detailmug.css">
</head>

<body>

    <div class="product-detail-container">
        <div class="product-image">
            <img src="<?= htmlspecialchars($data['gambar']) ?>" alt="<?= htmlspecialchars($data['nama']) ?>">
        </div>

        <div class="product-info">
            <h1><?= htmlspecialchars($data['nama']) ?></h1>
            <p class="price">Rp <?= number_format($data['harga'], 0, ',', '.') ?></p>
            <p class="description"><?= htmlspecialchars($data['deskripsi']) ?></p>
            <button onclick="pesanSekarang('MUG001','Mug Keramik Standar',45000,1)">Pesan Sekarang</button>

            <script>
                function pesanSekarang(id, nama, harga, qty = 1) {
                    const produk = {
                        id: id,
                        nama: nama,
                        harga: Number(harga),
                        qty: Number(qty)
                    };
                    localStorage.setItem('produkCheckout', JSON.stringify(produk));
                    // pindah ke checkout
                    window.location.href = 'checkout.php'; // atau checkout.html
                }
            </script>


        </div>
    </div>

</body>

</html>
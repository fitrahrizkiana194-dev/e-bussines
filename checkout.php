<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Checkout - Toko Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
        }

        .checkout-container {
            width: 90%;
            max-width: 800px;
            background: #fff;
            margin: 30px auto;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 25px 35px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
        }

        .summary-box,
        .shipping-info {
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            background: #fafafa;
            margin-bottom: 25px;
        }

        .summary-item,
        .summary-total {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 15px;
            color: #444;
        }

        .summary-total {
            font-weight: bold;
            font-size: 17px;
        }

        .btn-checkout {
            width: 100%;
            background: #ff5722;
            color: white;
            font-size: 17px;
            border: none;
            padding: 14px;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-checkout:hover {
            background: #e64a19;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: 600;
            font-size: 14px;
            display: block;
            margin-bottom: 6px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .bank-option {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .bank-option:hover {
            border-color: #ff9800;
            background: #fff8e1;
        }

        .bank-option.active {
            border-color: #ff5722;
            background: #ffe0b2;
        }
    </style>
</head>

<body>
    <div class="checkout-container">
        <h2><i class="fas fa-map-marker-alt"></i> Alamat Pengiriman</h2>
        <div class="shipping-info">
            <div class="form-group">
                <label for="nama">Nama Penerima</label>
                <input type="text" id="nama" placeholder="Contoh: Fitrah Rizkiana">
            </div>
            <div class="form-group">
                <label for="nohp">Nomor HP</label>
                <input type="text" id="nohp" placeholder="Contoh: 081234567890">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat Lengkap</label>
                <textarea id="alamat" rows="3" placeholder="Contoh: Jl. Raya Majenang No. 12, Cilacap"></textarea>
            </div>
            <div class="form-group">
                <label for="catatan">Catatan (Opsional)</label>
                <textarea id="catatan" rows="2" placeholder="Contoh: Tolong hubungi sebelum sampai."></textarea>
            </div>
        </div>

        <h2><i class="fas fa-receipt"></i> Rincian Pembayaran</h2>
        <div class="summary-box" id="summary-box">
            <div class="summary-item"><span>Loading...</span></div>
        </div>

        <h2><i class="fas fa-university"></i> Metode Pembayaran</h2>
        <div class="payment-methods">
            <div class="bank-option" data-bank="bca">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/BCA_logo.svg" style="width:60px">
                <div><strong>Bank BCA</strong><br><small>Virtual Account</small></div>
            </div>
            <div class="bank-option" data-bank="bri">
                <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/5a/Logo_BRI.png/640px-Logo_BRI.png" style="width:60px">
                <div><strong>Bank BRI</strong><br><small>Virtual Account</small></div>
            </div>
            <div class="bank-option" data-bank="cod">
                <img src="https://cdn-icons-png.flaticon.com/512/4290/4290854.png" style="width:60px">
                <div><strong>Bayar di Tempat (COD)</strong><br><small>Bayar langsung ke kurir</small></div>
            </div>
        </div>

        <div class="instructions" id="instructions" style="display:none">
            <h4>Petunjuk Pembayaran:</h4>
            <p id="instruction-text">Silakan pilih metode pembayaran terlebih dahulu.</p>
        </div>

        <button class="btn-checkout" id="btnCheckout">Buat Pesanan</button>
    </div>

    <script>
        // Format Rupiah
        const rupiah = n => 'Rp' + Number(n).toLocaleString('id-ID');

        // Ambil produk dari localStorage
        document.addEventListener('DOMContentLoaded', () => {
            const summary = document.getElementById('summary-box');
            const produk = JSON.parse(localStorage.getItem('produkCheckout') || '{}');
            if (!produk.nama) {
                alert("Belum ada produk yang dipilih. Silakan pilih dulu.");
                window.location.href = 'index.php';
                return;
            }
            const subtotal = produk.harga * (produk.qty || 1);
            const ongkir = 15000;
            const total = subtotal + ongkir;
            window.totalBayarAmount = total;

            summary.innerHTML = `
      <div class="summary-item"><span>Produk</span><span>${produk.nama} (x${produk.qty || 1})</span></div>
      <div class="summary-item"><span>Subtotal</span><span>${rupiah(subtotal)}</span></div>
      <div class="summary-item"><span>Ongkir</span><span>${rupiah(ongkir)}</span></div>
      <hr>
      <div class="summary-total"><span>Total</span><span>${rupiah(total)}</span></div>
    `;
        });

        // Pilih Bank
        let selectedBank = null;
        const bankOptions = document.querySelectorAll('.bank-option');
        const instructionBox = document.getElementById('instructions');
        const instructionText = document.getElementById('instruction-text');

        bankOptions.forEach(opt => {
            opt.addEventListener('click', () => {
                bankOptions.forEach(o => o.classList.remove('active'));
                opt.classList.add('active');
                selectedBank = opt.dataset.bank;
                instructionBox.style.display = 'block';
                if (selectedBank === 'bca') {
                    instructionText.innerHTML = "Transfer ke VA BCA: <b>80777XXXXXXXXX</b>";
                } else if (selectedBank === 'bri') {
                    instructionText.innerHTML = "Transfer ke BRIVA: <b>77777XXXXXXXXX</b>";
                } else {
                    instructionText.innerHTML = "Bayar ke kurir saat barang diterima (COD)";
                }
            });
        });

        // Kirim Pesanan
        document.getElementById('btnCheckout').addEventListener('click', async () => {
            const nama = document.getElementById('nama').value.trim();
            const nohp = document.getElementById('nohp').value.trim();
            const alamat = document.getElementById('alamat').value.trim();
            const catatan = document.getElementById('catatan').value.trim();

            if (!nama || !nohp || !alamat) return alert("Lengkapi data pengiriman!");
            if (!selectedBank) return alert("Pilih metode pembayaran!");

            const produk = JSON.parse(localStorage.getItem('produkCheckout'));
            const total = window.totalBayarAmount || 0;

            const order = {
                produk,
                qty: produk.qty || 1,
                total,
                payment_method: selectedBank,
                shipping: {
                    nama,
                    nohp,
                    alamat,
                    catatan
                }
            };

            try {
                const res = await fetch('order_process.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(order)
                });
                const data = await res.json();
                if (data.success) {
                    alert("Pesanan berhasil dibuat! Nomor Order: " + data.order_id);
                    localStorage.removeItem('produkCheckout');
                    window.location.href = 'pembayaran_sukses.php';
                } else {
                    alert("Gagal: " + data.message);
                }
            } catch (err) {
                alert("Terjadi kesalahan koneksi ke server.");
                console.error(err);
            }
        });
    </script>
</body>

</html>
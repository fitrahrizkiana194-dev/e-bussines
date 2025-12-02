<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $jenis = $_POST['jenis'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $catatan = $_POST['catatan'];

    // Proses upload file (untuk desain mug)
    $upload_path = '';
    if (!empty($_FILES['desain']['name'])) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) mkdir($target_dir);
        $upload_path = $target_dir . basename($_FILES["desain"]["name"]);
        move_uploaded_file($_FILES["desain"]["tmp_name"], $upload_path);
    }

    // Simulasi hasil (bisa nanti diarahkan ke database)
    echo "<div style='font-family: Poppins, sans-serif; text-align:center; padding:30px'>";
    echo "<h2>✅ Pemesanan Berhasil!</h2>";
    echo "<p>Terima kasih, <strong>$nama</strong>.</p>";
    echo "<p>Jenis Pesanan: <strong>$jenis</strong></p>";
    echo "<p>Jumlah: <strong>$jumlah</strong></p>";
    echo "<p>Tanggal: <strong>$tanggal</strong></p>";
    if ($upload_path) echo "<p>Desain terkirim: <strong>" . basename($upload_path) . "</strong></p>";
    echo "<p>Kami akan menghubungi Anda melalui WhatsApp: <strong>$no_hp</strong>.</p>";
    echo "<a href='pemesanan.php' style='color:#fff; background:#ff8c00; padding:10px 20px; border-radius:8px; text-decoration:none;'>Kembali</a>";
    echo "</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Souvenir & Mug Custom</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            background: #fafafa;
            color: #333;
        }

        header {
            background: #ff8c00;
            color: white;
            text-align: center;
            padding: 1.5rem 0;
        }

        main {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            border-radius: 12px;
            padding: 25px 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #ff8c00;
            border-bottom: 2px solid #ff8c00;
            padding-bottom: 5px;
        }

        .info {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 12px;
            font-weight: 500;
        }

        input,
        select,
        textarea {
            margin-top: 6px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        textarea {
            resize: none;
        }

        button {
            background: #ff8c00;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #ff6a00;
        }

        footer {
            text-align: center;
            background: #222;
            color: #ccc;
            padding: 15px 0;
            margin-top: 30px;
        }

        .desain-field {
            display: none;
        }
    </style>

    <script>
        // Tampilkan upload file jika jenis = Mug Custom
        function toggleDesainField() {
            const jenis = document.getElementById("jenis").value;
            const desainField = document.getElementById("desain-field");
            desainField.style.display = (jenis === "Pembuatan Mug Custom") ? "block" : "none";
        }
    </script>
</head>

<body>
    <header>
        <h1>Pemesanan Souvenir & Mug Custom</h1>
    </header>

    <main>
        <section class="info">
            <h2>Cara Pemesanan</h2>
            <ol>
                <li>Pilih jenis pesanan: <b>Souvenir</b> atau <b>Mug Custom</b>.</li>
                <li>Isi form pemesanan dengan lengkap.</li>
                <li>Untuk Mug Custom, unggah desain atau beri catatan desain yang diinginkan.</li>
                <li>Kami akan menghubungi Anda melalui WhatsApp untuk konfirmasi dan pembayaran.</li>
            </ol>
        </section>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required>

            <label for="no_hp">Nomor WhatsApp</label>
            <input type="text" id="no_hp" name="no_hp" required>

            <label for="jenis">Jenis Pemesanan</label>
            <select id="jenis" name="jenis" onchange="toggleDesainField()" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="Souvenir">Souvenir</option>
                <option value="Pembuatan Mug Custom">Pembuatan Mug Custom</option>
            </select>

            <label for="tanggal">Tanggal Pemesanan</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="jumlah">Jumlah Barang</label>
            <input type="number" id="jumlah" name="jumlah" min="1" required>

            <div id="desain-field" class="desain-field">
                <label for="desain">Upload Desain Mug (opsional)</label>
                <input type="file" id="desain" name="desain" accept=".jpg,.png,.jpeg">
            </div>

            <label for="catatan">Catatan Tambahan</label>
            <textarea id="catatan" name="catatan" rows="4" placeholder="Tuliskan detail warna, ukuran, atau teks custom..."></textarea>

            <button type="submit">Kirim Pemesanan</button>
        </form>
    </main>

    <footer>
        <p>© 2025 teguk.in</p>
    </footer>
</body>

</html>
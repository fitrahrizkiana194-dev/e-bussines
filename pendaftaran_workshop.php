<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $tanggal = $_POST['tanggal'];
    $sesi = $_POST['sesi'];
    $motivasi = $_POST['motivasi'];

    echo "<div style='font-family: Poppins, sans-serif; text-align:center; padding:30px'>";
    echo "<h2>✅ Pendaftaran Berhasil!</h2>";
    echo "<p>Terima kasih, <strong>$nama</strong>, sudah mendaftar workshop pembuatan mug.</p>";
    echo "<p><b>Tanggal:</b> $tanggal</p>";
    echo "<p><b>Sesi:</b> $sesi</p>";
    echo "<p>Kami akan menghubungi Anda melalui WhatsApp: <b>$no_hp</b></p>";
    echo "<p>Silakan datang sesuai jadwal yang telah ditentukan. Sampai jumpa di workshop! ☕🎨</p>";
    echo "<a href='pendaftaran_workshop.php' style='color:#fff; background:#ff8c00; padding:10px 20px; border-radius:8px; text-decoration:none;'>Kembali</a>";
    echo "</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Workshop Mug</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #f9f9f9;
            margin: 0;
            color: #333;
        }

        header {
            background: #9e758aff;
            color: white;
            text-align: center;
            padding: 1.5rem 0;
        }

        main {
            max-width: 700px;
            margin: 30px auto;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #ff8c00;
            border-bottom: 2px solid #ff8c00;
            padding-bottom: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-top: 15px;
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

        .info-box {
            background: #fff7eb;
            padding: 15px;
            border: 1px solid #ffdca2;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            background: #222;
            color: #ccc;
            padding: 15px 0;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Workshop Pembuatan Mug Custom</h1>
        <p>Belajar langsung membuat mug sendiri di studio kami 🎨☕</p>
    </header>

    <main>
        <section class="info-box">
            <h2>📅 Jadwal Workshop</h2>
            <p>
                Workshop diadakan setiap:
            <ul>
                <li>Sabtu & Minggu</li>
                <li>Sesi 1: 09.00 - 11.00</li>
                <li>Sesi 2: 13.00 - 15.00</li>
            </ul>
            </p>
            <p>Peserta akan mendapatkan 1 mug hasil karya sendiri, bahan, dan sertifikat.</p>
        </section>

        <form method="POST">
            <h2>📝 Form Pendaftaran</h2>

            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required>

            <label for="email">Alamat Email</label>
            <input type="email" id="email" name="email" required>

            <label for="no_hp">Nomor WhatsApp</label>
            <input type="text" id="no_hp" name="no_hp" required>

            <label for="tanggal">Tanggal Workshop</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="sesi">Pilih Sesi</label>
            <select id="sesi" name="sesi" required>
                <option value="">-- Pilih Sesi --</option>
                <option value="Sesi Pagi (09.00 - 11.00)">Sesi Pagi (09.00 - 11.00)</option>
                <option value="Sesi Siang (13.00 - 15.00)">Sesi Siang (13.00 - 15.00)</option>
            </select>

            <label for="motivasi">Motivasi Mengikuti Workshop</label>
            <textarea id="motivasi" name="motivasi" rows="4" placeholder="Ceritakan sedikit alasan Anda mengikuti workshop ini..."></textarea>

            <button type="submit">Daftar Sekarang</button>
        </form>
    </main>

    <footer>
        <p>© 2025 teguk.in</p>
    </footer>
</body>

</html>
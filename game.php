<?php
session_start();

// Inisialisasi poin jika belum ada
if (!isset($_SESSION['poin'])) {
    $_SESSION['poin'] = 0;
}

// Inisialisasi voucher jika belum ada
if (!isset($_SESSION['voucher'])) {
    $_SESSION['voucher'] = [
        'produk_id' => 'MUG001',
        'nominal' => 0,
        'status' => 'tidak_aktif'
    ];
}

// Proses hasil game
if (isset($_POST['player_choice'])) {
    $player = $_POST['player_choice'];
    $choices = ['batu', 'gunting', 'kertas'];
    $computer = $choices[array_rand($choices)];
    $hasil = '';
    $poin = 0;

    // Logika permainan
    if ($player == $computer) {
        $hasil = "🤝 Seri! Kamu dan komputer sama-sama memilih $player.";
    } elseif (
        ($player == 'batu' && $computer == 'gunting') ||
        ($player == 'gunting' && $computer == 'kertas') ||
        ($player == 'kertas' && $computer == 'batu')
    ) {
        $hasil = "🎉 Kamu menang! $player mengalahkan $computer.";
        $poin = 10;
        $_SESSION['poin'] += $poin;
    } else {
        $hasil = "😢 Kamu kalah. Komputer memilih $computer.";
    }

    // Jika poin sudah cukup untuk voucher
    if ($_SESSION['poin'] >= 50 && $_SESSION['voucher']['status'] != 'aktif') {
        $_SESSION['voucher'] = [
            'produk_id' => 'MUG001',
            'nominal' => 10000, // Voucher Rp10.000
            'status' => 'aktif'
        ];
        $voucher_message = "🎁 Selamat! Kamu telah mendapatkan voucher Rp10.000 untuk produk Mug!";
        $_SESSION['poin'] -= 50; // Kurangi poin setelah tukar voucher
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Batu Gunting Kertas</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            text-align: center;
            background: linear-gradient(135deg, #c7d2fe, #e0e7ff);
            margin: 0;
            padding: 40px;
        }

        h1 {
            color: #1e3a8a;
        }

        .choices {
            margin: 25px 0;
        }

        button {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 14px 28px;
            margin: 8px;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        button:hover {
            background: #4338ca;
            transform: scale(1.05);
        }

        .result {
            background: white;
            display: inline-block;
            padding: 20px 30px;
            border-radius: 12px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .poin-box {
            background: #22c55e;
            color: white;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: bold;
        }

        .voucher-box {
            background: #f59e0b;
            color: white;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        a {
            display: inline-block;
            margin-top: 25px;
            text-decoration: none;
            color: #2563eb;
            font-weight: 500;
        }

        .links {
            margin-top: 30px;
        }

        .links a {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            margin: 5px;
        }

        .links a:hover {
            background: #1e40af;
        }
    </style>
</head>

<body>

    <h1>🎮 Game Batu Gunting Kertas</h1>
    <p>Menangkan permainan untuk mendapatkan poin dan tukarkan jadi voucher belanja!</p>

    <form method="POST">
        <div class="choices">
            <button type="submit" name="player_choice" value="batu">🪨 Batu</button>
            <button type="submit" name="player_choice" value="gunting">✂️ Gunting</button>
            <button type="submit" name="player_choice" value="kertas">📜 Kertas</button>
        </div>
    </form>

    <?php if (isset($hasil)): ?>
        <div class="result">
            <p><?= $hasil ?></p>
            <?php if ($poin > 0): ?>
                <p>+<?= $poin ?> poin 🎁</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="poin-box">
        Total Poin Kamu: <?= $_SESSION['poin'] ?>
    </div>

    <?php if (isset($voucher_message)): ?>
        <div class="voucher-box">
            <?= $voucher_message ?>
        </div>
    <?php elseif ($_SESSION['voucher']['status'] == 'aktif'): ?>
        <div class="voucher-box">
            🎟️ Kamu punya voucher aktif Rp<?= number_format($_SESSION['voucher']['nominal'], 0, ',', '.') ?>
            untuk produk Mug Keramik Glossy!
        </div>
    <?php endif; ?>

    <div class="links">
        <a href="checkout_voucher.php?id=MUG001">Gunakan Voucher Sekarang 🛍️</a>
        <a href="index.php">⬅️ Kembali ke Beranda</a>
    </div>

</body>

</html>
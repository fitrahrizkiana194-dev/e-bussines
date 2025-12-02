<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - Toko Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .success-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 40px 50px;
            max-width: 500px;
        }

        .success-icon {
            font-size: 80px;
            color: #4caf50;
            margin-bottom: 20px;
            animation: bounce 0.6s ease;
        }

        @keyframes bounce {
            0% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            font-size: 15px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .order-summary {
            text-align: left;
            margin: 20px auto;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 15px 20px;
            background: #fafafa;
        }

        .order-summary div {
            display: flex;
            justify-content: space-between;
            margin: 6px 0;
        }

        .btn-home {
            background-color: #ff5722;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-size: 16px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-home:hover {
            background-color: #e64a19;
        }
    </style>
</head>

<body>
    <div class="success-container">
        <i class="fas fa-check-circle success-icon"></i>
        <h2>Pembayaran Berhasil!</h2>
        <p>Terima kasih telah berbelanja di <b>Toko Online</b> 🎉<br>
            Pesanan kamu sedang kami proses dan akan segera dikirim.</p>

        <div class="order-summary">
            <div><span><b>No. Pesanan:</b></span><span>#ORD-<?php echo rand(10000, 99999); ?></span></div>
            <div><span><b>Total Bayar:</b></span><span>Rp204.000</span></div>
            <div><span><b>Status:</b></span><span style="color:green;">Berhasil</span></div>
            <div><span><b>Metode:</b></span><span>Transfer Bank</span></div>
        </div>

        <a href="index.php" class="btn-home"><i class="fas fa-home"></i> Kembali ke Beranda</a>
    </div>
</body>

</html>
<?php
session_start();

// pastikan folder uploads ada dan dapat ditulis
$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

$order_id = $_POST['order_id'] ?? 'UNKNOWN';
$bank = $_POST['bank'] ?? 'BANK';
$va = $_POST['va'] ?? 'N/A';
$simulated = isset($_POST['simulated']) && $_POST['simulated'] == '1';

$uploadedFile = null;
$message = '';

if ($simulated) {
    $status = 'PAID (SIMULATED)';
    $message = 'Pembayaran di-simulasikan. Pesanan diberi status terbayar untuk demo tugas.';
} else {
    if (!empty($_FILES['bukti']) && $_FILES['bukti']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['bukti']['tmp_name'];
        $origName = basename($_FILES['bukti']['name']);
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $newName = $order_id . '_' . time() . '.' . $ext;
        $target = $uploadDir . $newName;
        if (move_uploaded_file($tmpName, $target)) {
            $uploadedFile = 'uploads/' . $newName;
            $status = 'AWAITING_VERIFICATION';
            $message = 'Bukti transfer berhasil diunggah. Tunggu verifikasi admin.';
        } else {
            $status = 'UPLOAD_FAILED';
            $message = 'Gagal menyimpan file. Periksa permission folder uploads.';
        }
    } else {
        $status = 'NO_FILE';
        $message = 'Tidak ada file diunggah.';
    }
}

// untuk keperluan demo, simpan info sederhana ke session (bisa ganti ke DB)
$orders = $_SESSION['orders'] ?? [];
$orders[$order_id] = [
    'order_id' => $order_id,
    'bank' => $bank,
    'va' => $va,
    'status' => $status,
    'uploaded' => $uploadedFile,
    'time' => date('Y-m-d H:i:s')
];
$_SESSION['orders'] = $orders;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Konfirmasi Pembayaran</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
            color: #222;
            padding: 40px
        }

        .card {
            background: #fff;
            padding: 28px;
            border-radius: 10px;
            max-width: 720px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06)
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 8px;
            background: #e6f7ef;
            color: #065f46;
            font-weight: 700
        }

        .err {
            background: #fff0f0;
            color: #7f1d1d;
            padding: 10px;
            border-radius: 8px
        }

        img.preview {
            max-width: 320px;
            border-radius: 8px;
            margin-top: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06)
        }
    </style>
</head>

<body>

    <div class="card">
        <h2>Ringkasan Konfirmasi Pembayaran</h2>
        <p><strong>Order:</strong> <?= htmlspecialchars($order_id) ?></p>
        <p><strong>Bank:</strong> <?= htmlspecialchars($bank) ?> &nbsp; | &nbsp; <strong>VA:</strong> <?= htmlspecialchars($va) ?></p>
        <p><strong>Status:</strong> <span class="badge"><?= htmlspecialchars($status) ?></span></p>

        <?php if ($uploadedFile): ?>
            <div style="margin-top:12px">
                <div><strong>Bukti Transfer:</strong></div>
                <?php if (preg_match('/\.(jpe?g|png|gif|webp)$/i', $uploadedFile)): ?>
                    <img src="<?= htmlspecialchars($uploadedFile) ?>" alt="bukti" class="preview">
                <?php else: ?>
                    <div class="small">File tersimpan: <?= htmlspecialchars($uploadedFile) ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div style="margin-top:14px;color:#444">
            <?= htmlspecialchars($message) ?>
        </div>

        <div style="margin-top:18px">
            <a href="checkout.php" style="text-decoration:none;padding:10px 14px;background:#1f2937;color:#fff;border-radius:8px">Kembali ke Checkout</a>
            &nbsp;
            <a href="index.php" style="text-decoration:none;padding:10px 14px;background:#ff5722;color:#fff;border-radius:8px">Kembali ke Beranda</a>
        </div>
    </div>

</body>

</html>
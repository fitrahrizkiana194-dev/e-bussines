<?php
require_once 'vendor/autoload.php';

\Midtrans\Config::$serverKey = 'YOUR_SERVER_KEY';
\Midtrans\Config::$isProduction = false; // true jika sudah live
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

$data = json_decode(file_get_contents('php://input'), true);

$params = [
    'transaction_details' => [
        'order_id' => $data['order_id'],
        'gross_amount' => $data['total'],
    ],
    'customer_details' => [
        'first_name' => 'Nama Customer',
        'email' => 'email@example.com',
        'phone' => '08123456789',
    ],
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo json_encode(['snapToken' => $snapToken]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

<?php
session_start();
include 'db_connect.php';

// Terima data JSON dari fetch()
$data = json_decode(file_get_contents("php://input"), true);

// Cek apakah data valid
if (!$data || empty($data['produk'])) {
    echo json_encode(['success' => false, 'message' => 'Data tidak valid']);
    exit;
}

$user_id = $_SESSION['user']['id'] ?? 0;
$produk = mysqli_real_escape_string($conn, $data['produk']['nama']);
$jumlah = intval($data['qty']);
$total_harga = intval($data['total']);
$metode = mysqli_real_escape_string($conn, $data['payment_method']);
$nama = mysqli_real_escape_string($conn, $data['shipping']['nama']);
$nohp = mysqli_real_escape_string($conn, $data['shipping']['nohp']);
$alamat = mysqli_real_escape_string($conn, $data['shipping']['alamat']);
$catatan = mysqli_real_escape_string($conn, $data['shipping']['catatan'] ?? '');

$sql = "INSERT INTO transaksi1 (user_id, produk, jumlah, total_harga, metode_pembayaran, nama_penerima, nohp, alamat, catatan)
        VALUES ('$user_id', '$produk', '$jumlah', '$total_harga', '$metode', '$nama', '$nohp', '$alamat', '$catatan')";

if (mysqli_query($conn, $sql)) {
    $order_id = mysqli_insert_id($conn);
    echo json_encode(['success' => true, 'order_id' => $order_id]);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan ke database: ' . mysqli_error($conn)]);
}

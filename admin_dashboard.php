<?php
session_start();
include 'db_connect.php';

// Pastikan hanya admin yang bisa masuk
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Ambil data penjualan untuk grafik
$penjualan = $conn->query("SELECT nama_produk, SUM(jumlah) as total FROM orders_1 GROUP BY nama_produk");
$produk = [];
$total = [];
while ($row = $penjualan->fetch_assoc()) {
    $produk[] = $row['nama_produk'];
    $total[] = $row['total'];
}

// Ambil data untuk tabel
$pembelian = $conn->query("SELECT * FROM orders_1 ORDER BY tanggal DESC");
$souvenir = $conn->query("SELECT * FROM pemesanan_souvenir ORDER BY tanggal DESC");
$workshop = $conn->query("SELECT * FROM workshop ORDER BY tanggal_daftar DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 230px;
            height: 100vh;
            background: #1e293b;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            color: #38bdf8;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin: 6px 0;
            text-decoration: none;
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #334155;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
        }

        h1 {
            color: #0f172a;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-width: 300px;
        }

        .card h3 {
            color: #1e293b;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #e2e8f0;
            padding: 10px;
            text-align: left;
        }

        table th {
            background: #38bdf8;
            color: white;
        }

        .search-box {
            margin-bottom: 10px;
        }

        .search-box input {
            padding: 8px 12px;
            width: 250px;
            border: 1px solid #94a3b8;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>🛠️ Admin Panel</h2>
        <a href="admin_dashboard.php">📊 Dashboard</a>
        <a href="manage_products.php">🛍️ Kelola Produk</a>
        <a href="manage_users.php">👤 Data Pengguna</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

    <div class="content">
        <h1>📈 Dashboard Penjualan</h1>

        <div class="cards">
            <div class="card">
                <h3>Grafik Penjualan</h3>
                <canvas id="chartPenjualan"></canvas>
            </div>
            <div class="card">
                <h3>Distribusi Penjualan</h3>
                <canvas id="chartDoughnut"></canvas>
            </div>
        </div>

        <div class="card">
            <h3>🛒 Data Pembelian Produk</h3>
            <div class="search-box">
                <input type="text" id="searchOrder" placeholder="Cari nama pembeli...">
            </div>
            <table id="orderTable">
                <tr>
                    <th>Nama Pembeli</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                </tr>
                <?php while ($row = $pembelian->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_pembeli']) ?></td>
                        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td>Rp<?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                        <td><?= $row['tanggal'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <div class="card">
            <h3>🎁 Pemesanan Souvenir</h3>
            <table>
                <tr>
                    <th>Nama</th>
                    <th>Jenis Souvenir</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                </tr>
                <?php while ($row = $souvenir->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['jenis_souvenir']) ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td><?= $row['tanggal'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <div class="card">
            <h3>🎨 Pendaftar Workshop Mug</h3>
            <table>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Tanggal Daftar</th>
                </tr>
                <?php while ($row = $workshop->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['no_hp']) ?></td>
                        <td><?= $row['tanggal_daftar'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('chartPenjualan');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($produk) ?>,
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: <?= json_encode($total) ?>,
                    backgroundColor: 'rgba(59,130,246,0.6)',
                    borderColor: '#2563eb',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('chartDoughnut');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($produk) ?>,
                datasets: [{
                    data: <?= json_encode($total) ?>,
                    backgroundColor: ['#60a5fa', '#34d399', '#fbbf24', '#f87171', '#a78bfa']
                }]
            }
        });

        // Pencarian tabel
        document.getElementById('searchOrder').addEventListener('keyup', function() {
            const search = this.value.toLowerCase();
            const rows = document.querySelectorAll('#orderTable tr');
            rows.forEach((row, index) => {
                if (index === 0) return;
                row.style.display = row.textContent.toLowerCase().includes(search) ? '' : 'none';
            });
        });
    </script>

</body>

</html>
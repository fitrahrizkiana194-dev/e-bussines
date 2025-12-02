<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
</head>

<body>
    <h1>Keranjang Belanja</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody id="cart-items"></tbody>
    </table>

    <script>
        // Ambil isi keranjang dari localStorage
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const tableBody = document.getElementById('cart-items');

        if (cart.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="3">Keranjang kosong</td></tr>';
        } else {
            cart.forEach(item => {
                tableBody.innerHTML += `
        <tr>
          <td>${item.name}</td>
          <td>Rp ${item.price.toLocaleString()}</td>
          <td>${item.quantity}</td>
        </tr>
      `;
            });
        }
    </script>
</body>

</html>
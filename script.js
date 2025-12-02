// Misalnya untuk menghitung jumlah di cart (dummy)
document.addEventListener('DOMContentLoaded', () => {
  const cartBtn = document.querySelector('.btn-cart');
  let count = 0;
  const productCards = document.querySelectorAll('.product-card');

  productCards.forEach(card => {
    // kamu bisa tambahkan tombol "Add to Cart" di setiap card dan event listener
    card.addEventListener('click', () => {
      count++;
      cartBtn.textContent = `Cart (${count})`;
    });
  });
});


let slideIndex = 0;
const slides = document.querySelectorAll(".hero-slider img");

function showSlides() {
  slides.forEach(slide => slide.classList.remove("active"));
  slideIndex = (slideIndex + 1) > slides.length ? 1 : slideIndex + 1;
  slides[slideIndex - 1].classList.add("active");
}

showSlides(); // tampilkan pertama kali
setInterval(showSlides, 3000); // ganti setiap 3 detik


// File: script.js

function addToCart(id, name, price) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Logika untuk menambahkan atau memperbarui kuantitas produk
    let existingItem = cart.find(item => item.id === id);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id: id, name: name, price: price, quantity: 1 });
    }
    
    // --- Langkah Kunci: Menyimpan data ke Local Storage ---
    localStorage.setItem('cart', JSON.stringify(cart));
    
    alert(`${name} telah ditambahkan ke keranjang!`);
    
    // Opsional: Langsung arahkan pengguna ke halaman keranjang
    // window.location.href = 'keranjang.html'; 
    // Biasanya, lebih baik membiarkan pengguna tetap di halaman produk
}

// Fungsi ini harus ada di script.js dan keranjang.html akan memanggilnya
function displayCart() {
    // ... (Logika untuk menampilkan data keranjang yang sudah dibahas sebelumnya)
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    // ...
}

document.addEventListener('DOMContentLoaded', function() {
    // Jika Anda ingin menampilkan jumlah item di navbar (misalnya 'Keranjang (3)')
    // Anda bisa memanggil fungsi updateCartCount() di sini
    if (document.getElementById('cart-count')) {
        updateCartCount();
    }
    
    // Jika halaman yang dimuat adalah keranjang.html, tampilkan isinya
    if (window.location.pathname.includes('keranjang.html')) {
        displayCart();
    }
});

// Fungsi opsional untuk menampilkan jumlah item di navbar
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    let totalItems = 0;
    cart.forEach(item => {
        totalItems += item.quantity;
    });
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = totalItems;
    }
}
// Di dalam script.js

function clearCart() {
    if (confirm("Apakah Anda yakin ingin mengosongkan keranjang?")) {
        localStorage.removeItem('cart');
        displayCart(); // Memuat ulang tampilan keranjang
    }
}

     document.getElementById('add-to-cart-btn').addEventListener('click', function() {
         // Kode untuk tambah ke cart, misalnya via AJAX
         fetch('/api/cart/add', {
             method: 'POST',
             headers: { 'Content-Type': 'application/json' },
             body: JSON.stringify({ productId: 123, quantity: 1 })
         }).then(response => {
             if (response.ok) {
                 // Update UI cart
                 alert('Ditambahkan ke keranjang!');
             } else {
                 console.error('Gagal menambahkan');
             }
         });
     });
     

     // Simpan data keranjang di localStorage (frontend)
function addToCart(id, name, price) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  // Cek apakah produk sudah ada di keranjang
  let found = cart.find(item => item.id === id);
  if (found) {
    found.quantity += 1;
  } else {
    cart.push({ id, name, price, quantity: 1 });
  }

  // Simpan ulang ke localStorage
  localStorage.setItem('cart', JSON.stringify(cart));

  // Update tampilan jumlah keranjang
  document.getElementById('cart-count').textContent = cart.length;

  alert(name + " berhasil dimasukkan ke keranjang!");
}

// Saat halaman dibuka, update jumlah keranjang
window.onload = () => {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  document.getElementById('cart-count').textContent = cart.length;
};

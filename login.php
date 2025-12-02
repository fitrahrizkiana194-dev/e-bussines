<?php
include 'db_connect.php';
session_start();

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Cek apakah username ada di database
    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Cek password (gunakan password_hash() saat register)
        if (password_verify($password, $user['password'])) {
            // Simpan data ke session
            $_SESSION['user'] = $user;
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Arahkan ke halaman utama (index.php)
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login User</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <form method="post">
        <h2>🔓 Login ke Akun</h2>

        <?php if (isset($error)): ?>
            <div class="error"><?= $error; ?></div>
        <?php endif; ?>

        <input type="text" name="username" placeholder="Username" required><br>

        <div class="password-wrapper">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword()">👁️</span>
        </div>

        <button type="submit" name="login">Login</button>

        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </form>

    <script>
        function togglePassword() {
            const pass = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");
            if (pass.type === "password") {
                pass.type = "text";
                icon.textContent = "🙈"; // ubah ikon saat terlihat
            } else {
                pass.type = "password";
                icon.textContent = "👁️";
            }
        }
    </script>

</body>

</html>
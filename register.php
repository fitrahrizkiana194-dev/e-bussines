<?php
include 'db_connect.php';
session_start();

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $sql = "INSERT INTO users (nama, email, username, password, alamat, no_hp)
            VALUES ('$nama','$email','$username','$password','$alamat','$no_hp')";
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Gagal mendaftar: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Akun Baru | Teguk.in</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background: white;
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            font-size: 14px;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        input,
        textarea {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }

        input:focus,
        textarea:focus {
            border-color: #6366f1;
            box-shadow: 0 0 4px rgba(99, 102, 241, 0.3);
        }

        textarea {
            resize: none;
            height: 70px;
        }

        button {
            background: #6366f1;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s;
        }

        button:hover {
            background: #4f46e5;
            transform: scale(1.03);
        }

        .login-link {
            margin-top: 15px;
            font-size: 14px;
            color: #444;
        }

        .login-link a {
            color: #6366f1;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2>📝 Daftar Akun Baru</h2>
        <p>Bergabung dengan <strong>Teguk.in</strong> dan nikmati kemudahan berbelanja!</p>

        <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <textarea name="alamat" placeholder="Alamat Lengkap"></textarea>
            <input type="text" name="no_hp" placeholder="Nomor HP">
            <button type="submit" name="register">Daftar Sekarang</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </div>
    </div>
</body>

</html>
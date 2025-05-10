<?php 
session_start();
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'];
    $p = md5($_POST['password']); // MD5 sesuai database

    $res = $conn->query("SELECT * FROM `user` WHERE username='$u' AND password='$p'");

    if ($res && $res->num_rows === 1) {
        $data = $res->fetch_assoc();
        $_SESSION['user'] = [
            'id' => $data['id'],
            'nama' => $data['nama']
        ];
        header('Location: pages/dashboard.php');
        exit;
    } else {
        $err = "Login gagal: username atau password salah";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Rental Mobil</title>
   <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: url('mobil-bg.jpg') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .overlay {
        background-color: rgba(0, 51, 102, 0.8); /* biru tua transparan */
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1;
    }

    .login-container {
        position: relative;
        z-index: 2;
        background-color: rgba(255, 255, 255, 0.95);
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        width: 350px;
        color: #003366;
    }

    h1 {
        text-align: center;
        color: #003366;
        margin-bottom: 25px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        border-radius: 6px;
        background-color: #f0f8ff;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007BFF;
        border: none;
        border-radius: 6px;
        color: white;
        font-weight: bold;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    .register-link {
        text-align: center;
        margin-top: 15px;
    }

    .register-link a {
        color: #007BFF;
        text-decoration: none;
        font-weight: bold;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    .error {
        color: #c0392b;
        text-align: center;
        margin-top: 15px;
    }
    </style>
</head>
<body>
  <div class="login-container">
    <h1>Rental Mobil</h1>
    <form method="post" action="">
      <label>Username:</label>
      <input type="text" name="username" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <button type="submit">Login</button>

      <div class="register-link">
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
      </div>
    </form>

    <?php if (isset($err)): ?>
      <p class="error"><?= $err ?></p>
    <?php endif; ?>
  </div>
</body>
</html>

<?php
session_start();
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username']);
    $p_raw = $_POST['password'];
    $p2_raw = $_POST['password2'];

    if ($p_raw !== $p2_raw) {
        $err = "Password dan konfirmasi tidak sama.";
    } else {
        $check = $conn->prepare("SELECT id FROM `user` WHERE username = ?");
        $check->bind_param('s', $u);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $err = "Username sudah terdaftar.";
        } else {
            $p = md5($p_raw);
            $ins = $conn->prepare("INSERT INTO `user` (username, password) VALUES (?, ?)");
            $ins->bind_param('ss', $u, $p);
            if ($ins->execute()) {
                $_SESSION['user'] = $u;
                header('Location: login.php');
                exit;
            } else {
                $err = "Gagal mendaftar: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register Rental Mobil</title>
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

  .register-container {
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

  .login-link {
    text-align: center;
    margin-top: 15px;
  }

  .login-link a {
    color: #007BFF;
    text-decoration: none;
    font-weight: bold;
  }

  .login-link a:hover {
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
  <div class="register-container">
    <h1>Daftar Akun</h1>
    <form method="post">
      <label>Username:</label>
      <input type="text" name="username" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <label>Konfirmasi Password:</label>
      <input type="password" name="password2" required>

      <button type="submit">Daftar</button>
    </form>

    <?php if (isset($err)): ?>
      <p class="error"><?= $err ?></p>
    <?php endif; ?>

    <div class="login-link">
      <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
  </div>
</body>
</html>

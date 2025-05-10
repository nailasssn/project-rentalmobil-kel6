<?php
// pages/profile.php

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

include '../config/db.php';
include '../views/header.php';   // buka <body> & wrapper, navbar
include '../views/sidebar.php';  // tampilkan sidebar

// Proses update profil
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    if (!empty($_POST['password']) && $_POST['password'] !== $_POST['password2']) {
        $error = 'Password tidak sama';
    } else {
        if (!empty($_POST['password'])) {
            $sql = "UPDATE user SET nama=?, password=? WHERE id=?";
            $passHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssi', $nama, $passHash, $_SESSION['user']['id']);
        } else {
            $sql = "UPDATE user SET nama=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $nama, $_SESSION['user']['id']);
        }
        if (! $stmt->execute()) {
            $error = 'Gagal update profil: ' . $stmt->error;
        } else {
            $_SESSION['user']['nama'] = $nama;
            header('Location: profile.php?msg=updated');
            exit;
        }
    }
}
?>

<style>
 <style>
  body {
    background: linear-gradient(to right, #e0ecf8, #f9fafe);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
  }

  .card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease-in-out;
  }

  .card:hover {
    transform: scale(1.01);
    box-shadow: 0 12px 36px rgba(0, 0, 0, 0.08);
  }

  .card-header {
    background: #0d6efd;
    color: white;
    border-bottom: none;
    padding: 1rem 1.5rem;
    font-size: 1.25rem;
    font-weight: 600;
  }

  .form-control {
    border-radius: 12px;
    border: 1px solid #ccc;
    padding: 0.75rem 1rem;
    font-size: 1rem;
  }

  .form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
  }

  .btn {
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
  }

  .btn-success {
    background-color: #28a745;
    border: none;
  }

  .btn-success:hover {
    background-color: #218838;
  }

  .btn-outline-info,
  .btn-outline-secondary {
    padding: 8px 16px;
    font-size: 0.95rem;
  }

  .btn-outline-info:hover {
    background-color: #0dcaf0;
    color: white;
    border-color: #0dcaf0;
  }

  .btn-outline-secondary:hover {
    background-color: #6c757d;
    color: white;
    border-color: #6c757d;
  }

  .alert {
    border-radius: 12px;
    padding: 0.9rem 1.2rem;
    font-size: 0.95rem;
  }

  /* Avatar */
  .avatar-wrapper img {
    border: 4px solid white;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
  }

  .avatar-wrapper img:hover {
    transform: scale(1.05);
  }

  @media (max-width: 768px) {
    .card-body {
      padding: 1.5rem 1rem;
    }

    .btn {
      display: block;
      width: 100%;
      margin-bottom: 10px;
    }

    .btn:last-child {
      margin-bottom: 0;
    }
  }
</style>

</style>
<div class="content-wrapper" style="background: #f0f2f5;">
  <!-- Header halaman -->
  <section class="content-header">
    <div class="container-fluid text-center mt-4">
      <h1 class="display-5 font-weight-bold">Profil Saya</h1>
      <p class="text-muted">Kelola informasi akun Anda dengan mudah.</p>
    </div>
  </section>

  <!-- Konten Profil -->
  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <!-- Kartu Profil -->
        <div class="card border-0 shadow rounded-lg">
          <div class="card-body text-center">
            <!-- Avatar -->
            <div class="mb-4">
              <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['user']['nama']) ?>&background=0D8ABC&color=fff&size=100"
                   alt="Avatar"
                   class="rounded-circle shadow-sm"
                   width="100" height="100">
              <h3 class="mt-3"><?= htmlspecialchars($_SESSION['user']['nama']) ?></h3>
              <p class="text-muted mb-3">Halo, selamat datang kembali!</p>

              <!-- Tombol cepat -->
              <a href="riwayat.php" class="btn btn-outline-info btn-sm mr-2">
                <i class="fas fa-history"></i> Riwayat
              </a>
              <a href="dashboard.php" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-home"></i> Dashboard
              </a>
            </div>

            <!-- Notifikasi -->
            <?php if (isset($_GET['msg'])): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> Profil berhasil diperbarui.
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>
            <?php elseif ($error): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($error) ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>
            <?php endif; ?>

            <!-- Form Edit -->
            <form method="post" class="text-left mt-4">
              <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-control form-control-lg"
                       value="<?= htmlspecialchars($_SESSION['user']['nama'], ENT_QUOTES) ?>" required>
              </div>

              <div class="form-group">
                <label for="password">Password Baru
                  <small class="text-muted">(kosongkan jika tidak ingin mengganti)</small>
                </label>
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="••••••••">
              </div>

              <div class="form-group">
                <label for="password2">Konfirmasi Password</label>
                <input type="password" id="password2" name="password2" class="form-control form-control-lg" placeholder="••••••••">
              </div>

              <div class="text-right">
                <button type="submit" class="btn btn-success btn-lg px-4">
                  <i class="fas fa-save"></i> Simpan Perubahan
                </button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

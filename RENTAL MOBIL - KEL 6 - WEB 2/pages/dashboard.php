<?php
session_start(); // WAJIB di baris pertama!

// Proteksi: pastikan user sudah login
if (!isset($_SESSION['user'])) {
  header('Location: ../login.php');
  exit;
}

include('../config/db.php'); // Pastikan koneksi db.php sudah benar
include('../views/header.php');
include('../views/sidebar.php');
?>

<?php if (isset($_GET['msg']) && $_GET['msg'] === 'bayar_sukses'): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    Pembayaran berhasil diterima. Terima kasih!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1 class="text-primary">Dashboard</h1>
      <p class="lead">Selamat datang, <strong><?= htmlspecialchars($_SESSION['user']['nama']) ?></strong>! Di Dashboard Anda.</p>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <!-- Card Banner: Kemewahan Rental Mobil -->
      <div class="card card-primary mb-4 shadow-lg">
        <div class="card-header bg-gradient-dark text-white">
          <h3 class="card-title">Kemewahan Rental Mobil Kami</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <img src="https://www.pajakonline.com/wp-content/uploads/2022/08/rental-mobil-.jpg" alt="Mobil Mewah" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-md-6">
              <p>
                Nikmati pengalaman berkendara yang mewah dengan armada kami yang terdiri dari mobil premium seperti Mercedes-Benz, BMW, dan Lexus. Setiap kendaraan dirawat dengan standar tinggi untuk memastikan kenyamanan, keamanan, dan gaya Anda selama perjalanan.
              </p>
              <ul class="list-unstyled">
                <li><i class="fas fa-check-circle text-success"></i> Interior kulit premium</li>
                <li><i class="fas fa-check-circle text-success"></i> Driver profesional (jika dibutuhkan)</li>
                <li><i class="fas fa-check-circle text-success"></i> Sistem hiburan mutakhir</li>
                <li><i class="fas fa-check-circle text-success"></i> AC double zone</li>
                <li><i class="fas fa-check-circle text-success"></i> Koneksi WiFi gratis</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Stats Cards -->
      <div class="row">
        <!-- Total Mobil -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info text-white shadow-lg mb-4">
            <div class="inner">
              <h3><?= $conn->query("SELECT COUNT(*) FROM mobil")->fetch_row()[0] ?></h3>
              <p>Total Mobil</p>
            </div>
            <div class="icon">
              <i class="fas fa-car"></i>
            </div>
          </div>
        </div>

        <!-- Rating Rata-rata -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success text-white shadow-lg mb-4">
            <div class="inner">
              <h3><?= round($conn->query("SELECT AVG(rating) FROM mobil")->fetch_row()[0], 1) ?></h3>
              <p>Rating Rata-rata</p>
            </div>
            <div class="icon">
              <i class="fas fa-star"></i>
            </div>
          </div>
        </div>

        <!-- Jumlah Pengguna -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning text-white shadow-lg mb-4">
            <div class="inner">
              <h3><?= $conn->query("SELECT COUNT(*) FROM user")->fetch_row()[0] ?></h3>
              <p>Jumlah Pengguna</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
          </div>
        </div>

        <!-- Transaksi Terakhir -->
<div class="col-lg-3 col-6">
  <div class="small-box bg-danger text-white shadow-lg mb-4">
    <div class="inner">
      <h3>
        <?php
        // Check if the 'transaksi' table exists
        $table_check = $conn->query("SHOW TABLES LIKE 'transaksi'");
        if ($table_check->num_rows > 0) {
            // If table exists, run the query
            $result = $conn->query("SELECT COUNT(*) FROM transaksi");
            $total_transaksi = $result ? $result->fetch_row()[0] : 0;
        } else {
            // If table does not exist, set the count to 0
            $total_transaksi = 0;
        }
        echo $total_transaksi;
        ?>
      </h3>
      <p>Transaksi Terakhir</p>
    </div>
    <div class="icon">
      <i class="fas fa-dollar-sign"></i>
    </div>
  </div>
</div>
    </div>
  </section>
</div>

<?php include('../views/footer.php'); ?>

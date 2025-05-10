<?php
// pages/riwayat.php

session_start();
include '../config/db.php';
include '../views/header.php';
include '../views/sidebar.php';

$user = $_SESSION['user']['nama'];
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Riwayat Peminjaman</h1>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>KTP</th>
              <th>Keperluan</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Selesai</th>
              <th>Biaya</th>
              <th>Mobil</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $result = $conn->query("SELECT * FROM pinjam WHERE nama_peminjam = '$user' ORDER BY tgl_mulai DESC");
            while ($row = $result->fetch_assoc()):
            ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_peminjam']) ?></td>
                <td><?= htmlspecialchars($row['ktp']) ?></td>
                <td><?= htmlspecialchars($row['keperluan']) ?></td>
                <td><?= htmlspecialchars($row['tgl_mulai']) ?></td>
                <td><?= htmlspecialchars($row['tgl_selesai']) ?></td>
                <td>Rp<?= number_format($row['biaya'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($row['komentar']) ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<?php include '../views/footer.php'; ?>

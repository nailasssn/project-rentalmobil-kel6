<?php
include '../config/db.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Mobil</h1>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3>Detail Mobil yang tersedia saat ini :</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-bordered mb-0">
          <thead class="thead-dark">
            <tr>
              <th>id</th>
              <th>Merk</th>
              <th>NoPol</th>
              <th>Thn Beli</th>
              <th>Deskripsi</th>
              <th>Kursi</th>
              <th>Rating</th>
              <th>Biaya (Rp)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $r = $conn->query("SELECT * FROM mobil");
            $no = 1;
            while ($d = $r->fetch_assoc()):
            ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($d['merk']) ?></td>
                <td><?= htmlspecialchars($d['nopol']) ?></td>
                <td><?= $d['thn_beli'] ?></td>
                <td><?= htmlspecialchars($d['deskripsi']) ?></td>
                <td><?= $d['kapasitas_kursi'] ?></td>
                <td><?= $d['rating'] ?></td>
                <td>Rp <?= number_format($d['biaya'], 0, ',', '.') ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<?php include '../views/footer.php'; ?>

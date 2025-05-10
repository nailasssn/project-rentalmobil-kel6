<?php include '../config/db.php'; include '../views/header.php'; include '../views/sidebar.php';
$id_mobil = $_GET['id_mobil']; ?>
<div class="content-wrapper">
  <section class="content-header"><h1>Pembayaran</h1></section>
  <section class="content">
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'sukses'): ?>
  <div class="alert alert-success">Pembayaran berhasil dikirim!</div>
<?php endif; ?>
    <div class="card"><div class="card-body">
      <p>Transfer ke: <strong>Mandiri 01929383202</strong> A/N NAILAH HUSNA TUADA</p><hr>
      <form action="proses_bukti.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_mobil" value="<?= $id_mobil ?>">
        <div class="form-group"><label>Tanggal Transfer</label><input type="date" name="tanggal" class="form-control" required></div>
        <div class="form-group"><label>Jumlah</label><input type="number" name="jumlah" class="form-control" required></div>
        <div class="form-group"><label>Bukti (opsional)</label><input type="file" name="bukti" class="form-control-file"></div>
        <button type="submit" class="btn btn-success">Kirim</button>
      </form>
    </div></div>
  </section>
</div>
<?php include '../views/footer.php'; ?>


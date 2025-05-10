<?php include '../config/db.php'; include '../views/header.php'; include '../views/sidebar.php'; ?>
<div class="content-wrapper">
  <section class="content-header"><h1>Form Peminjaman</h1></section>
  <section class="content"><form action="proses_pinjam.php" method="post">
    <div class="card"><div class="card-body">
      <input type="hidden" name="id_mobil" value="1">
      <div class="form-group"><label>Nama</label><input type="text" name="nama" class="form-control" required></div>
      <div class="form-group"><label>KTP</label><input type="text" name="ktp" class="form-control" required></div>
      <div class="form-group"><label>Keperluan</label><textarea name="keperluan" class="form-control"></textarea></div>
      <div class="form-group"><label>Tanggal Mulai</label><input type="date" name="tgl_mulai" class="form-control" required></div>
      <div class="form-group"><label>Tanggal Selesai</label><input type="date" name="tgl_selesai" class="form-control" required></div>
      <div class="form-group"><label>Biaya</label><input type="number" name="biaya" class="form-control" required></div>
      <div class="form-group">
        <label>Pilih Mobil</label>
        <select name="komentar" class="form-control" required>
          <option value="">-- Pilih Mobil --</option>
          <option value="Toyota Avanza">Toyota Avanza</option>
          <option value="Honda Jazz">Honda Jazz</option>
          <option value="Suzuki Ertiga">Suzuki Ertiga</option>
          <option value="Honda Brio">Honda Brio</option>
          <option value="Daihatsu Terios">Daihatsu Terios</option>
          <option value="Mitsubishi Xpander">Mitsubishi Xpander</option>
          <option value="Daihatsu Sigra">Daihatsu Sigra</option>
          <option value="Toyota Fortuner">Toyota Fortuner</option>
          <option value="Hyundai Ioniq 5">Hyundai Ioniq 5</option>
          
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </div></div></form></section>
</div>
<?php include '../views/footer.php'; ?>
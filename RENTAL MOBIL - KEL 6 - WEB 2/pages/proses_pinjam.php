<?php include '../config/db.php';
$id_mobil = $_POST['id_mobil'];
$nama = $_POST['nama'];
$ktp = $_POST['ktp'];
$keperluan = $_POST['keperluan'];
$tgl_mulai = $_POST['tgl_mulai'];
$tgl_selesai = $_POST['tgl_selesai'];
$biaya = $_POST['biaya'];
$komentar = $_POST['komentar'];

$conn->query("INSERT INTO pinjam (id_mobil, nama_peminjam, ktp, keperluan, tgl_mulai, tgl_selesai, biaya, komentar)
              VALUES ('$id_mobil', '$nama', '$ktp', '$keperluan', '$tgl_mulai', '$tgl_selesai', '$biaya', '$komentar')");

header("Location: pembayaran.php?id_mobil=$id_mobil"); exit;
?>
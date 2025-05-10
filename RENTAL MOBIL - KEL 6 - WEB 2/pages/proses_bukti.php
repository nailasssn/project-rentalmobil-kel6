<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_mobil = $_POST['id_mobil'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];

    // Proses upload file jika ada
    $bukti = '';
    if (!empty($_FILES['bukti']['name'])) {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $bukti = basename($_FILES['bukti']['name']);
        $targetFile = $targetDir . $bukti;

        move_uploaded_file($_FILES['bukti']['tmp_name'], $targetFile);
    }

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO pembayaran (id_mobil, tanggal, jumlah, bukti) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $id_mobil, $tanggal, $jumlah, $bukti);

    if ($stmt->execute()) {
        header("Location: pembayaran.php?id_mobil=$id_mobil&msg=sukses");
    } else {
        echo "Gagal menyimpan pembayaran: " . $stmt->error;
    }
}
?>

<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}
// Include necessary files
include_once '../views/header.php';
include_once '../views/sidebar.php';
// Content section
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Kontak & Bantuan</h1>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body">
                <p>Jika butuh bantuan, hubungi kami melalui:</p>
                <ul class="list-unstyled">
                    <li>
                        <i class="fas fa-phone-alt"></i> WhatsApp: 08123456789 <br><br>
                        <i class="fas fa-envelope"></i> Email: rentalmobilpemweb2@gmail.com

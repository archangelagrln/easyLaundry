<?php
session_start();
include 'koneksi.php';

if (empty($_SESSION['nama'])) {
  header("Location: login.php?pesan=belum_login");
  exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$tgl_diambil = isset($_GET['tgl_diambil']) ? $_GET['tgl_diambil'] : '-';

// Ambil data pesanan
$query = mysqli_query($connect, "SELECT * FROM pesanan WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
  echo "Data tidak ditemukan.";
  exit;
}


$hargaPerLayanan = [
  "Iron" => 5000,
  "Washing & Folding" => 5000,
  "Washing & Iron" => 6000,
  "Washing" => 4000,
  "Wash Express" => 10000
];
$layanan = $data['layanan'];
$hargaLayanan = isset($hargaPerLayanan[$layanan]) ? $hargaPerLayanan[$layanan] : 0;
$total = $hargaLayanan * (int)$data['berat'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bukti Transaksi</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="gambar/android-chrome-512x512.png">
  <style>
    body {
      margin: 0;
      font-family: 'Rubik';
      display: flex;
      height: 100vh;
      font-size: 18px;
    }

    .left {
      background-color: #21b7e2;
      width: 45%;
      position: relative;
      height: 100vh;
      overflow: hidden;
    }

    .left h2 {
      color: white;
      padding: 15px;
      margin: 25px;
    }

    .right {
      background-color: #c9f1f9;
      flex: 1;
      padding: 60px;
      position: relative;
    }

    .right h1 {
      margin-bottom: 30px;
      font-size: 26px;
      font-weight: normal; 
    }

    .row {
      display: flex;
      justify-content: space-between;
      margin: 6px 0;
    }

    .divider {
      width: 85%;
      height: 2px;
      background: #737373;
      margin: 24px auto;
      border-radius: 4px;
    }

    .info {
      margin-top: 24px;
      font-size: 18px;
    }

    .total {
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      font-size: 20px;
      margin-top: 40px;
    }

    .done-btn {
      position: absolute;
      bottom: 40px;
      right: 60px;
      background-color: #21b7e2;
      color: white;
      padding: 12px 32px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
    }

    .done-btn:hover {
      background-color: #1aa4c7;
    }

    .curve-shape {
      position: absolute;
      top: 150px; 
      left: -37px;
      width: 400px;
      height: 100%;
      background-color: #c9f1f9;
      border-top-left-radius: 400px;
      border-top-right-radius: 400px;
      z-index: 0;
    }
  </style>
</head>
<body>

<div class="left">
  <h2>easyLaundry</h2>
  <div class="curve-shape"></div>
</div>

<div class="right">
  <h1>Thank you for your order!</h1>

  <div class="row">
    <p>Name: <strong><?= htmlspecialchars($data['nama']) ?></strong></p>
    <p>Date: <?= date('d M Y', strtotime($tgl_diambil)) ?></p>
  </div>

  <div class="divider"></div>

  <div class="info">
    <div class="row" style="margin-bottom: 30px;">
      <div><?= htmlspecialchars($layanan) ?></div>
      <div>Rp <?= number_format($hargaLayanan, 0, ',', '.') ?></div>
    </div>
    <div class="row">
      <div>Weight</div>
      <div><?= (int)$data['berat'] ?> kg</div>
    </div>
  </div>

  <div class="divider"></div>

  <div class="total">
    <div>Total</div>
    <div>Rp <?= number_format($total, 0, ',', '.') ?></div>
  </div>

  <a href="riwayat.php"><button class="done-btn">Done</button></a>
</div>

</body>
</html>

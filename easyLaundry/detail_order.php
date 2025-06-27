<?php
session_start();
if ($_SESSION['role'] !== 'pelanggan') {
  header("Location: login.php?pesan=akses_ditolak");
  exit;
}


  include 'koneksi.php';
  $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  $query = mysqli_query($connect, "SELECT * FROM pesanan WHERE id = $id");
  $data = mysqli_fetch_assoc($query);

  if (!$data) {
    echo "Data pesanan tidak ditemukan.";
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Order Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet" />
  <link rel="icon" type="image/png" sizes="16x16" href="gambar/android-chrome-512x512.png">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Rubik';
      background-color: #f9f9f9;
      display: flex;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background-color: white;
      border-right: 1px solid #eee;
      z-index: 1000;
    }

    .main-content {
      margin-left: 250px;
      width: calc(100% - 250px);
      padding: 40px 30px;
      height: 100vh;
      overflow-y: auto;
    }

    .order-card {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
      max-width: 900px;
      margin: 0 auto;
    }

    .order-card-header {
      background-color: #21b7e2;
      color: white;
      padding: 16px 24px;
      font-weight: 600;
      font-size: 18px;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }

    .order-card-body {
      padding: 32px 40px;
    }

    .order-label {
      color: #777;
      width: 150px;
    }

    .btn-pay {
      background-color: #21b7e2;
      color: white;
      width: 150.822px;
      padding: 10px 32px;
      font-weight: 500;
      font-size: 15px;
      border-radius: 8px;
      border: none;
      margin-top: 50px;
    }

    .btn-pay:hover {
      background-color: #1aa4c7;
      color: white;
    }
    .btn-pay:active {
    background-color: #1aa4c7 !important;
    color: white !important;
    box-shadow: none;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <?php include 'sidebar.php'; ?>
  </div>

  <div class="main-content">
    <div class="order-card">
      <div class="order-card-header">
        Order Detail
      </div>
      <div class="order-card-body">
        <p class="text-info">ID <?= htmlspecialchars($data['id']) ?></p>
        <h5 class="text"><?= htmlspecialchars($data['nama']) ?></h5>

        <div class="row mb-4">
          <div class="col-sm-4 order-label">Service</div>
          <div class="col-sm-8"><?= htmlspecialchars($data['layanan']) ?></div>
        </div>
        <div class="row mb-4">
          <div class="col-sm-4 order-label">Quantity</div>
          <div class="col-sm-8"><?= htmlspecialchars($data['berat']) ?> Kg</div>
        </div>
        <div class="row mb-4">
          <div class="col-sm-4 order-label">Parfume</div>
          <div class="col-sm-8"><?= htmlspecialchars($data['parfum']) ?></div>
        </div>
        <div class="row mb-4">
          <div class="col-sm-4 order-label">Phone Number</div>
          <div class="col-sm-8"><?= htmlspecialchars($data['no_telp']) ?></div>
        </div>
        <div class="row mb-5">
          <div class="col-sm-4 order-label">Date</div>
          <div class="col-sm-8"><?= date('d M Y', strtotime($data['tgl'])) ?></div>
        </div>

        <div class="text-end">
          <a href="payment.php?id=<?= $data['id']; ?>" class="btn btn-pay text-decoration-none d-inline-block text-center">
            Pay
          </a>
        </div>
      </div>
    </div>
  </div>

</body>
</html>

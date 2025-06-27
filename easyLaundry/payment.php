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

   $hargaPerLayanan = [
  "Iron" => 5000,
  "Washing & Folding" => 5000,
  "Washing & Iron" => 6000,
  "Washing" => 4000,
  "Wash Express" => 10000
];

// Ambil nama layanan dari data
$namaLayanan = $data['layanan'];

// Cek apakah layanan tersedia dalam array
$hargaLayanan = isset($hargaPerLayanan[$namaLayanan]) ? $hargaPerLayanan[$namaLayanan] : 0;

// Hitung total harga
$total = $hargaLayanan * (int)$data['berat'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet" />
  <link rel="icon" type="image/png" sizes="16x16" href="gambar/android-chrome-512x512.png">
  <style>
    body {
      font-family: 'Rubik';
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      position: relative;
      min-height: 100vh;
    }

    .top-bar {
      background-color: #21b7e2;
      padding: 20px 30px;
      display: flex;
      align-items: center;
    }

    .top-bar svg {
      width: 28px;
      height: 28px;
      stroke: white;
      cursor: pointer;
    }

    .container-payment {
      display: flex;
      justify-content: start;
      gap: 50px;
      padding: 50px 40px 100px;
      flex-wrap: wrap;
    }

    .payment-box {
      background-color: #fff;
      padding: 35px 40px;
      border-radius: 16px;
      box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
      flex: 1;
      min-width: 400px;
      max-width: 600px;
    }

    .payment-box h4 {
      font-weight: 700;
      color: #21b7e2;
      text-align: center;
      margin-bottom: 40px;
      font-size: 24px;
    }

    .form-group label {
      font-size: 14px;
      font-weight: normal;
      margin-bottom: 8px;
      display: block;
    }

    .form-method-row {
      display: flex;
      align-items: center;
      gap: 24px;
      margin-bottom: 24px;
    }

    .form-method-row label {
      font-size: 16px;
      margin-bottom: 0;
      white-space: nowrap;
      min-width: 150px;
    }

    .form-method-row select {
      flex: 1;
      border-radius: 30px;
      padding: 10px 20px;
      border: 1px solid black;
      width: 100%;
    }

    .form-control, .form-select {
      border-radius: 30px;
      padding: 10px 20px;
      width: 100%;
      border: 1px solid black;
    }

    .order-summary {
      flex: 1;
      max-width: 500px;
      align-self: flex-start;
    }

    .order-summary h6 {
      color: #777;
      font-weight: 500;
      font-size: 18px;
      margin-bottom: 20px;
    }

    .order-summary .row {
      margin-bottom: 12px;
      font-size: 16px;
    }

    .order-summary .total {
      font-weight: bold;
      color: #21b7e2;
      font-size: 18px;
    }

    .btn-pay {
      background-color: #21b7e2;
      color: white;
      padding: 14px 100px;
      font-weight: 600;
      border-radius: 8px;
      border: none;
      font-size: 16px;
      width: 535px;
    }

    .btn-pay:hover,
    .btn-pay:focus,
    .btn-pay:active {
      background-color: #1aa4c7 !important;
      color: white !important;
    }

    .fixed-pay-btn {
      position: fixed;
      right: 40px;
      bottom: 30px;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
      filter: invert(0.5);
    }

    .form-group {
      margin-bottom: 24px;
    }
  </style>
</head>
<body>

<!-- TOP BAR -->
<div class="top-bar" style="position: relative;">
  <a href="detail_order.php?id=<?= $data['id'] ?>">
    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 55 55" fill="none">
      <path d="M25.52 15.8134L9.33337 32L25.52 48.1867" stroke="white" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M54.6666 32H9.78662" stroke="white" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </a>
  
  <img src="gambar/spiral.png" alt="Spiral" 
       style="position: absolute; top: -20px; right: 7px; width: 205px; pointer-events: none;" />
</div>


<div class="container-payment">
  <!-- PAYMENT FORM -->
  <div class="payment-box">
    <h4>Payment Method</h4>
    <form>
      <div class="form-method-row ">
        <label for="method" style="font-size: 20px;">Payment Method:</label>
        <select id="method" class="form-select">
            <option selected disabled>Select payment method</option>
          <option>Tunai</option>
          <option>Non-Tunai</option>
        </select>
      </div>

      <div class="form-group">
        <label>Name:</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" readonly>
      </div>

      <div class="form-group">
        <label>Service:</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($data['layanan']) ?>" readonly>
      </div>

      <div class="row mt-3">
        <div class="col form-group">
          <label>Order Date :</label>
          <input type="text" class="form-control" value="<?= date('d M Y', strtotime($data['tgl'])) ?>" readonly>
        </div>
        <div class="col form-group">
          <label>Pick-up Date</label>
          <input type="date" class="form-control">
        </div>
      </div>
    </form>
  </div>

  <!-- ORDER SUMMARY -->
  <div class="order-summary">
    <h6>Order summary</h6>

    <div class="row">
      <div class="col"><?= htmlspecialchars($data['layanan']) ?></div>
      <div class="col text-end">Rp <?= number_format($hargaLayanan, 0, ',', '.') ?></div>
    </div>
    <hr>

    <div class="row">
      <div class="col">Weight</div>
      <div class="col text-end"><?= (int)$data['berat'] ?> kg</div>
    </div>
    <hr>

    <div class="row">
      <div class="col fw-bold">Total</div>
      <div class="col text-end total">Rp <?= number_format($total, 0, ',', '.') ?></div>
    </div>
  
</div>

<div class="fixed-pay-btn">
 <form method="POST" action="update_payment.php">
  <input type="hidden" name="id" value="<?= $data['id'] ?>">
  <input type="hidden" name="tgl_diambil" id="pickup_date_value">
  <button class="btn btn-pay" type="submit" onclick="syncPickupDate()">Pay</button>
</form>
</div>
<script>
  function syncPickupDate() {
    const dateVal = document.querySelector('input[type="date"]').value;
    document.getElementById('pickup_date_value').value = dateVal;
  }
</script>


</body>
</html>

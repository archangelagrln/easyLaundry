<?php
include '../koneksi.php';
session_start();
$namaUser = $_SESSION['nama'] ?? 'User';
if ($_SESSION['role'] !== 'pemilik') {
  header("Location: ../login.php?pesan=akses_ditolak");
  exit;
}

// Ambil data dari pesanan (debit) dan pengeluaran (kredit) per hari
$debit = [];
$kredit = [];

// Inisialisasi 7 hari terakhir
$hari = ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
foreach ($hari as $h) {
  $debit[$h] = 0;
  $kredit[$h] = 0;
}

$pesanan = mysqli_query($connect, "SELECT DAYNAME(tgl) as hari, SUM(total_harga) as total FROM pesanan GROUP BY hari");
while ($row = mysqli_fetch_assoc($pesanan)) {
  $en = substr($row['hari'], 0, 3); // Ambil 3 huruf pertama: Sat, Sun, etc
  $debit[$en] = $row['total'];
}

$pengeluaran = mysqli_query($connect, "SELECT DAYNAME(tgl) as hari, SUM(nominal) as total FROM pengeluaran GROUP BY hari");
while ($row = mysqli_fetch_assoc($pengeluaran)) {
  $en = substr($row['hari'], 0, 3);
  $kredit[$en] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Pemilik</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="icon" type="image/png" sizes="16x16" href="../gambar/android-chrome-512x512.png">
  <style>
    body {
      font-family: 'Rubik', sans-serif;
    }
  </style>
</head>
<body class="flex bg-gray-50 min-h-screen">
  <?php include 'sidebarpemilik.php'; ?>

  <div class="ml-[45px] w-[calc(100%-212px)] h-screen overflow-y-auto p-6">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold">Hello <?= htmlspecialchars($namaUser) ?> !</h2>
      <div class="border border-black p-3 rounded-md">
        <p class="font-medium"><?= htmlspecialchars($namaUser) ?></p>
        <p class="text-sm text-gray-500">Owner</p>
      </div>
    </div>

    <div class="bg-[#21B7E2] text-white px-6 py-14 rounded-2xl mb-10">
      <p class="text-sm font-normal -mt-5 mb-7">easyLaundry</p>
      <h3 class="text-2xl font-bold mt-1">From Baskets to Business Growth,<br />Check Out Your Monthly Reports!</h3>
    </div>

    <h3 class="text-lg font-semibold text-gray-700 mb-4">Debit & Credit Overview</h3>

    <div class="bg-white rounded-2xl p-4 shadow-md">
      <canvas id="financeChart" height="100"></canvas>
    </div>
  </div>

  <script>
  const ctx = document.getElementById('financeChart').getContext('2d');
  const financeChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($hari) ?>,
      datasets: [
        {
          label: 'Debit',
          backgroundColor: '#FBBF24',
          data: <?= json_encode(array_values($debit)) ?>,
          borderRadius: 6,
          barThickness: 30
        },
        {
          label: 'Credit',
          backgroundColor: '#3B82F6',
          data: <?= json_encode(array_values($kredit)) ?>,
          borderRadius: 6,
          barThickness: 30
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      },
      plugins: {
        legend: {
          position: 'top'
          
        }
        
      }
    }
  });
</script>

</body>
</html>

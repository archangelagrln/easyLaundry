<?php
session_start();
if ($_SESSION['role'] !== 'karyawan') {
  header("Location: ../login.php?pesan=akses_ditolak");
  exit;
}
include '../koneksi.php';

// Ambil data karyawan dari session
$nama = $_SESSION['nama'];
$queryKaryawan = mysqli_query($connect, "SELECT * FROM karyawan WHERE nama = '$nama'");
$karyawan = mysqli_fetch_assoc($queryKaryawan);

// Ambil semua pesanan
$queryPesanan = mysqli_query($connect, "SELECT * FROM pesanan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="16x16" href="../gambar/android-chrome-512x512.png">
  <style>
    body {
      font-family: 'Rubik';
    }
  </style>
</head>
<body class="flex bg-gray-50 min-h-screen">

  
      <?php include 'sidebarkaryawan.php'; ?>
    

    <!-- MAIN CONTENT -->
    <main class="ml-[3%] w-[80%] max-h-screen overflow-y-auto p-10">
      <div class="flex justify-between items-start mb-6">
        <h1 class="text-2xl font-bold">Hello <?= htmlspecialchars($karyawan['nama']) ?> !</h1>
        <div class="bg-white px-4 py-2 text-right" style="border: 1px solid #000; border-radius: 10px;">
          <p class="text-sm font-medium text-left"><?= htmlspecialchars($karyawan['nama']) ?></p>
          <p class="text-xs text-gray-500 text-left">Staff</p>
        </div>
      </div>

      <section class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold mb-1">All Customers</h2>
        <p class="text-sm text-blue-500 mb-4">Current Order</p>

        <div class="overflow-x-auto">
  <table class="min-w-full text-sm">
    <thead>
      <tr class="border-b border-gray-300 text-left text-[#B5B7C0] font-normal">
        <th class="py-4 px-4">Customer Name</th>
        <th class="py-4 px-4">Quantity</th>
        <th class="py-4 px-4">Phone Number</th>
        <th class="py-4 px-4">Service</th>
        <th class="py-4 px-4">Parfume</th>
        <th class="py-4 px-4">Status</th>
      </tr>
    </thead>
    <tbody class="text-gray-700">
      <?php while ($pesanan = mysqli_fetch_assoc($queryPesanan)) : ?>
        <tr class="border-b border-gray-200 leading-relaxed">
          <td class="py-4 px-4"><?= htmlspecialchars($pesanan['nama']) ?></td>
          <td class="py-4 px-4"><?= htmlspecialchars($pesanan['berat']) ?> kg</td>
          <td class="py-4 px-4"><?= htmlspecialchars($pesanan['no_telp']) ?></td>
          <td class="py-4 px-4"><?= htmlspecialchars($pesanan['layanan']) ?></td>
          <td class="py-4 px-4"><?= htmlspecialchars($pesanan['parfum']) ?></td>
          <td class="py-4 px-4">
            <?php if ($pesanan['status'] === 'Finished') : ?>
              <div class="flex w-[75px] h-[29px] px-3 justify-center items-center gap-2 rounded border border-[#00B087] bg-[#16C09861] text-[#008767] text-xs font-medium">
                Finished
              </div>
            <?php else : ?>
              <div class="flex w-[75px] h-[29px] px-3 justify-center items-center gap-2 rounded border border-[#FFEB0B] bg-[#F9FF85] text-[#848605] text-xs font-medium">
                Process
              </div>
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>

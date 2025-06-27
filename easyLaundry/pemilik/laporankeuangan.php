<?php
include '../koneksi.php';
session_start();
$namaUser = $_SESSION['nama'] ?? 'User';
if ($_SESSION['role'] !== 'pemilik') {
  header("Location: login.php?pesan=akses_ditolak");
  exit;
}

$tglAwal = $_POST['tanggalawal'] ?? '';
$tglAkhir = $_POST['tanggalakhir'] ?? '';

$filterPesanan = '';
$filterPengeluaran = '';
if (!empty($tglAwal) && !empty($tglAkhir)) {
  $filterPesanan = "WHERE tgl BETWEEN '$tglAwal' AND '$tglAkhir'";
  $filterPengeluaran = "WHERE tgl BETWEEN '$tglAwal' AND '$tglAkhir'";
}

$pesanan = mysqli_query($connect, "SELECT id, tgl AS tanggal, layanan AS deskripsi, total_harga AS debit FROM pesanan $filterPesanan");
$pengeluaran = mysqli_query($connect, "SELECT id, tgl As tanggal, deskripsi AS deskripsi, nominal AS credit FROM pengeluaran $filterPengeluaran");

$transaksi = [];

while ($row = mysqli_fetch_assoc($pesanan)) {
  $transaksi[] = [
    'tanggal' => $row['tanggal'],
    'deskripsi' => $row['deskripsi'],
    'debit' => (int)$row['debit'],
    'credit' => 0,
  ];
}

while ($row = mysqli_fetch_assoc($pengeluaran)) {
  $transaksi[] = [
    'tanggal' => $row['tanggal'],
    'deskripsi' => $row['deskripsi'],
    'debit' => 0,
    'credit' => (int)$row['credit'],
  ];
}

usort($transaksi, fn($a, $b) => strtotime($a['tanggal']) - strtotime($b['tanggal']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laporan Keuangan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="16x16" href="../gambar/android-chrome-512x512.png">
  <style>
    body {
      font-family: 'Rubik';
    }
    @media print {
      body * {
        visibility: hidden;
      }
      #print-area, #print-area * {
        visibility: visible;
      }
      #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
    }
  </style>
</head>
<body class="flex bg-gray-50 min-h-screen">
  <?php include 'sidebarpemilik.php'; ?>

  <div class="ml-[45px] w-[calc(100%-212px)] h-screen overflow-y-auto p-6">
    <div class="flex justify-between items-center mb-6">
      <h2 style="font-size: 28px;" class="text-2xl font-semibold">Hello <?= htmlspecialchars($namaUser) ?> !</h2>
      <div class="border border-black p-3 rounded-md">
        <p class="font-medium"><?= htmlspecialchars($namaUser) ?></p>
        <p class="text-sm text-gray-500">Owner</p>
      </div>
    </div>

    <h1 style="font-size: 35px; color: #21B7E2;" class="text-center font-bold mb-8 mt-5">Financial Report</h1>

    <form method="POST" class="flex items-center gap-4 mb-6">
      <div class="flex items-center gap-2">
        <label class="text-sm min-w-[80px]">Start Date</label>
        <input type="date" name="tanggalawal" value="<?= $tglAwal ?>" class="border border-black px-3 py-2 rounded-[8px]" required>
      </div>

      <div class="flex items-center gap-2">
        <label class="text-sm min-w-[80px]">End Date</label>
        <div class="flex">
          <input type="date" name="tanggalakhir" value="<?= $tglAkhir ?>" class="border border-black px-3 py-2 rounded-l-[8px] border-r-0" required>
          <button type="submit" class="bg-[#21b7e2] text-white px-4 py-2 rounded-r-[8px] h-[42px]">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <g clip-path="url(#clip0_167_1019)">
                  <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M19 18.9999L14.65 14.6499" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </g>
                <defs>
                  <clipPath id="clip0_167_1019">
                    <rect width="20" height="20" fill="white"/>
                  </clipPath>
                </defs>
              </svg>
          </button>
        </div>
      </div>

      <button type="button" onclick="window.print()" class="bg-[#21b7e2] text-white px-6 py-2 rounded h-[42px]">
        Print
      </button>
    </form>

    <!-- PRINT -->
    <div id="print-area">
      <div class="mt-6 rounded-lg shadow-md overflow-hidden">
        <table class="w-full text-sm text-left table-fixed border-collapse">
          <thead class="bg-[#D9D9D9] text-gray-800">
            <tr class="border-b-2 border-gray-500">
              <th class="py-3 px-4 text-center">No</th>
              <th class="py-3 px-4 text-center">Date</th>
              <th class="py-3 px-4 text-center">Description</th>
              <th class="py-3 px-4 text-center">Debit</th>
              <th class="py-3 px-4 text-center">Credit</th>
            </tr>
          </thead>
          <tbody class="text-gray-700 bg-white">
            <?php 
              $no = 1; $totalDebit = 0; $totalCredit = 0;
              foreach ($transaksi as $row):
                $totalDebit += $row['debit'];
                $totalCredit += $row['credit'];
            ?>
              <tr class="border-b border-gray-800">
                <td class="py-2 px-4 text-center"><?= $no++ ?></td>
                <td class="py-2 px-4 text-center"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                <td class="py-2 px-4 text-center"><?= $row['deskripsi'] ?></td>
                <td class="py-2 px-4 text-center">Rp <?= number_format($row['debit'], 0, ',', '.') ?></td>
                <td class="py-2 px-4 text-center">Rp <?= number_format($row['credit'], 0, ',', '.') ?></td>
              </tr>
            <?php endforeach; ?>

            <tr class="bg-[#F5F5F5] font-semibold border-t-2 border-gray-400">
              <td colspan="3" class="py-3 px-4 text-center">Total Debit and Credit</td>
              <td class="py-3 px-4 text-center">Rp <?= number_format($totalDebit, 0, ',', '.') ?></td>
              <td class="py-3 px-4 text-center">Rp <?= number_format($totalCredit, 0, ',', '.') ?></td>
            </tr>

            <tr class="bg-[#EDEDED] font-bold border-t-2 border-gray-500">
              <td colspan="3" class="py-3 px-4 text-center">Ending Balance</td>
              <td class="py-3 px-4 text-center">Rp <?= number_format($totalDebit - $totalCredit, 0, ',', '.') ?></td>
              <td class="py-3 px-4 text-center"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>

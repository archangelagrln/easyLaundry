<?php
include '../koneksi.php';
session_start();

$tglAwal = $_GET['tanggalawal'] ?? '';
$tglAkhir = $_GET['tanggalakhir'] ?? '';

$filterPesanan = $filterPengeluaran = '';
if (!empty($tglAwal) && !empty($tglAkhir)) {
  $filterPesanan = "WHERE tgl BETWEEN '$tglAwal' AND '$tglAkhir'";
  $filterPengeluaran = "WHERE tgl BETWEEN '$tglAwal' AND '$tglAkhir'";
}

$pesanan = mysqli_query($connect, "SELECT tgl AS tanggal, layanan AS deskripsi, total_harga AS debit FROM pesanan $filterPesanan");
$pengeluaran = mysqli_query($connect, "SELECT tgl AS tanggal, deskripsi, nominal AS credit FROM pengeluaran $filterPengeluaran");

$transaksi = [];

while ($row = mysqli_fetch_assoc($pesanan)) {
  $transaksi[] = ['tanggal' => $row['tanggal'], 'deskripsi' => $row['deskripsi'], 'debit' => (int)$row['debit'], 'credit' => 0];
}
while ($row = mysqli_fetch_assoc($pengeluaran)) {
  $transaksi[] = ['tanggal' => $row['tanggal'], 'deskripsi' => $row['deskripsi'], 'debit' => 0, 'credit' => (int)$row['credit']];
}

usort($transaksi, fn($a, $b) => strtotime($a['tanggal']) - strtotime($b['tanggal']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" sizes="16x16" href="../gambar/android-chrome-512x512.png">
  <title>Cetak Laporan</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    h2 { text-align: center; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #333; padding: 8px; text-align: center; }
    th { background-color: #f2f2f2; }
    @media print {
      button { display: none; }
    }
  </style>
</head>
<body>

<h2>Laporan Keuangan<br>
<?= $tglAwal ? "Periode: " . date('d-m-Y', strtotime($tglAwal)) . " s/d " . date('d-m-Y', strtotime($tglAkhir)) : '' ?></h2>

<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Deskripsi</th>
      <th>Debit</th>
      <th>Credit</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no = 1; $totalDebit = 0; $totalCredit = 0;
    foreach ($transaksi as $row):
      $totalDebit += $row['debit'];
      $totalCredit += $row['credit'];
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
      <td><?= $row['deskripsi'] ?></td>
      <td>Rp <?= number_format($row['debit'], 0, ',', '.') ?></td>
      <td>Rp <?= number_format($row['credit'], 0, ',', '.') ?></td>
    </tr>
    <?php endforeach; ?>
    <tr style="font-weight: bold; background-color: #f2f2f2;">
      <td colspan="3">Total</td>
      <td>Rp <?= number_format($totalDebit, 0, ',', '.') ?></td>
      <td>Rp <?= number_format($totalCredit, 0, ',', '.') ?></td>
    </tr>
    <tr style="font-weight: bold;">
      <td colspan="4">Ending Balance</td>
      <td>Rp <?= number_format($totalDebit - $totalCredit, 0, ',', '.') ?></td>
    </tr>
  </tbody>
</table>

<div style="text-align: center; margin-top: 30px;">
  <button onclick="window.print()">🖨 Print</button>
</div>

</body>
</html>

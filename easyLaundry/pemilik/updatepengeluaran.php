<?php
include '../koneksi.php';
session_start();

if ($_SESSION['role'] !== 'pemilik') {
    header("Location: login.php?pesan=akses_ditolak");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID tidak ditemukan.";
    exit;
}

// Ambil data pengeluaran berdasarkan ID
$data = mysqli_query($connect, "SELECT * FROM pengeluaran WHERE id='$id'");
$pengeluaran = mysqli_fetch_assoc($data);

if (!$pengeluaran) {
    echo "Data tidak ditemukan.";
    exit;
}

if (isset($_POST['submit'])) {
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $nominal = $_POST['nominal'];

    $update = mysqli_query($connect, "UPDATE pengeluaran SET 
        tgl = '$tanggal',
        deskripsi = '$deskripsi',
        nominal = '$nominal'
        WHERE id = '$id'
    ");

    if ($update) {
       header("Location: pengeluaran.php?status=success");
       exit;
    } else {
        echo "<script>alert('Gagal mengupdate data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Pengeluaran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="16x16" href="../gambar/android-chrome-512x512.png">
  <style>
    body {
      font-family: 'Rubik';
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
   <!-- Header -->
    <div class="bg-cyan-500 py-4 px-6">
        <a href="pengeluaran.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
                <path d="M25.5202 15.8135L9.3335 32.0001L25.5202 48.1868" stroke="white" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M54.6666 32H9.78662" stroke="white" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

    <!-- Card Form -->
    <form method="POST" class="px-6 sm:px-10">
        <div class="max-w-6xl mx-auto bg-white px-6 sm:px-10 py-8 mt-6 rounded-2xl shadow-md">
            <h2 class="text-2xl text-cyan-500 font-bold text-center mb-6">Expanses</h2>

            <label class="block mb-2 text-sm font-medium text-gray-700">Date</label>
            <div class="mb-4">
                 <input type="date" name="tanggal" value="<?= $pengeluaran['tgl'] ?>" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-cyan-400" required>
            </div>

            <label class="block mb-2 text-sm font-medium text-gray-700">Description</label>
            <input name="deskripsi" value="<?= $pengeluaran['deskripsi'] ?>" class="w-full border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-cyan-400" required></textarea>

            <label class="block mb-2 text-sm font-medium text-gray-700">Expanses (Rp)</label>
            <input type="number" name="nominal" value="<?= $pengeluaran['nominal'] ?>" class="w-full border border-gray-400 rounded-md p-2 mb-6 focus:outline-none focus:ring-2 focus:ring-cyan-400" required>
        </div>

        <div class="max-w-6xl mx-auto text-right mt-4 px-6 sm:px-10">
            <button type="submit" name="submit" class="bg-cyan-500 text-white px-6 py-2 rounded-md hover:bg-cyan-600 transition">Submit</button>
        </div>
    </form>
</body>
</html>

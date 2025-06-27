<?php
session_start();
if ($_SESSION['role'] !== 'pemilik') {
  header("Location: login.php?pesan=akses_ditolak");
  exit;
}

include '../koneksi.php';

$nama = $_SESSION['nama'];
$query = mysqli_query($connect, "SELECT * FROM pemilik WHERE nama = '$nama'");
$data = mysqli_fetch_assoc($query);

// Jika data pemilik tidak ditemukan
if (!$data) {
  header("Location: login.php?pesan=akses_ditolak");
  exit;
}

// Set id_pemilik dari data database (bukan dari session langsung)
$id_pemilik = $data['id'];

$pengeluaranSuccess = false;

// Proses input pengeluaran
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $tgl = $_POST['tgl'];
  $deskripsi = mysqli_real_escape_string($connect, $_POST['deskripsi']);
  $nominal = mysqli_real_escape_string($connect, $_POST['nominal']);

  // Simpan ke tabel pengeluaran
  $query = "INSERT INTO pengeluaran (tgl, deskripsi, nominal, id_pemilik)
            VALUES ('$tgl', '$deskripsi', '$nominal', '$id_pemilik')";
  
  $insert = mysqli_query($connect, $query);

  if ($insert) {
    $pengeluaranSuccess = true;
    header("Location: pengeluaran.php?status=success");
    exit;
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expanses Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="../gambar/android-chrome-512x512.png">
</head>
<style>
    body {
        font-family: 'Rubik';
    }
</style>
<body class="bg-gray-100 min-h-screen">

    <div class="bg-cyan-500 py-4 px-6">
        <a href="pengeluaran.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 55 55" fill="none">
                <path d="M25.52 15.8134L9.33337 32L25.52 48.1867" stroke="white" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
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
                <input type="date" name="tgl" class="w-full border border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-cyan-400" required>
            </div>

            <label class="block mb-2 text-sm font-medium text-gray-700">Description</label>
            <textarea name="deskripsi" rows="3" class="w-full border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-cyan-400" required></textarea>

            <label class="block mb-2 text-sm font-medium text-gray-700">Expanses (Rp)</label>
            <input type="number" name="nominal" class="w-full border border-gray-400 rounded-md p-2 mb-6 focus:outline-none focus:ring-2 focus:ring-cyan-400" required>
        </div>

        <div class="max-w-6xl mx-auto text-right mt-4 px-6 sm:px-10">
            <button type="submit" name="submit" class="bg-cyan-500 text-white px-6 py-2 rounded-md hover:bg-cyan-600 transition">Submit</button>
        </div>
    </form>

</body>
</html>

<?php
include 'koneksi.php';
session_start();

if ($_SESSION['role'] !== 'pelanggan') {
  header("Location: login.php?pesan=akses_ditolak");
  exit;
}

// Ambil id_pelanggan dari session login
$nama_session = $_SESSION['nama'];
$cek_pelanggan = mysqli_query($connect, "SELECT id FROM pelanggan WHERE nama = '$nama_session'");
$data_pelanggan = mysqli_fetch_assoc($cek_pelanggan);
$id_pelanggan = $data_pelanggan['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['customer'];
    $layanan = $_POST['service'];
    $berat = $_POST['qty'];
    $no_telp = $_POST['phone'];
    $tgl = $_POST['date'];
    $parfum = $_POST['parfume'];

    // Set otomatis
    $status = 'Process';
    $pembayaran = 'Unpaid';

    // Daftar harga per layanan
    $hargaList = [
        "Iron" => 5000,
        "Washing & Folding" => 5000,
        "Washing & Iron" => 6000,
        "Washing" => 4000,
        "Express Wash" => 10000
    ];

    // Hitung total harga
    $hargaPerKg = $hargaList[$layanan] ?? 0;
    $total_harga = $hargaPerKg * $berat;

    // INSERT ke database dengan id_pelanggan
    $query = "INSERT INTO pesanan 
        (nama, layanan, berat, total_harga, no_telp, tgl, parfum, pembayaran, status, id_pelanggan) 
        VALUES 
        ('$nama', '$layanan', '$berat', '$total_harga', '$no_telp', '$tgl', '$parfum', '$pembayaran', '$status', '$id_pelanggan')";

    $save = mysqli_query($connect, $query);

    if ($save) {
        header("Location: order.php?success=true");
        exit;
    } else {
        echo "<script>alert('Failed to place the order: " . mysqli_error($connect) . "');</script>";
    }
}
?>

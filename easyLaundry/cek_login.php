<?php
session_start();
include 'koneksi.php';

$username = mysqli_real_escape_string($connect, $_POST['nama']);
$password = mysqli_real_escape_string($connect, $_POST['password']);

// Cek di tabel karyawan
$queryKaryawan = mysqli_query($connect, "SELECT * FROM karyawan WHERE nama='$username' AND password='$password'");
$dataKaryawan = mysqli_fetch_assoc($queryKaryawan);

if ($dataKaryawan) {
    $_SESSION['nama'] = $dataKaryawan['nama'];
    $_SESSION['email'] = $dataKaryawan['email'];
    $_SESSION['role'] = 'karyawan';
    header("Location: karyawan/dashboard_karyawan.php");
    exit;
}

// Cek di tabel pelanggan
$queryPelanggan = mysqli_query($connect, "SELECT * FROM pelanggan WHERE nama='$username' AND password='$password'");
$dataPelanggan = mysqli_fetch_assoc($queryPelanggan);

if ($dataPelanggan) {
    $_SESSION['nama'] = $dataPelanggan['nama'];
    $_SESSION['email'] = $dataPelanggan['email'];
    $_SESSION['role'] = 'pelanggan';
    header("Location: dashboardpelanggan.php");
    exit;
}

// Cek di tabel pemilik
$queryPemilik = mysqli_query($connect, "SELECT * FROM pemilik WHERE nama='$username' AND password='$password'");
$dataPemilik = mysqli_fetch_assoc($queryPemilik);

if ($dataPemilik) {
    $_SESSION['nama'] = $dataPemilik['nama'];
    $_SESSION['email'] = $dataPemilik['email'];
    $_SESSION['role'] = 'pemilik';
    header("Location: pemilik/dashboardpemilik.php");
    exit;
}

// Jika tidak ditemukan
header("Location: login.php?pesan=gagal");
exit;


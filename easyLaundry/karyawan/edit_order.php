<?php
session_start();
if ($_SESSION['role'] !== 'karyawan') {
  header("Location: ../login.php?pesan=akses_ditolak");
  exit;
}

include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $layanan = $_POST['layanan'];
  $berat = $_POST['berat'];
  $parfum = $_POST['parfum'];

  $query = "UPDATE pesanan SET 
              nama = '$nama',
              layanan = '$layanan',
              berat = '$berat',
              parfum = '$parfum'
            WHERE id = '$id'";

  if (mysqli_query($connect, $query)) {
    header("Location: verifikasi.php?success=true");
    exit;
  } else {
    echo "Gagal memperbarui data: " . mysqli_error($connect);
  }
} else {
  header("Location: verifikasi.php");
  exit;
}
?>

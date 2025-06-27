<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $tgl_diambil = mysqli_real_escape_string($connect, $_POST['tgl_diambil']);

    // Ubah status pembayaran di database
    $update = mysqli_query($connect, "UPDATE pesanan SET pembayaran = 'Paid' WHERE id = $id");

    if ($update) {
       header("Location: bukti_transaksi.php?id=$id&tgl_diambil=$tgl_diambil");

        exit;
    } else {
        echo "Pembayaran gagal.";
    }
}
?>

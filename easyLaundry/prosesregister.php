<?php
include 'koneksi.php';
$nama = $_POST['nama'];
$no_telpon = $_POST['no_telpon'];
$email = $_POST['email'];
$password = $_POST['password'];

$query_sql = "INSERT INTO pelanggan (nama, no_telpon, email, password) VALUES ('$nama', '$no_telpon', '$email', '$password')";

if(mysqli_query($connect, $query_sql)){
    header("Location: registrasiberhasil.php");
    exit();
} else {
    echo "Pendaftaran Gagal : ". mysqli_error($connect);
}
?>
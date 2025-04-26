<?php
session_start();

include 'koneksi.php';

$nama=$_POST['nama'];
$pass=$_POST['password'];

$query=mysqli_query($connect, "SELECT * FROM pelanggan where nama='$nama' and password='$pass'") or die(mysqli_error($data));
$data=mysqli_num_rows($query);


if($data > 0){
    $_SESSION['nama']  = $nama;
    $_SESSION['status']    = "login";
    header("location:dashboardpelanggan.php");
} else{
    header(header: "location:login.php?pesan=gagal");
}
?>
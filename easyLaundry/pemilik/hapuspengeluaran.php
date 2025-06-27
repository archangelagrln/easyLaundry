<?php
include '../koneksi.php';

$ID = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM pengeluaran WHERE id = '$ID'");

if($query) {
    header("Location: pengeluaran.php?update=success");
    exit;
} else {
    echo "<script>alert('Delete Expenses failed')</script>";
}
?>

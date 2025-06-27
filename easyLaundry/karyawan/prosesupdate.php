<?php
session_start();
if ($_SESSION['role'] !== 'karyawan') {
    header("Location: ../login.php?pesan=akses_ditolak");
    exit;
}

include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    // Ambil id karyawan dari session
    $nama_session = $_SESSION['nama'];
    $cek_karyawan = mysqli_query($connect, "SELECT id FROM karyawan WHERE nama = '$nama_session'");
    $data_karyawan = mysqli_fetch_assoc($cek_karyawan);
    $id_karyawan = $data_karyawan['id'];

    foreach ($_POST['status'] as $id => $newStatus) {
        $id = intval($id); 
        $newStatus = mysqli_real_escape_string($connect, $newStatus);

        // Ambil status lama dari database
        $result = mysqli_query($connect, "SELECT status FROM pesanan WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
        $oldStatus = $row['status'];

        if ($newStatus !== $oldStatus) {
            if ($newStatus === 'Finished') {
                // Jika status berubah ke Finished, simpan juga id_karyawan
                $query = "UPDATE pesanan 
                          SET status = '$newStatus', id_karyawan = '$id_karyawan' 
                          WHERE id = $id";
            } else {
                // Jika hanya update status selain Finished, tidak perlu update id_karyawan
                $query = "UPDATE pesanan 
                          SET status = '$newStatus' 
                          WHERE id = $id";
            }
            mysqli_query($connect, $query);
        }
    }

    header("Location: status.php?update=success");
    exit;
} else {
    header("Location: status.php?pesan=tidak_ada_data");
    exit;
}
?>

<?php
session_start();
if ($_SESSION['role'] !== 'karyawan') {
  header("Location: ../login.php?pesan=akses_ditolak");
  exit;
}
include '../koneksi.php';

$updateSuccess = isset($_GET['update']) && $_GET['update'] === 'success';

$nama = $_SESSION['nama'];
$queryKaryawan = mysqli_query($connect, "SELECT * FROM karyawan WHERE nama = '$nama'");
$karyawan = mysqli_fetch_assoc($queryKaryawan);

$queryPesanan = mysqli_query($connect, "SELECT * FROM pesanan WHERE status = 'Process'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Status</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="16x16" href="../gambar/android-chrome-512x512.png">
  <style>
    body {
      font-family: 'Rubik';
    }
    select {
      border: 1px solid black;
      padding: 4px 8px;
      border-radius: 8px;
      width: 80px;       
      height: 35px;        
      font-size: 14px;    
    }
    select option {
    border-radius: 8px;
    background: var(--White, #FFF);
    }


    .update-btn {
      border-radius: 8px;
      background: #21B7E2;
      color: white;
      padding: 8px 16px;
      font-weight: 500;
    }
  </style>
</head>
<body class="flex bg-gray-50 min-h-screen">
  <?php include 'sidebarkaryawan.php'; ?>

  <main class="ml-[3%] w-[80%] max-h-screen overflow-y-auto p-10">
    <!--popout berhasil-->
        <?php if ($updateSuccess): ?>
        <div id="success-popup" class="fixed top-1/2 left-full transform -translate-y-1/2 opacity-0 bg-white shadow-lg rounded-2xl p-6 w-80 z-50 transition-all duration-500">
          <div class="flex flex-col items-start gap-3 mb-4">
            <div class="w-14 h-14 rounded-full bg-[#ECFDF3] flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path fill="#D1FADF" d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20Z"/>
                <path stroke="#12B76A" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 12 2.5 2.5L16 9"/>
              </svg>
            </div>
            <h4 class="text-base font-semibold text-[#1D2939] m-0">Success</h4>
          </div>
          <p class="text-sm text-[#667085] mb-4">Status updated successfully.</p>
          <button onclick="hideSuccessPopup()" class="bg-[#21B7E2] text-white py-2 px-4 w-full rounded-lg text-sm font-medium">Confirm</button>
        </div>
    <?php endif; ?>

    <div class="flex justify-between items-start mb-6">
      <h1 class="text-2xl font-bold">Hello <?= htmlspecialchars($karyawan['nama']) ?> !</h1>
      <div class="bg-white px-4 py-2 text-right" style="border: 1px solid #000; border-radius: 10px;">
        <p class="text-sm font-medium text-left"><?= htmlspecialchars($karyawan['nama']) ?></p>
        <p class="text-xs text-gray-500 text-left">Staff</p>
      </div>
    </div>

    <section class="bg-white rounded-xl shadow p-6">
      <div class="flex justify-between items-center mb-4">
        <div>
          <h2 class="text-xl font-semibold">All Customers</h2>
          <p class="text-sm text-blue-500">Current Order</p>
        </div>
        <div class="relative">
            <input type="text" id="searchInput" placeholder="Search" 
                class="pl-4 pr-10 py-2 w-[400px] text-sm rounded-full bg-[#ECF0F3] border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 20 20">
                <g clip-path="url(#clip0_93_1054)">
                    <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.9999 18.9999L14.6499 14.6499" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </g>
                <defs>
                    <clipPath id="clip0_93_1054">
                    <rect width="20" height="20" fill="white"/>
                    </clipPath>
                </defs>
                </svg>
            </div>
        </div>
      </div>

      <form method="POST" action="prosesupdate.php">
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm" id="orderTable">
            <thead>
              <tr class="border-b border-gray-300 text-left text-[#B5B7C0] font-normal">
                <th class="py-4 px-4">Customer Name</th>
                <th class="py-4 px-4">Quantity</th>
                <th class="py-4 px-4">Phone Number</th>
                <th class="py-4 px-4">Service</th>
                <th class="py-4 px-4">Parfume</th>
                <th class="py-4 px-4">Action</th>
              </tr>
            </thead>
            <tbody class="text-gray-700">
              <?php while ($pesanan = mysqli_fetch_assoc($queryPesanan)) : ?>
                <tr class="border-b border-gray-200 leading-relaxed">
                  <td class="py-4 px-4"><?= htmlspecialchars($pesanan['nama']) ?></td>
                  <td class="py-4 px-4"><?= htmlspecialchars($pesanan['berat']) ?> kg</td>
                  <td class="py-4 px-4"><?= htmlspecialchars($pesanan['no_telp']) ?></td>
                  <td class="py-4 px-4"><?= htmlspecialchars($pesanan['layanan']) ?></td>
                  <td class="py-4 px-4"><?= htmlspecialchars($pesanan['parfum']) ?></td>
                  <td class="py-4 px-4">
                    <select name="status[<?= $pesanan['id'] ?>]">
                      <option value="Process" <?= $pesanan['status'] == 'Process' ? 'selected' : '' ?>>Process</option>
                      <option value="Finished" <?= $pesanan['status'] == 'Finished' ? 'selected' : '' ?>>Finished</option>
                    </select>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

        <!-- Tombol Update -->
        <div class="flex justify-end mt-6">
          <button type="submit" class="update-btn">Update</button>
        </div>
      </form>
    </section>
  </main>

  <script>
  <?php if ($updateSuccess): ?>
    window.addEventListener('DOMContentLoaded', () => {
      const popup = document.getElementById('success-popup');
      popup.classList.remove('opacity-0');
      popup.classList.add('opacity-100');
      popup.style.left = '50%';
      popup.style.transform = 'translate(-50%, -50%)';

      setTimeout(() => {
        hideSuccessPopup();
      }, 3000);
    });
  <?php endif; ?>

  function hideSuccessPopup() {
    const popup = document.getElementById('success-popup');
    popup.classList.remove('opacity-100');
    popup.classList.add('opacity-0');
    popup.style.left = '100%';
    popup.style.transform = 'translateY(-50%)';
  }

  // Script pencarian
  const searchInput = document.getElementById('searchInput');
  const tableRows = document.querySelectorAll('#orderTable tbody tr');

  searchInput.addEventListener('keyup', () => {
    const keyword = searchInput.value.toLowerCase();
    tableRows.forEach(row => {
      const rowText = row.innerText.toLowerCase();
      row.style.display = rowText.includes(keyword) ? '' : 'none';
    });
  });
</script>

</body>
</html>

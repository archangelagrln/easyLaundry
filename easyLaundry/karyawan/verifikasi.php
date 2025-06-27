<?php
session_start();
if ($_SESSION['role'] !== 'karyawan') {
  header("Location: ../login.php?pesan=akses_ditolak");
  exit;
}
include '../koneksi.php';

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
  <title>Verifikasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="16x16" href="../gambar/android-chrome-512x512.png">
  <style>
    body {
      font-family: 'Rubik';
    }
  </style>
</head>
<body class="flex bg-gray-50 min-h-screen">

  <?php include 'sidebarkaryawan.php'; ?>

  <!-- Pop-Up Notifikasi -->
    <div id="success-popup" class="fixed top-1/2 right-[-500px] transform -translate-y-1/2 bg-white px-10 py-8 rounded-2xl shadow-2xl transition-all duration-700 z-50 w-[400px] max-w-full">
      <div class="flex flex-col">
        <div class="bg-green-100 p-4 rounded-full mb-4 flex items-center justify-center w-16 h-16">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M22 11.0799V11.9999C21.9988 14.1563 21.3005 16.2545 20.0093 17.9817C18.7182 19.7088 16.9033 20.9723 14.8354 21.5838C12.7674 22.1952 10.5573 22.1218 8.53447 21.3744C6.51168 20.6271 4.78465 19.246 3.61096 17.4369C2.43727 15.6279 1.87979 13.4879 2.02168 11.3362C2.16356 9.18443 2.99721 7.13619 4.39828 5.49694C5.79935 3.85768 7.69279 2.71525 9.79619 2.24001C11.8996 1.76477 14.1003 1.9822 16.07 2.85986M22 3.99986L12 14.0099L9.00001 11.0099" stroke="#039855" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Success</h2>
        <p class="text-base text-gray-500 mt-1">You have verified this order</p>
        <button onclick="hidePopup()" class="mt-6 bg-cyan-500 hover:bg-cyan-600 text-white text-lg px-6 py-3 rounded-lg shadow-md">Confirm</button>
      </div>
    </div>


  <main class="ml-[3%] w-[80%] max-h-screen overflow-y-auto p-10">
    <div class="flex justify-between items-start mb-6">
      <h1 class="text-2xl font-bold">Hello <?= htmlspecialchars($karyawan['nama']) ?> !</h1>
      <div class="bg-white px-4 py-2 text-right border border-black rounded-xl">
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
              <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="black" stroke-width="2"/>
              <path d="M18.9999 18.9999L14.6499 14.6499" stroke="black" stroke-width="2"/>
            </svg>
          </div>
        </div>
      </div>

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
                <td class="py-4 px-4 flex gap-2">
                  <a href="javascript:void(0);" 
                     onclick='openOrder(<?= json_encode($pesanan) ?>)' 
                     title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" fill="none" viewBox="0 0 25 24">
                      <path d="M11.375 4H4.375C3.84457 4 3.33586 4.21071 2.96079 4.58579C2.58571 4.96086 2.375 5.46957 2.375 6V20C2.375 20.5304 2.58571 21.0391 2.96079 21.4142C3.33586 21.7893 3.84457 22 4.375 22H18.375C18.9054 22 19.4141 21.7893 19.7892 21.4142C20.1643 21.0391 20.375 20.5304 20.375 20V13" stroke="#21B7E2" stroke-width="2"/>
                      <path d="M18.875 2.5C19.2728 2.10218 19.8124 1.87869 20.375 1.87869C20.9376 1.87869 21.4772 2.10218 21.875 2.5C22.2728 2.89782 22.4963 3.43739 22.4963 4C22.4963 4.56261 22.2728 5.10218 21.875 5.5L12.375 15L8.375 16L9.375 12L18.875 2.5Z" stroke="#21B7E2" stroke-width="2"/>
                    </svg>
                  </a>
                  <form method="POST" action="edit_order.php" class="inline-block">
                    <input type="hidden" name="id" value="<?= $pesanan['id'] ?>">
                    <input type="hidden" name="nama" value="<?= $pesanan['nama'] ?>">
                    <input type="hidden" name="layanan" value="<?= $pesanan['layanan'] ?>">
                    <input type="hidden" name="berat" value="<?= $pesanan['berat'] ?>">
                    <input type="hidden" name="parfum" value="<?= $pesanan['parfum'] ?>">
                    <button type="submit" title="Simpan">
                      <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" fill="none" viewBox="0 0 21 22">
                        <path d="M6.64185 11L9.12051 13.4787C9.17048 13.5283 9.23806 13.5562 9.30851 13.5562C9.37896 13.5562 9.44655 13.5283 9.49651 13.4787L13.9752 9" stroke="#27A857" stroke-width="2"/>
                        <path d="M14.3751 1.6665H6.37508C3.42956 1.6665 1.04175 4.05432 1.04175 6.99984V14.9998C1.04175 17.9454 3.42956 20.3332 6.37508 20.3332H14.3751C17.3206 20.3332 19.7084 17.9454 19.7084 14.9998V6.99984C19.7084 4.05432 17.3206 1.6665 14.3751 1.6665Z" stroke="#27A857" stroke-width="2"/>
                      </svg>
                    </button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Edit Order -->
<div id="editOrder" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-xl w-[400px] relative">
      <button onclick="closeOrder()" class="absolute top-4 right-4 text-gray-500 hover:text-black">&times;</button>
      <h2 class="text-xl font-semibold mb-4">Edit Order</h2>
      <form id="editForm" onsubmit="return updateOrderTable(event)">
        <input type="hidden" name="id" id="edit-id">
        <div class="mb-4">
          <label class="text-sm font-medium">Name</label>
          <input type="text" name="nama" id="edit-nama" class="mt-1 w-full px-3 py-2 border rounded-md" required>
        </div>
        <div class="mb-4">
          <label class="text-sm font-medium">Service</label>
          <select name="layanan" id="edit-layanan" class="mt-1 w-full px-3 py-2 border rounded-md" required>
            <option value="Iron">Iron</option>
            <option value="Washing & Folding">Washing & Folding</option>
            <option value="Washing & Iron">Washing & Iron</option>
            <option value="Washing">Washing</option>
            <option value="Express Wash">Express Wash</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="text-sm font-medium">Quantity</label>
          <input type="number" name="berat" id="edit-berat" class="mt-1 w-full px-3 py-2 border rounded-md" required>
        </div>
        <div class="mb-6">
          <label class="text-sm font-medium">Parfume</label>
          <select name="parfum" id="edit-parfum" class="mt-1 w-full px-3 py-2 border rounded-md" required>
            <option value="Lavender Fresh">Lavender Fresh</option>
            <option value="Sweet Vanilla">Sweet Vanilla</option>
            <option value="Floral Garden">Floral Garden</option>
          </select>
        </div>
        <button type="submit" class="w-full bg-[#21B7E2] text-white font-semibold py-2 rounded-md hover:bg-[#1ea6cd]">Edit</button>
      </form>
    </div>
  </div>


  <script>
    function showPopup() {
      const popup = document.getElementById('success-popup');
      popup.style.right = '50%';
      popup.style.transform = 'translate(50%, -50%)'; // geser ke tengah horizontal
    }


    function hidePopup() {
      document.getElementById('success-popup').style.right = '-400px';
    }

    if (window.location.search.includes('success=true')) {
      setTimeout(showPopup, 300);
    }

    function openOrder(data) {
      document.getElementById('edit-id').value = data.id || '';
      document.getElementById('edit-nama').value = data.nama || '';
      document.getElementById('edit-layanan').value = data.layanan || '';
      document.getElementById('edit-berat').value = data.berat || '';
      document.getElementById('edit-parfum').value = data.parfum || '';
      document.getElementById('editOrder').classList.remove('hidden');
    }

    function closeOrder() {
      document.getElementById('editOrder').classList.add('hidden');
    }

    function updateOrderTable(event) {
      event.preventDefault();

      const id = document.getElementById('edit-id').value;
      const nama = document.getElementById('edit-nama').value;
      const layanan = document.getElementById('edit-layanan').value;
      const berat = document.getElementById('edit-berat').value;
      const parfum = document.getElementById('edit-parfum').value;

      const rows = document.querySelectorAll('#orderTable tbody tr');
      rows.forEach(row => {
        const form = row.querySelector('form');
        const currentId = form.querySelector('input[name="id"]').value;

        if (currentId === id) {
          row.children[0].innerText = nama;
          row.children[1].innerText = berat + ' kg';
          row.children[3].innerText = layanan;
          row.children[4].innerText = parfum;

          form.querySelector('input[name="nama"]').value = nama;
          form.querySelector('input[name="layanan"]').value = layanan;
          form.querySelector('input[name="berat"]').value = berat;
          form.querySelector('input[name="parfum"]').value = parfum;

          const editBtn = row.querySelector('a[onclick^="openOrder"]');
          if (editBtn) {
            editBtn.setAttribute('onclick', `openOrder(${JSON.stringify({ id, nama, layanan, berat, parfum })})`);
          }
        }
      });

      closeOrder();
      return false;
    }

    document.getElementById('searchInput').addEventListener('keyup', function () {
      const keyword = this.value.toLowerCase();
      document.querySelectorAll('#orderTable tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(keyword) ? '' : 'none';
      });
    });
  </script>
</body>
</html>

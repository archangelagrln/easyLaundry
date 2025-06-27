<?php
include '../koneksi.php';
session_start();
$namaUser = $_SESSION['nama'] ?? 'User';
if ($_SESSION['role'] !== 'pemilik') {
  header("Location: login.php?pesan=akses_ditolak");
  exit;
}

$pengeluaran = mysqli_query($connect, "SELECT * FROM pengeluaran ORDER BY tgl ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laporan Pengeluaran</title>
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
  <?php include 'sidebarpemilik.php'; ?>

  <div class="ml-[45px] w-[calc(100%-212px)] h-screen overflow-y-auto p-6">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold">Hello <?= htmlspecialchars($namaUser) ?> !</h2>
      <div class="border border-black p-3 rounded-md">
        <p class="font-medium"><?= htmlspecialchars($namaUser) ?></p>
        <p class="text-sm text-gray-500">Owner</p>
      </div>
    </div>

    <h1 class="text-center text-3xl font-bold mb-8 mt-5 text-[#21B7E2]">Expense Report</h1>

    <!-- TABLE -->
    <div class="mt-6 rounded-lg shadow-md overflow-hidden">
      <table class="w-full text-sm text-left table-fixed border-collapse">
        <thead class="bg-[#D9D9D9] text-gray-800">
          <tr class="border-b-2 border-gray-500">
            <th class="py-3 px-4 text-center">ID</th>
            <th class="py-3 px-4 text-center">Date</th>
            <th class="py-3 px-4 text-center">Description</th>
            <th class="py-3 px-4 text-center">Expenses (Rp)</th>
            <th class="py-3 px-4 text-center">Action</th>
          </tr>
        </thead>
        <tbody class="text-gray-700 bg-white">
          <?php while ($row = mysqli_fetch_assoc($pengeluaran)): ?>
            <tr class="border-b border-gray-800">
              <td class="py-2 px-4 text-center"><?= $row['id'] ?></td>
              <td class="py-2 px-4 text-center"><?= date('d-m-Y', strtotime($row['tgl'])) ?></td>
              <td class="py-2 px-4 text-center"><?= htmlspecialchars($row['deskripsi']) ?></td>
              <td class="py-2 px-4 text-center">Rp <?= number_format($row['nominal'], 0, ',', '.') ?></td>
              <td class="py-2 px-4 text-center flex justify-center gap-2">
               <a href="updatepengeluaran.php?id=<?= $row['id'] ?>" class="text-blue-500 hover:scale-110 transition-transform" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <mask id="mask0_515_848" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                            <rect width="24" height="24" fill="#D9D9D9"/>
                        </mask>
                        <g mask="url(#mask0_515_848)">
                            <path d="M4.99997 19H6.2615L16.4981 8.7634L15.2366 7.50188L4.99997 17.7385V19ZM4.40385 20.5C4.14777 20.5 3.93311 20.4133 3.75987 20.2401C3.58662 20.0668 3.5 19.8522 3.5 19.5961V17.8635C3.5 17.6196 3.5468 17.3871 3.6404 17.1661C3.73398 16.9451 3.86282 16.7526 4.02692 16.5885L16.6904 3.93078C16.8416 3.79343 17.0086 3.68729 17.1913 3.61237C17.374 3.53746 17.5656 3.5 17.7661 3.5C17.9666 3.5 18.1608 3.53558 18.3488 3.60675C18.5368 3.6779 18.7032 3.79103 18.848 3.94615L20.0692 5.18268C20.2243 5.32754 20.3349 5.49424 20.4009 5.68278C20.4669 5.87129 20.5 6.05981 20.5 6.24833C20.5 6.44941 20.4656 6.64131 20.3969 6.82403C20.3283 7.00676 20.219 7.17373 20.0692 7.32495L7.41147 19.973C7.24738 20.1371 7.05483 20.266 6.83383 20.3596C6.61281 20.4532 6.38037 20.5 6.1365 20.5H4.40385ZM15.8563 8.1437L15.2366 7.50188L16.4981 8.7634L15.8563 8.1437Z" fill="#35353A"/>
                        </g>
                    </svg>
                </a>
                <a href="#" onclick="showDeletePopup(<?= $row['id'] ?>)" class="text-blue-500 hover:scale-110 transition-transform" title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <mask id="mask0_515_244" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                            <rect width="24" height="24" fill="#D9D9D9"/>
                        </mask>
                        <g mask="url(#mask0_515_244)">
                            <path d="M7.3077 20.4998C6.81058 20.4998 6.38502 20.3228 6.03102 19.9688C5.67701 19.6148 5.5 19.1892 5.5 18.6921V5.99981H5.25C5.0375 5.99981 4.85938 5.9279 4.71563 5.78408C4.57188 5.64028 4.5 5.46208 4.5 5.24948C4.5 5.0369 4.57188 4.85882 4.71563 4.71523C4.85938 4.57163 5.0375 4.49983 5.25 4.49983H8.99997C8.99997 4.25497 9.08619 4.04632 9.25863 3.87388C9.43106 3.70145 9.63971 3.61523 9.88457 3.61523H14.1154C14.3602 3.61523 14.5689 3.70145 14.7413 3.87388C14.9138 4.04632 15 4.25497 15 4.49983H18.75C18.9625 4.49983 19.1406 4.57174 19.2843 4.71556C19.4281 4.85938 19.5 5.03758 19.5 5.25016C19.5 5.46276 19.4281 5.64085 19.2843 5.78443C19.1406 5.92802 18.9625 5.99981 18.75 5.99981H18.5V18.6921C18.5 19.1892 18.3229 19.6148 17.9689 19.9688C17.6149 20.3228 17.1894 20.4998 16.6922 20.4998H7.3077ZM17 5.99981H6.99997V18.6921C6.99997 18.7818 7.02883 18.8556 7.08652 18.9133C7.14422 18.971 7.21795 18.9998 7.3077 18.9998H16.6922C16.782 18.9998 16.8557 18.971 16.9134 18.9133C16.9711 18.8556 17 18.7818 17 18.6921V5.99981ZM10.1542 16.9998C10.3668 16.9998 10.5448 16.9279 10.6884 16.7842C10.832 16.6404 10.9038 16.4623 10.9038 16.2498V8.74979C10.9038 8.5373 10.8319 8.35918 10.6881 8.21543C10.5443 8.07168 10.3661 7.99981 10.1535 7.99981C9.9409 7.99981 9.76281 8.07168 9.61922 8.21543C9.47564 8.35918 9.40385 8.5373 9.40385 8.74979V16.2498C9.40385 16.4623 9.47576 16.6404 9.61958 16.7842C9.76337 16.9279 9.94158 16.9998 10.1542 16.9998ZM13.8464 16.9998C14.059 16.9998 14.2371 16.9279 14.3807 16.7842C14.5243 16.6404 14.5961 16.4623 14.5961 16.2498V8.74979C14.5961 8.5373 14.5242 8.35918 14.3804 8.21543C14.2366 8.07168 14.0584 7.99981 13.8458 7.99981C13.6332 7.99981 13.4551 8.07168 13.3115 8.21543C13.1679 8.35918 13.0961 8.5373 13.0961 8.74979V16.2498C13.0961 16.4623 13.168 16.6404 13.3118 16.7842C13.4557 16.9279 13.6339 16.9998 13.8464 16.9998Z" fill="#35353A"/>
                        </g>
                    </svg>
                </a>
                
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <div class="fixed bottom-6 right-6">
    <a href="formpengeluaran.php" class="bg-[#21b7e2] text-white px-6 py-2 rounded h-[42px]">
        Add Expenses
    </a>
    </div>

  </div>
 <!-- Popout Konfirmasi Delete -->
<div id="delete-popup" class="fixed top-1/2 left-full transform -translate-y-1/2 opacity-0 bg-white shadow-lg rounded-2xl p-6 w-80 z-50 transition-all duration-500">
  <div class="flex flex-col items-start gap-3 mb-4">
    <div class="w-14 h-14 rounded-full bg-[#FEF3F2] flex items-center justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M12 8V12M12 16H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#BC3638" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    <h4 class="text-base font-semibold text-[#1D2939] m-0">Delete</h4>
  </div>
  <p class="text-sm text-[#667085] mb-4">Are you sure you want to delete?</p>
  <div class="flex gap-3">
    <button onclick="hideDeletePopup()" class="bg-white border border-gray-300 text-gray-800 py-2 px-4 w-1/2 rounded-lg text-sm font-medium">Cancel</button>
    <a id="deleteConfirmLink" href="#" class="bg-[#D92D20] hover:bg-[#C5291A] text-white py-2 px-4 w-1/2 rounded-lg text-sm font-medium text-center">Delete</a>
  </div>
</div>


<script>
function showDeletePopup(id) {
  const popup = document.getElementById('delete-popup');
  const link = document.getElementById('deleteConfirmLink');
  link.href = `hapuspengeluaran.php?id=${id}`; 

  popup.classList.remove('opacity-0');
  popup.classList.add('opacity-100');
  popup.style.left = '50%';
  popup.style.transform = 'translate(-50%, -50%)';
}

function hideDeletePopup() {
  const popup = document.getElementById('delete-popup');
  popup.classList.remove('opacity-100');
  popup.classList.add('opacity-0');
  popup.style.left = '100%';
  popup.style.transform = 'translateY(-50%)';
}

</script>

</body>
</html>

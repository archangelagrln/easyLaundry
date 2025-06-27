<?php
session_start();
if ($_SESSION['role'] !== 'pelanggan') {
  header("Location: login.php?pesan=akses_ditolak");
  exit;
}

include 'koneksi.php';

$iconMap = [
  'Washing & Iron'    => 'https://cdn-icons-png.freepik.com/256/2946/2946539.png',
  'Washing & Folding' => 'https://cdn-icons-png.freepik.com/256/2230/2230632.png',
  'Washing'           => 'https://cdn-icons-png.freepik.com/256/2226/2226109.png',
  'Iron'              => 'https://cdn-icons-png.freepik.com/256/3005/3005699.png',
  'Express Wash'      => 'https://cdn-icons-png.freepik.com/256/6255/6255434.png'
];

$username = $_SESSION['nama'];
$query = "SELECT layanan, tgl FROM pesanan WHERE nama = '$username' ORDER BY tgl DESC";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Pelanggan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="16x16" href="gambar/android-chrome-512x512.png">
  <style>
    body {
      font-family: 'Rubik', sans-serif;
    }

  .custom-scroll::-webkit-scrollbar {
    width: 6px;
  }

  .custom-scroll::-webkit-scrollbar-track {
    background: transparent;
  }

  .custom-scroll::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.2);
    border-radius: 10px;
  }

  .custom-scroll {
    scrollbar-width: thin; 
    scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
    scrollbar-color: transparent transparent; 
  }
  </style>
</head>
<body class="flex h-screen bg-gray-50 overflow-hidden">

  <?php include 'sidebar.php'; ?>

  <main class="flex-1 flex gap-6 overflow-hidden">
    <!-- Konten kiri -->
    <div class="w-3/4 space-y-10 overflow-y-auto pr-2 p-10">
      <div class="relative bg-[#21B7E2] rounded-2xl text-white p-10 overflow-hidden h-[250px]">
  
        <div class="absolute inset-0 z-0">
          <img src="gambar/Fill-1_2_.png" alt="Wave Background 1" class="absolute top-0 left-0 w-[100%] max-w-none h-auto opacity-10 mt-4" />
          <img src="gambar/Fill-1_3_.png" alt="Wave Background 2" class="absolute top-0 left-0 w-[100%] max-w-none h-auto opacity-10 mt-4" />
        </div>

        <div class="relative z-10">
          <p class="text-sm mb-2">easyLaundry</p>
          <h1 class="text-2xl md:text-3xl mt-10 font-semibold">Bring New Life to Your Clothes With Our Laundry Services</h1>
        </div>
    </div>


      <section>
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Service</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
          <?php
          $services = [
            "Washing & Iron" => "Clothes washing and ironing service",
            "Washing & Folding" => "Clothes washing and folding service",
            "Washing" => "Clothes washing to dry service",
            "Iron" => "Clothes ironing service, wrinkle-free & neat",
            "Express Wash" => "Express service finished in 1 day."
          ];

          foreach ($services as $name => $desc) {
            $icon = $iconMap[$name];
            echo "
            <div class='bg-white p-5 rounded-xl text-center shadow'>
              <img src='$icon' alt='$name' class='w-14 h-14 mx-auto mb-3'>
              <h3 class='font-semibold text-sm'>$name</h3>
              <p class='text-xs text-gray-600'>$desc</p>
            </div>";
          }
          ?>
        </div>
      </section>
    </div>

    <!-- Panel kanan -->
    <aside class="w-1/4 h-full">
      <div class="bg-[#D0F6FF] h-full p-6 flex flex-col overflow-hidden">
        <div class="bg-white text-center py-3 mb-6 rounded-full font-medium text-gray-700">
          Hello <?= htmlspecialchars($_SESSION['nama']) ?> !
        </div>
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Order</h3>
        <div class="flex-1 overflow-y-auto space-y-4 custom-scroll">
          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <?php
              $layanan = trim($row['layanan']); 
              $icon = $iconMap[$layanan] ?? null;
            ?>
            <div class="flex items-center gap-4 bg-white p-3 rounded-xl shadow">
              <?php if ($icon): ?>
                <img src="<?= $icon ?>" class="w-10 h-10" />
              <?php endif; ?>
              <div>
                <p class="text-sm font-medium"><?= htmlspecialchars($layanan) ?></p>
                <p class="text-xs text-gray-500"><?= date('d M Y', strtotime($row['tgl'])) ?></p>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </aside>
  </main>
</body>
</html>

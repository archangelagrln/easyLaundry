<?php
session_start();
if ($_SESSION['role']!== 'pelanggan') {
  header("Location: login.php?pesan=akses_ditolak");
  exit;
}

include 'koneksi.php';

$nama = $_SESSION['nama'];
$query = mysqli_query($connect, "SELECT * FROM pelanggan WHERE nama = '$nama'");
$data = mysqli_fetch_assoc($query);

// Jika tidak ditemukan, tolak akses
if (!$data) {
  header("Location: login.php?pesan=akses_ditolak");
  exit;
}

// Set id pelanggan dari database
$id_pelanggan = $data['id'];

$feedbackSuccess = false;

// Proses feedback
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_feedback'])) {
  $isi_feedback = mysqli_real_escape_string($connect, $_POST['feedback']);
  $tgl = date('Y-m-d');

  $insert = mysqli_query($connect, "INSERT INTO feedback (id_pelanggan, isi, tgl) VALUES ('$id_pelanggan', '$isi_feedback', '$tgl')");

 if ($insert) {
    $feedbackSuccess = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Order History</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="16x16" href="gambar/android-chrome-512x512.png">
  <style>
    body { font-family: 'Rubik'; }
    th {
      background-color: #E7E7E7;
      font-weight: normal;
      text-transform: capitalize;
      position: relative;
    }
    th::after {
      content: "";
      position: absolute;
      top: 25%;
      bottom: 25%;
      right: 0;
      width: 1px;
      background-color: #ccc;
    }
    th:last-child::after { display: none; }
    .modal {
      display: none;
      position: fixed;
      z-index: 50;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 90%;
      max-width: 500px;
      border-radius: 10px;
    }
  </style>
</head>
<body class="flex bg-gray-50 min-h-screen">

    <?php include 'sidebar.php'; ?>

<main class="ml-[3%] w-[80%] max-h-screen overflow-y-auto p-10">

<div class="content">
  <h1 class="text-4xl font-bold mb-6 text-center mt-5" style="color: #21B7E2;">Order History</h1>

  <div class="max-w-[1000px] mx-auto bg-white p-6 rounded-lg shadow space-y-4 mt-20">
    <form method="GET">
      <div class="relative w-full max-w-md">
        <input type="text" name="search" placeholder="Search for id or service name" class="border px-4 py-2 pr-12 w-full shadow-sm text-sm" style="border-radius: 12px;"/>
        <div class="absolute right-3 top-[9px]">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
            <path d="M13.3891 13.3891L19 19M9.5 15C12.5376 15 15 12.5376 15 9.5C15 6.46243 12.5376 4 9.5 4C6.46243 4 4 6.46243 4 9.5C4 12.5376 6.46243 15 9.5 15Z" stroke="#454545" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </form>

    <div class="overflow-x-auto">
      <table class="min-w-full rounded-lg overflow-hidden shadow">
        <thead>
          <tr class="text-left text-sm border-b" style="color: #454545;">
            <th class="px-4 py-3">Orders</th>
            <th class="px-4 py-3">Customer</th>
            <th class="px-4 py-3">Price</th>
            <th class="px-4 py-3">Date</th>
            <th class="px-4 py-3">Payment</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Action</th>
          </tr>
        </thead>
        <tbody class="text-sm text-black">

<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$username = $_SESSION['nama'];
$sql = "SELECT * FROM pesanan WHERE nama = '$username' AND (id LIKE '%$search%' OR layanan LIKE '%$search%') ORDER BY tgl DESC";
$result = $connect->query($sql);
while ($row = $result->fetch_assoc()):
?>
<tr class="border-t">
  <td class="px-4 py-3 text-blue-500">
    <a href="#"><?= $row['id']; ?><br><span class="text-black text-sm"><?= $row['layanan']; ?></span></a>
  </td>
  <td class="px-4 py-3"><?= $row['nama']; ?></td>
  <td class="px-4 py-3">Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
  <td class="px-4 py-3"><?= $row['tgl']; ?></td>
  <td class="px-4 py-3"><span style="<?= $row['pembayaran'] === 'Paid' ? 'background:#E6FF96;color:#00B809;' : 'background:#FFF5C5;color:#E27D00;'; ?> padding:6px 8px;border-radius:4px;"><?= $row['pembayaran']; ?></span></td>
  <td class="px-4 py-3"><span style="<?= $row['status'] === 'Finished' ? 'background:rgba(22,192,152,0.38);color:#008767;' : 'background:#F9FF85;color:#848605;'; ?> padding:4px 12px;border-radius:4px;"><?= $row['status']; ?></span></td>
  <td class="px-4 py-3">
    <div style="display:flex;gap:10px;align-items:center;">
      <a href="detail_order.php?id=<?= $row['id']; ?>" title="Lihat Detail">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
            <path d="M12.5002 3.125C18.1169 3.125 22.7898 7.16667 23.77 12.5C22.7908 17.8333 18.1169 21.875 12.5002 21.875C6.88353 21.875 2.21061 17.8333 1.23145 12.5C2.21061 7.16667 6.88353 3.125 12.5002 3.125ZM12.5002 19.7917C14.6248 19.7914 16.6864 19.0699 18.3476 17.7453C20.0087 16.4206 21.1709 14.5713 21.6439 12.5C21.1696 10.43 20.0069 8.58225 18.346 7.2589C16.6851 5.93555 14.6243 5.21495 12.5007 5.21495C10.3771 5.21495 8.3163 5.93555 6.6554 7.2589C4.99451 8.58225 3.83182 10.43 3.35749 12.5C3.8305 14.5711 4.99256 16.4203 6.65347 17.745C8.31438 19.0696 10.3757 19.7912 12.5002 19.7917ZM12.5002 17.1875C11.257 17.1875 10.0647 16.6936 9.18563 15.8146C8.30656 14.9355 7.8127 13.7432 7.8127 12.5C7.8127 11.2568 8.30656 10.0645 9.18563 9.18544C10.0647 8.30636 11.257 7.8125 12.5002 7.8125C13.7434 7.8125 14.9357 8.30636 15.8148 9.18544C16.6938 10.0645 17.1877 11.2568 17.1877 12.5C17.1877 13.7432 16.6938 14.9355 15.8148 15.8146C14.9357 16.6936 13.7434 17.1875 12.5002 17.1875ZM12.5002 15.1042C13.1909 15.1042 13.8532 14.8298 14.3416 14.3414C14.83 13.853 15.1044 13.1907 15.1044 12.5C15.1044 11.8093 14.83 11.147 14.3416 10.6586C13.8532 10.1702 13.1909 9.89583 12.5002 9.89583C11.8095 9.89583 11.1471 10.1702 10.6588 10.6586C10.1704 11.147 9.89603 11.8093 9.89603 12.5C9.89603 13.1907 10.1704 13.853 10.6588 14.3414C11.1471 14.8298 11.8095 15.1042 12.5002 15.1042Z" fill="#737373"/>
        </svg>
      </a>
      <a href="#"
        onclick="<?= $row['pembayaran'] === 'Unpaid' ? 'showFeedbackPopup()' : 'openFeedback(' . $row['id'] . ')' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
            <path d="M20 2.58325C20.3582 2.58325 20.665 2.69428 20.9375 2.93188L21.0527 3.04224C21.3539 3.35611 21.5005 3.72189 21.5 4.16626V16.6663C21.5 17.0564 21.387 17.3856 21.1572 17.6721L21.0518 17.7922C20.7895 18.0659 20.4955 18.2117 20.1514 18.2434L20.001 18.2502H5.78711L5.63965 18.4036L3.33887 20.7991C3.23433 20.908 3.15135 20.9458 3.09082 20.9583C3.04616 20.9674 2.98607 20.969 2.9043 20.9446L2.81543 20.9104C2.68693 20.8532 2.61716 20.7872 2.57617 20.7219C2.53418 20.6549 2.49977 20.5524 2.5 20.3909V4.16626C2.50006 3.77653 2.61292 3.44811 2.84277 3.16235L2.94824 3.04224C3.2117 2.76827 3.50679 2.62252 3.85059 2.59009L4.00098 2.58325H20ZM3.5 19.0618L4.35645 18.1887L5.36035 17.1663H20.5V3.66626H3.5V19.0618ZM12 14.0413C12.1504 14.0413 12.2561 14.0882 12.3506 14.1868C12.4231 14.2626 12.4709 14.3502 12.4902 14.4631L12.5 14.5842C12.5004 14.758 12.4489 14.8784 12.3525 14.9788C12.281 15.0532 12.2033 15.0986 12.1055 15.1165L12 15.1252H11.9971C11.8502 15.1259 11.7447 15.08 11.6484 14.9797C11.5755 14.9038 11.5287 14.8169 11.5098 14.7053L11.5 14.5842C11.5004 14.4092 11.5529 14.2877 11.6494 14.1868C11.7439 14.0882 11.8496 14.0413 12 14.0413ZM11.999 5.70825C12.1492 5.70867 12.2559 5.7556 12.3516 5.85474C12.4474 5.95426 12.5 6.07501 12.5 6.25024V10.4172C12.5004 10.5909 12.4488 10.7114 12.3525 10.8118C12.2811 10.8862 12.2032 10.9316 12.1055 10.9495L12 10.9583H11.999C11.8871 10.9585 11.7996 10.9322 11.7227 10.8772L11.6484 10.8127C11.5522 10.7123 11.5 10.5913 11.5 10.4163V6.25024C11.5 6.12049 11.5294 6.01989 11.585 5.93481L11.6494 5.85376C11.7209 5.77908 11.798 5.7346 11.8945 5.71704L11.999 5.70825Z" fill="#737373" stroke="#737373"/>
        </svg>
      </a>
    </div>
  </td>
</tr>
<?php endwhile; ?>

</tbody>
</table>
</div>
</div>
</div>

<!-- Popup gagal kirim feedback -->
<div id="feedback-popup" class="fixed top-1/2 left-full transform -translate-y-1/2 opacity-0 bg-white shadow-lg rounded-2xl p-6 w-80 z-50 transition-all duration-500">
  <div class="flex flex-col items-start gap-3 mb-4">
    <div class="w-14 h-14 rounded-full bg-[#FEF3F2] flex items-center justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M12 8V12M12 16H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#BC3638" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    <h4 class="text-base font-semibold text-[#1D2939] m-0">Sorry</h4>
  </div>
  <p class="text-sm text-[#667085] mb-4">You cannot submit feedback unless the order is paid</p>
  <button onclick="hideFeedbackPopup()" class="bg-[#D92D20] hover:bg-[#C5291A] text-white py-2 px-4 w-full rounded-lg text-sm font-medium">Confirm</button>
</div>

<!-- Feedback Form -->
<div id="feedbackModal" class="modal">
  <div class="modal-content">
    <form method="POST">
      <input type="hidden" id="id_pesanan" name="id_pesanan">

      <h2 class="text-xl font-semibold text-center">Session Feedback</h2>
      <h3 class="text-sm text-center text-gray-600 mb-4">Please give your feedback</h3>

      <label for="feedback" class="text-xs font-medium text-gray-500 mb-1 block">Feedback</label>

      <textarea name="feedback" rows="4" required class="w-full border border-gray-300 rounded p-2 mb-4" placeholder="Write your feedback..."></textarea>

      <div class="flex gap-4">
        <button type="button" onclick="closeFeedback()" class="w-1/2 text-white px-4 py-2 rounded-[8px]" style="background-color: #BC3638;">Cancel</button>
        <button type="submit" name="submit_feedback" class="w-1/2  text-white px-4 py-2 rounded-[8px]" style="background-color: #21B7E2;">Submit</button>
      </div>
    </form>
  </div>
</div>
<!-- Popout Feedback Success -->
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
          <p class="text-sm text-[#667085] mb-4">You have given feedback</p>
          <button onclick="hideSuccessPopup()" class="bg-[#21B7E2] text-white py-2 px-4 w-full rounded-lg text-sm font-medium">Confirm</button>
        </div>

</main>
<?php if ($feedbackSuccess): ?>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    showSuccessPopup();
  });
</script>
<?php endif; ?>

<script>
function showFeedbackPopup() {
  const popup = document.getElementById('feedback-popup');
  popup.classList.remove('opacity-0');
  popup.classList.add('opacity-100');
  popup.style.left = '50%';
  popup.style.transform = 'translate(-50%, -50%)';

  setTimeout(hideFeedbackPopup, 3000);
}

function hideFeedbackPopup() {
  const popup = document.getElementById('feedback-popup');
  popup.classList.remove('opacity-100');
  popup.classList.add('opacity-0');
  popup.style.left = '100%';
  popup.style.transform = 'translateY(-50%)';
}

function showSuccessPopup() {
  const popup = document.getElementById('success-popup');
  popup.classList.remove('opacity-0');
  popup.classList.add('opacity-100');
  popup.style.left = '50%';
  popup.style.transform = 'translate(-50%, -50%)';

  setTimeout(hideSuccessPopup, 3000);
}

function hideSuccessPopup() {
  const popup = document.getElementById('success-popup');
  popup.classList.remove('opacity-100');
  popup.classList.add('opacity-0');
  popup.style.left = '100%';
  popup.style.transform = 'translateY(-50%)';
}

function openFeedback(id) {
  document.getElementById('id_pesanan').value = id;
  document.getElementById('feedbackModal').style.display = 'block';
}

function closeFeedback() {
  document.getElementById('feedbackModal').style.display = 'none';
}
</script>

</body>
</html>

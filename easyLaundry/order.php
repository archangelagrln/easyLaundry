<?php
session_start();
if ($_SESSION['role'] !== 'pelanggan') {
  header("Location: login.php?pesan=akses_ditolak");
  exit;
}

$success = isset($_GET['success']) && $_GET['success'] === 'true';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Order</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="16x16" href="gambar/android-chrome-512x512.png">
  <style>
    body {
      background-color: #f9f9f9;
      font-family: 'Rubik';
      margin: 0;
    }
   
    .order-form-container {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 16px;
      padding: 40px 30px;
      max-width: 850px;
      margin: 0 auto;
    }
    .form-control,
    .form-select {
      border-radius: 30px;
      padding: 12px 20px;
      font-size: 15px;
    }
    .form-label {
      font-weight: 500;
      margin-bottom: 6px;
    }
    .form-check-input {
      margin-top: 6px;
    }
    .form-check-label {
      font-weight: 500;
      margin-left: 8px;
    }
    .form-check-label small {
      font-weight: normal;
      color: #888;
    }
    .btn-order {
      background-color: #21b7e2;
      border: none;
      border-radius: 10px;
      padding: 10px 40px;
      color: white;
      font-weight: 600;
      font-size: 16px;
    }
    .btn-order:hover {
      background-color: #1aa4c7;
      color: white;
    }
    @media (max-width: 768px) {
      .main {
        margin-left: 0;
        padding: 30px 20px;
      }
    }
    .btn-order:active {
    background-color: #1aa4c7 !important;
    color: white !important;
    box-shadow: none;
    }

  </style>
</head>
<body class="flex bg-gray-50 min-h-screen">

<?php include 'sidebar.php'; ?>
 
  <div class="ml-[3%] w-[80%] max-h-screen overflow-y-auto p-10">
    <h2 class="text-center text-info fw-bold mb-4" style="font-size: 33px;">Create Order</h2>
    <div class="order-form-container">
      <form action="input_order.php" method="POST">
        <div class="mb-4">
          <label for="customer" class="form-label">Customer Name</label>
          <input type="text" class="form-control" id="customer" name="customer" placeholder="Enter name" required>
        </div>

        <div class="mb-4">
          <label for="service" class="form-label">Services</label>
          <select class="form-select" id="service" name="service" required>
            <option selected disabled>Select a service</option>
            <option value="Washing & Iron">Washing & Iron</option>
            <option value="Washing & Folding">Washing & Folding</option>
            <option value="Iron">Iron</option>
            <option value="Washing">Washing</option>
            <option value="Express Wash">Express Wash</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="qty" class="form-label">Quantity</label>
          <input type="number" class="form-control" id="qty" name="qty" placeholder="Enter quantity (kg)" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-4">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="08xxxxxxxxxx" required>
          </div>
          <div class="col-md-6 mb-4">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label">Parfume</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="parfume" id="lavender" value="Lavender Fresh" required>
            <label class="form-check-label" for="lavender">
              Lavender Fresh<br><small>The soft and soothing scent of lavender flowers.</small>
            </label>
          </div>
          <div class="form-check mt-3">
            <input class="form-check-input" type="radio" name="parfume" id="vanilla" value="Sweet Vanilla">
            <label class="form-check-label" for="vanilla">
              Sweet Vanilla<br><small>Sweet and creamy like vanilla.</small>
            </label>
          </div>
          <div class="form-check mt-3">
            <input class="form-check-input" type="radio" name="parfume" id="floral" value="Floral Garden">
            <label class="form-check-label" for="floral">
              Floral Garden<br><small>An elegant combination of rose, jasmine, and lily scents.</small>
            </label>
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-order">Order</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Popout Order Success -->
        <div id="order-success-popup" class="fixed top-1/2 left-full transform -translate-y-1/2 opacity-0 bg-white shadow-lg rounded-2xl p-6 w-80 z-50 transition-all duration-500">
          <div class="flex flex-col items-start gap-3 mb-4">
            <div class="w-14 h-14 rounded-full bg-[#ECFDF3] flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path fill="#D1FADF" d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20Z"/>
                <path stroke="#12B76A" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 12 2.5 2.5L16 9"/>
              </svg>
            </div>
            <h4 class="text-base font-semibold text-[#1D2939] m-0">Success</h4>
          </div>
          <p class="text-sm text-[#667085] mb-4">Your order has been successfully placed</p>
          <button onclick="hideOrderSuccessPopup()" class="bg-[#21B7E2] text-white py-2 px-4 w-full rounded-lg text-sm font-medium">Confirm</button>
        </div>
  
</div>
<script>
  if (window.location.search.includes('success=true')) {
      window.onload = () => {
      const popup = document.getElementById('order-success-popup');
      popup.classList.remove('opacity-0');
      popup.classList.add('opacity-100');
      popup.style.left = '50%';
      popup.style.transform = 'translate(-50%, -50%)';

      setTimeout(() => {
        hideOrderSuccessPopup();
      }, 3000);
    };
  }

  function hideOrderSuccessPopup() {
    const popup = document.getElementById('order-success-popup');
    popup.classList.remove('opacity-100');
    popup.classList.add('opacity-0');
    popup.style.left = '100%';
    popup.style.transform = 'translateY(-50%)';

    setTimeout(() => {
      const url = new URL(window.location);
      url.searchParams.delete('success');
      window.history.replaceState({}, document.title, url.pathname);
    }, 600);
  }
</script>

</body>
</html>

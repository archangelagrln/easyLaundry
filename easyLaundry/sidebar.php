<?php
  $current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" sizes="16x16" href="gambar/android-chrome-512x512.png">
<style>
:root {
    --gray-1: #333333;
    --primary-color-gray-10: #FFFFFF;
    --primary-color-gray-100: #202020;
    --primary-color-gray-90: #3F3F3F;
    --white: #FFFFFF;
    --blue: #21B7E2;
    --light-blue: #D0F6FF;
    --red: #F13E3E;
  }

.sidebar {
  width: 212px;
  background-color: var(--white);
  box-shadow: 1px 0px 2px rgba(128, 128, 128, 0.1);
  padding: 43px 36px;
  display: flex;
  flex-direction: column;
}

.logo {
  color: var(--blue);
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 48px;
}

nav h3 {
  color: var(--primary-color-gray-90);
  font-size: 16px;
  margin-bottom: 10px;
  font-weight: bold;
}

nav ul {
  list-style: none;
  padding: 0;
}

nav ul li {
  margin-bottom: 12px;
}

nav ul li a {
  display: flex;
  align-items: center;
  gap: 12px;
  color: var(--primary-color-gray-100);
  text-decoration: none;
  font-size: 16px;
  padding: 10px 14px;
  border-radius: 10px;
  transition: background-color 0.2s ease, color 0.2s ease;
}

nav ul li a:hover {
  background-color: #EFF6FF;
  color: var(--blue);
}

nav ul li.active a {
  background-color: #EFF6FF;
  color: var(--blue);
}

.icon {
  width: 20px;
  height: 20px;
}

.logout {
  margin-top: auto;
  padding-top: 30px;
}

.logout a {
  display: flex;
  align-items: center;
  gap: 12px;
  color: var(--red);
  text-decoration: none;
}
</style>
<body>
<aside class="sidebar">
  <div class="logo">easyLaundry</div>
  <nav>
    <h3>OVERVIEW</h3>
    <ul>
      <li class="<?= $current_page == 'dashboardpelanggan.php' ? 'active' : '' ?>">
        <a href="dashboardpelanggan.php">
        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 12.5V10.5" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.71343 2.37998L2.09343 6.07998C1.57343 6.49331 1.2401 7.36665 1.35343 8.01998L2.2401 13.3266C2.4001 14.2733 3.30676 15.04 4.26676 15.04H11.7334C12.6868 15.04 13.6001 14.2666 13.7601 13.3266L14.6468 8.01998C14.7534 7.36665 14.4201 6.49331 13.9068 6.07998L9.28676 2.38665C8.57343 1.81331 7.4201 1.81331 6.71343 2.37998Z" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
          Dashboard
        </a>
      </li>
      <li class="<?= $current_page == 'order.php' ? 'active' : '' ?>">
        <a href="order.php">
        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 1.83325V6.49992L9.33333 5.16659" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.00008 6.50008L6.66675 5.16675" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M1.32007 9.16675H4.26007C4.5134 9.16675 4.74007 9.30675 4.8534 9.53341L5.6334 11.0934C5.86007 11.5467 6.32007 11.8334 6.82674 11.8334H9.18007C9.68674 11.8334 10.1467 11.5467 10.3734 11.0934L11.1534 9.53341C11.2667 9.30675 11.5001 9.16675 11.7467 9.16675H14.6534" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M4.66659 3.25342C2.30659 3.60008 1.33325 4.98675 1.33325 7.83342V10.5001C1.33325 13.8334 2.66659 15.1668 5.99992 15.1668H9.99992C13.3333 15.1668 14.6666 13.8334 14.6666 10.5001V7.83342C14.6666 4.98675 13.6933 3.60008 11.3333 3.25342" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
          Order
        </a>
      </li>
      <li class="<?= $current_page == 'riwayat.php' ? 'active' : '' ?>">
        <a href="riwayat.php">
        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.4466 10.0333L14.1799 13.3666C14.0799 14.3866 13.9999 15.1666 12.1933 15.1666H3.80659C1.99993 15.1666 1.91993 14.3866 1.81993 13.3666L1.55326 10.0333C1.49993 9.47992 1.67326 8.96659 1.98659 8.57325C1.99326 8.56659 1.99326 8.56659 1.99993 8.55992C2.36659 8.11325 2.91993 7.83325 3.53993 7.83325H12.4599C13.0799 7.83325 13.6266 8.11325 13.9866 8.54659C13.9933 8.55325 13.9999 8.55992 13.9999 8.56659C14.3266 8.95992 14.5066 9.47325 14.4466 10.0333Z" stroke="#202020" stroke-width="1.5" stroke-miterlimit="10"/>
            <path d="M2.33325 8.11994V4.6866C2.33325 2.41994 2.89992 1.85327 5.16659 1.85327H6.01325C6.85992 1.85327 7.05325 2.1066 7.37325 2.53327L8.21992 3.6666C8.43325 3.9466 8.55992 4.11994 9.12659 4.11994H10.8266C13.0933 4.11994 13.6599 4.6866 13.6599 6.95327V8.1466" stroke="#202020" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.28662 11.8333H9.71329" stroke="#202020" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
          History
        </a>
      </li>
    </ul>
  </nav>
  <div class="logout">
    <a href="logout.php">
    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5.93335 5.54016C6.14002 3.14016 7.37335 2.16016 10.0733 2.16016H10.16C13.14 2.16016 14.3333 3.35349 14.3333 6.33349V10.6802C14.3333 13.6602 13.14 14.8535 10.16 14.8535H10.0733C7.39335 14.8535 6.16002 13.8868 5.94002 11.5268" stroke="#F13E3E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M10 8.5H2.41333" stroke="#F13E3E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M3.90008 6.2666L1.66675 8.49994L3.90008 10.7333" stroke="#F13E3E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
      Logout
    </a>
  </div>
</aside>
</body>
</html>


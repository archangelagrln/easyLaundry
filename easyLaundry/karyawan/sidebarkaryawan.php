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
<link rel="icon" type="image/png" sizes="16x16" href="../gambar/android-chrome-512x512.png">
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
      <li class="<?= $current_page == 'dashboard_karyawan.php' ? 'active' : '' ?>">
        <a href="dashboard_karyawan.php">
        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 12.5V10.5" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.71343 2.37998L2.09343 6.07998C1.57343 6.49331 1.2401 7.36665 1.35343 8.01998L2.2401 13.3266C2.4001 14.2733 3.30676 15.04 4.26676 15.04H11.7334C12.6868 15.04 13.6001 14.2666 13.7601 13.3266L14.6468 8.01998C14.7534 7.36665 14.4201 6.49331 13.9068 6.07998L9.28676 2.38665C8.57343 1.81331 7.4201 1.81331 6.71343 2.37998Z" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
          Dashboard
        </a>
      </li>
      <li class="<?= $current_page == 'verifikasi.php' ? 'active' : '' ?>">
        <a href="verifikasi.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
            <path d="M7.66669 11.5002C7.66669 11.5002 8.33335 11.5002 9.00002 12.8335C9.00002 12.8335 11.118 9.50016 13 8.8335" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.33333 14.1668H6.15133C3.978 14.1668 2.89 14.1668 2.13533 13.6348C1.92057 13.4842 1.7286 13.3035 1.56533 13.0982C1 12.3875 1 11.3648 1 9.31816V7.6215C1 5.64616 1 4.65816 1.31267 3.8695C1.81533 2.60083 2.878 1.60083 4.226 1.1275C5.06333 0.833496 6.112 0.833496 8.212 0.833496C9.41067 0.833496 10.0107 0.833496 10.4893 1.0015C11.2593 1.27216 11.8667 1.8435 12.154 2.56816C12.3333 3.01883 12.3333 3.5835 12.3333 4.71216V6.16683" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M1 7.50016C1 6.91085 1.2341 6.34568 1.65081 5.92897C2.06751 5.51227 2.63269 5.27816 3.222 5.27816C3.666 5.27816 4.18933 5.3555 4.62067 5.24016C4.80914 5.18944 4.98097 5.09006 5.11892 4.95199C5.25687 4.81392 5.3561 4.64201 5.40667 4.4535C5.522 4.02216 5.44467 3.49883 5.44467 3.05483C5.44484 2.46563 5.67902 1.90063 6.09571 1.48407C6.5124 1.06751 7.07747 0.833496 7.66667 0.833496" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
          Verification
        </a>
      </li>
      <li class="<?= $current_page == 'status.php' ? 'active' : '' ?>">
        <a href="status.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
            <path d="M8.24664 6.41992H11.7466" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M4.25336 6.41992L4.75336 6.91992L6.25336 5.41992" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.24664 11.0864H11.7466" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M4.25336 11.0864L4.75336 11.5864L6.25336 10.0864" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M5.99998 15.1668H9.99998C13.3333 15.1668 14.6666 13.8335 14.6666 10.5002V6.50016C14.6666 3.16683 13.3333 1.8335 9.99998 1.8335H5.99998C2.66665 1.8335 1.33331 3.16683 1.33331 6.50016V10.5002C1.33331 13.8335 2.66665 15.1668 5.99998 15.1668Z" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
          Status
        </a>
      </li>
    </ul>
  </nav>
  <div class="logout">
    <a href="../logout.php">
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


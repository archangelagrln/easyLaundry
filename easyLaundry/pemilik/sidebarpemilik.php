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
  font-size: 15px;
  padding: 10px 14px;
  border-radius: 10px;
  transition: background-color 0.2s ease, color 0.2s ease;
}

nav ul li .submenu {
  display: none;
  margin-left: 28px;
  margin-top: 4px;
}

nav ul li.active .submenu {
  display: block;
}

/* override lagi kalau perlu */
nav ul li .submenu a {
  background-color: white !important;
  color: black !important;
}

nav ul li .submenu a:hover {
 background-color: #f5f5f5; /* abu muda saat hover */
  color: var(--primary-color-gray-100); /* tetap hitam saat hover */
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
      <li class="<?= $current_page == 'dashboardpemilik.php' ? 'active' : '' ?>">
        <a href="dashboardpemilik.php">
        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 12.5V10.5" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.71343 2.37998L2.09343 6.07998C1.57343 6.49331 1.2401 7.36665 1.35343 8.01998L2.2401 13.3266C2.4001 14.2733 3.30676 15.04 4.26676 15.04H11.7334C12.6868 15.04 13.6001 14.2666 13.7601 13.3266L14.6468 8.01998C14.7534 7.36665 14.4201 6.49331 13.9068 6.07998L9.28676 2.38665C8.57343 1.81331 7.4201 1.81331 6.71343 2.37998Z" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
          Dashboard
        </a>
      </li>
      <li class="<?= $current_page == 'pengeluaran.php' ? 'active' : '' ?>">
        <a href="pengeluaran.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
          <path d="M11.7333 11.6998H13.3333V10.0998M11.7333 5.29984H13.3333V6.89984M4.26666 5.29984H2.66666V6.89984M2.66666 10.0998V11.6998H4.26666M7.99999 10.6332C7.4342 10.6332 6.89157 10.4084 6.4915 10.0083C6.09142 9.60825 5.86666 9.06563 5.86666 8.49984C5.86666 7.93404 6.09142 7.39142 6.4915 6.99134C6.89157 6.59126 7.4342 6.3665 7.99999 6.3665C8.56579 6.3665 9.10841 6.59126 9.50849 6.99134C9.90856 7.39142 10.1333 7.93404 10.1333 8.49984C10.1333 9.06563 9.90856 9.60825 9.50849 10.0083C9.10841 10.4084 8.56579 10.6332 7.99999 10.6332ZM1.59999 3.1665H14.4C14.6829 3.1665 14.9542 3.27888 15.1542 3.47892C15.3543 3.67896 15.4667 3.95027 15.4667 4.23317V12.7665C15.4667 13.0494 15.3543 13.3207 15.1542 13.5208C14.9542 13.7208 14.6829 13.8332 14.4 13.8332H1.59999C1.31709 13.8332 1.04578 13.7208 0.845745 13.5208C0.645706 13.3207 0.533325 13.0494 0.533325 12.7665V4.23317C0.533325 3.95027 0.645706 3.67896 0.845745 3.47892C1.04578 3.27888 1.31709 3.1665 1.59999 3.1665Z" stroke="#202020"/>
        </svg>
          Expenses
        </a>
      </li>
      <li class="<?= in_array($current_page, ['laporankeuangan.php', 'laporanpesanan.php']) ? 'active' : '' ?>">
        <a href="#" onclick="event.preventDefault(); this.parentElement.classList.toggle('active');">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none">
                <path d="M12.0626 2.8125H11.967V3.9375H12.0626C12.2118 3.9375 12.3548 3.99676 12.4603 4.10225C12.5658 4.20774 12.6251 4.35082 12.6251 4.5V15.75C12.6251 15.8992 12.5658 16.0423 12.4603 16.1477C12.3548 16.2532 12.2118 16.3125 12.0626 16.3125H1.93751C1.78833 16.3125 1.64525 16.2532 1.53976 16.1477C1.43427 16.0423 1.37501 15.8992 1.37501 15.75V4.5C1.37501 4.35082 1.43427 4.20774 1.53976 4.10225C1.64525 3.99676 1.78833 3.9375 1.93751 3.9375H2.03314V2.8125H1.93751C1.48996 2.8125 1.06073 2.99029 0.744261 3.30676C0.427791 3.62322 0.25 4.05245 0.25 4.5V15.75C0.25 16.1976 0.427791 16.6268 0.744261 16.9432C1.06073 17.2597 1.48996 17.4375 1.93751 17.4375H12.0626C12.5101 17.4375 12.9394 17.2597 13.2558 16.9432C13.5723 16.6268 13.7501 16.1976 13.7501 15.75V4.5C13.7501 4.05245 13.5723 3.62322 13.2558 3.30676C12.9394 2.99029 12.5101 2.8125 12.0626 2.8125Z" fill="black"/>
                <path d="M10.9376 1.6875H9.25004V0H4.75001V1.6875H3.0625V5.0625H10.9376V1.6875ZM9.81255 3.9375H4.18751V2.8125H5.87502V1.125H8.12504V2.8125H9.81255V3.9375Z" fill="black"/>
                <path d="M3.625 7.3125H10.375V8.4375H3.625V7.3125ZM3.625 10.125H10.375V11.25H3.625V10.125ZM3.625 12.9375H10.375V14.0625H3.625V12.9375Z" fill="black"/>
            </svg>
            Report
            <svg style="margin-left:auto;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none"><path d="M4.75 5.25 7 7.5l2.25-2.25" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <div class="submenu">
            <a href="laporankeuangan.php" class="<?= $current_page == 'laporankeuangan.php' ?  : '' ?>">Financial Report</a>
            <a href="laporanpesanan.php" class="<?= $current_page == 'laporanpesanan.php' ?  : '' ?>">Order Report</a>
        </div>
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


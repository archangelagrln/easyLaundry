<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form login</title>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      background: #d0f6ff;
      font-family: 'rubik';
      padding: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      position: relative;
      overflow: hidden;
    }

    .form-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
      max-width: 400px;
      z-index: 2;
      margin-right: 200px;
    }

    .text-welcome {
        color: #000;
        text-shadow: 2px 4px 8px rgba(252, 226, 206, 0.20);
        font-family: 'rubik';
        font-size: 40px;
        font-weight: bold;
        margin-bottom: 60px;
        font-style: normal;
    }

    .input-group {
      position: relative;
      margin-bottom: 30px;
      width: 100%;
    }

    .input-inner {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 18px 16px;
      border-radius: 63px;
      border: 1px solid #888;
      background-color: #d0f6ff;
    }

    .input-group input {
      width: 100%;
      border: none;
      background: #d0f6ff;
      font-size: 16px;
      font-family: 'rubik';
      color: #333;
      outline: none;
    }

    .input-group input::placeholder {
      color: #aaa;
    }

    .input-group label {
      position: absolute;
      top: -10px;
      left: 50px;
      background: #d0f6ff;
      padding: 0 6px;
      font-weight: bold;
      color: #555;
      font-size: 14px;
      z-index: 1;
    }

    .icon-left {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .icon-right {
      position: absolute;
      top: 50%;
      right: 16px;
      transform: translateY(-50%);
      font-size: 18px;
      color: #aaa;
      cursor: pointer;
    }

    .login-btn {
      width: 100%;
      padding: 16px;
      border-radius: 63px;
      background-color: #21B7E2;
      font-family: 'rubik';
      color: white;
      font-size: 16px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-top: 40px;
    }

    .login-btn:hover {
      background-color:rgb(0, 217, 241);
    }

    .decor-shape {
      width: 550px;
      height: 939px;
      position: absolute;
      left: 1000px;
      top: 110px;
      background: #21B7E2;
      border-top-left-radius: 394px;
      border-top-right-radius: 394px;
      z-index: 0;
    }

    @media (max-width: 768px) {
      .decor-shape {
        display: none;
      }

      .form-container {
        padding: 0 20px;
        max-width: 90%;
      }
    }
  </style>
</head>

  <?php 
      if(isset($_GET['pesan'])) {
        if($_GET['pesan'] == "gagal") {
          echo "Login gagal! Email dan password salah!";
        } else if($_GET['pesan'] == "logout") {
          echo "Anda telah berhasil logout";
        } else if($_GET['pesan'] == "belum_login") {
          echo "Anda harus login untuk mengakses halaman";
        }
      }
    ?>

  <!-- Decorative Shape -->
  <div class="decor-shape"></div>

  <!-- Form -->
  <div class="form-container">
  <form class="form-container" action="proseslogin.php" method="POST">

  <?php 
      if(isset($_GET['pesan'])) {
        if($_GET['pesan'] == "gagal") {
          echo "Login gagal! Email dan password salah!";
        } else if($_GET['pesan'] == "logout") {
          echo "Anda telah berhasil logout";
        } else if($_GET['pesan'] == "belum_login") {
          echo "Anda harus login untuk mengakses halaman";
        }
      }
    ?>

  <div class="text-welcome">Welcome</div>
    <div class="input-group">
      <label for="username">Username</label>
      <div class="input-inner">
        <span class="icon-left">
          <!-- User SVG here -->
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 28 29" fill="none">
          <path d="M20.3443 26.0931H7.65568C6.88213 26.0931 6.14027 25.7858 5.59329 25.2388C5.0463 24.6918 4.73901 23.95 4.73901 23.1764V22.2116C4.73901 17.5811 8.89351 13.8116 14 13.8116C19.1065 13.8116 23.261 17.5787 23.261 22.2116V23.1764C23.261 23.95 22.9537 24.6918 22.4067 25.2388C21.8598 25.7858 21.1179 26.0931 20.3443 26.0931ZM14 14.9806C9.53635 14.9806 5.90568 18.2239 5.90568 22.2139V23.1787C5.90568 23.6429 6.09006 24.088 6.41824 24.4162C6.74643 24.7444 7.19155 24.9287 7.65568 24.9287H20.3443C20.8085 24.9287 21.2536 24.7444 21.5818 24.4162C21.91 24.088 22.0943 23.6429 22.0943 23.1787V22.2116C22.0943 18.2239 18.4637 14.9806 14 14.9806ZM14 12.0627C13.0945 12.063 12.2093 11.7947 11.4563 11.2918C10.7033 10.7889 10.1163 10.074 9.76966 9.23747C9.42298 8.40097 9.33216 7.48045 9.50867 6.59233C9.68518 5.70421 10.1211 4.88838 10.7613 4.24802C11.4015 3.60766 12.2172 3.17153 13.1053 2.99479C13.9934 2.81805 14.9139 2.90864 15.7505 3.25511C16.5871 3.60157 17.3021 4.18835 17.8052 4.94122C18.3083 5.69409 18.5768 6.57925 18.5768 7.48474C18.5759 8.69841 18.0935 9.86213 17.2354 10.7204C16.3773 11.5787 15.2137 12.0615 14 12.0627ZM14 4.07457C13.3252 4.07434 12.6655 4.27425 12.1043 4.649C11.5432 5.02375 11.1057 5.55652 10.8474 6.17991C10.5891 6.80329 10.5214 7.4893 10.653 8.15114C10.7846 8.81298 11.1095 9.42093 11.5867 9.89808C12.0638 10.3752 12.6718 10.7002 13.3336 10.8317C13.9955 10.9633 14.6815 10.8957 15.3048 10.6373C15.9282 10.379 16.461 9.94158 16.8358 9.38041C17.2105 8.81924 17.4104 8.15954 17.4102 7.48474C17.4093 6.58059 17.0497 5.71374 16.4103 5.07441C15.771 4.43508 14.9042 4.0755 14 4.07457Z" fill="#616161"/>
        </svg>
        </span>
        <input type="text" id="username" name="nama" placeholder="Enter your username" />
      </div>
    </div>

    <div class="input-group">
      <label for="password">Password</label>
      <div class="input-inner">
        <span class="icon-left">
          <!-- Lock SVG here -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 28 29" fill="none">
            <path d="M4.97913 22.4855C5.24149 24.4342 6.85551 25.9608 8.81962 26.0511C10.4723 26.127 12.1512 26.1667 14 26.1667C15.8488 26.1667 17.5277 26.127 19.1804 26.0511C21.1446 25.9608 22.7585 24.4342 23.0209 22.4855C23.1922 21.2138 23.3334 19.9105 23.3334 18.5833C23.3334 17.2561 23.1922 15.9529 23.0209 14.6812C22.7585 12.7325 21.1446 11.2059 19.1804 11.1156C17.5277 11.0396 15.8488 11 14 11C12.1512 11 10.4723 11.0396 8.81962 11.1156C6.85551 11.2059 5.24149 12.7325 4.97913 14.6812C4.80791 15.9529 4.66669 17.2561 4.66669 18.5833C4.66669 19.9105 4.80791 21.2138 4.97913 22.4855Z" stroke="#616161" stroke-width="1.75"/>
            <path d="M8.75 10.9999V8.08325C8.75 5.18376 11.1005 2.83325 14 2.83325C16.8995 2.83325 19.25 5.18376 19.25 8.08325V10.9999" stroke="#616161" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18.6667 18.5718V18.5834" stroke="#616161" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14 18.5718V18.5834" stroke="#616161" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9.33331 18.5718V18.5834" stroke="#616161" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        </span>
        <input type="password" id="password" name="password" placeholder="Enter your password" />
        <span class="icon-right" onclick="togglePassword()">
          <!-- Eye icon here -->
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 25" fill="none">
            <g opacity="0.8">
                <path d="M19.439 15.939C20.3636 15.0212 21.0775 14.1091 21.544 13.455C21.848 13.0287 22 12.8155 22 12.5C22 12.1845 21.848 11.9713 21.544 11.545C20.1779 9.62944 16.6892 5.5 12 5.5C11.0922 5.5 10.2294 5.65476 9.41827 5.91827M6.74742 7.24742C4.73118 8.6072 3.24215 10.4427 2.45604 11.545C2.15201 11.9713 2 12.1845 2 12.5C2 12.8155 2.15201 13.0287 2.45604 13.455C3.8221 15.3706 7.31078 19.5 12 19.5C13.9908 19.5 15.7651 18.7557 17.2526 17.7526" stroke="#9E9E9E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.85786 10.5C9.32783 11.03 9 11.7623 9 12.5711C9 14.1887 10.3113 15.5 11.9289 15.5C12.7377 15.5 13.47 15.1722 14 14.6421" stroke="#9E9E9E" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M3 3.5L21 21.5" stroke="#9E9E9E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
        </svg>
        </span>
      </div>
    </div>

    <button type= "submit" class="login-btn">Login</button>
    <p style="margin-top: 30px; font-family: 'rubik'; font-size: 14px; color: #555;">
        Don't have an account?
        <a href="registrasi.php" style="color: #21B7E2; text-decoration: none; font-weight: 500;">Sign up</a>
    </p>
  </div>
    </form>

  <script>
    function togglePassword() {
      const input = document.getElementById("password");
      input.type = input.type === "password" ? "text" : "password";
    }
  </script>

</body>
</html>
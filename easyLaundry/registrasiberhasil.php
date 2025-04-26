<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register Success</title>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      height: 100vh;
      background-color: #00b7e2;
      font-family: rubik;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .popup-container {
      max-width: 500px;
      width: 90%;
      text-align: center;
      background-color: #00b7e2;
      padding: 64px 24px;
      border-radius: 12px;
    }

    .check-icon {
      margin-bottom: 64px;
    }

    .check-icon img {
      width: 190px;
      height: auto;
      display: block;
      margin: 0 auto;
    }

    .title {
      font-size: 64px;
      font-weight: bold;
      margin-bottom: 12px;
    }

    .subtitle {
      font-size: 20px;
      margin-bottom: 64px;
    }

    .close-btn {
      padding: 12px 24px;
      font-size: 16px;
      background-color: white;
      color: #00b7e2;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .close-btn:hover {
      background-color: #e0e0e0;
    }

    @media (min-width: 768px) {
      .title {
        font-size: 32px;
      }

      .popup-container {
        padding: 96px 48px;
      }

      .subtitle {
        font-size: 18px;
      }
    }
  </style>
</head>
<body>
  <div class="popup-container">
    <div class="check-icon">
      <img src="gambar/berhasil_registrasi.png"/>
    </div>
    <div class="title">Register Successful</div>
    <div class="subtitle">Welcome! Your account has been created successfully</div>
    <button class="close-btn" onclick="window.location.href='login.php'">Close</button>
  </div>
</body>
</html>

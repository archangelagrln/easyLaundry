<?php
include 'koneksi.php';

$query = "
  SELECT feedback.isi, pelanggan.nama 
  FROM feedback 
  JOIN pelanggan ON feedback.id_pelanggan = pelanggan.id
";

$result = mysqli_query($connect, $query);
if (!$result) {
    die("Query error: " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Feedback</title>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="16x16" href="gambar/android-chrome-512x512.png">
  <style>
    body {
      font-family: 'Rubik';
      background-color: #f6f6f6;
      padding: 20px;
      margin: 0;
    }

    body {
    font-family: 'Rubik';
    background-color: #f6f6f6;
    margin: 0;
    padding: 0;
  }

  .page-layout {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
  }

  .back-button {
    align-self: flex-start;
    margin-bottom: 20px;
    margin-left: 16px;
  }

  .back-button svg {
    cursor: pointer;
  }

  .container {
    width: 100%;
    max-width: 1000px;
  }

    .feedback-box {
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .feedback-name {
      font-weight: bold;
      font-size: 16px;
      padding-bottom: 10px;
      border-bottom: 1px solid #ccc;
    }

    .feedback-text {
      margin-top: 10px;
      font-size: 15px;
      color: #333;
    }

    .back-button {
      margin-bottom: 20px;
    }

    .back-button svg {
      cursor: pointer;
    }

    @media (min-width: 768px) {
      .feedback-box {
        padding: 24px;
      }

      .feedback-name {
        font-size: 18px;
      }

      .feedback-text {
        font-size: 16px;
      }
    }
  </style>
</head>
<body>

  <div class="page-layout">
    <div class="back-button">
      <a href="landingpage.php">
       <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 55 55" fill="none">
        <path d="M25.52 15.8134L9.33337 32L25.52 48.1867" stroke="#202020" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M54.6666 32H9.78662" stroke="#202020" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      </a>
    </div>

    <div class="container">
      <?php while ($row = mysqli_fetch_array($result)) : ?>
        <div class="feedback-box">
          <div class="feedback-name"><?= htmlspecialchars($row['nama']) ?></div>
          <div class="feedback-text"><?= htmlspecialchars($row['isi']) ?></div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

</body>
</html>

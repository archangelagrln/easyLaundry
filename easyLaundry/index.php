<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>easyLaundry</title>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="16x16" href="gambar/android-chrome-512x512.png">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Rubik';
    }

    body {
      overflow-x: hidden;
    }

    header {
      position: fixed;
      top: 0;
      width: 100%;
      background: #fff;
      z-index: 1000;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 {
      color: #21b7e2;
      font-size: 1.5rem;
    }

    header a.button {
      background-color: #21b7e2;
      color: white;
      padding: 0.5rem 1rem;
      text-decoration: none;
      border-radius: 5px;
      font-weight: 500;
    }

    main {
      margin-top: 72px;
    }

    .hero {
      background: url('gambar/bg_banner.png') no-repeat center center/cover;
      height: 650px;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      padding: 0;
      margin-top: -72px;
    }

    .hero .text {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      max-width: 460px;
      margin: 0 3rem 0 0;
      height: 20rem;
    }

    .hero h2 {
      color: #21b7e2;
      font-size: 2.5rem;
      font-weight: 700;
      margin-top: 3.5rem;
    }

    .hero p {
      font-size: 1.05rem;
      color: #555;
      margin-top: 0.5rem;
    }

    .section-title {
      text-align: center;
      margin: 3rem 0 1rem;
      font-size: 2rem;
      font-weight: 700;
    }

    .section-sub {
      text-align: center;
      color: #21b7e2;
      font-size: 1.25rem;
      margin-bottom: 2rem;
    }

    .steps, .services, .testimonials {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: center;
      padding: 1rem;
    }

    .card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 1.5rem;
      flex: 1 1 250px;
      max-width: 300px;
    }

    .card h3 {
      color: #21b7e2;
      font-size: 1.25rem;
      margin-bottom: 0.5rem;
    }

    .card ul {
      list-style: none;
      padding-left: 1rem;
    }

    .card ul li::before {
      content: "\2713";
      color: #21b7e2;
      margin-right: 0.5rem;
    }

    .card .price {
      text-align: center;
      font-size: 1.25rem;
      font-weight: 700;
      margin-top: 1rem;
    }

    .why-choose {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      gap: 2rem;
      padding: 1rem;
    }

    .why-choose .features {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
    }

    footer {
      background: #f5f5f5;
      padding: 2rem;
      text-align: center;
      font-size: 0.9rem;
      color: #555;
    }
      .how-it-works {
      padding: 3rem 1rem;
      background-color: #ffffff;
    }

    .how-it-works .steps {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 2rem;
    }

    .step-card {
      background: white;
      padding: 1.25rem 1rem;
      border-radius: 20px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.1);
      text-align: center;
      width: 220px;
      height: 320.929px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: start;
    }

    .step-card .step {
      color: #21b7e2;
      font-weight: 500;
      font-size: 0.9rem;
    }

    .step-card h4 {
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 0.25rem;
    }

    .step-card img.step-icon {
      width: 90px;
      height: 90px;
      margin-top: 3rem;
      margin-bottom: 1rem;
    }

    .step-card p {
      font-size: 0.85rem;
      color: #333;
      line-height: 1.4;
      padding: 0 0.5rem;
      margin-top: 0.75rem;
    }

  .services-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: start;
  gap: 2rem 2rem;
  max-width: 1024px;
  margin: 0 auto;
  height: 100%;
}

.services-grid .service-card:nth-child(4),
.services-grid .service-card:nth-child(5) {
  grid-column: span 1;
  justify-self: center;
}

.service-card {
  background: white;
  border-radius: 20px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  padding: 1.5rem;
  text-align: left;
  display: flex;
  flex-direction: column;
  justify-content: start;
  width: 260px;
  height: 380px; 
  position: relative;
}

.service-card h3 {
  color: #21b7e2;
  font-size: 1rem;
  font-weight: 700;
  text-align: center;
  margin-bottom: 0.75rem;
}

.subtitle {
  font-size: 0.9rem;
  font-weight: normal;
  color: #00000080; 
  margin-top: 0.25rem;
  margin-bottom: 0.75rem;
  text-align: left;
}

hr.dotted {
  border: none;
  border-top: 1px dotted #999;
  margin: 0.5rem 0 1rem;
}

.service-card ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  align-items: start;
  flex-grow: 1;
  min-height: 120px; 
}

.service-card ul li {
  display: flex;
  align-items: center;
  font-size: 0.85rem;
  color: #333;
  line-height: 2.0;

}

.service-card ul li img {
  width: 16px;
  height: 16px;
  margin-right: 0.5rem;
}

.divider {
  width: 90%;
  display: block;
  margin: 0 auto 3.0rem auto;
  object-fit: contain;
}

.service-card .price {
  font-weight: bold;
  font-size: 1.5rem; 
  text-align: left;
  margin-top: 1rem;
  margin-bottom: 1rem;
}

.section-title {
  font-size: 2.80rem;      
  font-weight: 700;        
  color: black;         
  text-align: center;
  margin-bottom: 2.45rem; 
  margin-top: 0; 
}

.why-choose-us {
  background-color: white;
  padding: 6rem 1rem;
  display: flex;
  justify-content: center;
}

.choose-container {
  max-width: 1024px;
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  align-items: center;
  justify-content: center;
  gap: 5rem; 
  flex-wrap: wrap; 
}

.choose-image img {
  width: 350px;
  object-fit: cover;
}

.choose-content {
  max-width: 500px;
}

.choose-title {
  font-size: 1.8rem;
  font-weight: 700;
  color: #21b7e2;
  margin-bottom: 1.0rem;
}

.choose-subtitle {
  font-size: 0.95rem;
  color: #444;
  margin-bottom: 2.0rem;
}

.choose-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(150px, 1fr));
  gap: 1.5rem 10rem;
}

.choose-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 600;
  font-size: 0.95rem;
  
}

.choose-item img {
  width: 18px;
  height: 18px;
}

.testimonial-section {
  background-color: #d4f4fd;
  padding: 4rem 1rem;
  text-align: center;
}

.testimonial-header .subheading {
  color: #21b7e2;
  font-weight: 600;
  letter-spacing: 0.05em;
  font-size: 0.9rem;
  margin-bottom: 1rem;
}

.testimonial-header .main-heading {
  font-size: 2rem;
  font-weight: 800;
  color: #1e1e60;
  margin-bottom: 4.5rem;
}

.testimonial-cards {
  display: flex;
  flex-wrap: wrap;
  gap: 1.5rem;
  justify-content: center;
}

.testimonial-card {
  background: #fff;
  padding: 1.5rem;
  border-radius: 10px;
  border: 1px solid var(--Grey-1, #D1D1DC);
  width: 280px;
  text-align: left;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.testimonial-content {
  font-size: 0.95rem;
  color: #333;
  margin-bottom: 1rem;
}

.testimonial-author {
  padding-top: 1rem;
  border-top: 1px solid #ddd;
  font-weight: bold;
  color: #1e1e60; 
}

.view-more {
  margin-top: 2rem;
  margin-left: 51rem;

}

.view-more a {
  font-size: 0.9rem;
  color: #333;
  text-decoration: none;
}

.view-more a:hover {
  text-decoration: underline;
}

.footer {
  background-color: #fff;
  padding: 3rem 1rem;
  font-family: 'rubik';
  font-size: 0.9rem;
  color: #333;
}

.footer-container {
  display: flex;
  justify-content: flex-start;
  flex-wrap: wrap;
  max-width: 1100px;
  margin: 0 auto;
  gap: 1rem;
  height: 15rem;
}

.footer-column {
  flex: 1;
  min-width: 220px;
}

.company-info {
  flex: 2;
}

.footer-brand {
  font-size: 1.1rem;
  color: #21b7e2;
  font-weight: 700;
  margin-bottom: 0.8rem;
  text-align: left;
}

.footer-description {
  line-height: 1.6;
  color: #444;
  font-weight: 300;
  text-align: left;
  margin-top: 2rem;
}

.footer-heading {
  font-weight: bold;
  margin-bottom: 1rem;
  font-size: 1rem;
}

.footer-column ul {
  list-style: none;
  padding: 0;
  margin: 0;
 
}

.footer-column ul li {
  margin-bottom: 0.7rem;
}

.footer-column,
.footer-column ul,
.footer-column h4 {
  text-align: left;
  margin-left: 3rem;
}


.footer-column ul li a {
  text-decoration: none;
  color: #333;
  transition: color 0.3s;
}

.footer-column ul li a:hover {
  color: #21b7e2;
}

.footer-line {
  border: none;
  border-top: 1px solid #ddd;
  margin: 2rem auto 1rem;
  width: 90%;
}

.footer-bottom {
  text-align: center;
  font-size: 0.8rem;
  color: #777;
}

</style>

</style>
</head>
<body>
  <header>
    <h1>easyLaundry</h1>
    <a href="login.php" class="button">Login</a>
  </header>

  <main>
    <section class="hero">
      <div class="text">
        <h2>Laundry Today or <br>Naked Tomorrow</h2>
        <p>easyLaundry service will wash your clothes very clean at an affordable price.</p>
      </div>
    </section>

    <section class="how-it-works">
  <h2 class="section-title">HOW IT WORKS</h2>
  <p class="section-sub">Get it done in 4 steps</p>
  <div class="steps">
    <div class="step-card">
      <h4><span class="step">STEP 1</span><br>Order</h4>
      <img src="gambar/checklist.png" alt="Order Icon" class="step-icon">
      <p>Order laundry services, and drop off the clothes</p>
    </div>
    <div class="step-card">
      <h4><span class="step">STEP 2</span><br>Wash & Dry</h4>
      <img src="gambar/washing-machine.png" alt="Wash Icon" class="step-icon">
      <p>Clothes are washed, and then dried</p>
    </div>
    <div class="step-card">
      <h4><span class="step">STEP 3</span><br>Fold</h4>
      <img src="gambar/laundry-basket.png" alt="Fold Icon" class="step-icon">
      <p>The clothes will be neatly folded or ironed</p>
    </div>
    <div class="step-card">
      <h4><span class="step">STEP 4</span><br>Pickup</h4>
      <img src="gambar/clothes.png" alt="Pickup Icon" class="step-icon">
      <p>Pick up clothes directly at Victory Laundry</p>
    </div>
  </div>
</section>

<section class="services-section" style="background-color: #d4f4fd; padding: 4rem 1rem 3rem 1rem; display: flex; flex-direction: column; align-items: center;">
  <h2 class="section-title">Services</h2>
  <div class="services-grid">
        <div class="service-card">
        <h3>IRON</h3>
        <p class="subtitle">What's included</p>
        <ul>
            <li><img src="gambar/check-circle.png"> Ironing only</li>
            <li><img src="gambar/check-circle.png"> Neat & wrinkle free</li>
            <li><img src="gambar/check-circle.png"> Completed within 3 day</li>
            <li><img src="gambar/check-circle.png"> Perfume</li>
        </ul>
        <img src="gambar/divider.png" alt="divider" class="divider">
        <div class="price">Rp 5.000/kg</div>
        </div>

        <div class="service-card">
        <h3>WASHING & FOLDING</h3>
        <p class="subtitle">What's included</p>
        <ul>
            <li><img src="gambar/check-circle.png"> Washed clean</li>
            <li><img src="gambar/check-circle.png"> Folded neatly</li>
            <li><img src="gambar/check-circle.png"> Completed within 3 day</li>
            <li><img src="gambar/check-circle.png"> Perfume</li>
        </ul>
        <img src="gambar/divider.png" alt="divider" class="divider">
        <div class="price">Rp 5.000/kg</div>
        </div>

        <div class="service-card">
        <h3>WASHING & IRON</h3>
        <p class="subtitle">What's included</p>
        <ul>
            <li><img src="gambar/check-circle.png"> Washed</li>
            <li><img src="gambar/check-circle.png"> Completed within 3 day</li>
            <li><img src="gambar/check-circle.png"> Ironed</li>
            <li><img src="gambar/check-circle.png"> Perfume</li>
        </ul>
        <img src="gambar/divider.png" alt="divider" class="divider">
        <div class="price">Rp 6.000/kg</div>
        </div>

        <div class="service-card">
        <h3>WASH</h3>
        <p class="subtitle">What's included</p>
        <ul>
            <li><img src="gambar/check-circle.png"> Washed only</li>
            <li><img src="gambar/check-circle.png"> Completed within 3 day</li>
            <li><img src="gambar/check-circle.png"> Perfume</li>
        </ul>
        <img src="gambar/divider.png" alt="divider" class="divider">
        <div class="price">Rp 4.000/kg</div>
        </div>

        <div class="service-card">
        <h3>WASH EXPRESS</h3>
        <p class="subtitle">What's included</p>
        <ul>
        <li><img src="gambar/check-circle.png"> Fast Service</li>
        <li><img src="gambar/check-circle.png"> Priority Clothes</li>
        <li><img src="gambar/check-circle.png"> Completed within 1 day</li>
        <li><img src="gambar/check-circle.png"> Parfume</li>
        </ul>
        <img src="gambar/divider.png" alt="divider" class="divider">
        <div class="price">Rp 10.000/kg</div>
        </div>
    </div>
</section>

<section class="why-choose-us">
  <div class="choose-container">
    <div class="choose-image">
      <img src="gambar/image1.png" alt="Why Choose Us" />
    </div>
    <div class="choose-content">
      <h2 class="choose-title">Why Choose Us ?</h2>
      <p class="choose-subtitle">Cleaning with care, serving with heart.</p>
      <div class="choose-grid">
        <div class="choose-item">
          <img src="gambar/vector.png" alt="check" />
          <span>Professional</span>
        </div>
        <div class="choose-item">
          <img src="gambar/vector.png" alt="check" />
          <span>Affordable</span>
        </div>
        <div class="choose-item">
          <img src="gambar/vector.png" alt="check" />
          <span>Reliable</span>
        </div>
        <div class="choose-item">
          <img src="gambar/vector.png" alt="check" />
          <span>Fresh & Clean</span>
        </div>
        <div class="choose-item">
          <img src="gambar/vector.png" alt="check" />
          <span>Quick Service</span>
        </div>
        <div class="choose-item">
          <img src="gambar/vector.png" alt="check" />
          <span>Trustworthy</span>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include 'koneksi.php'; 

// Ambil 3 feedback terbaru beserta nama pelanggan
$query = "SELECT feedback.isi, pelanggan.nama 
          FROM feedback 
          JOIN pelanggan ON feedback.id_pelanggan = pelanggan.id 
          ORDER BY feedback.id_feedback DESC 
          LIMIT 3
          ";
$result = mysqli_query($connect, $query);
?>

<section class="testimonial-section">
  <div class="testimonial-header">
    <p class="subheading">OUR TESTIMONIAL</p>
    <h2 class="main-heading">Hear What Our Customers Say</h2>
  </div>

  <div class="testimonial-cards">
    <?php while($row = mysqli_fetch_assoc($result)) : ?>
      <div class="testimonial-card">
        <div class="testimonial-content">
          <?= htmlspecialchars($row['isi']) ?>
        </div>
        <div class="testimonial-author">
          <strong><?= htmlspecialchars($row['nama']) ?></strong>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <div class="view-more">
    <a href="feedback.php">view more</a>
  </div>
</section>

<footer class="footer">
  <div class="footer-container">
    <div class="footer-column company-info">
      <h3 class="footer-brand">easyLaundry</h3>
      <p class="footer-description">
        Reliable, Affordable, And Handled With Care – Laundry Made Simple, Just For You.
        Find Us At Jalan Swadaya Raya No 33 RT 09/RW 05, Duren Sawit – Jakarta Timur.
      </p>
    </div>
    <div class="footer-column">
      <h4 class="footer-heading">Links</h4>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Location</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h4 class="footer-heading">Services</h4>
      <ul>
        <li><a href="#">Washing & Iron</a></li>
        <li><a href="#">Washing & Folding</a></li>
        <li><a href="#">Wash</a></li>
        <li><a href="#">Express Wash</a></li>
      </ul>
    </div>
  </div>
  <hr class="footer-line">
  <p class="footer-bottom">&copy; 2025 All right policy reserved</p>
</footer>


<!-- (Remaining sections stay the same) -->
  </main>

</body>
</html>

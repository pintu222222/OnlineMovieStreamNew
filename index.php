<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FmDiaries - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
      color: white;
    }

    .navbar-brand img {
      height: 60px;
    }

    .navbar-nav .nav-link {
      font-size: 1.1rem;
      margin-right: 15px;
      color: white;
    }

    .navbar-nav .nav-link:hover {
      color: #f7b733;
      border-bottom: 2px solid #f7b733;
    }

    .hero {
      height: 90vh;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
      animation: fadeIn 2s ease-in-out;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .hero .btn-lg {
      background-color: #f7b733;
      color: white;
      font-weight: bold;
      padding: 12px 30px;
      border-radius: 50px;
      transition: background-color 0.3s;
    }

    .hero .btn-lg:hover {
      background-color: #fc4a1a;
    }

    .features {
      padding: 60px 0;
      background-color: #1e2d3b;
    }

    .features h2 {
      text-align: center;
      margin-bottom: 50px;
      font-size: 2.5rem;
    }

    .features h2::after {
      content: '';
      width: 100px;
      height: 4px;
      background: #f7b733;
      display: block;
      margin: 15px auto 0;
    }

    .card {
      background-color: rgba(255, 255, 255, 0.12);
      border: none;
      color: white;
      transition: transform 0.3s ease;
      backdrop-filter: blur(10px);
      padding: 20px;
      border-radius: 10px;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card i {
      font-size: 2.5rem;
      margin-bottom: 20px;
      color: #f7b733;
    }

    footer {
      background-color: #000;
      padding: 20px 0;
      text-align: center;
      color: white;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a href="index.php" class="navbar-brand d-flex align-items-center">
      <img src="images/logo.png" alt="FmDiaries Logo">
      <span class="fw-bold ms-2">FmDiaries</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="#services_section" class="nav-link">Services</a></li>
        <?php if (isset($_SESSION['id'])): ?>
          <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
        <?php else: ?>
          <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <h1 class="text-white">Watch Anywhere,<br>Watch Anytime...</h1>
  <a href="signup.php" class="btn btn-lg mt-3">Register Now</a>
</section>

<!-- Services Section -->
<section id="services_section" class="features">
  <div class="container">
    <h2>Our Services</h2>
    <div class="row g-4">
      <!-- Free Movie Previews -->
      <div class="col-lg-4 col-md-6">
        <div class="card text-center">
          <i class="bi bi-camera-reels-fill"></i>
          <h4>Free Movie Previews</h4>
          <ul class="text-start mt-3">
            <li><strong>Trailers:</strong> High-quality official trailers.</li>
            <li><strong>Clips:</strong> Short, exciting highlight scenes.</li>
            <li><strong>Teasers:</strong> 30-sec hover previews.</li>
            <li><strong>BTS:</strong> Behind-the-scenes footage.</li>
            <li><strong>Interactive:</strong> Choose your preview style.</li>
            <li><strong>User Reviews:</strong> Real user mini-reviews.</li>
          </ul>
        </div>
      </div>

      <!-- Multi-Device Streaming -->
      <div class="col-lg-4 col-md-6">
        <div class="card text-center">
          <i class="bi bi-pc-display-horizontal"></i>
          <h4>Multi-Device Streaming</h4>
          <ul class="text-start mt-3">
            <li>Cross-platform apps (TV, mobile, desktop)</li>
            <li>Responsive website design</li>
            <li>Adaptive streaming quality</li>
            <li>Progress sync across devices</li>
            <li>Chromecast & AirPlay support</li>
          </ul>
        </div>
      </div>

      <!-- Ad-Supported Free Streaming -->
      <div class="col-lg-4 col-md-6 mx-md-auto">
        <div class="card text-center">
          <i class="bi bi-badge-ad-fill"></i>
          <h4>Ad-Supported Streaming</h4>
          <ul class="text-start mt-3">
            <li>Non-intrusive pre/mid/post-roll ads</li>
            <li>Smart, behavior-based targeting</li>
            <li>Skip-ad options for users</li>
            <li>Optional ad-free upgrade</li>
            <li>Brand-sponsored content</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  <div>© 2025 FmDiaries. All Rights Reserved.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

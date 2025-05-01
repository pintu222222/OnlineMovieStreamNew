<?php
session_start();
if (isset($_SESSION['id'])) {
  header("Location: dashboard.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FmDiaries - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('images/back.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
    }
    .navbar-brand img {
      height: 50px;
    }
    .login-card {
      backdrop-filter: blur(8px);
      background: rgba(0, 0, 0, 0.5);
      border: none;
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      max-width: 400px;
      width: 100%;
      color: #fff;
    }
    .form-control {
      border-radius: 0.5rem;
      background-color: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.3);
      color: #fff;
    }
    .form-control::placeholder {
      color: #ddd;
    }
    .btn-login {
      background: linear-gradient(135deg, #f7b733, #fc4a1a);
      border: none;
      border-radius: 2rem;
      padding: 0.75rem;
      font-size: 1rem;
      width: 100%;
      transition: 0.3s ease;
      color: #fff;
    }
    .btn-login:hover {
      background: linear-gradient(135deg, #fc4a1a, #f7b733);
    }
    footer {
      margin-top: auto;
      background-color: rgba(0,0,0,0.8);
      color: #ccc;
      text-align: center;
      padding: 1rem;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="index.php">
        <img src="images/logo.png" alt="Logo">
        <span class="ms-2 text-warning fw-bold">FmDiaries</span>
      </a>
      <div class="ms-auto">
        <a href="signup.php" class="btn btn-outline-warning">Sign Up</a>
      </div>
    </div>
  </nav>

  <div class="container flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="login-card">
      <h2 class="text-center mb-4">Login to Your Account</h2>
      <form action="Plogin.php" method="POST" novalidate class="needs-validation">
        <div class="mb-3">
          <input type="email" name="mail" class="form-control" placeholder="Username / Email" required>
          <div class="invalid-feedback">Please enter your email or username.</div>
        </div>
        <div class="mb-3">
          <input type="password" name="pass" class="form-control" placeholder="Password" required>
          <div class="invalid-feedback">Please enter your password.</div>
        </div>
        <div class="d-grid">
          <button type="submit" name="login" class="btn btn-login">Login</button>
        </div>
      </form>
    </div>
  </div>

  <footer>
    &copy; 2025 FmDiaries.com
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    (() => {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>
</body>
</html>

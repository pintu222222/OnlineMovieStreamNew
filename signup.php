<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FmDiaries - Sign Up</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('images/back.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .navbar {
      background-color: rgba(0, 0, 0, 0.8);
    }
    .navbar-brand img {
      height: 50px;
    }
    .navbar-brand span {
      color: #f7b733;
      font-size: 1.5rem;
      font-weight: bold;
      margin-left: 10px;
    }
    .card-register {
      backdrop-filter: blur(8px);
      background: rgba(0, 0, 0, 0.5);
      border: none;
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      max-width: 480px;
      width: 100%;
      margin: 2rem auto;
      color: #fff;
    }
    .form-control,
    .form-select {
      border-radius: 0.5rem;
      background-color: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.3);
      color: #fff;
    }
    .form-control::placeholder {
      color: #ddd;
    }
    .form-select option {
      color: #000;
      background-color: #fff;
    }
    .form-control:focus,
    .form-select:focus {
      outline: none;
      border-color: #f7b733;
      box-shadow: 0 0 5px rgba(247, 183, 51, 0.5);
    }
    .btn-submit {
      background: linear-gradient(135deg, #f7b733, #fc4a1a);
      border: none;
      border-radius: 2rem;
      padding: 0.75rem;
      font-size: 1.1rem;
      width: 100%;
      transition: 0.3s ease;
    }
    .btn-submit:hover {
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
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="index.php">
        <img src="images/logo.png" alt="Logo">
        <span>FmDiaries</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link text-warning" href="login.php">Sign In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="card-register">
      <h2 class="text-center mb-3">Create Account</h2>
      <p class="text-center mb-4">Free forever. Just sign up and start streaming.</p>
      <form action="user.php" method="POST" novalidate class="needs-validation">
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <input type="text" name="fname" class="form-control" placeholder="First Name" required>
            <div class="invalid-feedback">First name is required.</div>
          </div>
          <div class="col-md-6">
            <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
            <div class="invalid-feedback">Last name is required.</div>
          </div>
        </div>
        <div class="mb-3">
          <input type="tel" name="phn" class="form-control" placeholder="Mobile Number" required>
          <div class="invalid-feedback">Phone number is required.</div>
        </div>
        <div class="mb-3">
          <input type="email" name="mail" class="form-control" placeholder="Email Address" required>
          <div class="invalid-feedback">Email is required.</div>
        </div>
        <div class="mb-3">
          <input type="password" name="pass" class="form-control" placeholder="Password" required>
          <div class="invalid-feedback">Password is required.</div>
        </div>
        <label class="form-label">Birthday</label>
        <div class="row g-3 mb-4">
          <div class="col-4">
            <select name="date" class="form-select" required>
              <option value="" disabled selected>Day</option>
              <?php for ($d = 1; $d <= 31; $d++): ?>
                <option value="<?= $d ?>"><?= $d ?></option>
              <?php endfor; ?>
            </select>
            <div class="invalid-feedback">Select day.</div>
          </div>
          <div class="col-4">
            <select name="month" class="form-select" required>
              <option value="" disabled selected>Month</option>
              <?php
                $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                foreach ($months as $index => $m):
              ?>
                <option value="<?= str_pad($index+1, 2, '0', STR_PAD_LEFT) ?>"><?= $m ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Select month.</div>
          </div>
          <div class="col-4">
            <select name="year" class="form-select" required>
              <option value="" disabled selected>Year</option>
              <?php for ($y = 1980; $y <= 2025; $y++): ?>
                <option value="<?= $y ?>"><?= $y ?></option>
              <?php endfor; ?>
            </select>
            <div class="invalid-feedback">Select year.</div>
          </div>
        </div>
        <button type="submit" class="btn btn-submit">Sign Up</button>
      </form>
    </div>
  </div>

  <footer>
    &copy; 2025 FmDiaries.com
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Bootstrap client-side validation
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

<script>
document.querySelector('input[name="mail"]').addEventListener('blur', function () {
  const email = this.value.trim();
  if (email) {
    fetch('check_user.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ email: email })
    })
    .then(res => res.json())
    .then(data => {
      if (data.exists) {
        alert("Email already registered!");
        document.querySelector('input[name="mail"]').value = "";
      }
    });
  }
});

document.querySelector('input[name="phn"]').addEventListener('blur', function () {
  const phone = this.value.trim();
  if (phone) {
    fetch('check_user.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ phone: phone })
    })
    .then(res => res.json())
    .then(data => {
      if (data.exists) {
        alert("Phone number already registered!");
        document.querySelector('input[name="phn"]').value = "";
      }
    });
  }
});
</script>

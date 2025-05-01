<?php
session_start();
include 'dbh.php';

// Redirect if not logged in
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit();
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM user1 WHERE id = $id";
$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FmDiaries - Account Settings</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #121212; color: #fff; }
    .form-section { background-color: #1e1e1e; border-radius: .75rem; padding: 2rem; }
    .navbar-brand img { height: 40px; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
      <img src="images/logo.png" alt="Logo">
      <span class="ms-2">FmDiaries</span>
    </a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container py-5">
  <h2 class="mb-4">Account Settings</h2>
  <?php
  if (isset($_SESSION['update_success'])) {
    echo '<div class="alert alert-success">' . $_SESSION['update_success'] . '</div>';
    unset($_SESSION['update_success']);
  }
  if (isset($_SESSION['pass_success'])) {
    echo '<div class="alert alert-success">' . $_SESSION['pass_success'] . '</div>';
    unset($_SESSION['pass_success']);
  }
  if (isset($_SESSION['pass_error'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['pass_error'] . '</div>';
    unset($_SESSION['pass_error']);
  }
  ?>


  <div class="row g-4">
    <!-- Profile Update -->
    <div class="col-lg-6">
      <div class="form-section">
        <h4 class="mb-3">Update Profile</h4>
        <form action="update.php" method="POST">
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="fname" value="<?= ucwords($result['name']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mobile Number</label>
            <input type="text" class="form-control" name="phn" value="<?= $result['phone'] ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="text" class="form-control" name="dob" value="<?= $result['DOB'] ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email ID</label>
            <input type="text" class="form-control" value="<?= $result['email'] ?>" disabled>
          </div>
          <button type="submit" class="btn btn-success w-100" name="sub">Update Details</button>
        </form>
      </div>
    </div>

    <!-- Password Update -->
    <div class="col-lg-6">
      <div class="form-section">
        <h4 class="mb-3">Change Password</h4>
        <form action="updatep.php" method="POST">
          <div class="mb-3">
            <label class="form-label">Old Password</label>
            <input type="password" class="form-control" name="oldp" required>
          </div>
          <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control" name="newp" required>
          </div>
          <button type="submit" class="btn btn-warning w-100" name="subpass">Update Password</button>
        </form>
      </div>
    </div>
  </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
  &copy; 2025 FmDiaries
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

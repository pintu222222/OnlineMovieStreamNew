<?php
session_start();
if (!(isset($_SESSION['usertype']) && $_SESSION['usertype'] === "admin")) {
  ?>
  <script>
    alert("You are not an admin!");
    window.location.href = "dashboard.php";
  </script>
  <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FmDiaries Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #000000, #1f1f1f, #2c2c2c);
      color: #ffffff;
    }
    .card {
      background-color: #212529;
      color: #ffffff;
      border: none;
    }
    .form-control {
      background-color: #343a40;
      color: #fff;
      border: 1px solid #495057;
    }
    .form-control:focus {
      background-color: #343a40;
      color: #fff;
      border-color: #0d6efd;
      box-shadow: none;
    }
    .navbar-brand img {
      height: 40px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="dashboard.php">
        <img src="images/logo.png" alt="FmDiaries">
      </a>
      <span class="navbar-text text-white">FmDiaries</span>
      <div class="ms-auto">
        <a href="dashboard.php" class="btn btn-outline-light me-2">Home</a>
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
      </div>
    </div>
  </nav>
  <?php if (isset($_SESSION['upload_success'])): ?>
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <?= $_SESSION['upload_success']; unset($_SESSION['upload_success']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['upload_error'])): ?>
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <?= $_SESSION['upload_error']; unset($_SESSION['upload_error']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>


  <!-- Main Container -->
  <div class="container my-5">
    <div class="card shadow">
      <div class="card-body p-5">
        <h2 class="mb-4">Enter Movie Details</h2>
        <?php if (isset($_SESSION['upload_success'])): ?>
          <div class="alert alert-success"><?php echo $_SESSION['upload_success']; unset($_SESSION['upload_success']); ?></div>
        <?php elseif (isset($_SESSION['upload_error'])): ?>
          <div class="alert alert-danger"><?php echo $_SESSION['upload_error']; unset($_SESSION['upload_error']); ?></div>
        <?php endif; ?>

        <form action="admin-control.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Movie Name</label>
            <input type="text" class="form-control" name="mname" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Year of Release</label>
            <input type="text" class="form-control" name="release" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text" class="form-control" name="genre" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Runtime (minutes)</label>
            <input type="number" class="form-control" name="rtime" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="desc" rows="4" placeholder="Brief description..." required></textarea>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label"><b>Upload Image</b></label>
              <input type="file" class="form-control" name="image" accept="image/*" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><b>Upload Video</b></label>
              <input type="file" class="form-control" name="video" accept="video/*" required>
            </div>
          </div>

          <div class="text-center mt-4">
            <button type="submit" name="upload" class="btn btn-primary btn-lg px-5">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-center text-white py-3 mt-5">
    &copy; <?php echo date("Y"); ?> FmDiaries. All rights reserved.
  </footer>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

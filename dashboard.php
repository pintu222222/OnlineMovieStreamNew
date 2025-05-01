<?php
session_start();
include 'dbh.php';

// Redirect if not logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['user'])) {
  header('Location: login.php');
  exit();
}

$userId = $_SESSION['id'];
$userEmail = $_SESSION['user'];

// Search handling
$searchResults = [];
$searchPerformed = false;
$searchText = '';
$searchOption = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $searchPerformed = true;
  $searchText = trim($_POST['textoption']);
  $searchOption = $_POST['option'] ?? '';

  if ($searchText !== '') {
    $esc = mysqli_real_escape_string($conn, $searchText);
    if ($searchOption === '') {
      $query = "SELECT * FROM movies WHERE name LIKE '%$esc%' OR genre LIKE '%$esc%' OR rdate LIKE '%$esc%'";
    } else {
      switch ($searchOption) {
        case '1': $query = "SELECT * FROM movies WHERE name LIKE '%$esc%'"; break;
        case '2': $query = "SELECT * FROM movies WHERE genre LIKE '%$esc%'"; break;
        case '3':
          if (preg_match('/^\\d{4}$/', $esc)) {
            $query = "SELECT * FROM movies WHERE rdate = '$esc'";
          } else {
            $errorMessage = 'Enter a valid 4-digit year.';
            $query = null;
          }
          break;
        default:
          $query = "SELECT * FROM movies WHERE name LIKE '%$esc%' OR genre LIKE '%$esc%' OR rdate LIKE '%$esc%'";
      }
    }
    if (!empty($query)) {
      $searchResults = mysqli_query($conn, $query);
    }
  }
}

// Fetch user data
$userRes = mysqli_query($conn, "SELECT name FROM user1 WHERE id = '$userId'");
$user = mysqli_fetch_assoc($userRes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FmDiaries - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #121212; color: #fff; }
    .navbar-brand img { height: 40px; }
    .search-form .form-select, .search-form .form-control { border-radius: .5rem; }
    .card-movie { background: #1e1e1e; border: none; border-radius: .75rem; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
      <img src="images/logo.png" alt="Logo">
      <span class="ms-2">FmDiaries</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navMenu">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="account.php">Account</a></li>
        <?php if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === "admin"): ?>
          <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container py-4">
  <h3>Welcome, <span class="text-info"><?= htmlspecialchars(ucwords($user['name'])) ?></span>!</h3>

  <!-- Search -->
  <form class="search-form row g-2 my-4" action="dashboard.php" method="POST">
    <div class="col-md-4">
      <select name="option" class="form-select" aria-label="Search by">
        <option value="" <?= $searchOption==''?'selected':'' ?>>Search By</option>
        <option value="1" <?= $searchOption=='1'?'selected':'' ?>>Name</option>
        <option value="2" <?= $searchOption=='2'?'selected':'' ?>>Genre</option>
        <option value="3" <?= $searchOption=='3'?'selected':'' ?>>Year</option>
      </select>
    </div>
    <div class="col-md-6">
      <input type="text" name="textoption" class="form-control" placeholder="Enter search..." value="<?= htmlspecialchars($searchText) ?>" required>
    </div>
    <div class="col-md-2 d-grid">
      <button type="submit" name="submit" class="btn btn-success">Search</button>
    </div>
    <?php if ($errorMessage): ?>
      <div class="col-12 text-warning"><?= $errorMessage ?></div>
    <?php endif; ?>
  </form>

  <?php if ($searchPerformed): ?>
    <h4>Search Results</h4>
    <div class="row g-3">
      <?php if ($searchResults && mysqli_num_rows($searchResults)): ?>
        <?php while($m = mysqli_fetch_assoc($searchResults)): ?>
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card card-movie h-100">
              <img src="uploads/<?= $m['imgpath'] ?>" class="card-img-top" alt="">
              <div class="card-body text-center">
                <form action="movie.php" method="POST">
                  <button class="btn btn-outline-info w-100" name="submit" value="<?= htmlspecialchars($m['name']) ?>"><?= ucwords($m['name']) ?></button>
                </form>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No movies found.</p>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <h4>Latest Releases</h4>
    <?php include 'latest-fetcher.php'; ?>
    <h4 class="mt-5">All Movies</h4>
    <?php include 'fetcher.php'; ?>
  <?php endif; ?>
</div>

<footer class="bg-dark text-center text-white py-3">
  &copy; 2025 FmDiaries
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

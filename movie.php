<?php
session_start();
if (isset($_POST['submit'])) {
  $title = $_POST['submit'];

  include 'dbh.php';
  $im = "SELECT * FROM movies WHERE name = '$title'";
  $records = mysqli_query($conn, $im);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($title) ?> - FmDiaries</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #000;
      color: #e2dd31;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .movie-card {
      background-color: #1e1e1e;
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
      margin-top: 2rem;
    }
    h1:hover, h4:hover {
      color: #85c639;
    }
    h5 {
      color: #9e8b24;
    }
    .btn-back {
      color: orange;
      border: 1px solid orange;
      border-radius: 5px;
      padding: 8px 15px;
      text-decoration: none;
      transition: 0.3s;
      display: inline-block;
      margin-bottom: 1.5rem;
    }
    .btn-back:hover {
      background-color: orange;
      color: #000;
    }
    video {
      width: 100%;
      height: auto;
      border: 2px solid #e2dd31;
      border-radius: 10px;
      margin-top: 2rem;
    }
    footer {
      background-color: #111;
      color: white;
      text-align: center;
      padding: 1rem;
      margin-top: 4rem;
    }
  </style>
</head>
<body>

<div class="container">
  <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>

  <?php while ($result = mysqli_fetch_assoc($records)) :
    $mname = $result['name'];
    $person = $_SESSION['id'];
    $movieid = $result['mid'];
    $current = $result['viewers'];
    $newcount = $current + 1;

    // Update viewers and user's last watched movie
    $newsql = "UPDATE movies SET viewers = '$newcount' WHERE name='$mname'";
    $nsql = "UPDATE user1 SET mid = '$movieid' WHERE id = '$person'";

    mysqli_query($conn, $newsql);
    mysqli_query($conn, $nsql);

    $url = "video-uploads/" . $result['videopath'];
  ?>

  <div class="movie-card">
    <h5>Movie Name:</h5>
    <h1><?= ucwords($result['name']) ?></h1>

    <h5 class="mt-3">Genre:</h5>
    <h4><?= ucwords($result['genre']) ?></h4>

    <h5 class="mt-3">Release Year:</h5>
    <h4><?= $result['rdate'] ?></h4>

    <h5 class="mt-3">Description:</h5>
    <h4><?= ucfirst($result['decription']) ?></h4>

    <h5 class="mt-3">Runtime:</h5>
    <h4><?= $result['runtime'] ?> mins</h4>

    <h5 class="mt-3">Views:</h5>
    <h4><?= $newcount ?></h4>

    <video controls>
      <source src="<?= htmlspecialchars($url) ?>" type="video/mp4">
      Your browser does not support the video element.
    </video>
  </div>

  <?php endwhile; ?>
</div>

<footer>
  &copy; 2025 FmDiaries
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php } ?>

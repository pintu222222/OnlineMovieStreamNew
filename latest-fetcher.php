<?php
include 'dbh.php';

$query = "SELECT * FROM movies ORDER BY mid DESC LIMIT 3";
$records = mysqli_query($conn, $query);

echo "<div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4'>";

while ($movie = mysqli_fetch_assoc($records)) {
    echo "
    <div class='col'>
      <div class='card h-100'>
        <img src='uploads/{$movie['imgpath']}' class='card-img-top' alt='{$movie['name']}' style='height: 300px; object-fit: cover;'>
        <div class='card-body text-center'>
          <form action='movie.php' method='POST'>
            <input type='submit' name='submit' class='btn btn-outline-success w-100' value='".ucwords($movie['name'])."'>
          </form>
        </div>
      </div>
    </div>";
}
echo "</div>";
?>
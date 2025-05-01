<?php
session_start();
include 'dbh.php';

if (isset($_POST['upload'])) {

    $name = strtolower(trim($_POST['mname']));
    $rdate = trim($_POST['release']);
    $genre = strtolower(trim($_POST['genre']));
    $rtime = intval($_POST['rtime']);
    $desc = trim($_POST['desc']);

    // Handle file uploads
    $image = $_FILES['image'];
    $video = $_FILES['video'];

    $imageName = basename($image['name']);
    $videoName = basename($video['name']);

    $imagePath = "uploads/" . $imageName;
    $videoPath = "video-uploads/" . $videoName;

    $allowedImageTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $allowedVideoTypes = ['mp4', 'webm', 'mkv'];

    $imageExt = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
    $videoExt = strtolower(pathinfo($videoPath, PATHINFO_EXTENSION));

    // Validate file extensions
    if (!in_array($imageExt, $allowedImageTypes)) {
        $_SESSION['upload_error'] = "Invalid image file type. Allowed: jpg, jpeg, png, gif.";
        ?>
        <script>
          alert(<?= json_encode($_SESSION['upload_error']) ?>);
          window.location.href="admin.php";
        </script>
        <?php
        exit();
    }

    if (!in_array($videoExt, $allowedVideoTypes)) {
        $_SESSION['upload_error'] = "Invalid video file type. Allowed: mp4, webm, mkv.";
        ?>
        <script>
          alert(<?= json_encode($_SESSION['upload_error']) ?>);
          window.location.href="admin.php";
        </script>
        <?php
        exit();
    }

    // Check if files are uploaded correctly
    if (!is_uploaded_file($image['tmp_name']) || !is_uploaded_file($video['tmp_name'])) {
        $_SESSION['upload_error'] = "Error uploading files. Please try again.";
        ?>
        <script>
          alert(<?= json_encode($_SESSION['upload_error']) ?>);
          window.location.href="admin.php";
        </script>
        <?php
        exit();
    }

    // Move files
    $imageMoved = move_uploaded_file($image['tmp_name'], $imagePath);
    $videoMoved = move_uploaded_file($video['tmp_name'], $videoPath);

    if ($imageMoved && $videoMoved) {
        // Insert into DB
        $stmt = $conn->prepare("INSERT INTO movies (name, rdate, genre, runtime, decription, imgpath, videopath) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisss", $name, $rdate, $genre, $rtime, $desc, $imageName, $videoName);

        if ($stmt->execute()) {
            $_SESSION['upload_success'] = "✅ Movie uploaded successfully!";
            ?>
            <script>
              alert(<?= json_encode($_SESSION['upload_success']) ?>);
              window.location.href="admin.php";
            </script>
            <?php
            exit();
        } else {
            $_SESSION['upload_error'] = "❌ Database insertion failed.";
            ?>
            <script>
              alert(<?= json_encode($_SESSION['upload_error']) ?>);
              window.location.href="admin.php";
            </script>
            <?php
            exit();
        }
    } else {
        $_SESSION['upload_error'] = "❌ Failed to move uploaded files.";
        ?>
        <script>
            alert(<?= json_encode($_SESSION['upload_error']) ?>);
            window.location.href="admin.php";
        </script>
        <?php
        exit();
    }
} else {
  ?>
  <script>
    alert("Not submitted correctly!!!upload");
    window.location.href = "admin.php";
  </script>
  <?php
  exit();
}
?>

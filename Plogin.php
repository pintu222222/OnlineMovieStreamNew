<?php
session_start();
include 'dbh.php';

$username = $_POST['mail'];
$password = $_POST['pass'];

$stmt = $conn->prepare("SELECT * FROM user1 WHERE username = ? AND passwd = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if (!$row = $result->fetch_assoc()) {
    echo "<script>alert('Incorrect username or password!'); window.location.href='login.php';</script>";
} else {
    $_SESSION['id'] = $row['id'];
    if($row['id'] == 1){
        $_SESSION['usertype'] = "admin";
    }
    $_SESSION['user'] = $row['username'];
    header("Location: dashboard.php");
}
?>

<?php
session_start();
include 'dbh.php';

// Sanitize and prepare input
$fname = strtolower(trim($_POST['fname']));
$lname = strtolower(trim($_POST['lname']));
$name = $fname . " " . $lname;
$phn = trim($_POST['phn']);
$email = trim($_POST['mail']);
$username = $email; // same as email
$password = trim($_POST['pass']);
$date = $_POST['date'];
$month = $_POST['month'];
$year = $_POST['year'];
$dob = $date . "/" . $month . "/" . $year;

// Check if email already exists
$check = $conn->prepare("SELECT id FROM user1 WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "<script>alert('Email already registered!'); window.location.href='signup.php';</script>";
    exit();
}

// Insert into database
$sql = $conn->prepare("INSERT INTO user1 (username, passwd, name, phone, email, DOB) VALUES (?, ?, ?, ?, ?, ?)");
$sql->bind_param("ssssss", $username, $password, $name, $phn, $email, $dob);

if ($sql->execute()) {
    echo "<script>alert('Registration successful! Please log in.'); window.location.href='login.php';</script>";
} else {
    echo "<script>alert('Error: Could not register user.'); window.location.href='signup.php';</script>";
}
?>

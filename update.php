<?php
session_start();
include 'dbh.php';

if (isset($_POST['sub'])) {
    $name = strtolower(trim($_POST['fname']));
    $phone = trim($_POST['phn']);
    $dob = $_POST['dob'];
    $id = $_SESSION['id'];

    $sql = "UPDATE user1 SET name=?, DOB=?, phone=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $dob, $phone, $id);
    $stmt->execute();

    $_SESSION['update_success'] = "Profile updated successfully.";
    header("Location: account.php");
    exit();
}
?>

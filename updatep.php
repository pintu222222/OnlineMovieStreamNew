<?php
session_start();
include 'dbh.php';

if (isset($_POST['subpass'])) {
    $old = $_POST['oldp'];
    $new = $_POST['newp'];
    $id = $_SESSION['id'];

    // Fetch current password from DB
    $stmt = $conn->prepare("SELECT passwd FROM user1 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($db_pass);
    $stmt->fetch();
    $stmt->close();

    // Verify old password in plain text
    if ($old === $db_pass) {
        // Update to new password (plain text)
        $stmt = $conn->prepare("UPDATE user1 SET passwd = ? WHERE id = ?");
        $stmt->bind_param("si", $new, $id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['pass_success'] = "Password updated successfully.";
    } else {
        $_SESSION['pass_error'] = "Old password is incorrect.";
    }

    header("Location: account.php");
    exit();
}
?>
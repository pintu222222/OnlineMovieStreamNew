<?php
include 'dbh.php';

$response = ['exists' => false, 'type' => ''];

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT id FROM user1 WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $response['exists'] = $stmt->num_rows > 0;
    $response['type'] = 'email';
}

if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
    $stmt = $conn->prepare("SELECT id FROM user1 WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->store_result();
    $response['exists'] = $stmt->num_rows > 0;
    $response['type'] = 'phone';
}

echo json_encode($response);
?>

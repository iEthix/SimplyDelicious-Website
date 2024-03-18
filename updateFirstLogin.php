<?php
session_start();
include('dbh.inc.php'); // Your database connection file

// Ensure the AJAX request is a POST request and the userId is provided
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['userId'])) {
    $userId = $_POST['userId'];
    
    // Securely prepare your SQL query to avoid SQL injection
    $stmt = $mysqli->prepare("UPDATE users SET firstLogin = 0 WHERE UserId = ?");
    $stmt->bind_param("i", $userId);
    
    if ($stmt->execute()) {
        // If the update is successful
        echo json_encode(['success' => true]);
    } else {
        // If the update fails
        echo json_encode(['success' => false, 'message' => 'Could not update firstLogin status.']);
    }
    
    $stmt->close();
} else {
    // Invalid request
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
<?php
session_start();
include('dbh.inc.php');

$response = ['error' => false]; // Default response
$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];
    
    // Fetch user details along with firstLogin status
    $stmt = $mysqli->prepare("SELECT UserId, Username, Email, Password, firstLogin FROM users WHERE Username = ? OR Email = ?");
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            $_SESSION['user_id'] = $row['UserId'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['firstLogin'] = (bool)$row['firstLogin'];
            
            $response = [
                'error' => false,
                'firstLogin' => $_SESSION['firstLogin'],
                'userId' => $row['UserId']
            ];
        } else {
            $loginError = "Invalid username or password";
            $response = ['error' => true, 'errorMessage' => $loginError];
        }
    } else {
        $loginError = "Invalid username or password";
        $response = ['error' => true, 'errorMessage' => $loginError];
    }

    $stmt->close();
    
    // Set header to application/json for proper AJAX response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
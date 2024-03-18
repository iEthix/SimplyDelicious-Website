<?php
include('dbh.inc.php');

$firstName = "";
$nameError = "";
$lastName = "";
$password = "";
$passwordError = "";
$bio = NULL;
$profilepictureURL = NULL;
$email = "";
$emailError = "";
$username = "";
$usernameError = "";
$isValid = true; // Flag to track overall validation status

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate First Name
    if (empty($_POST["firstName"])) {
        $nameError = "First name is required";
        $isValid = false;
    } else {
        $firstName = test_inputs($_POST["firstName"]);
        if (preg_match("/\s/", $firstName)) {
            $nameError = "Only enter one word for the first name!";
            $isValid = false;
        } elseif (!preg_match("/^[a-zA-Z]*$/", $firstName)) {
            $nameError = "Only letters allowed in first name!";
            $isValid = false;
        }
    }

    // Validate Last Name
    if (empty($_POST["lastName"])) {
        $nameError = "Last name is required";
        $isValid = false;
    } else {
        $lastName = test_inputs($_POST["lastName"]);
        if (preg_match("/\s/", $lastName)) {
            $nameError = "Only enter one word for the last name!";
            $isValid = false;
        } elseif (!preg_match("/^[a-zA-Z]*$/", $lastName)) {
            $nameError = "Only letters allowed in last name!";
            $isValid = false;
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
        $isValid = false;
    } else {
        $email = test_inputs($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
            $isValid = false;
        }
    }

    // Validate Username
    if (empty($_POST["signupUsername"])) {
        $usernameError = "Username is required";
        $isValid = false;
    } else {
        $username = test_inputs($_POST["signupUsername"]);
        if (strlen($username) > 50) {
            $usernameError = "Username cannot be longer than 50 characters";
            $isValid = false;
        } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $usernameError = "Only letters and numbers allowed in username!";
            $isValid = false;
        }
    }

    // Validate Password
    if (empty($_POST["signupPassword"])) {
        $passwordError = "Password is required";
        $isValid = false;
    } else {
        $password = test_inputs($_POST["signupPassword"]);
        if (strlen($password) < 8) {
            $passwordError = "Password must be at least 8 characters long";
            $isValid = false;
        }
    }

    // Proceed with inserting data into the database only if all validations pass
    if ($isValid) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert into users table
        $stmt = $mysqli->prepare("INSERT INTO users (Username, Password, Email, DateCreated, firstLogin) VALUES (?, ?, ?, NOW(), 1)");
        $stmt->bind_param("sss", $username, $hashedPassword, $email);
        $stmt->execute();
        $userId = $mysqli->insert_id;
        $stmt->close();

        // Insert into user_profiles table
        $stmt = $mysqli->prepare("INSERT INTO user_profiles (UserId, FirstName, LastName, Bio, ProfilePictureURL) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $userId, $firstName, $lastName, $bio, $profilepictureURL);
        $stmt->execute();
        $stmt->close();

        header('Location: homepage.php');
        exit();
    }
}

function test_inputs($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
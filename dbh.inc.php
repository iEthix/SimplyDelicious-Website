<?php

$db_servername = "localhost";
$db_port = 3307; // This is the correct port you've mentioned
$db_username = "root";
$db_password = "";
$db_name = "users_db";

// Create connection
$mysqli = new mysqli($db_servername, $db_username, $db_password, $db_name, $db_port);

// Check connection
if ($mysqli->connect_error) {
    error_log("Connection failed: " . $mysqli->connect_error);
    exit();
}

// Connection is successful
// You can proceed with your operations

?>
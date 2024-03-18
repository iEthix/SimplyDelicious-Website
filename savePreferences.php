<?php
session_start();
include('dbh.inc.php'); // Ensure you have your database connection set up

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['userId'])) {
    $userId = $_POST['userId'];
}
    
?>
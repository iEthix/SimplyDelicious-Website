<?php
// Database connection variables
$db_servername = "localhost";
$db_port = 3307;
$db_username = "root";
$db_password = "";
$db_name = "ingredients_db";

// Only proceed if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create connection
    $mysqli = new mysqli($db_servername, $db_username, $db_password, $db_name, $db_port);

    // Check for database connection error
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE); // Convert JSON to array

    $search = isset($input['search']) ? $input['search'] : '';
    $offset = isset($input['offset']) ? (int) $input['offset'] : 0;
    $limit = 10;

    // Prepare the SQL based on whether a search term is provided
    if (!empty($search)) {
        $searchTerm = "%$search%";
        $stmt = $mysqli->prepare("SELECT ingredients FROM ingredients_name WHERE ingredients LIKE ? LIMIT ?");
        $stmt->bind_param("si", $searchTerm, $limit);
    } else {
        $stmt = $mysqli->prepare("SELECT ingredients FROM ingredients_name LIMIT ?, ?");
        $stmt->bind_param("ii", $offset, $limit);
    }

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the ingredients
    $ingredients = [];
    while ($row = $result->fetch_assoc()) {
        $ingredients[] = $row['ingredients'];
    }

    // Close the statement and the mysqli connection
    $stmt->close();
    $mysqli->close();

    // Return the ingredients as JSON
    echo json_encode($ingredients);
}
?>
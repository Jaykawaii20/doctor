<?php
include '../connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the title, start date, and category from the AJAX request
    $title = $_POST['title'] ?? '';
    $start = $_POST['start'] ?? '';
    $category = $_POST['category'] ?? '';

    // Debugging output
    error_log("Title: $title, Start Date: $start, Category: $category");

    if (empty($title) || empty($start) || empty($category)) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
        exit;
    }

    // Validate the date format
    $date = date('Y-m-d', strtotime($start));
    if (!$date) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid date format']);
        exit;
    }

    // Log the converted date
    error_log("Converted Date: $date");

    // Insert into appointment table
    $sql = "INSERT INTO appointment (appointname, date, category, status, datecreated) 
            VALUES (?, ?, ?, 'appoint', NOW())";

    // Prepare the SQL statement
    $stmt = $database->prepare($sql);
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Error in statement preparation: ' . $database->error]);
        exit;
    }

    // Bind the parameters
    $stmt->bind_param('sss', $title, $date, $category); // Bind title, date, and category

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'id' => $database->insert_id]);
    } else {
        error_log("Execution error: " . $stmt->error); // Log execution error
        echo json_encode(['status' => 'error', 'message' => 'Error in execution: ' . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

// Close the database connection
$database->close();
?>

<?php
include '../connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the title, start date, and pid from the AJAX request
    $title = $_POST['title'] ?? '';
    $start = $_POST['start'] ?? '';
    $pid = $_POST['pid'] ?? ''; // Patient ID

    // Debugging output
    error_log("Title: $title, Start Date: $start, PID: $pid");

    if (empty($title) || empty($start) || empty($pid)) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
        exit;
    }

    // Extract date and time
    $dateTime = new DateTime($start);
    $date = $dateTime->format('Y-m-d');
    $time = $dateTime->format('H:i:s');

    // Log the converted date and time
    error_log("Converted Date: $date, Time: $time");

    // Insert into appointment_patient table
    $sql = "INSERT INTO appointment_patient (appointmentname, pid, category, time, date, status, datecreated) 
            VALUES (?, ?, 'General', ?, ?, 'appoint', NOW())";

    // Prepare the SQL statement
    $stmt = $database->prepare($sql);
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Error in statement preparation: ' . $database->error]);
        exit;
    }

    // Bind the parameters
    $stmt->bind_param('ssss', $title, $pid, $time, $date); // Bind title, pid, time, and date

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'event_id' => $database->insert_id]); // Return new event ID
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

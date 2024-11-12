<?php
include '../connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve input fields from the AJAX request
    $title = $_POST['title'] ?? '';
    $start = $_POST['start'] ?? '';
    $pid = $_POST['pid'] ?? ''; // Patient ID
    $appointmentId = $_POST['appointment_id'] ?? null; // Optional appointment ID   

    // Debugging output
    error_log("Title: $title, Start Date: $start, PID: $pid, Appointment ID: $appointmentId");

    // Validate required fields
    if (empty($title) || empty($start) || empty($pid)) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
        exit;
    }

    // Parse date and time
    try {
        $dateTime = new DateTime($start);
        $date = $dateTime->format('Y-m-d');
        $time = $dateTime->format('H:i:s');
    } catch (Exception $e) {
        error_log("DateTime Error: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Invalid date format.']);
        exit;
    }

    // Determine whether to insert or update based on appointment ID
    if ($appointmentId) {
        // Update existing appointment
        $sql = "UPDATE appointment_patient 
                SET appointmentname = ?, pid = ?, time = ?, date = ?, datecreated = NOW() 
                WHERE id = ?";
        $stmt = $database->prepare($sql);
        if ($stmt === false) {
            error_log("SQL Preparation Error: " . $database->error);
            echo json_encode(['status' => 'error', 'message' => 'Error in preparing update statement.']);
            exit;
        }

        // Bind parameters and execute the update
        $stmt->bind_param('ssssi', $title, $pid, $time, $date, $appointmentId);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Appointment updated successfully.']);
        } else {
            error_log("Execution error: " . $stmt->error);
            echo json_encode(['status' => 'error', 'message' => 'Error in execution: ' . $stmt->error]);
        }

    } else {
        // Insert new appointment
        $sql = "INSERT INTO appointment_patient (appointmentname, pid, time, date, status, datecreated) 
                VALUES (?, ?, ?, ?, 'appoint', NOW())";
        $stmt = $database->prepare($sql);
        if ($stmt === false) {
            error_log("SQL Preparation Error: " . $database->error);
            echo json_encode(['status' => 'error', 'message' => 'Error in preparing insert statement.']);
            exit;
        }

        // Bind parameters and execute the insertion
        $stmt->bind_param('ssss', $title, $pid, $time, $date);
        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'event_id' => $database->insert_id, // Return new event ID
                'time' => $time // Return the time for display
            ]);
        } else {
            error_log("Execution error: " . $stmt->error);
            echo json_encode(['status' => 'error', 'message' => 'Error in execution: ' . $stmt->error]);
        }
    }

    // Close the statement
    $stmt->close();

} else {
    error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

// Close the database connection
$database->close();

?>

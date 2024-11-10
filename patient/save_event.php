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
    try {
        $dateTime = new DateTime($start);
        $date = $dateTime->format('Y-m-d'); // Ensure it's in YYYY-MM-DD format
        $time = $dateTime->format('H:i:s'); // Ensure it's in HH:MM:SS format
    } catch (Exception $e) {
        error_log("DateTime Error: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Invalid date format.']);
        exit;
    }

    // Log the converted date and time
    error_log("Converted Date: $date, Time: $time");

    // Fetch the appointment details including the category based on the title
    $appointmentDetailsSql = "SELECT `id`, `category` FROM `appointment` WHERE `appointname` = ? AND `status` = 'appoint'"; // Ensure the correct status
    $appointmentDetailsStmt = $database->prepare($appointmentDetailsSql);
    
    if ($appointmentDetailsStmt === false) {
        error_log("SQL Preparation Error: " . $database->error);
        echo json_encode(['status' => 'error', 'message' => 'Error in appointment statement preparation: ' . $database->error]);
        exit;
    }

    // Bind title to fetch the corresponding appointment details
    $appointmentDetailsStmt->bind_param('s', $title);
    $appointmentDetailsStmt->execute();
    $appointmentDetailsStmt->bind_result($appointmentId, $category);
    $appointmentDetailsStmt->fetch();
    $appointmentDetailsStmt->close();

    // Check if appointment details were found
    if (empty($appointmentId)) {
        echo json_encode(['status' => 'error', 'message' => 'Appointment not found']);
        exit;
    }

    // Insert into appointment_patient table
    $sql = "INSERT INTO appointment_patient ( appointmentname, pid, category, time, date, status, datecreated) 
            VALUES (?, ?, ?, ?, ?, 'appoint', NOW())";

    // Prepare the SQL statement
    $stmt = $database->prepare($sql);
    if ($stmt === false) {
        error_log("SQL Preparation Error: " . $database->error);
        echo json_encode(['status' => 'error', 'message' => 'Error in statement preparation: ' . $database->error]);
        exit;
    }

    // Bind the parameters
    $stmt->bind_param('sssss',  $title, $pid, $category, $time, $date); // Bind appointmentId, title, pid, category, time, and date

    // Execute the statement
    if ($stmt->execute()) {
        // Successful insert
        echo json_encode([
            'status' => 'success',
            'event_id' => $database->insert_id, // Return new event ID
            'time' => $time // Return the time for display
        ]);
    } else {
        // Log execution error
        error_log("Execution error: " . $stmt->error);
        echo json_encode(['status' => 'error', 'message' => 'Error in execution: ' . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
} else {
    // Log invalid request method
    error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

// Close the database connection
$database->close();
?>

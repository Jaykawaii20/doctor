<?php
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $midwife_id = $_POST['midwife_id'];  // Make sure the midwife ID is sent correctly

    // Insert the new appointment into the database
    $sql = "INSERT INTO midwivesappointment (midwife_id, appointment_date, description) VALUES (?, ?, ?)";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("iss", $midwife_id, $start, $title);

    if ($stmt->execute()) {
        $response = ['status' => 'success', 'event_id' => $database->insert_id];  // Return new event ID
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to save event'];
    }

    echo json_encode($response);
}
?>

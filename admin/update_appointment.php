<?php
// Include your database connection
include("../connection.php");

// Check if the appointment ID and action are set
if (isset($_POST['appointment_id']) && isset($_POST['action'])) {
    $appointment_id = $_POST['appointment_id'];
    $action = $_POST['action'];

    // Determine the new status based on the action
    $new_status = ($action == 'approve') ? 'approved' : 'disapproved';

    // Update the status in the database
    $sql = "UPDATE appointment_patient SET status = ? WHERE id = ?";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("si", $new_status, $appointment_id);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "<script>alert('Appointment status updated to " . ucfirst($new_status) . ".');</script>";
    } else {
        echo "<script>alert('Error updating appointment status: " . $database->error . "');</script>";
    }

    // Redirect back to the schedule page or the appropriate page
    header("Location: appointment.php");
    exit();
} else {
    echo "<script>alert('Invalid request.');</script>";
    header("Location: schedule.php");
    exit();
}

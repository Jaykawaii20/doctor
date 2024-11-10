<?php
session_start();
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $midwife_id = $_POST['midwife_id'];

    // Insert into the midwivesappointment table
    $sql = "INSERT INTO midwivesappointment (midwife_id, description, appointment_date) VALUES (?, ?, ?)";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("iss", $midwife_id, $title, $date);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Event added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding event']);
    }

    $stmt->close();
    $database->close();
}
?>

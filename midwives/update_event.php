<?php
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];

    // Update the event in the database
    $sql = "UPDATE midwivesappointment SET description = ? WHERE appointment_id = ?";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("si", $title, $id);

    if ($stmt->execute()) {
        $response = ['status' => 'success'];
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to update event'];
    }

    echo json_encode($response);
}
?>

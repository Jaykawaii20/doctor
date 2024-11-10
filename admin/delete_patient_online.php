<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION['usertype'] != 'a') {
    header("location: ../login.php");
    exit();
}

// Import database connection
include("../connection.php");

if (isset($_GET['pid'])) {
    $pid = intval($_GET['pid']); // Ensure it's an integer to prevent SQL injection

    // Prepare the SQL delete statement
    $sql = "DELETE FROM patient WHERE pid = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $pid); // Bind the parameter
        if ($stmt->execute()) {
            // Redirect back to the patients page after deletion
            header("Location: patient.php?message=Patient deleted successfully");
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "No patient ID provided.";
}

$conn->close();
?>
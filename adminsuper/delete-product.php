<?php
session_start();

// Check if the user is logged in and is an admin
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] == "" || $_SESSION['usertype'] != 's') {
        header("location: ../login.php");
        exit;
    }
} else {
    header("location: ../login.php");
    exit;
}

// Include the database connection
include("../connection.php");

// Check if the ID is set and delete the product
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM product WHERE id = ?";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        // Set success message in session
        $_SESSION['message'] = "Product deleted successfully";
    } else {
        // Set error message in session if deletion fails
        $_SESSION['message'] = "Error deleting product: " . $database->error;
    }
}

// Close the database connection
$database->close();

// Redirect back to product.php
header("Location: product.php");
exit;
?>

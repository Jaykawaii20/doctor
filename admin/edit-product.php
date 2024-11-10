<?php
session_start();

// Check if the user is logged in and is an admin
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
        exit;
    }
} else {
    header("location: ../login.php");
    exit;
}

// Include the database connection
include("../connection.php");

// Check if the ID is set and fetch the product details for editing
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch the existing product details
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    // Check if the form is submitted to update the product
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];

        // Prepare and execute the UPDATE query
        $updateSql = "UPDATE product SET name = ?, quantity = ?, description = ? WHERE id = ?";
        $updateStmt = $database->prepare($updateSql);
        $updateStmt->bind_param("sisi", $name, $quantity, $description, $productId);

        if ($updateStmt->execute()) {
            // Set success message in session
            $_SESSION['message'] = "Product updated successfully";
        } else {
            // Set error message in session if update fails
            $_SESSION['message'] = "Error updating product: " . $database->error;
        }

        // Redirect back to product.php
        header("Location: product.php");
        exit;
    }
} else {
    // Redirect to product.php if no ID is provided
    header("Location: product.php");
    exit;
}

// Close the database connection
$database->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <title>Edit Product</title>
    <style>
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- Modal for editing product -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h1>Edit Product</h1>
        <form method="POST" action="">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $product['name']; ?>" required>
            
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="<?php echo $product['quantity']; ?>" required>
            
            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo $product['description']; ?></textarea>
            
            <button type="submit">Update Product</button>
        </form>
    </div>
</div>

<!-- Script to open the modal -->
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    window.onload = function() {
        modal.style.display = "block";
    };

    // Get the <span> element that closes the modal
    var span = document.getElementById("closeModal");

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
        window.location.href = 'product.php'; // Redirect to products page
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            window.location.href = 'product.php'; // Redirect to products page
        }
    }
</script>

</body>
</html>

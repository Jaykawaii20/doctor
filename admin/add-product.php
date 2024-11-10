<?php
session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" || $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
        exit;
    }
} else {
    header("location: ../login.php");
    exit;
}

// Import database connection
include("../connection.php"); // Use the correct path

// Check if the connection is established
if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    
    // Handle file upload
    $image = $_FILES["image"]["name"];
    $target_dir = "productpc/"; // Use relative path
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // SQL query to insert product into the database
        $sql = "INSERT INTO product (name, quantity, description, image) VALUES ('$name', '$quantity', '$description', '$image')";

        if (mysqli_query($database, $sql)) {
            echo "<script>alert('Medicine added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding Medicine: " . mysqli_error($database) . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading image. Please check the permissions of the folder.');</script>";
    }
}
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
    <title>Add Product</title>
    <style>
        .form-container {
            width: 500px;
            margin: auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: rgb(49, 49, 49);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: rgb(49, 49, 49);
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
        .form-group textarea {
            resize: none;
            height: 100px;
        }
        .form-group button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: rgb(56, 193, 114);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: rgb(45, 160, 95);
        }
        .back-button {
            margin-top: 20px;
            padding: 10px;
            background-color: rgb(220, 220, 220);
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            text-align: center;
        }
        .back-button:hover {
            background-color: rgb(200, 200, 200);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2>Add New Medicine</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Medicine Image:</label>
                <input type="file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="name">Medicine Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Add Medicine</button>
            </div>
        </form>
        <button class="back-button" onclick="window.location.href='product.php'">Back to list</button>
    </div>
</div>

</body>
</html>

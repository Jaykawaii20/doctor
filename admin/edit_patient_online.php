<?php
// Database connection
include('../connection.php');

// Check if `pid` is passed in the URL
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];

    // Fetch the patient data
    $sql = "SELECT * FROM patient WHERE pid = ?";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    // If the form is submitted, update the record
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $birthdate = $_POST['birthdate'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $bp = $_POST['bp'];
        $temp = $_POST['temp'];
    
        $updateSql = "UPDATE patient SET name = ?, middlename = ?, lastname = ?, address = ?, age = ?, birthdate = ?, weight = ?, height = ?, bp = ?, temp = ? WHERE pid = ?";
        $updateStmt = $database->prepare($updateSql);
        $updateStmt->bind_param("ssssssssssi", $name, $middlename, $lastname, $address, $age, $birthdate, $weight, $height, $bp, $temp, $pid);
        $updateStmt->execute();
    
        // Redirect after update
        header("Location: patient.php");
        exit();
    }
    
    
}
?>

<!-- HTML form to edit patient data with styling -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #218838;
        }

        .form-group select {
            width: 100%;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        .back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Patient Information</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">First Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $patient['name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="middlename">Middle Name:</label>
            <input type="text" id="middlename" name="middlename" value="<?php echo $patient['middlename']; ?>" required>
        </div>

        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $patient['lastname']; ?>" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $patient['address']; ?>" required>
        </div>

        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo $patient['age']; ?>" required>
        </div>


        <div class="form-group">
            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate" value="<?php echo $patient['birthdate']; ?>" required>
        </div>

        <div class="form-group">
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" step="0.1" value="<?php echo $patient['weight']; ?>" required>
        </div>

        <div class="form-group">
            <label for="height">Height (cm):</label>
            <input type="number" id="height" name="height" step="0.1" value="<?php echo $patient['height']; ?>" required>
        </div>

        <div class="form-group">
            <label for="bp">Blood Pressure (mmHg):</label>
            <input type="text" id="bp" name="bp" value="<?php echo $patient['bp']; ?>" required>
        </div>

        <div class="form-group">
            <label for="temp">Body Temperature (°C):</label>
            <input type="number" id="temp" name="temp" step="0.1" value="<?php echo $patient['temp']; ?>" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Update">
        </div>
    </form>

    <a href="patient.php" class="back-btn">Back to Patient List</a>
</div>

</body>
</html>

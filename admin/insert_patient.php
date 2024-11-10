<?php
    include("../connection.php");


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $patient_name = $_POST['patient_name'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $civil_status = $_POST['civil_status'];
    $gender = $_POST['gender'];
    $bp = $_POST['bp'];
    $temp = $_POST['temp'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $session_category = $_POST['session_category'];

    // Insert data into the database
    $sql = "INSERT INTO patient_walkin (name, middlename, lastname, birthdate, address, age, civil_status, gender, bp, temp, weight, height, session_category)
            VALUES ('$patient_name', '$middlename', '$lastname', '$birthdate', '$address', $age, '$civil_status', '$gender', '$bp', '$temp', '$weight', '$height','$session_category')";

    if ($database->query($sql) === TRUE) {
        echo "New patient added successfully!";
        header("Location: patient.php?success=1"); // Redirect to patient page with success
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $database->error;
    }
}

// Close the connection
$database->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient</title>
    <style>
        /* General styles */
        body, html {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px; /* Add padding in case of small screen */
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        /* Form container styling */
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            overflow-y: auto; /* Allow scrolling if form is too tall */
            max-height: 90vh; /* Prevents form from going off-screen */
        }

        /* Form element styling */
        form label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1em;
            color: #333;
        }

        /* Submit button styling */
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
            width: 100%;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add New Patient</h1>
        <form ="your_php_file.php" method="POST">
            <label for="patient_name">First Name:</label>
            <input type="text" id="patient_name" name="patient_name" required>

            <label for="middlename">Middle Name:</label>
            <input type="text" id="middlename" name="middlename">

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>

            <label for="civil_status">Civil Status:</label>
            <select id="civil_status" name="civil_status" required>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
            </select>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="bp">Blood Pressure (BP):</label>
            <input type="text" id="bp" name="bp" required>

            <label for="temp">Temperature (°C):</label>
            <input type="text" id="temp" name="temp" required>

            <label for="weight">Weight (kg):</label>
            <input type="text" id="weight" name="weight" required>

            <label for="height">Height (cm):</label>
            <input type="text" id="height" name="height" required>

            <label for="session_category">Session Category:</label>
            <input type="text" id="session_category" name="session_category" required>

            <input type="submit" value="Add Patient">
        </form>
    </div>
</body>
</html>

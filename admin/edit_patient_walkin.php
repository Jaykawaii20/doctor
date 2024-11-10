<?php
// Database connection
include('../connection.php');

// Check if `id` is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the patient data
    $sql = "SELECT * FROM patient_walkin WHERE id = ?";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("i", $id);
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
        
        // Update the record in the patient_walkin table
        $updateSql = "UPDATE patient_walkin SET name = ?, middlename = ?, lastname = ?, address = ?, age = ?, birthdate = ?, weight = ?, height = ?, bp = ?, temp = ? WHERE id = ?";
        $updateStmt = $database->prepare($updateSql);
        $updateStmt->bind_param("ssssisssssi", $name, $middlename, $lastname, $address, $age, $birthdate, $weight, $height, $bp, $temp, $id);
        
        if($updateStmt->execute()){
            header("Location: patient.php");
            exit();
        } else {
            echo 'error: ' . error;
        }
    }
}
?>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container mt-5">
    <h2>Edit Patient Information</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">First Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($patient['name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="middlename">Middle Name:</label>
            <input type="text" id="middlename" name="middlename" class="form-control" value="<?php echo htmlspecialchars($patient['middlename']); ?>" required>
        </div>

        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo htmlspecialchars($patient['lastname']); ?>" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($patient['address']); ?>" required>
        </div>

        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" class="form-control" value="<?php echo htmlspecialchars($patient['age']); ?>" required>
        </div>

        <div class="form-group">
            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate" class="form-control" value="<?php echo htmlspecialchars($patient['birthdate']); ?>" required>
        </div>

        <div class="form-group">
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" class="form-control" step="0.1" value="<?php echo htmlspecialchars($patient['weight']); ?>" required>
        </div>

        <div class="form-group">
            <label for="height">Height (cm):</label>
            <input type="number" id="height" name="height" class="form-control" step="0.1" value="<?php echo htmlspecialchars($patient['height']); ?>" required>
        </div>

        <div class="form-group">
            <label for="bp">Blood Pressure (mmHg):</label>
            <input type="text" id="bp" name="bp" class="form-control" value="<?php echo htmlspecialchars($patient['bp']); ?>" required>
        </div>

        <div class="form-group">
            <label for="temp">Body Temperature (°C):</label>
            <input type="number" id="temp" name="temp" class="form-control" step="0.1" value="<?php echo htmlspecialchars($patient['temp']); ?>" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Update" class="btn btn-primary">
        </div>
    </form>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

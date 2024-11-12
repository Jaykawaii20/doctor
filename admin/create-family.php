<?php
    include("../connection.php");

    // Check if the form data was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $Id = $conn->real_escape_string($_POST['Id']);
    $name = $conn->real_escape_string($_POST['name']);
    $age = intval($_POST['age']);
    $sex = $conn->real_escape_string($_POST['sex']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $status = $conn->real_escape_string($_POST['status']);
    $religion = $conn->real_escape_string($_POST['religion']);
    $occupation = $conn->real_escape_string($_POST['occupation']);

    // SQL insert query
    $sql = "INSERT INTO family (
                Id ,name, age, sex, address, city, contact, status, religion, occupation
            ) VALUES (
                '0','$name', $age, '$sex', '$address', '$city', '$contact', '$status', '$religion', '$occupation'
            )";
            // INSERT INTO `family`(`Id`, `name`, `age`, `sex`, `address`, `city`, `contact`, `status`, `religion`, `occupation`) VALUES ('asdasd','asdasd','12','1','prk','gensan','0903','single','catholic','mason japin')

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "Record successfully inserted.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Planning</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            color: #495057;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        h2 {
            color: #343a40;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Reduced gap for compactness */
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px; /* Reduced gap for compactness */
        }

        label {
            width: 30%;
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px; /* Added margin for better spacing */
        }

        .form-input, select, textarea {
            flex: 1;
            padding: 8px; /* Reduced padding for compactness */
            border: 1px solid #ced4da;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-input:focus, select:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        td {
            padding: 5px; /* Reduced padding for compactness */
            vertical-align: top;
        }

        input[type="checkbox"] {
            margin-right: 5px; /* Reduced margin for compactness */
        }

        .submit-row {
            text-align: center;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px; /* Reduced padding for compactness */
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px; /* Reduced font size for compactness */
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .form-row {
                flex-direction: column;
            }

            label {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Family Planning</h1>
        <form action="family.php" method="POST">
            <!-- First Row -->
            <div class="form-row">
                <label>Name of Patient:</label>
                <input type="text" name="name" placeholder="Enter Patient Name" class="form-input">
                <label>Age:</label>
                <input type="number" name="age" placeholder="Enter Age" class="form-input">
                <label>Sex:</label>
                <select name="sex" class="form-input">
                    <option value="">Select</option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
                <label>Address:</label>
                <input type="text" name="address" placeholder="Enter Address" class="form-input">
            </div>

            <div class="form-row">
                <label>City:</label>
                <input type="text" name="city" placeholder="Enter City" class="form-input">
                <label>Contract #:</label>
                <input type="text" name="contact" placeholder="Enter Contract Number" class="form-input">
                <label>Civil Status:</label>
                <input type="text" name="status" placeholder="Enter Civil Status" class="form-input">
                <label>Religion:</label>
                <input type="text" name="religion" placeholder="Enter Religion" class="form-input">
                <label>Occupation:</label>
                <input type="text" name="occupation" placeholder="Enter Occupation" class="form-input">
            </div>


            <!-- <div class="form-row">
                
                <label>Name of Spouse:</label>
                <input type="text" name="accompanied_by" placeholder="Enter Spouse" class="form-input">
                <label>Spouse   Date of Birth:</label>
                <input type="datetime-local" name="date_time" class="form-input">
            </div>

            <div class="form-row">
                <label>Chief Complaints:</label>
                <textarea name="chief_complaints" rows="3" class="form-input"></textarea>
            </div>

            <h2>Medical Conditions</h2>
            <div class="form-row">
                <label>Hypertension:</label>
                <input type="checkbox" name="hypertension" value="yes">
                <label>Meds:</label>
                <input type="text" name="hypertension_meds" class="form-input">
            </div>

            <div class="form-row">
                <label>Diabetes:</label>
                <input type="checkbox" name="diabetes" value="yes">
                <label>Meds:</label>
                <input type="text" name="diabetes_meds" class="form-input">
            </div>

            <h2>Personal/Social History</h2>
            <div class="form-row">
                <label>Nature of Work/Occupation:</label>
                <input type="text" name="occupation" placeholder="Enter Occupation" class="form-input">
            </div>

            <div class="form-row">
                <label>Smoking:</label>
                <input type="checkbox" name="smoking" value="yes">
                <label>Pack Years:</label>
                <input type="number" name="pack_years" placeholder="Enter Pack Years" class="form-input">
            </div>

            <h2>Allergies</h2>
            <div class="form-row">
                <label>Food:</label>
                <input type="text" name="allergies_food" placeholder="Specify Food Allergies" class="form-input">
                <label>Drugs:</label>
                <input type="text" name="allergies_drugs" placeholder="Specify Drug Allergies" class="form-input">
                <label>Others:</label>
                <input type="text" name="allergies_others" placeholder="Specify Other Allergies" class="form-input">
            </div>

            <h2>Review of Systems:</h2>
            <table>
                <tr>
                    <td><input type="checkbox" name="altered_mental_sensorium"> Altered mental sensorium</td>
                    <td><input type="checkbox" name="diarrhea"> Diarrhea</td>
                    <td><input type="checkbox" name="hematemesis"> Hematemesis</td>
                    <td><input type="checkbox" name="palpitations"> Palpitations</td>
                </tr>
            </table> -->

            <!-- Submit Button -->
            <div class="submit-row">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
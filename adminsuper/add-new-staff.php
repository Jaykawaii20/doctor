<?php
session_start();
if (!isset($_SESSION["user"]) || ($_SESSION["user"] == "" || $_SESSION['usertype'] != 's')) {
    header("location: ../login.php");
}

include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $role = $_POST['role']; // 'midwife', 'nurse', 'doctor', 'patient'
    $user_type = '';

    // Determine the user type
    switch ($role) {
        case 'midwife':
            $user_type = 'm';
            $query = "INSERT INTO midwives (fullname, username, phone_no, email, password, role) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            break;
        case 'nurse':
            $user_type = 'n';
            $query = "INSERT INTO nurses (fullname, username, phone_no, email, password, role) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            break;
        case 'doctor':
            $user_type = 'd';
            $query = "INSERT INTO doctor (docname, docemail, docpassword, doctel) 
                      VALUES (?, ?, ?, ?)";
            break;
        case 'patient':
            $user_type = 'p';
            $query = "INSERT INTO patient (pname, pemail, ppassword, ptel) 
                      VALUES (?, ?, ?, ?)";
            break;
        default:
            die("Invalid role specified.");
    }

    // Prepare and execute the query
    $stmt = $database->prepare($query);
    if ($role == 'doctor') {
        $stmt->bind_param("ssss", $fullname, $email, $password, $phone_no);
    } else if ($role == 'patient') {
        $stmt->bind_param("ssss", $fullname, $email, $password, $phone_no);
    } else {
        $stmt->bind_param("ssssss", $fullname, $username, $phone_no, $email, $password, $role);
    }
    
    if ($stmt->execute()) {
        // Insert into webuser table
        $insertWebUserQuery = "INSERT INTO webuser (email, usertype) VALUES (?, ?)";
        $webUserStmt = $database->prepare($insertWebUserQuery);
        $webUserStmt->bind_param("ss", $email, $user_type);
        $webUserStmt->execute();

        header("location: staff-list.php?success=1"); // Redirect back to the staff list
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $database->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Staff</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <h1>Add New Staff</h1>
    <form action="" method="POST">
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" required>
        
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        
        <label for="phone_no">Phone Number:</label>
        <input type="text" name="phone_no" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <label for="role">Role:</label>
        <select name="role" required>
            <option value="midwife">Midwife</option>
            <option value="nurse">Nurse</option>
            <option value="doctor">Doctor</option>
            <option value="patient">Patient</option>
        </select>
        
        <button type="submit">Add Staff</button>
    </form>
</body>
</html>

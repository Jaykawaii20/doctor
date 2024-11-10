<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
        
    <title>Login</title>
</head>
<body>
<?php
session_start();

$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$_SESSION["date"] = $date;

// Import database
include("connection.php");

$error = '<label for="promter" class="form-label">&nbsp;</label>';  // Default error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $database->real_escape_string($_POST['useremail']); // Prevent SQL injection
    $password = $_POST['userpassword'];

    // Query to check user in the webuser table
    $result = $database->query("SELECT * FROM webuser WHERE email='$email'");

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $utype = $user['usertype'];

        switch ($utype) {
            case 'p':
                // Patient login
                $checker = $database->query("SELECT * FROM patient WHERE email='$email'");
                if ($checker->num_rows == 1) {
                    $patientRecord = $checker->fetch_assoc();
                    if ($password === $patientRecord['password']) { // Assuming password is plain text
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'p';
                        header('location: patient/index.php');
                        exit();
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
                }
                break;

            case 'a':
                // Admin login
                $checker = $database->query("SELECT * FROM admin WHERE aemail='$email'");
                if ($checker->num_rows == 1) {
                    $adminRecord = $checker->fetch_assoc();
                    if ($password === $adminRecord['apassword']) { // Assuming password is plain text
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'a';
                        header('location: admin/index.php');
                        exit();
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
                }
                break;

            case 'd':
                // Doctor login
                $checker = $database->query("SELECT * FROM doctor WHERE docemail='$email'");
                if ($checker->num_rows == 1) {
                    $doctorRecord = $checker->fetch_assoc();
                    if ($password === $doctorRecord['docpassword']) { // Assuming password is plain text
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'd';
                        header('location: doctor/index.php');
                        exit();
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
                }
                break;

            case 's':
                // Superadmin login
                $checker = $database->query("SELECT * FROM admin WHERE aemail='$email'");
                if ($checker->num_rows == 1) {
                    $adminRecord = $checker->fetch_assoc();
                    if ($password === $adminRecord['apassword']) { // Assuming password is plain text
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 's';
                        header('location: adminsuper/index.php');
                        exit();
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
                }
                break;

            case 'n':
                // Nurse login
                $checker = $database->query("SELECT * FROM nurses WHERE email='$email'");
                if ($checker->num_rows == 1) {
                    $userRecord = $checker->fetch_assoc();
                    if ($password === $userRecord['password']) { // Assuming password is plain text
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'n';
                        header('location: nurse/index.php');
                        exit();
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
                }
                break;

            case 'm':
                // Midwives login
                $checker = $database->query("SELECT * FROM midwives WHERE email='$email'");
                if ($checker->num_rows == 1) {
                    $userRecord = $checker->fetch_assoc();
                    if (password_verify($password, $userRecord['password'])) { // Use password_verify for hashed passwords
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'm';
                        header('location: midwives/index.php');
                        exit();
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
                }
                break;

            case 'ph':
                // Pharmacist login
                $checker = $database->query("SELECT * FROM users WHERE email='$email'");
                if ($checker->num_rows == 1) {
                    $userRecord = $checker->fetch_assoc();
                    if (password_verify($password, $userRecord['password'])) { // Use password_verify for hashed passwords
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'ph';
                        header('location: pharmacist/index.php');
                        exit();
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
                }
                break;

            default:
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Invalid user type.</label>';
                break;
        }
    } else {
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
    }
}
?>


    <center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Welcome!</p>
                </td>
            </tr>
            <div class="form-body">
                <tr>
                    <td>
                        <p class="sub-text">Login with your details to continue</p>
                    </td>
                </tr>
                <tr>
                    <form action="" method="POST">
                    <td class="label-td">
                        <label for="useremail" class="form-label">Email: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td">
                        <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td">
                        <label for="userpassword" class="form-label">Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td">
                        <input type="password" name="userpassword" class="input-text" placeholder="Password" required>
                    </td>
                </tr>
                <tr>
                    <td><br>
                    <?php echo $error ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Login" class="login-btn btn-primary btn">
                    </td>
                </tr>
                </div>
                <tr>
                    <td>
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                        <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a>
                        <br><br><br>
                    </td>
                </tr>
                </form>
            </table>
        </div>
    </center>
</body>
</html>

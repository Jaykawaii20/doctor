<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        
    <title>Patients</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .overlay {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* semi-transparent background */
        }

        .popup {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 90%; /* Adjust width as needed */
            max-width: 600px; /* Maximum width */
            overflow: hidden; /* Prevents content overflow */
        }
    </style>
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION["user"]) || $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
        exit();
    }

    // Import database
    include("../connection.php");
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">BHW</p>
                                    <p class="profile-subtitle">frontdesk</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Menu items -->
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu"><div><p class="menu-text">Staff</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-schedule">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-patient menu-active menu-icon-patient-active">
                        <a href="patient.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Patients(Walk-in)</p></div></a>
                    </td>
                </tr>
                
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-patient menu-active menu-icon-patient-active">
                        <a href="patient.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Patients(Online)</p></div </a>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                <td class="menu-btn menu-icon-history">
                <i class="fas fa-history" aria-hidden="true" style="margin-left: 82px; margin-top: 5px;"></i>
                <a href="Servicehistory.php" class="non-style-link-menu" style="margin: 10px;">Service History</a>
                </td>
                </tr>
                </tr>
                 <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="doctor_session.php" class="non-style-link-menu"><div><p class="menu-text">Patient Medical Record</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style="border-spacing: 0; margin: 0; padding: 0; margin-top: 25px;">
                <tr>
                    <td width="13%">
                        <a href="patient.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px; padding-bottom:11px; margin-left:20px; width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    
                    <td width="15%">
                        <p style="font-size: 14px; color: rgb(119, 119, 119); padding: 0; margin: 0; text-align: right;">Today's Date</p>
                        <p class="heading-sub12" style="padding: 0; margin: 0;">
                            <?php 
                            date_default_timezone_set('Asia/Kolkata');
                            echo date('Y-m-d');
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex; justify-content: center; align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:30px;">
                        <p class="heading-main12" style="margin-left: 45px; font-size:20px; color:rgb(49, 49, 49)">Patient Online</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" style="border-spacing:20px;">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">Name</th>
                                            <th class="table-headin">Date of Birth</th>
                                            <th class="table-headin">Address</th>
                                            <th class="table-headin">Age</th>
                                            <th class="table-headin">Gender</th>
                                            <th class="table-headin">Events</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // Database connection
                                    $host = "localhost";
                                    $username = "u593957475_root"; // change as per your DB setup
                                    $password = "OcPK^2g~"; // change as per your DB setup
                                    $dbname = "u593957475_dbkupal"; // change to your actual database name

                                    $conn = new mysqli($host, $username, $password, $dbname);

                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Fetch patient data
                                    $sql = "SELECT pid, name, middlename, lastname, birthdate, address, age, gender FROM patient";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['name']} {$row['middlename']} {$row['lastname']}</td>
                                                    <td>{$row['birthdate']}</td>
                                                    <td>{$row['address']}</td>
                                                    <td>{$row['age']}</td>
                                                    <td>{$row['gender']}</td>
                                                    <td>
                                                        <a href='edit_patient_online.php?pid={$row['pid']}' class='btn btn-sm btn-primary'>Edit</a>
                                                        <a href='delete_patient_online.php?pid={$row['pid']}' class='btn btn-sm btn-primary' onclick='return confirm(\"Are you sure you want to delete this patient?\")'>Delete</a>
                                                    </td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No data found</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </center>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php 
    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
        $sqlmain = "SELECT * FROM patient WHERE pid='$id'";
        $result = $database->query($sqlmain);
        $row = $result->fetch_assoc();
        $name = $row[" pname"];
        $email = $row["pemail"];
        $nic = $row["pnic"];
        $dob = $row["pdob"];
        $tele = $row["ptel"];
        $address = $row["paddress"];
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <a class="close" href="patient.php">&times;</a>
                    <div class="content"></div>
                    <form action="insert_patient.php" method="POST" style="display: flex; justify-content: center; overflow-y: auto; max-height: 600px;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                            <tr>
                                <td>
                                    <p style="padding: 0; margin: 0; text-align: left; font-size: 25px; font-weight: 500;">Add Patients</p><br><br>
                                </td>
                            </tr>
                            <tr>                    
                                <td class="label-td" colspan="2">
                                    <label for="patient_name" class="form-label">Patient Name:</label>
                                    <input type="text" id="patient_name" name="patient_name" required>
                                </td>
                            </tr>
                            <tr>                    
                                <td class="label-td" colspan="2">
                                    <label for="middlename" class="form-label">Middle Name:</label>
                                    <input type="text" id="middlename" name="middlename">
                                </td>
                            </tr>
                            <tr>                    
                                <td class="label-td" colspan="2">
                                    <label for="lastname" class="form-label">Last Name:</label>
                                    <input type="text" id="lastname" name="lastname" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="birthdate" class="form-label">Birthdate:</label>
                                    <input type="date" id="birthdate" name="birthdate" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="address" class="form-label">Address:</label>
                                    <input type="text" id="address" name="address" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="age" class="form-label">Age:</label>
                                    <input type="number" id="age" name="age" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="civil_status" class="form-label">Civil Status:</label>
                                    <input type="text" id="civil_status" name="civil_status">
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="gender" class="form-label">Gender:</label>
                                    <select id="gender" name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="bp" class="form-label">Blood Pressure (BP):</label>
                                    <input type="text" id="bp" name="bp">
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="temp" class="form-label"> Temperature (TEMP):</label>
                                    <input type="text" id="temp" name="temp">
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="weight" class="form-label">Weight (WT):</label>
                                    <input type="text" id="weight" name="weight">
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="height" class="form-label">Height (HT):</label>
                                    <input type="text" id="height" name="height">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="OK" class="login-btn btn-primary-soft btn "> <!-- Submit button -->
                                </td>
                            </tr>
                        </table>
                    </form>
                </center>
                <br><br>
            </div>
        </div>
        ';               
    }
?>
</div>

</body>
</html>
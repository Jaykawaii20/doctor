<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Schedule</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .top-right {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .heading-main12 {
            font-size: 20px;
            color: rgb(49, 49, 49);
        }
        .btn-container {
            margin-right: 20px;
        }
        .btn-container a {
            text-decoration: none;
        }
        .btn-container button {
            background-image: url('../img/icons/add.svg');
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION["user"]) || ($_SESSION["user"] == "" || $_SESSION['usertype'] != 's')) {
        header("location: ../login.php");
    }
    
    include("../connection.php");
    ?>

    <div class="container">
        <div class="menu">
            <!-- Your sidebar content here -->
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">BHW-Admin</p>
                                    <p class="profile-subtitle">admin@admin.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu "><div><p class="menu-text">Staff</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule menu-active menu-icon-schedule-active">
                        <a href="schedule.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>

            </table>
        </div>

        <div class="dash-body">
            <div class="top-right">
            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Add New Staff</p>
            <div class="btn-container">
    <a href="add-new-staff.php" class="non-style-link"><button class="login-btn btn-primary btn button-icon" style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">Add New</button></a>
                    </a>
                </div>
            </div>
           
            <table border="0" width="100%" style="border-spacing: 0; margin:0; padding:0;">
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">Full Name</th>
                                            <th class="table-headin">Email</th>
                                            <th class="table-headin">Role</th>
                                            <th class="table-headin">Phone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Your PHP code for fetching data goes here.

                                        // Fetch data from midwives
                                        $midwivesQuery = "SELECT fullname, email, 'Midwife' AS role, phone_no FROM midwives";
                                        $midwivesResult = $database->query($midwivesQuery);

                                        // Fetch data from nurses
                                        $nursesQuery = "SELECT fullname, email, 'Nurse' AS role, phone_no FROM nurses";
                                        $nursesResult = $database->query($nursesQuery);

                                        // Fetch data from doctors
                                        $doctorsQuery = "SELECT docname AS fullname, docemail AS email, 'Doctor' AS role, doctel AS phone_no FROM doctor";
                                        $doctorsResult = $database->query($doctorsQuery);

                                        // Fetch data from patients
                                        $patientsQuery = "SELECT pname AS fullname, pemail AS email, 'Patient' AS role, ptel AS phone_no FROM patient";
                                        $patientsResult = $database->query($patientsQuery);

                                        // Combine and display data
                                        if ($midwivesResult->num_rows > 0 || $nursesResult->num_rows > 0 || $doctorsResult->num_rows > 0 || $patientsResult->num_rows > 0) {
                                            // Display midwives
                                            while ($row = $midwivesResult->fetch_assoc()) {
                                                echo "<tr>
                                                    <td>" . $row['fullname'] . "</td>
                                                    <td>" . $row['email'] . "</td>
                                                    <td>" . $row['role'] . "</td>
                                                    <td>" . $row['phone_no'] . "</td>
                                                </tr>";
                                            }

                                            // Display nurses
                                            while ($row = $nursesResult->fetch_assoc()) {
                                                echo "<tr>
                                                    <td>" . $row['fullname'] . "</td>
                                                    <td>" . $row['email'] . "</td>
                                                    <td>" . $row['role'] . "</td>
                                                    <td>" . $row['phone_no'] . "</td>
                                                </tr>";
                                            }

                                            // Display doctors
                                            while ($row = $doctorsResult->fetch_assoc()) {
                                                echo "<tr>
                                                    <td>" . $row['fullname'] . "</td>
                                                    <td>" . $row['email'] . "</td>
                                                    <td>" . $row['role'] . "</td>
                                                    <td>" . $row['phone_no'] . "</td>
                                                </tr>";
                                            }

                                            // Display patients
                                            while ($row = $patientsResult->fetch_assoc()) {
                                                echo "<tr>
                                                    <td>" . $row['fullname'] . "</td>
                                                    <td>" . $row['email'] . "</td>
                                                    <td>" . $row['role'] . "</td>
                                                    <td>" . $row['phone_no'] . "</td>
                                                </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No staff or patients found</td></tr>";
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
</body>
</html>

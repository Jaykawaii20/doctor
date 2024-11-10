<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Appointments</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    
    

       //import database
       include("../connection.php");
       $userrow = $database->query("select * from doctor where docemail='$useremail'");
       $userfetch=$userrow->fetch_assoc();
       $userid= $userfetch["docid"];
       $username=$userfetch["docname"];
    //echo $userid;
    ?>
    <div class="container">
        <div class="menu">
        <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
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
                    <td class="menu-btn menu-icon-dashbord " >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment  menu-active menu-icon-appoinment-active">
                        <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">My Appointments</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">My Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">My Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="appointment.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Appointment Manager</p>
                                           
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">

                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                <!-- <tr>
                    <td colspan="4" >
                        <div style="display: flex;margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">Schedule a Session</div>
                        <a href="?action=add-session&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('../img/icons/add.svg');">Add a Session</font></button>
                        </a>
                        </div>
                    </td>
                </tr> -->
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
                        

                    </tr>
                            </table>

                        </center>
                    </td>
                    
                </tr>
                
                  
                <tr>
                <?php
// Database connection
include('../connection.php');

// Fetch appointment data along with patient details where status is 'approved'
$sql = "SELECT ap.id AS appointment_id, ap.appointmentname, ap.category, ap.date AS appointment_date, 
        ap.datecreated, p.pid, p.name, p.middlename, p.lastname, p.address, p.age, p.Gender 
        FROM appointment_patient ap
        INNER JOIN patient p ON ap.pid = p.pid
        WHERE ap.status = 'approved' AND ap.category = 'doctor'";

// Execute the query
$result = $database->query($sql);
?>

<td colspan="4">
    <center>
        <div class="abc scroll">
            <table width="93%" class="sub-table scrolldown" style="border-spacing:15px;">
                        <h4>Appointment Online</h4>
                <thead>
                    <tr>
                        <th class="table-headin">Appointment Number</th>
                        <th class="table-headin">Patient Name</th>
                        <th class="table-headin">Patient Address</th>
                        <th class="table-headin">Patient Age</th>
                        <th class="table-headin">Appointment Date</th>
                        <th class="table-headin">Patient Gender</th>
                        <th class="table-headin">Events</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are any results
                    if ($result->num_rows > 0) {
                        // Loop through and display the data
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['appointment_id']}</td>
                                    <td>{$row['name']} {$row['middlename']} {$row['lastname']}</td>
                                    <td>{$row['address']}</td>
                                    <td>{$row['age']}</td>
                                    <td>{$row['appointment_date']}</td>
                                    <td>{$row['Gender']}</td>
                                    <td>
                                        <a href='historysheetAdult.php?pid={$row['pid']}' class='btn btn-primary btn-sm'>SESSION</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        // If no data, show message
                        echo "<tr><td colspan='7'>No approved appointments found</td></tr>";
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
    </div>
</body>
</html>
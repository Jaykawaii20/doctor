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
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table {
    width: 100%; /* Full width */
    border: 1px solid #ccc; /* Table border */
    border-radius: 8px; /* Rounded corners */
    overflow: hidden; /* Ensures rounded corners are visible */
}

.table-heading {
    background-color: #f2f2f2; /* Light gray background for headers */
    color: #333; /* Darker text color for better contrast */
    padding: 10px; /* Padding inside header cells */
    text-align: left; /* Align text to the left */
    border-bottom: 2px solid #ccc; /* Bottom border for header */
}

.sub-table th, .sub-table td {
    padding: 15px; /* Padding inside cells */
    border: 1px solid #ddd; /* Border for cells */
}

.sub-table tbody tr:nth-child(even) {
    background-color: #f9f9f9; /* Zebra striping for even rows */
}

.sub-table tbody tr:hover {
    background-color: #f1f1f1; /* Highlight row on hover */
}

.scroll {
    max-height: 300px; /* Set a max height for scrolling */
    overflow-y: auto; /* Enable vertical scrolling */
}
</style>
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    

    //import database
    include("../connection.php");

    
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
                                    <p class="profile-title">BHW</p>
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
                    <td class="menu-btn menu-icon-schedule">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient  menu-active menu-icon-patient-active">
                        <a href="patient.php" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient  menu-active menu-icon-patient-active">
                        <a href="patientwalkin.php" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">Patients Walk in</p></a></div>
                    </td>
                </tr>
                </tr>
                <tr class="menu-row" >
                <td class="menu-btn menu-icon-history">
                <i class="fas fa-history" aria-hidden="true" style="margin-left: 82px; margin-top: 5px;"></i>
                <a href="Servicehistory.php" class="non-style-link-menu" style="margin: 10px;">Appointment History</a>
                </td>
                </tr>
                 <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="doctor_session.php" class="non-style-link-menu"><div><p class="menu-text">Patient Medical Record</p></a></div>
                    </td>
                </tr>
               
              

            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">

                    <a href="patient.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                        
                    </td>
                    <td>
                        
                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Patient name or Email" list="patient">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="patient">';
                                $list11 = $database->query("select  name,email from patient;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $name=$row00["name"];
                                    $email=$row00["email"];
                                    echo "<option value='$name'><br/>";
                                    echo "<option value='$email'><br/>";
                                };

                            echo ' </datalist>';
?>
                            
                       
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                        date_default_timezone_set('Asia/Kolkata');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               

               <!-- <tr >
                    <td colspan="2" style="padding-top:30px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Add New Patient</p>
                    </td>
                    <td colspan="2">
                        <a href="?action=add&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">Add Newbelat</font></button>
                            </a></td>
                </tr>-->
                
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Patients Walk In(<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <tr>
    <td colspan="2" style="padding-top:30px;">
        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Add New Patient</p>
    </td>
    <td colspan="2">
        <a href="insert_patient.php?action=add" class="non-style-link">
            <button class="login-btn btn-primary btn button-icon" style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">
                Add New
            </button>
            
        </a>
    </td>
</tr>
                <?php
if ($_POST) {
    $keyword = $_POST["search"];
    
    // Use prepared statements to prevent SQL injection
    $stmt = $database->prepare("SELECT * FROM patient_walkin WHERE pemail = ? OR pname = ? OR pname LIKE ? OR pname LIKE ? OR pname LIKE ?");
    $likeKeyword = "%$keyword%";
    $stmt->bind_param("sssss", $keyword, $keyword, $likeKeyword, $likeKeyword, $likeKeyword);
} else {
    $stmt = $database->prepare("SELECT * FROM patient_walkin ORDER BY id DESC");
}

if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();

    ?>
    <tr>
        <td colspan="4">
            <center>
                <div class="abc scroll">
                    <table width="93%" class="sub-table scrolldown" style="border-collapse: collapse; margin: 20px auto;">
                        <thead>
                            <tr>
                                <th class="table-heading">Name</th>
                                <th class="table-heading">Middlename</th>
                                <th class="table-heading">Lastname</th>
                                <th class="table-heading">Address</th>
                                <th class="table-heading">Gender</th>
                                <th class="table-heading">Bp</th>
                                <th class="table-heading">Temp</th>
                                <th class="table-heading">Weight</th>
                                <th class="table-heading">Height</th>
                                <th class="table-heading">Session Category</th>
                                <th class="table-heading">Civil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row["id"];
                                    $name = $row["name"];
                                    $middlename = $row["middlename"];
                                    $lastname = $row["lastname"];
                                    $address = $row["address"];
                                    $gender = $row["gender"]; 
                                    $bp = $row["bp"]; 
                                    $temp = $row["temp"]; 
                                    $weight = $row["weight"]; 
                                    $height = $row["height"]; 
                                    $session_category = $row["session_category"]; 
                                    $civil = $row["civil_status"];
                                    
                                    echo '<tr>
                                        <td>&nbsp;' . substr($name, 0, 35) . '</td>
                                        <td>' . substr($middlename, 0, 12) . '</td>
                                        <td>' . substr($lastname, 0, 10) . '</td>
                                        <td>' . substr($address, 0, 10) . '</td>
                                        <td>' . substr($gender, 0, 10) . '</td>
                                         <td>' . substr($bp, 0, 10) . '</td>
                                          <td>' . substr($temp, 0, 10) . '</td>
                                           <td>' . substr($weight, 0, 10) . '</td>
                                           <td>' . substr($height, 0, 10) . '</td>
                                                 <td>' . substr($session_category, 0, 10) . '</td>
                                        <td>' . substr($civil, 0, 10) . '</td>
                                    </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="7">No results found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </center>
        </td>
    </tr>
    <?php
} else {
    echo "Error preparing statement: " . $database->error;
}
?>
        </div>
    </div>
    <?php 
    if($_GET){
        
        $id=$_GET["id"];
        $action=$_GET["action"];
            $sqlmain= "select * from patient_walkin where pid='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["pname"];
            $email=$row["pemail"];
            $nic=$row["pnic"];
            $dob=$row["pdob"];
            $tele=$row["ptel"];
            $address=$row["paddress"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="patient.php">&times;</a>
                        <div class="content">

                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Patient ID: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    P-'.$id.'<br><br>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$name.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$email.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nid" class="form-label">NId: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$nic.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$tele.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Address: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            '.$address.'<br><br>
                            </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Date of Birth: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$dob.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="patient.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        
    };

?>
</div>

</body>
</html>
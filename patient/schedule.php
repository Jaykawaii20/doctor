<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.2/main.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <title>Sessions</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        /* Calendar Styles */
        #calendar {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Form Styles */
        .event-form {
            margin: 20px auto;
            max-width: 400px;
            display: flex;
            flex-direction: column;
        }

        .event-form input,
        .event-form button {
            margin-bottom: 10px;
        }

        #eventModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        #eventModal>div {
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
        }
    </style>


</head>

<body>
    <?php

    // Start the session
    session_start();

    // Check if the user is logged in and is of the correct user type ('p' for patient)
    if (isset($_SESSION["user"])) {
        if (empty($_SESSION["user"]) || $_SESSION['usertype'] != 'p') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }

    // Import database connection
    include("../connection.php");

    // Fetch patient details based on email
    $sqlmain = "SELECT * FROM patient WHERE email = ?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $result = $stmt->get_result();
    $userfetch = $result->fetch_assoc();
    $userid = $userfetch["pid"];  // Patient ID
    $username = $userfetch["name"];

    // Store the patient ID (pid) in the session
    $_SESSION['pid'] = $userid;

    // Set the timezone and get today's date
    date_default_timezone_set('Asia/Kolkata');
    $today = date('Y-m-d');

    // Fetch the patient's appointments
    // Fetch approved appointments for the logged-in patient
    $userid = $_SESSION['pid'];  // Make sure to retrieve the patient ID from session or other secure methods
    $sql = "SELECT * FROM appointment WHERE status = 'appoint'";
    $result = $database->query($sql);

    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            'title' => $row['appointname'] ?: 'appointment',  // Use the correct column name
            'start' => $row['date'],
            'id'    => $row['id']  // Use appointment ID for future edits (ensure this is the correct ID field)
        ];
    }

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
                                    <p class="profile-title"><?php echo substr($username, 0, 13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22)  ?></p>
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
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home ">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Home</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                <a href="schedule.php" class="non-style-link-menu non-style-link-menu-active">
                    <div>
                        <p class="menu-text">Scheduled Events</p>
                    </div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment">
                <a href="appointment.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">My Bookings</p>
                </a>
    </div>
    </td>
    </tr>
    <!-- <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr> -->

    </table>
    </div>
    <?php

    $sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today'  order by schedule.scheduledate asc";
    $sqlpt1 = "";
    $insertkey = "";
    $q = '';
    $searchtype = "All";
    if ($_POST) {
        //print_r($_POST);

        if (!empty($_POST["search"])) {
            /*TODO: make and understand */
            $keyword = $_POST["search"];
            $sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today' and (doctor.docname='$keyword' or doctor.docname like '$keyword%' or doctor.docname like '%$keyword' or doctor.docname like '%$keyword%' or schedule.title='$keyword' or schedule.title like '$keyword%' or schedule.title like '%$keyword' or schedule.title like '%$keyword%' or schedule.scheduledate like '$keyword%' or schedule.scheduledate like '%$keyword' or schedule.scheduledate like '%$keyword%' or schedule.scheduledate='$keyword' )  order by schedule.scheduledate asc";
            //echo $sqlmain;
            $insertkey = $keyword;
            $searchtype = "Search Result : ";
            $q = '"';
        }
    }


    $result = $database->query($sqlmain)


    ?>

    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="schedule.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>
                    <form action="" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Staff Specialist name or Email or Date (YYYY-MM-DD)" list="Staff" value="<?php echo $insertkey ?>">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="Staff">';
                        $list11 = $database->query("select DISTINCT * from  doctor;");
                        $list12 = $database->query("select DISTINCT * from  schedule GROUP BY title;");





                        for ($y = 0; $y < $list11->num_rows; $y++) {
                            $row00 = $list11->fetch_assoc();
                            $d = $row00["docname"];

                            echo "<option value='$d'><br/>";
                        };


                        for ($y = 0; $y < $list12->num_rows; $y++) {
                            $row00 = $list12->fetch_assoc();
                            $d = $row00["title"];

                            echo "<option value='$d'><br/>";
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


                        echo $today;



                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>


            <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;">
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $searchtype . " Sessions" . "(" . $result->num_rows . ")"; ?> </p>
                    <p class="heading-main12" style="margin-left: 45px;font-size:22px;color:rgb(49, 49, 49)"><?php echo $q . $insertkey . $q; ?> </p>
                </td>

            </tr>



            <tr>
                <td colspan="4">
                    <form action="save_event.php" post="POST">
                        <center>
                            <div class="abc scroll">
                                <div id="calendar" style="max-width: 800px; margin: 20px auto; padding: 20px;"></div>
                            </div>
                        </center>
                    </form>
                </td>
            </tr>





        </table>
    </div>
    </div>

    </div>



    <!-- Add this HTML to define the dropdown time picker -->
    <!-- Add this HTML to define the dropdown time picker -->
    <div id="eventModal">
        <div id="modalContent">
            <form method="POST" id="eventForm">
                <h3>Appointment Details</h3>
                <label for="eventTitle">Appointment Title:</label>
                <input type="text" id="eventTitle" style="width: 100%; margin-bottom: 10px;" required>

                <label for="eventTime">Select Time:</label>
                <select id="eventTime" style="width: 100%; margin-bottom: 10px;">
                    <option value="06:00">06:00 AM</option>
                    <option value="07:00">07:00 AM</option>
                    <option value="08:00">08:00 AM</option>
                    <option value="09:00">09:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="13:00">01:00 PM</option>
                    <option value="14:00">02:00 PM</option>
                    <option value="15:00">03:00 PM</option>
                    <option value="16:00">04:00 PM</option>
                    <option value="17:00">05:00 PM</option>
                </select>

                <button type="button" id="saveEventButton">Appoint</button>
                <button type="button" id="cancelEventButton">Cancel</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var eventModal = document.getElementById('eventModal');
            var saveEventButton = document.getElementById('saveEventButton');
            var cancelEventButton = document.getElementById('cancelEventButton');
            var eventTitleInput = document.getElementById('eventTitle');
            var eventTimeSelect = document.getElementById('eventTime');
            var selectedDate = null;
            var currentEvent = null;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                editable: true,
                events: <?php echo json_encode($appointments); ?>,

                // Event click handler to open the modal for editing
                eventClick: function(info) {
                    currentEvent = info.event; // Store the clicked event for potential updates
                    selectedDate = info.event.startStr.split("T")[0]; // Extract date

                    // Set the time and title in the modal
                    eventTimeSelect.value = info.event.start.toISOString().substr(11, 5);
                    eventTitleInput.value = info.event.title;

                    // Show the modal
                    eventModal.style.display = 'block';
                },

                // Date selection handler for creating new events
                select: function(info) {
                    selectedDate = info.startStr; // Store the selected date
                    currentEvent = null; // No current event (indicating new event)
                    eventTitleInput.value = ''; // Clear previous values
                    eventTimeSelect.value = '09:00'; // Reset to default time

                    // Show the modal
                    eventModal.style.display = 'block';
                }
            });

            // Handle save button click to save or update the event
            saveEventButton.addEventListener('click', function() {
                var title = eventTitleInput.value;
                var time = eventTimeSelect.value; // Fetch the selected time

                console.log("Selected Date:", selectedDate); // Log selected date
                console.log("Time:", time); // Log the selected time

                // Ensure selectedDate and time are defined before proceeding
                if (title && selectedDate && time) {
                    var startDateTime = selectedDate + ' ' + time + ':00'; // Use space instead of 'T'

                    // Save the new event in the database
                    $.ajax({
                        url: 'save_event.php',
                        method: 'POST',
                        data: {
                            title: title,
                            start: startDateTime,
                            pid: <?php echo json_encode($_SESSION['pid']); ?>, // Ensure this is set and properly escaped for JavaScript
                        },
                        success: function(response) {
                            console.log(response); // Log the response from the server
                            try {   
                                var jsonResponse = JSON.parse(response); // Ensure we're parsing JSON

                                if (jsonResponse.status === 'success') {
                                    calendar.addEvent({
                                        id: jsonResponse.event_id, // Use event_id returned from PHP
                                        title: title,
                                        start: startDateTime, // Correctly formatted timestamp
                                        allDay: false // Adjust based on your needs
                                    });
                                    eventModal.style.display = 'none'; // Hide the modal
                                } else {
                                    alert('Error saving event: ' + jsonResponse.message);
                                }
                            } catch (error) {
                                console.error('Parsing error:', error);
                                alert('An error occurred while processing the response.');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('AJAX error:', textStatus, errorThrown);
                            alert('AJAX error: ' + textStatus + ' - ' + errorThrown);
                        }
                    });
                } else {
                    alert('Please enter an event title, select a date, and choose a time.');
                }
            });

            // Handle cancel button click to close the modal
            cancelEventButton.addEventListener('click', function() {
                eventModal.style.display = 'none'; // Hide the modal
                calendar.unselect(); // Deselect any selected date
            });

            calendar.render(); // Render the calendar
        });
    </script>




</body>

</html>
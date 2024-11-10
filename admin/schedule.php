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
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <title>Schedule</title>
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

        .modal {
            position: fixed; 
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }
    </style>
</head>
<body>
<?php
// Start the session
session_start();

// Check if the user is logged in and is of the correct user type ('a' for admin)
if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
    header("location: ../login.php");
    exit();  // Stop script execution after the redirect
}

// Import database connection
include("../connection.php");

// Fetch appointments
$sql = "SELECT * FROM appointment WHERE status = 'appoint'";
$result = $database->query($sql);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . $database->error);
}

// Initialize appointments array
$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = [
        'title' => $row['appointname'] ?: 'appointment',  // Default title if none provided
        'start' => $row['date'],
        'id'    => $row['id']  // Use appointment ID for future edits
    ];
}

// Debugging: Check if appointments were fetched
if (empty($appointments)) {
    echo "<script>console.log('No appointments found.');</script>";
} else {
    echo "<script>console.log('Appointments fetched successfully: " . count($appointments) . "');</script>";
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
            <tr class="menu-row">
                <td class="menu-btn menu-icon-dashbord">
                    <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                </td>
            </tr>
            <!-- Other menu items... -->
            <tr class="menu-row menu-active ">
                <td class="menu-btn menu-icon-schedule">
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
        <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;margin-top:25px;">
            <tr>
                <td width="13%">
                    <a href="schedule.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Set Schedule</p>
                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">Today's Date</p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php 
                        date_default_timezone_set('Asia/Kolkata');
                        $today = date('Y-m-d');
                        echo $today;
                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top:0px;width: 100%;">
                    <center>
                        <form action="save_event.php" method="POST">
                        <div class="abc scroll">
                            <div id="calendar" style="max-width: 800px; margin: 20px auto; padding: 20px;"></div>
                        </div>
                        </form>
                    </center>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- Modal Structure -->
 
<div id="categoryModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000;">
    <div style="position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 8px; width: 300px;">
        <h4>Appointment Details</h4>
        <label for="appointmentname"> Appointment:
            <input type="text" name="appointmentname" id="appointmentname" required>
        </label>
        <br>
        <h3>Select Category</h3>
        <label>
            <input type="radio" name="category" value="Doctor" checked>
            Doctor
        </label>
        <label>
            <input type="radio" name="category" value="Midwives">
            Midwives
        </label>
        <label>
            <input type="radio" name="category" value="Nurse">
            Nurse
        </label>
        <div class="modal-footer" style="margin-top: 20px; text-align: right;">
            <button id="modalConfirm" class="btn">Confirm</button>
            <button id="modalCancel" class="btn">Cancel</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var modal = document.getElementById('categoryModal');
    var selectedCategory = 'Doctor'; // Default category

    // Prepare the events data from PHP
    var eventsData = <?php echo json_encode($appointments); ?>;
    console.log('Events Data:', eventsData);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        editable: true,
        events: eventsData,

        // Event click handler
        eventClick: function(info) {
            console.log("Event clicked: ", info.event);
            alert('You cannot edit events here. Please use the create button.'); // Inform that editing is not allowed
        },

        // Date selection handler for creating new events
        select: function(info) {
            console.log("Date selected: ", info.startStr);

            // Show modal for category selection when creating a new event
            modal.style.display = 'block'; // Show modal

            document.getElementById('modalConfirm').onclick = function() {
                // Get selected category from modal
                selectedCategory = document.querySelector('input[name="category"]:checked').value;

                var title = document.getElementById('appointmentname').value; // Get title from input
                if (title) {
                    // Send AJAX request to save the new event in the database
                    $.ajax({
                        url: 'save_event.php',
                        method: 'POST',
                        data: {
                            title: title,
                            start: info.startStr,
                            end: info.endStr,
                            category: selectedCategory // Include category in save
                        },
                        success: function(response) {
                            console.log("Save response: ", response);
                            if (response.status === 'success') {
                                calendar.addEvent({
                                    id: response.id,
                                    title: title,
                                    start: info.startStr,
                                    end: info.endStr,
                                    allDay: true,
                                    extendedProps: {
                                        category: selectedCategory // Store category in event
                                    }
                                });
                            } else {
                                alert('Added successfully!');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('AJAX error:', textStatus, errorThrown);
                            alert('AJAX error: ' + textStatus + ', ' + errorThrown);
                        }
                    });
                } else {
                    alert('Please enter an appointment name.'); // Alert for missing title
                }

                modal.style.display = 'none'; // Close modal
            };
            calendar.unselect(); // Clear the selection
        }
    });

    // Close modal on cancel
    document.getElementById('modalCancel').onclick = function() {
        modal.style.display = 'none'; // Close modal
    };

    calendar.render(); // Render the calendar
});
</script>


</body>
</html>

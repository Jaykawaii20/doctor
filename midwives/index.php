<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.2/main.min.css">

    <!-- FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.2/main.min.js"></script>
    <!-- Keep only one version of FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>


    <style>
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
    </style>
</head>

<body>
    <?php
    session_start();

    // User Authentication
    if (!isset($_SESSION["user"]) || $_SESSION['usertype'] != 'm') {
        header("Location: ../login.php");
        exit();
    }

    $useremail = $_SESSION["user"];
    include("../connection.php");

    // Fetch midwife details
    $userrow = $database->query("SELECT * FROM midwives WHERE email='$useremail'");
    if ($userrow->num_rows == 1) {
        $userfetch = $userrow->fetch_assoc();
        $userid = $userfetch["midwife_id"];
        $username = $userfetch["fullname"];
    } else {
        header("Location: ../login.php");
        exit();
    }

    // Fetch appointments for the logged-in midwife
        $sql = "SELECT * FROM midwivesappointment WHERE midwife_id = $userid";
        $result = $database->query($sql);

        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = [
                'title' => $row['description'] ?: 'Appointment',  // Default title if no description
                'start' => $row['appointment_date'],
                'id'    => $row['appointment_id']  // Keep track of the appointment ID for future edits
            ];
        }

    
    
    ?>

    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td colspan="2" style="padding:10px">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="User" style="border-radius:50%" width="100%">
                                </td>
                                <td>
                                    <p class="profile-title"><?php echo substr($username, 0, 13) ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22) ?></p>
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
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active">
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                            <div><p class="menu-text">Dashboard</p></div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Appointments</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">My Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;">
                <tr>
                    <td class="nav-bar">
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Dashboard</p>
                    </td>
                    <td width="25%"></td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);text-align: right;">Today's Date</p>
                        <p class="heading-sub12">
                            <?php echo date('Y-m-d'); ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label">
                            <img src="../img/calendar.svg" width="100%">
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <table class="filter-container doctor-header" style="border: none;width:95%" border="0">
                                <tr>
                                    <td>
                                        <h3>Welcome!</h3>
                                        <h1><?php echo $username; ?>.</h1>
                                        <p>Thanks for joining us. You can view your daily schedule and reach patients' appointments easily!<br><br></p>
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <!-- Calendar Container -->
                        <div id="calendar" style="max-width: 800px; margin: 20px auto; padding: 20px;"></div>
                        </td>
                </tr>
            </table>
        </div>
    </div>
<!-- FullCalendar Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,   // Enable date selection
            editable: true,     // Allow events to be edited (drag/drop)
            events: <?php echo json_encode($appointments); ?>, // Load events from PHP

            // Debugging: Log loaded events
            console.log("Loaded events: ", <?php echo json_encode($appointments); ?>);

            // Event click handler
            eventClick: function(info) {
                var newTitle = prompt('Edit Event Title:', info.event.title);
                if (newTitle) {
                    // Debugging: Log event details before update
                    console.log("Updating event: ", { id: info.event.id, title: newTitle });

                    // Send AJAX request to update the event in the database
                    $.ajax({
                        url: 'update_event.php',
                        method: 'POST',
                        data: { id: info.event.id, title: newTitle },
                        success: function(response) {
                            // Debugging: Log AJAX response
                            console.log("Update response: ", response);

                            if (response.status == 'success') {
                                info.event.setProp('title', newTitle);  // Update the title in the calendar
                            } else {
                                alert('Error updating event');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Debugging: Log AJAX errors
                            console.log("Error updating event: ", status, error);
                        }
                    });
                }
            },

            // Date selection handler for creating new events
            select: function(info) {
                var title = prompt('Enter Event Title:');
                if (title) {
                    // Debugging: Log event details before insertion
                    console.log("Creating new event with title: ", title, " Start date: ", info.startStr);

                    // Send AJAX request to save the new event in the database
                    $.ajax({
                        url: 'save_event.php',  // Insert new event into the database
                        method: 'POST',
                        data: {
                            title: title,
                            start: info.startStr,
                            midwife_id: <?php echo $userid; ?>  // Send the logged-in midwife's ID
                        },
                        success: function(response) {
                            // Debugging: Log AJAX response
                            console.log("Save response: ", response);

                            if (response.status == 'success') {
                                // Add the new event to the calendar
                                calendar.addEvent({
                                    id: response.event_id,  // Use the returned event ID
                                    title: title,
                                    start: info.startStr
                                });
                            } else {
                                alert('Error saving event');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Debugging: Log AJAX errors
                            console.log("Error saving event: ", status, error);
                        }
                    });
                }
                calendar.unselect();  // Clear the selection after adding the event
            }
        });

        // Render the calendar
        calendar.render();

        // Debugging: Log calendar rendered
        console.log("Calendar rendered successfully.");
    });
</script>


</body>

</html>

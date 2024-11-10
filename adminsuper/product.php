<?php
// Start session if needed
session_start();

// Check if the user is logged in and is an admin
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] == "" || $_SESSION['usertype'] != 's') {
        header("location: ../login.php");
    }
} else {
    header("location: ../login.php");
}

// Include the database connection
include("../connection.php");

// Fetch products from the database
$sql = "SELECT * FROM product";
$result = mysqli_query($database, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <title>Products</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        /* Styling for the floating message */
        .floating-message {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .floating-message.show {
            opacity: 1;
        }

        .floating-message.hide {
            opacity: 0;
        }
    </style>
</head>
<body>

<!-- Floating message -->
<?php if (isset($_SESSION['message'])): ?>
    <div class="floating-message" id="floatingMessage">
        <?php 
        echo $_SESSION['message']; 
        unset($_SESSION['message']); // Clear the message after displaying it
        ?>
    </div>
<?php endif; ?>


<script>
    // Show the floating message and fade it out after 3 seconds
    window.onload = function() {
        const messageBox = document.getElementById('floatingMessage');
        if (messageBox) {
            messageBox.classList.add('show');
            setTimeout(() => {
                messageBox.classList.remove('show');
                messageBox.classList.add('hide');
            }, 3000); // 3 seconds delay
        }
    }
</script>

<!-- Rest of your HTML content for product listing -->
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
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-medicine">
                        <a href="product.php" class="non-style-link-menu"><div><p class="menu-text">Medicine</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon">
                        <a href="staff-list.php" class="non-style-link-menu"><div><p class="menu-text">Staff List</p></a></div>
                    </td>
                </tr>

            </table>
        </div>

    <div class="dash-body">
        <table border="0" width="100%" style="border-spacing: 0; margin: 0; padding: 0; margin-top: 25px;">
            <tr>
                <td colspan="4">
                    <div style="display: flex; margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px; font-size: 20px; color: rgb(49, 49, 49); margin-top: 5px;">Add Medicine</div>
                        <a href="add-product.php" class="non-style-link">
                            <button class="login-btn btn-primary btn button-icon" style="margin-left: 25px; background-image: url('../img/icons/add.svg');">Add Medicine</button>
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">Image</th>
                                        <th class="table-headin">Medicine Name</th>
                                        <th class="table-headin">Quantity</th>
                                        <th class="table-headin">Description</th>
                                        <th class="table-headin">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        // Fetch and display each product
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td><img src='../admin/productpc/{$row['image']}' alt='{$row['name']}' class='product-image'></td>";
                                            echo "<td>{$row['name']}</td>";
                                            echo "<td>{$row['quantity']}</td>";
                                            echo "<td>{$row['description']}</td>";
                                            echo "<td>
                                                    <a href='edit-product.php?id={$row['id']}' class='btn btn-primary'>Edit</a>
                                                    <a href='delete-product.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No products found.</td></tr>";
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

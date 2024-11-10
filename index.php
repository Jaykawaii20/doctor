<?php
// Start session if needed
session_start();

// Include database connection
include("connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/index.css">
    <title>Health Center</title>
    <style>
                 body {
                    font-family: Arial, sans-serif;
                }

                .pharmacy-section {
                    margin-top: 50px;
                    text-align: center;
                }

                .product-container {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-around; /* Distribute space between items */
                    gap: 30px; /* Add space between cards */
                    margin-top: 20px;
                }

                .product-card {
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    padding: 15px;
                    width: 320px; /* Set a larger width for the product cards */
                    text-align: center;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                    background-color: #fff; /* Optional: add background color for better visibility */
                }

                .product-image {
                    width: 100%; /* Make the image take the full width of the card */
                    height: 400px; /* Set a fixed height for the image */
                    object-fit: cover; /* Ensure the image covers the space while maintaining aspect ratio */
                    border-radius: 5px;
                }

                .product-card h3 {
                    margin: 15px 0 10px;
                    font-size: 1.2em;
                }

                .product-card p {
                    margin: 5px 0;
                }

    </style>
</head>
<body>
    <div class="full-height">
        <center>
            <table border="0">
                <tr>
                    <td width="80%">
                        <span class="edoc-logo">weHealthCenter.</span>
                        <span class="edoc-logo-sub">| The Web-based Health Center Management of san isidro</span>
                    </td>
                    <td width="10%">
                        <a href="login.php" class="non-style-link">
                            <p class="nav-item">LOGIN</p>
                        </a>
                    </td>
                    <td width="10%">
                        <a href="signup.php" class="non-style-link">
                            <p class="nav-item" style="padding-right: 10px;">REGISTER</p>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p class="heading-text">Make an appointment today!</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p class="sub-text2">
                            How's your health today? No worries! With SanIsidro weHealthCenter, you can easily find and book an appointment online at your convenience. 
                            <br> Enjoy our  service and schedule your appointment now!
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <center>
                            <a href="login.php">
                                <input type="button" value="Make Appointment" class="login-btn btn-primary btn">
                            </a>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
    </div>

    
</body>
</html>

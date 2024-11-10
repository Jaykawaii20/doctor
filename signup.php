<?php

@include 'connection.php';

if (isset($_POST['submit'])) {

   // Escape and sanitize user inputs
   $name = mysqli_real_escape_string($database, $_POST['name']);
   $email = mysqli_real_escape_string($database, $_POST['email']);
   $middlename = mysqli_real_escape_string($database, $_POST['middlename']);
   $lastname = mysqli_real_escape_string($database, $_POST['lastname']);
   $address = mysqli_real_escape_string($database, $_POST['address']);
   $Gender = mysqli_real_escape_string($database, $_POST['Gender']);
   $civil = mysqli_real_escape_string($database, $_POST['civil']);
   $age = mysqli_real_escape_string($database, $_POST['age']);

   // Convert the birthdate to a proper format (Y-m-d)
   $birthdate_raw = mysqli_real_escape_string($database, $_POST['birthday']); 
   $birthdate = date('Y-m-d', strtotime($birthdate_raw));  // Convert to MySQL's date format

   // Validate age (14 years and above)
   $birthdate_valid = DateTime::createFromFormat('Y-m-d', $birthdate);
   if ($birthdate_valid && $birthdate_valid->format('Y-m-d') === $birthdate) {
       // Calculate age from birthdate
       $today = new DateTime();
       $diff = $today->diff($birthdate_valid);
       $calculated_age = $diff->y;

       if ($calculated_age < 14) {
           $error[] = 'You must be 14 years or older to register.';
       } else {
           // Raw password handling
           $pass = $_POST['password'];
           $cpass = $_POST['cpassword'];

           // Check if the passwords match
           if ($pass !== $cpass) {
               $error[] = 'Passwords do not match!';
           } else {
               // Check if user already exists in the `patient` table
               $select_patient = "SELECT * FROM patient WHERE email = '$email'";
               $result_patient = mysqli_query($database, $select_patient);

               // Check if user already exists in the `webuser` table
               $select_webuser = "SELECT * FROM webuser WHERE email = '$email'";
               $result_webuser = mysqli_query($database, $select_webuser);

               if (mysqli_num_rows($result_patient) > 0 || mysqli_num_rows($result_webuser) > 0) {
                   $error[] = 'User with this email already exists!';
               } else {
                   // Insert user into the `patient` table
                   $insert_patient = 
                   "INSERT INTO patient(name, email, middlename, lastname, address, Gender, civil, age, birthdate, password) 
                   VALUES('$name', '$email', '$middlename', '$lastname', '$address', '$Gender', '$civil', '$calculated_age', '$birthdate', '$pass')";

                   // Insert user into the `webuser` table with the usertype as 'p' (patient)
                   $insert_webuser = 
                   "INSERT INTO webuser(email, usertype) 
                   VALUES('$email', 'p')";

                   // Execute both insertions
                   if (mysqli_query($database, $insert_patient) && mysqli_query($database, $insert_webuser)) {
                       echo '<script>alert("Successfully signed up!")</script>';
                       header('location:login.php');
                   } else {
                       $error[] = 'Error in signing up. Please try again.';
                   }
               }
           }
       }
   } else {
       $error[] = 'Invalid birthdate format. Please enter a valid date.';
   }

   // Display errors if any
   if (isset($error)) {
       foreach ($error as $msg) {
           echo '<span class="error-msg">'.$msg.'</span>';
       }
   }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" href="icon/icon.png">
   <title>Register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

<form action="" method="post" onsubmit="return validateAge()">
  <h3>register now</h3>
  <?php
  if(isset($error)){
     foreach($error as $error){
        echo '<span class="error-msg">'.$error.'</span>';
     };
  };
  ?>
  <label for="name">Enter name:</label>
  <input type="text" name="name" required placeholder="Enter your name">
  <label for="middlename">Enter middle name:</label>
  <input type="text" name="middlename" required placeholder="Enter your middle name">
  <label for="lastname">Enter last name:</label>
  <input type="text" name="lastname" required placeholder="Enter your last name">
  <label for="address">Address:</label>
  <input type="text" name="address" required placeholder="Enter your address">
  
  <select name="Gender">
    <option value="">Select your gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select>
  
  <select name="civil">
    <option value="">Select your civil status</option>
    <option value="single">single</option>
    <option value="married">married</option>
  </select>
  
  <label for="datetime">Enter birthday:</label>
  <input type="date" name="birthday" id="birthday" required>
  
  <label for="age">Your age:</label>
  <input type="text" name="age" id="age" required readonly placeholder="Your age will be auto-generated">
  
  <label for="email">Enter email:</label>
  <input type="email" name="email" required placeholder="Enter your email">
  <label for="password">Enter password:</label>
  <input type="password" name="password" required placeholder="Enter your password">
  <label for="cpassword">Enter confirmed password:</label>
  <input type="password" name="cpassword" required placeholder="Confirm your password">
  <input type="submit" name="submit" value="register now" class="form-btn">
  
  <p>already have an account? <a href="login.php">login now</a></p>
</form>

<script>
  document.getElementById('birthday').addEventListener('change', function() {
    const birthday = new Date(this.value);
    const today = new Date();
    let age = today.getFullYear() - birthday.getFullYear();
    const monthDiff = today.getMonth() - birthday.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
      age--;
    }

    // Update the age input field
    document.getElementById('age').value = age;

    // Check if the age is below 14
    if (age < 14) {
      alert("You must be 14 years or older to register.");
    }
  });

  // Validation before form submission
  function validateAge() {
    const age = document.getElementById('age').value;
    if (age < 14) {
      alert("You must be 14 years or older to register.");
      return false;  // Prevent form submission
    }
    return true;  // Allow form submission if the age is valid
  }
</script>



</div>

</body>
</html>
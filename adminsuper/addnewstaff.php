<?php

@include 'connection.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($database, $_POST['name']);
   $email = mysqli_real_escape_string($database, $_POST['email']);
   $middlename = mysqli_real_escape_string($database, $_POST['middlename']);
   $lastname = mysqli_real_escape_string($database, $_POST['lastname']);
   $address = mysqli_real_escape_string($database, $_POST['address']);
   $Gender = mysqli_real_escape_string($database, $_POST['Gender']);
   $civil = mysqli_real_escape_string($database, $_POST['civil']);
   $age = mysqli_real_escape_string($database, $_POST['age']);
   $day = mysqli_real_escape_string($database, $_POST['day']);
   $month = mysqli_real_escape_string($database, $_POST['month']);
   $year = mysqli_real_escape_string($database, $_POST['year']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM patient WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($database, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO patient(name, email, middlename, lastname, address, Gender, civil, age, day, month, year, password) VALUES('$name','$email','$middlename','$lastname','$address','$Gender','$civil','$age','$day','$month','$year','$pass')";
         mysqli_query($database, $insert);
         header('location:doctor.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" href="icon/icon.png">
   <title>Register Staff</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Register BHW-STAFF</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Enter your username">
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="password" name="cpassword" required placeholder="Confirm your password">
      <select name="role">
         <option value="">Select role</option>
         <option value="staff">staff</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
   </form>

</div>

</body>
</html>
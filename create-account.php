<?php

@include 'connection.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($database, $_POST['name']);
   $email = mysqli_real_escape_string($database, $_POST['email']);
   $middlename = mysqli_real_escape_string($database, $_POST['middlename']);
   $lastname = mysqli_real_escape_string($database, $_POST['lastname']);
   $Gender = mysqli_real_escape_string($database, $_POST['Gender']);
   $civil = mysqli_real_escape_string($database, $_POST['civil']);
   $month = mysqli_real_escape_string($database, $_POST['month']);
   $day = mysqli_real_escape_string($database, $_POST['day']);
   $year = mysqli_real_escape_string($database, $_POST['year']);
   $address = mysqli_real_escape_string($database, $_POST['address']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM patient WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($database, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $pass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO patient(name, email, middlename, lastname, address, Gender, civil, age, birth, month, day, year, password) VALUES('$name','$email','$middlename','$lastname','$Gender','$civil','$month','$day','$year','$address','$pass')";
         mysqli_query($database, $insert);
         header('location:Login.php');
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
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
<!--bootstrap 4 link-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <title>Sign Up</title>
    <style>
        @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}
.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}
.card-registration .select-arrow {
top: 13px;
}

.gradient-custom-2 {
/* fallback for old browsers */
background: #a1c4fd;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
}

.bg-indigo {
background-color: #4835d4;
}
@media (min-width: 992px) {
.card-registration-2 .bg-indigo {
border-top-right-radius: 15px;
border-bottom-right-radius: 15px;
}
}
@media (max-width: 991px) {
.card-registration-2 .bg-indigo {
border-bottom-left-radius: 15px;
border-bottom-right-radius: 15px;
}
}
    </style>
</head>
<body>
<section class="h-100 h-custom gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-6">
                <form action="" method="POST">
                <div class="p-5">
                  <h3 class="fw-normal mb-5" style="color: #4835d4;">General Infomation</h3>

                  <div class="row">
                    <div class="col-md-4 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                        <input type="text" id="form3Examplev2" class="form-control form-control-lg" placeholder="First Name" name="name"/>
                      </div>

                    </div>
                    <div class="col-md-4 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                        <input type="text" id="form3Examplev3" class="form-control form-control-lg" name="middlename" placeholder="MiddleName"/>
                      </div>

                    </div>
                    <div class="col-md-4 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                        <input type="text" id="form3Examplev3" class="form-control form-control-lg" name="lastname" placeholder="LastName"/>
                      </div>

                    </div>
                  </div>
                  <div class="mb-4 pb-2">
                    <div data-mdb-input-init class="form-outline">
                      <input type="text" id="form3Examplev4" class="form-control form-control-lg" name="address" placeholder="Address"/>
                    </div>
                  </div>
                  <center><label class="form-label" for="form3Examplev5">Birthdate</label></center>
                  <div class="row">
                    <div class="col-md-4 mb-4 pb-2">

                    <div class="form-group">
                    <select class="select2" name="month" id="category" style="width:100%">
                              <option value="">Select a month</option>
                              <option value="january">January</option>
                              <option value="february">february</option>
                           </select>
                      </div>

                    </div>
                          <div class="col-md-4 mb-4 pb-2">

                    <div class="form-group">
                    <select class="select2" name="day" id="category" style="width:100%">
                              <option value="">Select a day</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                           </select>
                      </div>

                    </div>
                       <div class="col-md-4 mb-4 pb-2">

                    <div class="form-group">
                    <select class="select2" name="year" id="category" style="width:100%">
                              <option value="">Select a year</option>
                              <option value="2011">2011</option>
                              <option value="2012">2012</option>
                              <option value="2013">2013</option>
                           </select>
                      </div>
                    </div>
                     <div class="col-md-4 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                        <input type="text" id="form3Examplev3" class="form-control form-control-lg" name="age" placeholder="Age"/>
                      </div>

                    </div>
                  </div>
                </div>
                
              </div>
              <div class="col-lg-6 bg-indigo text-white">
                <div class="p-5">
                  <div class="mb-4 pb-2">
                    <div data-mdb-input-init class="form-outline form-white">
                      <input type="email" id="form3Examplea2" class="form-control form-control-lg" name="email" placeholder="Email"/>
                    </div>
                  </div>
                  <div class="mb-4 pb-2">
                    <div data-mdb-input-init class="form-outline form-white">
                      <input type="text" id="form3Examplea3" class="form-control form-control-lg" name="password" placeholder="Password"/>
                    </div>
                  </div>
                  <div class="mb-4 pb-2">
                    <div data-mdb-input-init class="form-outline form-white">
                      <input type="text" id="form3Examplea3" class="form-control form-control-lg" name="cpassword" placeholder="Re Password"/>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 mb-4 pb-2">

                    <div class="form-group">
                    <select class="select2" name="civil" id="category" style="width:100%">
                              <option value="">Select civil status</option>
                              <option value="single">Single</option>
                              <option value="married">Married</option>
                           </select>
                      </div>

                    </div>
                    <div class="col-md-7 mb-4 pb-2">

                    <div class="form-group">
                    <select class="select2" name="Gender" id="category" style="width:100%">
                              <option value="">Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                           </select>
                      </div>

                    </div>
                  </div>



                  <input type="button" name="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-light btn-lg"
                    data-mdb-ripple-color="dark">submit</input>

                  

                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</center>
<!--bootstrap js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
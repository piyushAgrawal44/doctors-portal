<?php
session_start();
if (isset($_SESSION["is_admin"])) {
    header("location: ./user/dashboard.php");
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/index.css">

    <title>Doctors Portal - A hospital for doctors</title>
</head>

<body>

    <div class="container">
        <h1 class="heading">Welcome to Doctors Portal - A hospital for doctors ! </h1>

        <div class="row">
            <div class="col-12 col-md-6 mb-5">
                <div class="login_form">
                    <h3 class="heading">For Doctors</h3>
                    <div style="height: 60px; width: 100%;">
                        <div class="alert bg-warning visible-none">
                            <span class="alert-message">Invalid Credential !</span>
                        </div>
                    </div>
                    <form class="form" action="../backend/login_signup/doctor_login.php" method="post">
                        <div class="mb-2">
                            <input type="email" name="email" class="input_type1 email" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-2">
                            <input type="password" name="password" id="doctor_password" class="input_type1 password" placeholder="Enter your password" required>
                            <br>
                            <input type="checkbox" class="checkbox" onclick="showPass1(this)"> Show Password
                        </div>

                        <button type="submit" class="btn login_btn">Login</button>

                    </form>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-5">
                <div class="login_form">
                    <h3 class="heading">For Admin</h3>
                    <div style="height: 60px; width: 100%;">
                        <div class="alert bg-warning visible-none">
                            <span class="alert-message">Invalid Credential !</span>
                        </div>
                    </div>
                    <form class="form" action="../backend/login_signup/login.php" method="post">
                        <div class="mb-2">
                            <input type="email" name="email" class="input_type1 email" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-2">
                            <input type="password" name="password" id="admin_password" class="input_type1 password" placeholder="Enter your password" required>
                            <br>
                            <input type="checkbox" class="checkbox" onclick="showPass2(this)"> Show Password
                        </div>

                        <button type="submit" class="btn login_btn">Login</button>

                    </form>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <h3 class="text-center mb-3">Services that we offer :</h3>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="card h-100 border_bottom" style="max-width: 300px; margin: auto;">
                    <div class="card-body">
                        <h5 class="card-title text-center text-danger"><b>Doctor Management</b></h5>
                        <p class="card-text text-justify">We offer complete doctor management. You can add doctor, edit and block the doctor.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="card h-100 border_bottom" style="max-width: 300px; margin: auto;">
                <div class="card-body">
                        <h5 class="card-title text-center text-danger"><b>Appointment Management</b></h5>
                        <p class="card-text text-justify">We offer complete appointment management. You can add appointment, edit the appointment.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="card h-100 border_bottom" style="max-width: 300px; margin: auto;">
                <div class="card-body">
                        <h5 class="card-title text-center text-danger"><b>Patient Management</b></h5>
                        <p class="card-text text-justify">We offer complete patient management. You can add patient, edit the patient.</p>
                    </div>
                </div>
            </div>
            
        </div>

    </div>

    <script>
        function showPass1(checkbox){
            if(checkbox.checked){
                document.getElementById("doctor_password").type="text";
            }
            else{
                document.getElementById("doctor_password").type="password";
            }
        }

        function showPass2(checkbox){
            if(checkbox.checked){
                document.getElementById("admin_password").type="text";
            }
            else{
                document.getElementById("admin_password").type="password";
            }
        }
    </script>

</body>

</html>
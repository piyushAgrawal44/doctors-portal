<?php
session_start();
if (!isset($_SESSION["is_admin"])) {
  header("location: ../../frontend/login.php");
}
include("../../backend/config.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php require('./user_components/header_links.php'); ?>
     
    <title>New Doctor</title>
</head>

<body>
    <div id="loader" class="center"></div>

    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <?php require('./user_components/side_bar.php'); ?>


        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight mb-3">New Doctor</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">

                                    <!-- <a href="./new_document.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Create</span>
                                    </a> -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">


                    <div class="card shadow border-0 mb-7 p-sm-5">

                        <div class="form-box px-sm-5 mb-5">
                            <form class="px-sm-5" action="../../backend/user/new_doctor.php" method="post"
                                onsubmit="return cofirmdetails()" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="doc_name" class="form-label">Doctor Name *</label>
                                    <input type="text" placeholder="Doctor Name" required class="form-control"
                                        name="fullname" aria-describedby="nameHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="email_id" class="form-label">Email *</label>
                                    <input type="email" placeholder="Email" required class="form-control"
                                        name="email_id" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="primary_phone_number" class="form-label">Primary Phone *</label>
                                    <input type="tel" minlength="10" placeholder="Phone Number " required
                                        class="form-control" name="primary_phone_number">
                                </div>

                                <div class="mb-3">
                                    <label for="secondary_phone_number" class="form-label">Secondary Phone</label>
                                    <input type="tel" placeholder="Phone Number"
                                        class="form-control" name="secondary_phone_number">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control"
                                        name="address" placeholder="Address">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Adhar Number</label>
                                    <input type="text" class="form-control"
                                        name="adharcard_number" placeholder="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pancard Number</label>
                                    <input type="text" class="form-control"
                                        name="pancard_number" placeholder="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Joining Date</label>
                                    <input type="date" class="form-control"
                                        name="joining_date" placeholder="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Speciality</label>
                                    <input type="text" class="form-control"
                                        name="speciality" placeholder="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Visit Time From *</label>
                                    <input type="time" required class="form-control"
                                        name="visit_time_from" placeholder="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Visit Time To *</label>
                                    <input type="time" required class="form-control"
                                        name="visit_time_to" placeholder="">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="staus" class="form-label">Status *</label>
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option value="1" selected>Active</option>
                                        <option value="0" >Blocked</option>
                                    </select>
                                </div>



                                <button type="submit" class="btn btn-primary">Create User</button>
                            </form>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>

        function cofirmdetails() {
            var are_you_sure = confirm("Are you sure, you want to send invitation to this Doctor ?")
            if (are_you_sure == true) {

                document.querySelector(
                    "body").style.visibility = "hidden";
                document.querySelector(
                    "#loader").style.visibility = "visible";
                document.querySelector(
                    "#loader").style.zIndex = "2";

                return true;
            } else {
                return false;
            }
        }
    </script>



    <?php require('./user_components/scripts.php');?>

</body>

</html>
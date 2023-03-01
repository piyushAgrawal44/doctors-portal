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
     
    <title>New Patient</title>
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
                                <h1 class="h2 mb-0 ls-tight mb-3">New Patient</h1>
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
                        <!-- <div class="card-header">
                            <h5 class="mb-0">Documents</h5>
                        </div> -->

                        <div class="form-box px-sm-5 mb-5">
                            <form class="px-sm-5" action="../../backend/user/new_allotment.php" method="post"
                                onsubmit="return cofirmdetails()" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label  class="form-label">Patient Name *</label>
                                    <select class="form-select" required name="patient_id">
                                        <option value="">-Select-</option>
                                        <?php
                                   
                                            $stmt="SELECT patient_schema.id,patient_schema.fullname,patient_schema.primary_contact_number
                                            FROM `patient_schema`";
                                            $sql=mysqli_prepare($conn, $stmt);

                                            // mysqli_stmt_bind_param($sql,'i',$is_admin);
                                            // $is_admin=1;
                                
                                            $result=mysqli_stmt_execute($sql);
                                            if ($result){
                                                    $data= mysqli_stmt_get_result($sql);
                                                    $sno=1;
                                                    while ($row = mysqli_fetch_array($data)){
                                        ?>
                                        <option value="<?php echo $row["id"]?>"><?php echo $row["fullname"]?> - <?php echo $row["primary_contact_number"]?></option>
                                        <?php
                                            
                                            }
                                            mysqli_stmt_close($sql);
                                        }
                                        else{
                                            mysqli_stmt_close($sql);
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Doctor Name *</label>
                                    <select class="form-select" required name="doctor_id">
                                        <option value="">-Select-</option>
                                        <?php
                                   
                                            $stmt="SELECT doctor_schema.id,doctor_schema.fullname,doctor_schema.primary_contact_number
                                            FROM `doctor_schema`";
                                            $sql=mysqli_prepare($conn, $stmt);

                                            // mysqli_stmt_bind_param($sql,'i',$is_admin);
                                            // $is_admin=1;
                                
                                            $result=mysqli_stmt_execute($sql);
                                            if ($result){
                                                    $data= mysqli_stmt_get_result($sql);
                                                    $sno=1;
                                                    while ($row = mysqli_fetch_array($data)){
                                        ?>
                                        <option value="<?php echo $row["id"]?>"><?php echo $row["fullname"]?> - <?php echo $row["primary_contact_number"]?></option>
                                        <?php
                                            
                                            }
                                            mysqli_stmt_close($sql);
                                            mysqli_close($conn);
                                        }
                                        else{
                                            mysqli_stmt_close($sql);
                                            mysqli_close($conn);
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Disease *</label>
                                    <input type="text" placeholder="Disease Name" required class="form-control"
                                        name="disease_name" >
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Appoitment Date and Time *</label>
                                    <div class="d-flex justify-content-between gap-4 ">
                                    <input type="date" class="form-control"
                                        name="appoitment_date" placeholder="" required>
                                        <input type="time" class="form-control"
                                        name="appoitment_time" placeholder="" required>
                                    </div>
                                    
                                </div>



                                <button type="submit" class="btn btn-primary">Allot Doctor</button>
                            </form>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>

        function cofirmdetails() {
            var are_you_sure = confirm("Are you sure ?")
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
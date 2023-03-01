<?php
session_start();
if (!isset($_SESSION["is_admin"])) {
  header("location: ../../frontend/login.php");
  exit;
}
include("../../backend/config.php");


function trim_input_value($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    // $data=strtolower($data);

    return $data;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('./user_components/header_links.php'); ?>
    <title>Patient Details</title>

    
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
                                <h1 class="h2 mb-0 ls-tight">Patient Details</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <!-- Card stats -->
                   

                    <div class="card shadow border-0 p-3 mb-4">
                        <div class="card-header px-0 pt-2 pb-3">
                            <h5 class="mb-0">Patient Details</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover " id="myTable1">
                                
                                <tbody style="border: 0px solid black !important;">
                                    <?php
                                    
                                        $doctor_id=trim_input_value($_GET['id']);
                                        $stmt="SELECT patient_schema.id,fullname,email_id,primary_contact_number,secondary_contact_number,address,adharcard_number,pancard_number,patient_schema.status,created_date
                                        FROM `patient_schema`
                                        WHERE patient_schema.id=(?) LIMIT 1";
                                        $sql=mysqli_prepare($conn, $stmt);

                                        mysqli_stmt_bind_param($sql,'i',$doctor_id);
                                        $status=1;
                            
                                        $result=mysqli_stmt_execute($sql);
                                        if ($result){
                                                $data= mysqli_stmt_get_result($sql);

                                                if($data->num_rows<=0){
                                                    
                                                        ?>
                                                        <script>
                                                            history.back();
                                                        </script>
                                                        <?php
                                                        exit;
                                                }
                                               
                                                while ($row = mysqli_fetch_array($data)){
                                                   
                                    ?>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Name</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["fullname"];?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Email</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["email_id"];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Primary Phone Number</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["primary_contact_number"];?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Secondary Phone Number</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["secondary_contact_number"]==null?"NA":$row["secondary_contact_number"];?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Address</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["address"]==null?"NA":$row["address"];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Adhar</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["adharcard_number"]==null?"NA":$row["adharcard_number"];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Pancard</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["pancard_number"]==null?"NA":$row["pancard_number"];?>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <th style="font-size: 16px;"><b>created date</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo ($row["created_date"]);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 14px;"><b>Status</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php 
                                            if($row["status"]==1){
                                                echo "<b class='text-success'>Active</b>";
                                            }
                                            else if($row["status"]==0){
                                                echo "<b class='text-danger'>Blocked</b>";
                                            }
                                            else{
                                                echo "Defalut";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    mysqli_stmt_close($sql);
                                    
                                }
                                else{
                                    mysqli_error($conn);
                                }
                                
                                ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
         
        function confirm_delete() {
            var confirm_del = confirm("Are you sure ?");
            if (confirm_del == true) {
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
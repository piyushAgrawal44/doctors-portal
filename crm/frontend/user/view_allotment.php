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
                            <h5 class="mb-0">Allotment Details</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover " id="myTable1">
                                
                                <tbody style="border: 0px solid black !important;">
                                    <?php
                                    
                                        $stmt="SELECT allotment_schema.id,doctor_schema.fullname as doctor_name,doctor_schema.primary_contact_number as doctor_phone, patient_schema.fullname as patient_name,patient_schema.primary_contact_number as patient_phone,allotment_schema.disease_name,allotment_schema.status,allotment_schema.appoitment_datetime
                                        FROM `allotment_schema` INNER JOIN `doctor_schema` ON doctor_schema.id=allotment_schema.doctor_id INNER JOIN `patient_schema` ON patient_schema.id=allotment_schema.patient_id WHERE allotment_schema.id=(?)";
                                        $sql=mysqli_prepare($conn, $stmt);

                                        mysqli_stmt_bind_param($sql,'i',$allotment_id);
                            
                                        $allotment_id=trim_input_value($_GET['id']);
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
                                        <th style="font-size: 16px;"><b>Patient Name</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["patient_name"];?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Patient Phone</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["patient_phone"];?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Doctor Name</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["doctor_name"];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Doctor Phone</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["doctor_phone"];?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Disease Name</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["disease_name"];?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Status</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php 
                                                $status="Processing";
                                                if ($row["status"]==0) {
                                                    $status="<span class='text-danger'>Pending</span>";
                                                }
                                                else if($row["status"]==1){
                                                    $status="<span class='text-success'>Completed</span>";
                                                } 
                                                else if($row["status"]==2){
                                                    $status="<span class='text-info'>Processing</span>";
                                                }
                                                else {
                                                    $status="<span class='text-secondry'>Hold</span>";   
                                                }
                                                
                                            ?>
                                            <b><?php echo $status;?></b>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <th style="font-size: 16px;"><b>Appoitment Date and Time</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo ($row["appoitment_datetime"]);?>
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
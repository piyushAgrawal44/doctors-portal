<?php
session_start();
if (!isset($_SESSION["is_doctor"])) {
  header("location: ../../frontend/login.php");
  exit;
}
$user_id=$_SESSION["user_id"];
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
                                        FROM `allotment_schema` INNER JOIN `doctor_schema` ON doctor_schema.id=allotment_schema.doctor_id INNER JOIN `patient_schema` ON patient_schema.id=allotment_schema.patient_id WHERE allotment_schema.id=(?) and allotment_schema.doctor_id=(?)";
                                        $sql=mysqli_prepare($conn, $stmt);

                                        mysqli_stmt_bind_param($sql,'ii',$allotment_id,$_SESSION["user_id"]);
                            
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
                                                $status_code=$row["status"];
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

                    <div class="card shadow border-0 p-3 mb-4">
                        <div class="card-header px-0 pt-2 pb-3">
                            <h5 class="mb-0">Update Status</h5>

                            <div class="form-box px-sm-5 my-5">
                                <form class="" action="../../backend/doctor/update_allotment_status.php" method="post"
                                    onsubmit="return cofirmdetails()" enctype="multipart/form-data">
                                    <input type="text" hidden class="d-none" value="<?php echo $allotment_id; ?>" name="allotment_id">
                                    
                                    <div class="mb-3">
                                        <label for="staus" class="form-label">Status *</label>
                                        <select class="form-select" aria-label="Default select example" name="status">
                                            <option value="0" <?php echo $status_code==0?"selected":"" ?> >Pending</option>
                                            <option value="1" <?php echo $status_code==1?"selected":"" ?> >Completed</option>
                                            <option value="2" <?php echo $status_code==2?"selected":"" ?> >Processing</option>
                                            <option value="3" <?php echo $status_code==3?"selected":"" ?> >Hold</option>
                                        </select>
                                    </div>



                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </form>
                            </div>

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
<?php
session_start();
if (!isset($_SESSION["is_admin"])) {
  header("location: ../../frontend/login.php");
}
include("../../backend/config.php");

$pending_allotment=0;
$completed_allotment=0;
$processing_allotment=0;
$hold_allotment=0;
                     
$stmt="SELECT status FROM `allotment_schema`";
$sql=mysqli_prepare($conn, $stmt);

$result=mysqli_stmt_execute($sql);
if ($result){
    $data= mysqli_stmt_get_result($sql);
    while($row=mysqli_fetch_array($data)){
        if($row["status"]==0){
            $pending_allotment++;
        }
        elseif ($row["status"]==0) {
            $completed_allotment++;
        }
        elseif ($row["status"]==2) {
            $processing_allotment++;
        }
        else{
            $hold_allotment++;
        }
    }
}
else{
    echo "
    <script>
        history_back();
    </script>
    ";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('./user_components/header_links.php'); ?>
    <title>Manage Allotment</title>

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
                        <div class="row align-items-center mb-4">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">Allot Doctor</h1>
                            </div>
                             <!-- Actions -->
                             <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">
                                    
                                    <a href="./new_allotment.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>New Allotment</span>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <!-- Card stats -->
                    <div class="row g-6 mb-6">

                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0 overflow_style" style="height: 130px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total
                                                Allotment</span>
                                            <?php
                                                echo $completed_allotment+$processing_allotment+$pending_allotment+$completed_allotment;
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                <i class="bi bi-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0 overflow_style" style="height: 130px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Pending Allotment</span>
                                            <?php
                                                echo $pending_allotment;
                                                ?>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white text-lg rounded-circle">
                                                <i class="bi bi-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0 overflow_style" style="height: 130px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Processing Allotment</span>
                                            <?php
                        
                                                echo $processing_allotment;
                                                    
                                                ?>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                                <i class="bi bi-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0 overflow_style" style="height: 130px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Hold Allotment</span>
                                            <?php
                        
                                                echo $hold_allotment;
                                                   
                                                ?>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-secondary text-white text-lg rounded-circle">
                                                <i class="bi bi-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0 overflow_style" style="height: 130px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Completed Allotment</span>
                                            <?php echo $completed_allotment; ?>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-success text-white text-lg rounded-circle">
                                                <i class="bi bi-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                    </div>

                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Doctor</h5>
                        </div>
                        <div class="table-responsive" style="padding: 30px 18px;">
                            <table class="table table-hover table-nowrap" id="myTable"
                                style="padding: 30px 2px; border: 0px solid black !important;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="font-size: 16px;">Sno</th>
                                        <th style="font-size: 16px;">Patient Name</th>
                                        <th style="font-size: 16px;">Doctor Name</th>
                                        <th style="font-size: 16px;">Disease</th>
                                        <th style="font-size: 16px;">Status</th>
                                        <th style="font-size: 16px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="border: 0px solid black !important;">
                                    <?php
                                   
                                        $stmt="SELECT allotment_schema.id,doctor_schema.fullname as doctor_name,patient_schema.fullname as patient_name,allotment_schema.disease_name,allotment_schema.status
                                        FROM `allotment_schema` INNER JOIN `doctor_schema` ON doctor_schema.id=allotment_schema.doctor_id INNER JOIN `patient_schema` ON patient_schema.id=allotment_schema.patient_id";
                                        $sql=mysqli_prepare($conn, $stmt);

                                        // mysqli_stmt_bind_param($sql,'i',$is_admin);
                                        // $is_admin=1;
                            
                                        $result=mysqli_stmt_execute($sql);
                                        if ($result){
                                                $data= mysqli_stmt_get_result($sql);
                                                $sno=1;
                                                while ($row = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <td style="font-size: 14px;">
                                            <?php echo $sno;?>
                                        </td>

                                        <td style="font-size: 14px;">
                                            <?php echo $row["patient_name"];?>
                                        </td>
                                        <td style="font-size: 14px;">
                                            <?php echo $row["doctor_name"];?>
                                        </td>
                                        <td style="font-size: 14px; min-width: fit-content;">
                                            <?php echo $row["disease_name"];?>
                                        </td>
                                        <td style="font-size: 14px; min-width: fit-content;">
                                            <?php 
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
                                        

                                        <td class="d-flex p-1">
                                            
                                            <a class="btn btn-secondary p-2" href="./view_allotment.php?id=<?php echo $row['id'];?>">
                                                <span style="font-size: 12px;">View</span>
                                            </a>

                                        </td>
                                    </tr>
                                    <?php
                                    $sno++;
                                    }
                                    mysqli_stmt_close($sql);
                                    mysqli_close($conn);
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


    <?php require('./user_components/scripts.php'); ?>

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
        document.getElementById('manage_user').classList.add('active');
    </script>


<?php require('./user_components/scripts.php');?>

<script>
    document.getElementById("manage_doctor").classList.add("active");
</script>
</body>

</html>
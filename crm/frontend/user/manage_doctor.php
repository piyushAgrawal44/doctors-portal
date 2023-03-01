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
    <title>Manage Doctors</title>

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
                                <h1 class="h2 mb-0 ls-tight"> Doctor</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">
                                    
                                    <a href="./new_doctor.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Add New Doctor</span>
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
                                                Doctor</span>
                                            <?php
                        
                                                    $stmt="SELECT count(id) FROM `doctor_schema` WHERE status=(?)";
                                                    $sql=mysqli_prepare($conn, $stmt);

                                                    $status=1;
                                                    mysqli_stmt_bind_param($sql,'i',$status);
                                        
                                                    $result=mysqli_stmt_execute($sql);
                                                        if ($result){
                                                            $data= mysqli_stmt_get_result($sql);
                                                            $sno=1;
                                                            while ($row = mysqli_fetch_array($data)){
                                                        ?>
                                            <span class="h3 font-bold mb-0">
                                                <?php echo $row[0]; ?>
                                            </span>
                                            <?php }
                                                    }
                                                ?>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                <i class="bi bi-people"></i>
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
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Blocked Doctor</span>
                                            <?php
                        
                                                    $stmt="SELECT count(id) FROM `doctor_schema` WHERE status=(?)";
                                                    $sql=mysqli_prepare($conn, $stmt);

                                                    mysqli_stmt_bind_param($sql,'i',$status);
                                                    // $is_admin=2;
                                                    $status=0;
                                        
                                                    $result=mysqli_stmt_execute($sql);
                                                        if ($result){
                                                            $data= mysqli_stmt_get_result($sql);
                                                            $sno=1;
                                                            while ($row = mysqli_fetch_array($data)){
                                                        ?>
                                                        <span class="h3 font-bold mb-0">
                                                            <?php echo $row[0]; ?>
                                                        </span>
                                            <?php }
                                                    }
                                                ?>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white text-lg rounded-circle">
                                                <i class="bi bi-people"></i>
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
                                        <th style="font-size: 16px;">Name</th>
                                        <th style="font-size: 16px;">Email</th>
                                        <th style="font-size: 16px;">Phone</th>
                                        <th style="font-size: 16px;">Status</th>
                                        <th style="font-size: 16px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="border: 0px solid black !important;">
                                    <?php
                                   
                                        $stmt="SELECT doctor_schema.id,doctor_schema.fullname,doctor_schema.email_id,doctor_schema.primary_contact_number,doctor_schema.status
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
                                    <tr>
                                        <td style="font-size: 14px;">
                                            <?php echo $sno;?>
                                        </td>

                                        <td style="font-size: 14px;">
                                            <?php echo $row["fullname"];?>
                                        </td>
                                        <td style="font-size: 14px;">
                                            <?php echo $row["email_id"];?>
                                        </td>
                                        <td style="font-size: 14px; min-width: fit-content;">
                                            <?php echo $row["primary_contact_number"];?>
                                        </td>
                                        <td style="font-size: 14px; min-width: fit-content;">
                                            <?php echo $row["status"]==1?"<span class='text-success'><b>Active</b></span>":"<span class='text-danger'><b>Blocked</b></span>";?>
                                        </td>
                                        

                                        <td class="d-flex p-1">
                                            
                                            <a class="btn btn-secondary p-2" href="./view_doctor.php?id=<?php echo $row['id'];?>">
                                                <span style="font-size: 12px;">View</span>
                                            </a>
                                            
                                            <form action="../../backend/user/update_doctor.php"
                                                onsubmit="return confirm_delete()" method="post">
                                                <input type="number" hidden name="user_id"
                                                    value="<?php echo $row['id'];?>">
                                               
                                                <input type="number" hidden name="status"
                                                    value="<?php echo $row['status'];?>">
                                                <button type="submit" class="btn btn-outline-<?php echo $row['status']==0?"success":"danger";?> p-2"
                                                    style="margin-left: 7px;">
                                                   <span style="font-size: 12px;"><?php echo $row['status']==0?"Activate":"Block";?></span>
                                                </button>
                                            </form>

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
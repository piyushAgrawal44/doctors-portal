<?php
session_start();
if (!isset($_SESSION["is_doctor"])) {
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
    <title>Order Details</title>

    <style>
        .tags {
            list-style: none;
            margin: 0;
            overflow: hidden;
            padding: 0;
        }

        .tags li {
            float: left;
        }

        .tag {
            background: #eee;
            border-radius: 3px 0 0 3px;
            color: #999;
            display: inline-block;
            height: 26px;
            line-height: 26px;
            padding: 0 20px 0 23px;
            position: relative;
            margin: 0 10px 10px 0;
            text-decoration: none;
            -webkit-transition: color 0.2s;

            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .overflow_style2 {
            max-width: 150px !important;
            overflow-x: auto;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .overflow_style2::-webkit-scrollbar {
            display: none;
        }

        .tag::before {
            background: #fff;
            border-radius: 10px;
            box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
            content: '';
            height: 6px;
            left: 10px;
            position: absolute;
            width: 6px;
            top: 10px;
        }

        .tag::after {
            background: #fff;
            border-bottom: 13px solid transparent;
            border-left: 10px solid #eee;
            border-top: 13px solid transparent;
            content: '';
            position: absolute;
            right: 0;
            top: 0;
        }

        .tag:hover {
            background-color: blue;
            color: white;
        }

        .tag:hover::after {
            border-left-color: blue;
        }
    </style>

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
                                <h1 class="h2 mb-0 ls-tight">Order Details</h1>
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
                            <h5 class="mb-0">Order Details</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover " id="myTable1">
                                
                                <tbody style="border: 0px solid black !important;">
                                    <?php
                                    
                                        $sales_order_id=trim_input_value($_GET['id']);
                                        $stmt="SELECT customer_id,gst_percent,
                                        discount_percent,final_amount,business_id,
                                        status,created_at
                                        FROM `sales_order`
                                        WHERE id=(?) LIMIT 1";
                                        $sql=mysqli_prepare($conn, $stmt);

                                        mysqli_stmt_bind_param($sql,'i',$sales_order_id);
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
                                                    if($row["business_id"]!=$_SESSION["user_id"]){
                                                        ?>
                                                        <script>
                                                            history.back();
                                                        </script>
                                                        <?php
                                                        exit;
                                                    }
                                                    $customer_id=$row['customer_id'];
                                    ?>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Total Amount </b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["final_amount"];?> INR
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Gst Percentage</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["gst_percent"];?> %
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Discount</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row["discount_percent"];?> %
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 16px;"><b>Date and Time</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo ($row["created_at"]);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 14px;"><b>Status</b></th>

                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php 
                                            if($row["status"]==1){
                                                echo "Active";
                                            }
                                            else if($row["status"]==2){
                                                echo "<b class='text-danger'>Credit (उधारी)</b>";
                                            }
                                            else{
                                                echo "Draft";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $order_status=$row["status"];

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
                            <h5 class="mb-0">Customer Details</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover " id="myTable2">
                
                                <tbody style="border: 0px solid black !important;">
                                    <?php
                                        
                                        $stmt="SELECT customers.name,
                                        customers.email,customers.phone,customers.dob
                                        FROM `customers`
                                        WHERE id=(?)";
                                        
                                        
                                        $sql=mysqli_prepare($conn, $stmt);

                                        mysqli_stmt_bind_param($sql,'i',$customer_id);
                                        $status=1;
                            
                                        $result=mysqli_stmt_execute($sql);
                                        if ($result){
                                                $data= mysqli_stmt_get_result($sql);
                                                $sno=1;
                                                while ($row = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <td style="font-size: 16px;"><b>Name</b></td>
                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row['name']?$row['name']:"Not Available"; ?>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px;"><b>Email</b></td>
                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row['email']?$row['email']:"Not Available"; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px;"><b>Phone</b></td>
                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row['phone']?$row['phone']:"Not Available"; ?>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px;"><b>Date of Birth</b></td>
                                        <td class="overflow_style2" style="font-size: 14px;">
                                            : <?php echo $row['dob']?$row['dob']:"Not Available"; ?>
                                        </td>
                                    </tr>
                                    
                                    
                                    <?php
                                        $sno++;
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

                    <div class="card shadow border-0 p-3">
                        <div class="card-header px-0 pt-2 pb-3">
                            <h5 class="mb-0">Product Details</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover " id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Sno</th>
                                    <th scope="col">Produc Name</th>
                                    <th scope="col">Purchased Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                                
                                <tbody style="border: 0px solid black !important;">
                                    <?php
                                        $stmt="SELECT sales_order_products.purchased_quantity,
                                        sales_order_products.total_price,products.name,products.unit
                                        FROM `sales_order_products` INNER JOIN `products` ON
                                        products.id=sales_order_products.product_id
                                        WHERE sales_order_products.sales_order_id=(?)";
                                        $sql=mysqli_prepare($conn, $stmt);

                                        mysqli_stmt_bind_param($sql,'i',$sales_order_id);
                                        $status=1;
                            
                                        $result=mysqli_stmt_execute($sql);
                                        if ($result){
                                                $data= mysqli_stmt_get_result($sql);
                                               $sno=1;
                                                while ($row = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <th style="font-size: 14px;"><?php echo $sno; ?></th>
                                        <td class="overflow_style2" style="font-size: 14px;">
                                            <?php echo $row["name"];?>
                                        </td>
                                        <td class="overflow_style2" style="font-size: 14px;">
                                            <?php echo $row["purchased_quantity"];?> <?php echo $row["unit"]==null?"":$row["unit"];?>
                                        </td>
                                        <td class="overflow_style2" style="font-size: 14px;">
                                            <?php echo $row["total_price"];?> INR
                                        </td>
                                        
                                       
                                    </tr>
                                    
                                   
                                    <?php
                                        $sno++;
                                    }
                                    mysqli_stmt_close($sql);
                                    // mysqli_close($conn);
                                }
                                else{
                                    mysqli_error($conn);
                                }
                                mysqli_close($conn);
                                
                                ?>

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <br>
                    <div class="d-flex">
                        <a class="btn btn-primary mx-2" target="_blank" href="../../backend/doctor/create_bill.php?id=<?php echo $sales_order_id;?>">Create Bill</a>
                   
                        <?php  
                            if($order_status==2){
                                ?>
                                <form action="../../backend/doctor/update_status.php" onsubmit="return confirm('Are you sure ? Once submitted you will not be able undo(बदल) this action !')" method="post">
                                    <input type="number" hidden name="sales_order_id" value="<?php echo $sales_order_id;?>">
                                    <button type="submit" class="btn btn-outline-success">Mark as Done</button>
                                </form>
                                
                                <?php
                            }
                        
                        
                        ?>

                    </div>
              

                    <!-- <div class="mt-3" style="gap:10px; display:<?php echo $order_status ?"none":"block"; ?>">
                        
                        <form action="../../backend/doctor/update_status.php" onsubmit="return confirm('Are you sure ? Once submitted you can not edit this!!')" method="post">
                            <input type="number" hidden name="sales_order_id" value="<?php echo $sales_order_id;?>">
                            <button type="submit" class="btn btn-outline-primary">Change Status from Draft to Active</button>
                        </form>
                        
                    </div> -->
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
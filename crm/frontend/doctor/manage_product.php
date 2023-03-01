<?php
session_start();
if (!isset($_SESSION["is_doctor"])) {
  header("location: ../../frontend/login.php");
}
include("../../backend/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('./user_components/header_links.php'); ?>
    <title>Manage product</title>

    <style>
        .overflow_style2 {
            max-width: 100px !important;
            overflow-x: auto;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .overflow_style2::-webkit-scrollbar {
            display: none;
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
                        <div class="row align-items-center mb-2">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">Manage product</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">

                                    <button class="btn d-inline-flex btn-sm btn-primary mx-1" data-bs-toggle="modal"
                                        data-bs-target="#addProduct">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Add New product</span>
                                    </button>
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
                                                product</span>
                                            <?php
                        
                                                    $stmt="SELECT count(id) FROM `products` 
                                                    WHERE deleted_at IS NULL AND business_id=(?)";
                                                    $sql=mysqli_prepare($conn, $stmt);

                                                    $business_id=$_SESSION['user_id'];
                                                    mysqli_stmt_bind_param($sql,'i',$business_id);
                                        
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
                                                <i class="bi bi-files"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Product List</h5>
                        </div>
                        <div class="table-responsive" style="padding: 30px 18px;">
                            <table class="table table-hover table-nowrap" id="myTable"
                                style="padding: 30px 2px; border: 0px solid black !important;">
                                <thead class="thead-light">
                                    <tr>
                                        <!-- DO not change the order because we are editing based on order.. -->
                                        <th style="font-size: 14px;">Sno</th>
                                        <th style="font-size: 14px;">product Name</th>
                                        <th style="font-size: 14px;">मात्रा (Stock)</th>
                                        <th style="font-size: 14px;">कीमत (Price)</th>
                                        <th style="font-size: 14px;">Location</th>
                                        <th style="font-size: 14px;">Unit</th>
                                        <th style="font-size: 14px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="border: 0px solid black !important;">
                                    <?php
                                   
                                        $stmt="SELECT id,name,stock,unit,price,location
                                        FROM `products` WHERE products.business_id=(?) AND products.deleted_at IS NULL 
                                        ORDER BY stock";
                                        $sql=mysqli_prepare($conn, $stmt);

                                        mysqli_stmt_bind_param($sql,'i',$_SESSION['user_id']);
                                        $status=1;
                                        $archive=0;
                            
                                        $result=mysqli_stmt_execute($sql);
                                        if ($result){
                                                $data= mysqli_stmt_get_result($sql);
                                                $sno=1;
                                                while ($row = mysqli_fetch_array($data)){
                                    ?>
                                    <tr id="productRow<?php echo $row['id']; ?>">
                                        <!-- DO not change the order because we are editing based on order.. -->
                                        <td style="font-size: 13px;">
                                            <?php echo $sno;?>
                                        </td>

                                        <td class="overflow_style2" style="font-size: 13px;">
                                            <b><?php echo $row["name"];?></b>
                                        </td>
                                        <td class="overflow_style2 <?php echo $row["stock"]<10?"text-danger fw-bolder":"";?> 
                                        <?php echo $row["stock"]<50?"text-warning fw-bolder":"";?> <?php echo $row["stock"]>=50?"text-success fw-bolder":"";?>" style="font-size: 13px;">
                                            <?php echo $row["stock"] <=0 ?0:$row["stock"];?>
                                        </td>
                                        <td class="overflow_style2" style="font-size: 13px;">
                                            <span class="fw-bold"><?php echo $row["price"];?> ₹</span>
                                        </td>
                                        <td class="overflow_style2" style="font-size: 13px;">
                                            <?php echo $row["location"]==null?"Not Available":$row["location"];?>
                                        </td>
                                        <td class="overflow_style2" style="font-size: 13px;">
                                            <?php echo $row["unit"]==null?"Not Available":$row["unit"];?>
                                        </td>

                                        <td class="d-flex p-1">
                                            <button type="button" class="btn btn-primary btn-sm p-2"
                                                onclick="showEditModal(<?php echo $row['id']; ?>)">Edit</button>
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


    <!-- Modal -->
    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductLabel">New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="px-sm-5" action="../../backend/doctor/new_product.php" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="product_name" class="form-label">Product Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" placeholder="Name" class="form-control" name="product_name"
                                maxlength="70" id="product_name" required aria-describedby="product_name">

                        </div>
                        <div class="mb-2">
                            <label for="product_price" class="form-label ">Selling Price (INR) <span
                                    class="text-danger">*</span></label>
                            <input type="number" placeholder="120 rs" class="form-control" name="product_price" required
                                aria-describedby="product_price" min="1">
                            <p class="text-sm text-muted">Price of single unit.</p>
                        </div>
                        <div class="mb-2">
                            <label for="product_unit" class="form-label">Available Stock (मात्रा) <span
                                    class="text-danger">*</span></label>
                            <input type="number" placeholder="100" class="form-control" name="product_stock" required
                                aria-describedby="product_stock" min="0">

                        </div>
                        <div class="mb-2">
                            <label for="product_stock" class="form-label">Product Unit <span
                                    class="text-danger"></span></label>
                            <input type="text" placeholder="Example: pcs, kg, gm, liter etc. " class="form-control" name="product_unit"  aria-describedby="product_unit">

                        </div>
                        
                        <div class="mb-2">
                            <label for="product_location" class="form-label">Location </label>
                            <textarea type="text" placeholder="Box 1" class="form-control" maxlength="200"
                                name="product_location" id="product_location" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductLabel">Edit Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="px-sm-5" action="../../backend/doctor/update_product_details.php" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="product_name" class="form-label">Product Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" placeholder="Name" class="form-control" name="update_product_name"
                                id="update_product_name" required aria-describedby="product_name">

                        </div>
                        <div class="mb-2">
                            <label for="product_price" class="form-label">Selling Price (INR) <span
                                    class="text-danger">*</span></label>
                            <input type="number" placeholder="200" class="form-control" min="1"
                                name="update_product_price" id="update_product_price" required
                                aria-describedby="product_price">
                            <p class="text-sm text-muted">Price of single unit.</p>
                        </div>
                        <div class="mb-2">
                            <label for="update_product_location" class="form-label">Product Location </label>
                            <textarea type="text" placeholder="Box 1" class="form-control"
                                name="update_product_location" id="update_product_location" rows="2"></textarea>
                        </div>
                        <div class="mb-2">
                            <label for="update_product_unit" class="form-label">Product Unit <span
                                    class="text-danger"></span></label>
                            <input type="text" id="update_product_unit" placeholder="Example: pcs, kg, gm, liter etc. " class="form-control" name="update_product_unit" aria-describedby="update_product_unit">

                        </div>

                        <input type="number" name="update_product_id" hidden readonly id="update_product_id">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showEditModal(id) {
            let productRow = document.getElementById('productRow' + id);

            let pName = productRow.children[1].innerText;
            let pPrice = productRow.children[3].innerText;
            let pLocation = productRow.children[4].innerText;
            let pUnit = productRow.children[5].innerText;

            pPrice = pPrice.split(' ');

            document.getElementById('update_product_id').value = id;
            document.getElementById('update_product_name').value = pName;
            document.getElementById('update_product_price').value = pPrice[0];
            document.getElementById('update_product_location').value = pLocation;
            document.getElementById('update_product_unit').value = pUnit;
            // document.getElementById('editModal').modal;
            $('#editModal').modal('show');

        }

        document.getElementById('manage_product').classList.add('active');
    </script>


    <?php require('./user_components/scripts.php'); ?>

   
</body>

</html>
<?php 
  include('../config.php');
if (isset($_POST["allotment_id"])) {
    $stmt="UPDATE `allotment_schema` SET status=? WHERE id=(?)";
    $sql=mysqli_prepare($conn, $stmt);

    //binding the parameters to prepard statement
    mysqli_stmt_bind_param($sql,"ii",$status,$id);
    $id=trim($_POST["allotment_id"]);
    $status=trim($_POST["status"]);

    $result=mysqli_stmt_execute($sql);
        if ($result) {
            mysqli_stmt_close($sql);
            mysqli_close($conn);
            echo "<script>
                        window.location.href='../../frontend/doctor/dashboard.php';
                        </script>";
                        exit;
        } else {
        echo mysqli_error($conn);
        mysqli_stmt_close($sql);
        mysqli_close($conn);
        echo "<script>alert('Sorry!! id not found.');
        window.location.href='../../frontend/doctor/dashboard.php';
        </script>";
        exit;
        }
    } 
    else {

        mysqli_close($conn);
        echo '<script>
        alert("Please fill all the details.");
        history.back();
        <script>';
        exit;
    }
    
?>
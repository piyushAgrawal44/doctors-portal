<?php
if(isset($_POST['user_id'])){
    include("../config.php");
    $stmt="UPDATE `patient_schema` SET status=? WHERE id=(?)";
    $sql=mysqli_prepare($conn, $stmt);

    //binding the parameters to prepard statement
    $timestamp=date('Y-m-d H:i:s');
    mysqli_stmt_bind_param($sql,"ii",$status,$_POST['user_id']);
    if ($_POST['status']==0) {
        $status=1;
    } else {
        $status=0;
    }
    $result=mysqli_stmt_execute($sql);
    if($result) {
        echo "<script>
                    window.location.href='../../frontend/user/manage_patient.php';
                </script>";
        exit;
    }
    else{
        echo "<script>alert('Something went wrong.');
                    window.location.href='../../frontend/user/manage_patient.php';
                </script>";
        exit;
    }

}
else{
    echo "<script>alert('Please fill all the details.');
                    window.location.href='../../frontend/user/manage_patient.php';
                </script>";
        exit;
}
?>
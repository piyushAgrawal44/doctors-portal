<?php

include('../config.php');

if (isset($_POST["doctor_id"]) && isset($_POST["patient_id"]) && isset($_POST["disease_name"])) {
   
        $doctor_id=trim($_POST["doctor_id"]);
        $patient_id=trim($_POST["patient_id"]);
        $disease_name=trim($_POST["disease_name"]);
      
        $appoitment_date=trim($_POST["appoitment_date"]);
        $appoitment_time=trim($_POST["appoitment_time"]);
        $appoitment_datetime=$appoitment_date." ".$appoitment_time; 
       
      
        $status=0;
        
        $stmt="INSERT INTO `allotment_schema` (doctor_id,patient_id,disease_name,appoitment_datetime,status) VALUES (?,?,?,?,?)";
        $sql=mysqli_prepare($conn, $stmt);
    
        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"iissi",$doctor_id,$patient_id,$disease_name,$appoitment_datetime,$status);
       
    
        $result=mysqli_stmt_execute($sql);
        if ($result) {
            
            mysqli_stmt_close($sql);
            mysqli_close($conn);
           
    
            echo "<script>
                window.location.href='../../frontend/user/manage_allotment.php';
                </script>";
        die;

    
        } 
        
        else {
            echo mysqli_error($conn);
            echo '<script>
            alert("Something went wrong. We are facing some technical issue. It will be resolved soon. ")
            window.location.href="../../frontend/user/manage_allotment.php"
            </script>';
        die;

        }
    
        
} 
else{
    echo '<script>
    alert("Technical Issue.");
    window.location.href="../../frontend/user/manage_allotment.php";
    </script>';  
    die;

}
function trim_input_value($data){
    $data=trim($data);
    return $data;
}
?>
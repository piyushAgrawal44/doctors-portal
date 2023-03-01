<?php

include('../config.php');

if (isset($_POST["email_id"]) && isset($_POST["fullname"]) && isset($_POST["primary_phone_number"])) {
    $stmt="SELECT id FROM `doctor_schema` WHERE email_id=(?)";
    $sql=mysqli_prepare($conn, $stmt);

    //binding the parameters to prepard statement

    $email=trim($_POST["email_id"]);
    mysqli_stmt_bind_param($sql,"s",$email);
    $result=mysqli_stmt_execute($sql);
    $data= mysqli_stmt_store_result($sql);
    $no_of_row=mysqli_stmt_num_rows($sql);

    if ($no_of_row>0){
        //   echo $no_of_row;
        mysqli_stmt_close($sql);
        echo "<script>alert('Sorry email already exists.');
        window.location.href='../../frontend/user/manage_doctor.php';
        </script>";
    }
    else{

        try{

            $fullname=trim($_POST["fullname"]);
        $email_id=trim($_POST["email_id"]);
        $primary_contact_number=trim($_POST["primary_phone_number"]);
        $secondary_contact_number=trim($_POST["secondary_phone_number"]);
        $address=trim($_POST["address"]);
        $adharcard_number=trim($_POST["adharcard_number"]);
        $pancard_number=trim($_POST["pancard_number"]);
        $joining_date=trim($_POST["joini$joining_date"]);
        $visit_time_from=trim($_POST["visit_time_from"]);
        $visit_time_to=trim($_POST["visit_time_to"]);
        $username=trim($_POST["email_id"]);
        $speciality_title=trim($_POST["speciality"]);
        $status=trim($_POST["status"]);
        mysqli_stmt_close($sql);

       if ($speciality_title) {
        $stmt="INSERT INTO `speciality_schema` (title,status) VALUES (?,?)";
        $sql=mysqli_prepare($conn, $stmt);
    
        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"si",$speciality_title,$speciality_status);
        $speciality_status=1;
    
        $result=mysqli_stmt_execute($sql);
        if (!$result) {
            echo '<script>
            alert("Something went wrong. We are facing some technical issue. It will be resolved soon. ")
            history.back();
            </script>';
        die;

        }
        $speciality_id=$sql->insert_id;
       }
       else{
        $speciality_id=1;
       }
       
        mysqli_stmt_close($sql);

        $digits=4;
        $code=rand(pow(10, $digits-1), pow(10, $digits)-1);
        $characters="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $string = '';
        for ($i = 0; $i < 6; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
    
        $random_password=$string."@".$code;
        $password=password_hash($random_password, PASSWORD_DEFAULT);
        $stmt="INSERT INTO `doctor_schema` (fullname,email_id,primary_contact_number,secondary_contact_number,address,adharcard_number,pancard_number,joining_date,speciality_id,visit_time_from,visit_time_to,username,password,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $sql=mysqli_prepare($conn, $stmt);
    
        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"ssssssssissssi",$fullname,$email_id,$primary_contact_number,$secondary_contact_number, $address,$adharcard_number,$pancard_number,$joining_date,$speciality_id,$visit_time_from,$visit_time_to,$username,$password,$status);
       
    
        $result=mysqli_stmt_execute($sql);
        if ($result) {
            
            mysqli_stmt_close($sql);
            mysqli_close($conn);
            $emailto=$email_id;
            $name=$fullname;
            $mail_subject="New Invitation";
            $mail_message="Congratulations! You have received a new invitation. 
            <br>
            Please use following credentials to login into your account: <br>
            Email: ".$email_id."
            <br>
            Password: ".$random_password."
            <br>
            <br>
            Note: We suggest you to reset your password after login.";
            require("../mailer_code/sendmail.php");
    
            echo "<script>
                        window.location.href='../../frontend/user/manage_doctor.php';
                </script>";
        die;

    
        } 
        
        else {
            echo mysqli_error($conn);
            echo '<script>
            alert("Something went wrong. We are facing some technical issue. It will be resolved soon. ")
            window.location.href="../../frontend/user/manage_doctor.php"
            </script>';
        die;

        }
    
        } catch(error){
            echo '<script>
            alert("Internal Server Error");
            window.location.href="../../frontend/user/manage_doctor.php";
            </script>';
        die;

        }
        
    } 
    
}
else{
    echo '<script>
    alert("Technical Issue.");
    window.location.href="../../frontend/user/manage_doctor.php";
    </script>';  
    die;

}
function trim_input_value($data){
    $data=trim($data);
    return $data;
}
?>
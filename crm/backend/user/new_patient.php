<?php

include('../config.php');

if (isset($_POST["email_id"]) && isset($_POST["fullname"]) && isset($_POST["primary_phone_number"])) {
    $stmt="SELECT id FROM `patient_schema` WHERE email_id=(?)";
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
        window.location.href='../../frontend/user/manage_patient.php';
        </script>";
    }
    else{


            $fullname=trim($_POST["fullname"]);
        $email_id=trim($_POST["email_id"]);
        $primary_contact_number=trim($_POST["primary_phone_number"]);
        $secondary_contact_number=trim($_POST["secondary_phone_number"]);
        $address=trim($_POST["address"]);
        $adharcard_number=trim($_POST["adharcard_number"]);
        $pancard_number=trim($_POST["pancard_number"]);
       
        $username=trim($_POST["email_id"]);
       
        $status=trim($_POST["status"]);
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
        $stmt="INSERT INTO `patient_schema` (fullname,email_id,primary_contact_number,secondary_contact_number,address,adharcard_number,pancard_number,username,password,status) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $sql=mysqli_prepare($conn, $stmt);
    
        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"sssssssssi",$fullname,$email_id,$primary_contact_number,$secondary_contact_number, $address,$adharcard_number,$pancard_number,$username,$password,$status);
       
    
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
                        window.location.href='../../frontend/user/manage_patient.php';
                </script>";
        die;

    
        } 
        
        else {
            echo mysqli_error($conn);
            echo '<script>
            alert("Something went wrong. We are facing some technical issue. It will be resolved soon. ")
            window.location.href="../../frontend/user/manage_patient.php"
            </script>';
        die;

        }
    
        
    } 
    
}
else{
    echo '<script>
    alert("Technical Issue.");
    window.location.href="../../frontend/user/manage_patient.php";
    </script>';  
    die;

}
function trim_input_value($data){
    $data=trim($data);
    return $data;
}
?>
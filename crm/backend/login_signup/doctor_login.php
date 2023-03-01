<?php
session_start();
include("../config.php");
function trim_input_value($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"])) {
    
            
            $stmt="SELECT id,fullname,password,status FROM `doctor_schema` WHERE email_id=(?) LIMIT 1";
            $sql=mysqli_prepare($conn, $stmt);
            mysqli_stmt_bind_param($sql,"s",$email);
            
            $email=trim_input_value($_POST['email']);

            $password=trim($_POST["password"]);
          
            $result=mysqli_stmt_execute($sql);

            if(!$result){
                echo "<script>alert('Something went wrong. Please try again later !');
                history.back();
                </script>";
                exit;
            }

            $data= mysqli_stmt_get_result($sql);
            if ($data->num_rows <= 0){
                echo "<script>alert('Invalid Credential !');
                history.back();
                </script>";
                exit;
            }


            $row=mysqli_fetch_array($data);
            $user_id=$row['id'];
           

            if (!password_verify($password, $row['password'])) 
            {
                echo "<script>alert('Invalid Credential !');
                history.back();
                </script>";
                exit;
            }

            if($row['status'] == 0){
                echo "<script>alert('Account is deactivated !!');
                window.location.href='../../frontend/login.php';
                </script>";
                exit;
            }

           

            mysqli_stmt_close($sql);
            mysqli_close($conn);
            $logged=true;   
            $_SESSION["is_doctor"]="yes";
                
            $_SESSION["user_id"]=$row["id"];
            $_SESSION["user_email"]=$email;
        
            echo "<script>
            window.location.href='../../frontend/doctor/dashboard.php';
            </script>";
            exit;
                
} 
else {
    mysqli_close($conn);
    echo "<script>alert('Sorry something went wrong');
                    window.location.href='../../frontend/login.php';
          </script>";
          exit;
}

?>
<?php
include('./config.php');

function trim_input_value($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['name']) && !empty($_POST['name']) 
    && isset($_POST['subject']) && !empty($_POST['subject']) && isset($_POST['message']) && !empty($_POST['message']))
    {
        $from_location="../../index.php";
        $name=trim_input_value($_POST['name']);
        $email=trim_input_value($_POST['email']);
        $phone=trim_input_value($_POST['phone']);
        $subject=trim_input_value($_POST['subject']);
        $message=trim_input_value($_POST['message']);
        
        $stmt="INSERT INTO `contact_us` (email,name,phone,subject,message) VALUES (?,?,?,?,?)";
        $sql = mysqli_prepare($conn, $stmt);
        mysqli_stmt_bind_param($sql, 'sssss', $email, $name, $phone,$subject,$message);
        $result=mysqli_stmt_execute($sql);
        if($result)
        {
            mysqli_stmt_close($sql); 

            
            ?>
            <script>
                    alert('Thank you for your request.');
                    window.location.href="<?php echo $from_location; ?>"
            </script>
        <?php } 
        else
        {
            mysqli_stmt_close($sql);
            ?>
            <script>alert('Sorry Something Went Wrong. Please try again.');
               history.back();
            </script>
            <?php
        }
    }
    else{
        ?>
        <script>
            alert("Sorry something went wrong");
            history.back();
        </script>
        <?php
    }
?>
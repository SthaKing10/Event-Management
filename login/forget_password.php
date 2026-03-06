<?php

include '../include/connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$error_msg = '';

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $result = mysqli_query($con,"select *from user where(email = '$email') limit 1");

    if(mysqli_num_rows($result)==1){
        $_SESSION['reset_email'] = $email;
            $_SESSION['tost'] = ["message"=>"OTP Successfully send to your email","type"=>"success"];
            header('location:verify_otp.php');
            exit();
        }
    
    else
        {
            $_SESSION['tost'] = ["message"=>"Email is not register in our system, try with diffrent email","type"=>"error"];
            header('location:forget_password.php');
            exit();
        }
    }     


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../Tost_Message/style.css">
    <script src="../Tost_Message/script.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="../style/formstyle.css">
</head>
<body>
     <div id="tostBox"></div>

    <?php 
        session_start();
        if(!empty($_SESSION['tost'])){
            $tost = $_SESSION['tost']; ?>

            <script>
                showTost("<?= $tost['message'] ?>","<?= $tost['type'] ?>");
            </script>
        <?php
        unset($_SESSION['tost']);

        }


    ?>
    <div class="container">
    <form method="post">
        <div class="form-box">
            <h2>Forget Password</h2>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter your Email Address" required>
                <p class="error"><?= $error_msg ?></p>
            </div>
            
                <button type="submit" name="submit">Forget password</button>
           
        </div>
        
    </form>
    </div>
    
</body>
</html>




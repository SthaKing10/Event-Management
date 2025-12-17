<?php
include '../include/connection.php';
$msg = "";
session_start();
if(isset($_POST['submit'])){
    $check_password = md5(mysqli_real_escape_string($con,$_POST['old_password']));
    $user_id = $_SESSION['user_id'];
    $result = mysqli_query($con,"SELECT * from user where(user_id = $user_id and password = '$check_password') limit 1");
    $row = mysqli_fetch_assoc($result);
    $_SESSION['reset_email'] = $row['email'];

    if(mysqli_num_rows($result)==1){
        $_SESSION['password-verified'] = true;
        header('location:../login/reset_password.php');

    }
    else{
        $msg = " Password Incorrect <a href='../login/forget_password.php'>Reset Password</a> ";

    }

}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/formstyle.css">
    <title>Check Password</title>
</head>
<body>
    <div class="container">
        <form method="post">
            <div class="form-box">
            <h2>Chek Old Password</h2>
            <div>
                <label for="oldpassword">Old Password:</label>
                <input type="password" name="old_password" id="oldpassword" placeholder="Enter your Old Password">
            </div>
            <button type="submit" name="submit">Check Password</button>
            <p class="error"><?= $msg ?></p>
</div>
        </form>
    </div>
    
</body>
</html>
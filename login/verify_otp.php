<?php
include '../include/connection.php';
session_start();
$email = $_SESSION['reset_email'];
$max_attempt = 5;
$error_msg = "";

if(isset($_POST['submit'])){
    $otp = mysqli_real_escape_string($con, $_POST['otp']);
    $result = mysqli_query($con, " SELECT * FROM otp WHERE email='$email'   and created_at >= now() - INTERVAL 5 MINUTE LIMIT 1");

    if(mysqli_num_rows($result) == 0){
        mysqli_query($con, "delete from otp where(email = '$email')");
        echo "<p style = 'color:red'>OTP Expired Feri Patha  <br><br><button><a href='forget_password.php'>Hya Bata</button></a></p>";
        exit();
    }
    $row = mysqli_fetch_assoc($result);

    if($row['attempt'] >=$max_attempt){
        mysqli_query($con, "delete from otp where(email = '$email')");
        echo "<h2 style='color:red'>You reached maximum attempts.</h2>";
        
        echo "<a href='forget_password.php'>Resend OTP</a>";
        exit();
    }
    if($row['otp'] ==$otp){
        $_SESSION['otp-verified'] = true;
        mysqli_query($con, "delete from otp where(email = '$email')");
        header('location:reset_password.php');
    }
    else
    {
        $id = $row['id'];
        mysqli_query($con,"update otp set attempt = attempt +1 where id = {$row['id']} and email = '$email'");
        $remaning_attempt = $max_attempt - ($row['attempt'] + 1);
        $error_msg = "Invalid OTP. Remaining attempts: ".$remaning_attempt;
        $_SESSION['tost'] = ["message"=>$error_msg,"type"=>"invalid"];
        
    }


}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Otp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../Tost_Message/style.css">
    <script src="../Tost_Message/script.js"></script>
    <link rel="stylesheet" href="../style/formstyle.css">
</head>
<body>
    <div id="tostBox"></div>

    <?php

    if(!empty($_SESSION['tost'])){ 
       $tost = $_SESSION['tost']; 
        ?>
    <script>
        showTost("<?= $tost['message'] ?>","<?= $tost['type'] ?>");
    </script>

   <?php
   unset($_SESSION['tost']);

}


    ?>
    <div class="container">
        <form action="" method="post">
        <div class="form-box">
            <h2>Verify OTP</h2>
            <div>
                <label for="otp">Enter Otp:</label>
                <input type="text" name="otp" id="otp" placeholder="Chek the Otp in your gmail" required>
                <p class="error"><?= $error_msg ?></p>
            </div>
            <button type="submit" name="submit">Verify Otp</button>
        </div>
    </form>
    </div>
</body>
</html>

<script>
    fetch('send_otp.php')
    .then(response=>response.text())
    .then(data=>console.log("Mail Sent",data))
    .catch(error=>console.error("Error:",error));
</script>
<?php
require '../Send_Mail/send_mails.php';
include '../include/connection.php';

session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);

$email = $_SESSION['reset_email'];





$otp_result = mysqli_query($con, "SELECT * FROM otp WHERE email='$email' AND created_at >= NOW() - INTERVAL 5 MINUTE LIMIT 1");

if(mysqli_num_rows($otp_result) > 0){
    $row = mysqli_fetch_assoc($otp_result);
    $otp = $row['otp'];
    
    if($row['email_sent'] == 0){
        $subject = 'Verify Your OTP';
        $body = "<p>Reset your password using the OTP:</p><h2>$otp</h2><p>This OTP expires in 5 minutes.</p>";
        if(send_mail($email, $subject, $body)){
            mysqli_query($con, "UPDATE otp SET email_sent=1 WHERE id={$row['id']}");
            

            
        }
    }
} else {
    $otp = rand(100000, 999999);
    mysqli_query($con, "INSERT INTO otp(email, otp, created_at, email_sent) VALUES('$email', '$otp', NOW(), 0)");

    // Send the email
    $subject = 'Verify Your OTP';
    $body = "<p>Reset your password using the OTP:</p><h2>$otp</h2><p>This OTP expires in 5 minutes.</p>";
    if(send_mail($email, $subject, $body)){
        // Mark email as sent
        $last_id = mysqli_insert_id($con);
        mysqli_query($con, "UPDATE otp SET email_sent=1 WHERE id=$last_id");
        $_SESSION['tost'] = ["message"=>"OTP Successfully send to your email","type"=>"success"];
    }
}

?>
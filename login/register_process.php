<?php
session_start();
include "../include/connection.php";

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

$hash_password = password_hash($password, PASSWORD_DEFAULT);



$sql = "INSERT INTO user(user_name,email,phone_number,password,role)
 VALUES ('$fullname','$email','$phone','$hash_password','user')";

if(mysqli_query($con,$sql)){
    $_SESSION['tost'] = ["message"=>"Register Successful,Login here","type"=>"success"];
    header("Location: login.php");
} else {
    $error = "Error".mysqli_error($con);
    $_SESSION['todt'] = ["message"=>"<?= $error ?>","type"=>"erroe"];
}
?>
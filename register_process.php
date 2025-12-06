<?php
include "connection.php";

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = md5($_POST['password']);


$sql = "INSERT INTO user(user_name,email,phone_number,password,role)
 VALUES ('$fullname','$email','$phone','$password','user')";

if(mysqli_query($con,$sql)){
    header("Location: login.php?success=1");
} else {
    echo "Error: " . mysqli_error($con);
}
?>
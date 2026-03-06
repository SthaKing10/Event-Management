<?php
session_start();
include "../include/connection.php";

$email = $_POST['email'];
$password = $_POST['password'];

$_SESSION['email'] = $email;
$_SESSION['password'] = $password;

$sql = "SELECT * FROM user WHERE email='$email' LIMIT 1";
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)==0){
    $_SESSION['tost'] = [
                "message"=>"Invalid Email,This email is not register in our system",
                "type"=>"error"
            ];
   header('location:login.php');  
   exit();       

}

if(mysqli_num_rows($result) == 1){

    $user = mysqli_fetch_assoc($result);

    if(password_verify($password,$user['password'])){

        $_SESSION['user'] = $user;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];

        if($user['role'] == "admin"){
            $_SESSION['tost'] = [
                "message"=>"Login Successful, Welcome to admin dashboard",
                "type"=>"success"
            ];
            unset($_SESSION['email']);
            unset($_SESSION['password']);
            header("Location: ../admin/admin_dashboard.php");
            exit();
        }else{

            $_SESSION['tost'] = [
                "message"=>"Login Successful, Welcome to user dashboard",
                "type"=>"success"
            ];

            unset($_SESSION['email']);
            unset($_SESSION['password']);

            header("Location: ../index.php");
            exit();
        }

    }else{
        $_SESSION['tost'] = [
                "message"=>"Incorrect Password",
                "type"=>"invalid"
            ];

            header("Location:login.php");
        
    }

}else{

    $_SESSION['tost'] = [
                "message"=>"Incorrect Password",
                "type"=>"invalid"
            ];

            header("Location:login.php");
    
}
?>
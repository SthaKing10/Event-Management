<?php
session_start();
include "connection.php";

$email = $_POST['email'];
// $password = md5($_POST['password']);

$sql = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)==1){
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user'] = $user;

    if($user['role'] == "admin"){
        header("Location: admin_dashboard.php");
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];
        
    } else {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
    }

} else {
    echo "Invalid email or password";
}
?>

<?php
session_start();
session_destroy();
session_start();
$_SESSION['tost'] = ["message"=>"Logout Successful,Login Here","type"=>"success"];
header("Location: login.php");
?>

<?php
include 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function sanitize($con, $data) {
    return mysqli_real_escape_string($con, trim($data));
}

function check_login() {
    
    if (!isset($_SESSION['user_id'])) {
        header("Location: /Event-Management/login/login.php");
        exit();
        
    }
}
?>

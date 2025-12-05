<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>
<style>
body{font-family:Arial;padding:20px;}
a{padding:10px 15px;background:#3498db;color:white;text-decoration:none;border-radius:5px;}
</style>
</head>
<body>

<h1>Welcome, <?=$_SESSION['user']['fullname']?>!</h1>

<a href="user_events.php">View Events</a>  
<a href="my_bookings.php">My Bookings</a>  
<a href="logout.php">Logout</a>

</body>
</html>

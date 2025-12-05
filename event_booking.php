<?php
session_start();
include "db.php";

$event_id = $_GET['id'];
$user_id = $_SESSION['user']['id'];

mysqli_query($conn,"INSERT INTO bookings(user_id,event_id) VALUES('$user_id','$event_id')");

header("Location: my_bookings.php?success=1");
?>

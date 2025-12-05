<?php
session_start();
include "db.php";

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $date = $_POST['date'];
    $venue = $_POST['venue'];
    $seats = $_POST['seats'];
    $user_id = $_SESSION['user']['id'];

    mysqli_query($conn, "INSERT INTO events(title,description,date,venue,seats,user_id)
                         VALUES('$title','$desc','$date','$venue','$seats','$user_id')");

    header("Location: user_my_events.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Event</title>
<style>
form { width: 350px; margin: auto; background: #fff; padding: 20px; border-radius: 10px; }
input, textarea { width: 100%; padding: 10px; margin: 10px 0; }
button { padding: 10px 15px; background: #2ecc71; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
</style>
</head>
<body>

<h2 style="text-align:center;">Add Event</h2>

<form method="POST">
    <input type="text" name="title" placeholder="Event Title" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="date" name="date" required>
    <input type="text" name="venue" placeholder="Venue" required>
    <input type="number" name="seats" placeholder="Available Seats" required>

    <button type="submit" name="submit">Save Event</button>
</form>

</body>
</html>

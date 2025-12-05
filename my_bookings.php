<?php
session_start();
include "db.php";

$user_id = $_SESSION['user']['id'];
$sql = "SELECT events.title, events.date, events.venue 
        FROM bookings
        JOIN events ON bookings.event_id = events.id
        WHERE bookings.user_id = $user_id";

$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html>
<head><title>My Bookings</title></head>
<body>

<h1>My Bookings</h1>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<p>
    <b><?=$row['title']?></b><br>
    Date: <?=$row['date']?><br>
    Venue: <?=$row['venue']?>
</p>
<hr>
<?php } ?>

</body>
</html>

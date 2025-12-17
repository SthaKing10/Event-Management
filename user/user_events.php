<?php
session_start();
include "db.php";

$result = mysqli_query($conn,"SELECT * FROM events");
?>
<!DOCTYPE html>
<html>
<head><title>Events</title>
<style>
.card{background:white;padding:20px;margin:15px;border-radius:8px;}
a.btn{background:#3498db;padding:8px 12px;color:white;text-decoration:none;border-radius:5px;}
</style>
</head>
<body>

<h1>Available Events</h1>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="card">
    <h3><?=$row['title']?></h3>
    <p><?=$row['description']?></p>
    <p><b>Date:</b> <?=$row['date']?></p>
    <p><b>Venue:</b> <?=$row['venue']?></p>
    <p><b>Seats:</b> <?=$row['seats']?></p>

    <a class="btn" href="event_booking.php?id=<?=$row['id']?>">Book Now</a>
</div>
<?php } ?>

</body>
</html>

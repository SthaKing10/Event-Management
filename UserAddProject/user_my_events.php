<?php
session_start();
include "db.php";

$user_id = $_SESSION['user']['id'];

$result = mysqli_query($conn, "SELECT * FROM events WHERE user_id = $user_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Events</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .card { background: #fff; padding: 20px; margin: 15px 0; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        a.btn { background: #3498db; padding: 8px 12px; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px; }
        a.delete { background: #e74c3c; }
        a.edit { background: #f1c40f; color: black; }
        .add-btn { background: #2ecc71; padding: 10px 18px; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

<h1>My Events</h1>

<a class="add-btn" href="user_event_add.php">+ Add New Event</a>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<div class="card">
    <h3><?= $row['title']; ?></h3>
    <p><?= $row['description']; ?></p>
    <p><b>Date:</b> <?= $row['date']; ?></p>
    <p><b>Venue:</b> <?= $row['venue']; ?></p>
    <p><b>Seats:</b> <?= $row['seats']; ?></p>

    <a class="btn edit" href="user_event_edit.php?id=<?= $row['id']; ?>">Edit</a>
    <a class="btn delete" href="user_event_delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Delete this event?')">Delete</a>
</div>
<?php } ?>

</body>
</html>

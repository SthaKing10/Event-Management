<?php
session_start();
if($_SESSION['user']['role'] != "admin"){
    header("Location: login.php");
}

include "db.php";

$query = "SELECT * FROM events ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>

<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:Arial, sans-serif;
    }

    body{
        background:#f2f4f9;
        padding:20px;
    }

    h1{
        text-align:center;
        margin-bottom:20px;
        color:#333;
    }

    .event-table{
        width:100%;
        border-collapse:collapse;
        background:#fff;
        box-shadow:0 4px 10px rgba(0,0,0,0.1);
        border-radius:10px;
        overflow:hidden;
    }

    .event-table thead{
        background:#007bff;
        color:#fff;
    }

    .event-table th, .event-table td{
        padding:12px 15px;
        text-align:left;
        border-bottom:1px solid #ddd;
    }

    .event-table tr:hover{
        background:#f1f5ff;
    }

    .event-img{
        width:80px;
        height:60px;
        object-fit:cover;
        border-radius:6px;
        border:1px solid #ccc;
    }

    .btn-edit{
        padding:6px 12px;
        background:#28a745;
        color:white;
        text-decoration:none;
        border-radius:5px;
        font-size:14px;
    }
    .btn-edit:hover{
        background:#1f7f35;
    }

    .btn-delete{
        padding:6px 12px;
        background:#dc3545;
        color:white;
        text-decoration:none;
        border-radius:5px;
        font-size:14px;
    }
    .btn-delete:hover{
        background:#b8212f;
    }

    .back-btn{
        display:inline-block;
        margin-bottom:20px;
        padding:10px 15px;
        background:#6c757d;
        color:white;
        text-decoration:none;
        border-radius:5px;
    }

    .back-btn:hover{
        background:#565e64;
    }

</style>

</head>
<body>

<a class="back-btn" href="admin_dashboard.php">← Back to Dashboard</a>

<h1>All Events</h1>

<table class="event-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Event Title</th>
            <th>Date</th>
            <th>Time</th>
            <th>Location</th>
            <th>Price</th>
            <th>Capacity</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['event_date']; ?></td>
            <td><?php echo $row['event_time']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['capacity']; ?></td>

            <td>
                <img src="<?php echo $row['image']; ?>" class="event-img">
            </td>

            <td>
                <a class="btn-edit" href="event_edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a class="btn-delete" href="event_delete.php?id=<?php echo $row['id']; ?>" 
                   onclick="return confirm('Are you sure you want to delete this event?');">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>

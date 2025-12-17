<?php
session_start();
if($_SESSION['user']['role']!="admin"){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    

    /* Container */
    .container{
        width:100%;
        display:flex;
        justify-content:center;
        align-items:flex-start;
        padding-top:40px;
        margin-top: 15px;
    }

    .admin-box{
        width:420px;
        background:white;
        padding:25px;
        border-radius:12px;
        box-shadow:0 4px 12px rgba(0,0,0,0.1);
        display:flex;
        flex-direction:column;
        gap:25px;
    }

    /* Header */
    h1{
        text-align:center;
        font-size:28px;
        color:#333;
        margin-bottom:10px;
    }

    /* Dashboard Boxes */
    .box{
        background:#f7f7f7;
        padding:18px;
        border-radius:10px;
        border:1px solid #ddd;
    }

    .box h2{
        margin-bottom:12px;
        color:#222;
        font-size:20px;
    }

    /* Links */
    .box a{
        display:block;
        margin:6px 0;
        padding:10px;
        background:#0066ff;
        color:white;
        text-decoration:none;
        border-radius:6px;
        text-align:center;
        transition:0.2s ease;
        font-size:15px;
    }

    .box a:hover{
        background:#004dc2;
    }

</style>
</head>
<body>
<?php include '../include/navbar.php';?>

<div class="container">
    <div class="admin-box">
        
        <h1>Admin Dashboard</h1>

        <div class="box">
            <h2>Manage Events</h2>
            <a href="event_add.php">Add New Event</a>
            <a href="view_event.php">View All Events</a>
        </div>

        <div class="box">
            <h2>View Bookings</h2>
            <a href="admin_view_booking.php">All Bookings</a>
        </div>

    </div>
</div>

</body>
</html>

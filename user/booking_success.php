<?php
session_start();
include '../include/connection.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Validate booking_id
if (!isset($_GET['booking_id']) || !is_numeric($_GET['booking_id'])) {
    die("Invalid Booking ID.");
}

$booking_id = intval($_GET['booking_id']);

// Fetch booking details (join event + booking + user)
$query = "
    SELECT b.*, e.title, e.location, e.event_date, e.event_time, e.price, u.user_name 
    FROM event_bookings b
    JOIN events e ON b.event_id = e.event_id
    JOIN user u ON b.user_id = u.user_id
    WHERE b.booking_id = '$booking_id' AND b.user_id = '$user_id'
";

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 0) {
    die("Booking not found or you don't have permission to view it.");
}

$booking = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            padding: 40px;
            margin: 0;
        }
        .success-box {
            max-width: 600px;
            background: white;
            margin: auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #28a745;
            margin-bottom: 10px;
        }
        .details {
            margin-top: 20px;
            text-align: left;
        }
        .details p {
            margin: 8px 0;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="success-box">
    <h2>🎉 Booking Successful!</h2>
    <p>Thank you for booking the event.</p>

    <div class="details">
        
        <p><strong>User Name:</strong> <?php echo htmlspecialchars($booking['user_name']); ?></p>
        <p><strong>Event:</strong> <?php echo htmlspecialchars($booking['title']); ?></p>
        <p><strong>Date:</strong> <?php echo $booking['event_date']; ?></p>
        <p><strong>Time:</strong> <?php echo $booking['event_time']; ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($booking['location']); ?></p>
        <p><strong>Tickets Booked:</strong> <?php echo $booking['tickets']; ?></p>
        <p><strong>Total Price:</strong> 
            Rs<?php echo number_format($booking['tickets'] * $booking['total_price'], 2); ?>
        </p>
    </div>

    <a class="btn" href="user_booking.php">View My Bookings</a>
</div>

</body>
</html>
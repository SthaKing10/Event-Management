<?php
session_start();
include '../include/connection.php';
include '../include/functions.php';

// USER MUST BE LOGGED IN
check_login();

$user_id = $_SESSION['user_id'];

// Get user bookings
$query = "
    SELECT eb.*, e.title, e.image, e.event_date, e.event_time, e.location 
    FROM event_bookings eb
    JOIN events e ON eb.event_id = e.event_id
    WHERE eb.user_id = $user_id
    ORDER BY eb.booking_date DESC

";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Event Bookings</title>
    <link rel="stylesheet" href="../style/user_booking.css">
</head>
<body>

<?php include '../include/navbar.php'; ?>

<div class="container">
    <h2>My Event Bookings</h2>

    <?php if (mysqli_num_rows($result) == 0): ?>

        <p class="no-bookings">You have not booked any events yet.</p>

    <?php else: ?>

        <div class="booking-grid">

            <?php while ($row = mysqli_fetch_assoc($result)): ?>

                <div class="booking-card">

                    <img src="../uploads/event/<?php echo $row['image']; ?>" class="event-img">

                    <div class="content">

                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>

                        <p><b>Date:</b> <?php echo $row['event_date']; ?></p>
                        <p><b>Time:</b> <?php echo $row['event_time']; ?></p>
                        <p><b>Location:</b> <?php echo htmlspecialchars($row['location']); ?></p>

                        <p><b>Tickets:</b> <?php echo $row['tickets']; ?></p>
                        <p class="price"><b>Total Amount:</b> Rs. <?php echo $row['total_price']; ?></p>
                        <p class="payment-status">
                        <b>Payment Status:</b> 
                        <span class="<?php echo strtolower($row['payment_status']); ?>">
                            <?php echo ucfirst($row['payment_status']); ?>
                        </span>
                        </p>

                        <p><b>Booked On:</b> <?php echo $row['booking_date']; ?></p>

                        <a href="booking_success.php?booking_id=<?php echo $row['booking_id']; ?>" class="btn">View Details</a>

                    </div>

                </div>

            <?php endwhile; ?>

        </div>

    <?php endif; ?>

</div>

</body>
</html>

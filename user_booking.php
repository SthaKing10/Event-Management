<?php
session_start();
include 'connection.php';
include 'functions.php';

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

    <style>
        body {
            margin: 0;
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1100px;
            margin: 90px auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .booking-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .booking-card {
            width: 320px;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .booking-card:hover {
            transform: translateY(-5px);
        }

        .event-img {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }

        .content {
            padding: 15px 20px;
        }

        .content h3 {
            margin: 0;
            font-size: 20px;
        }

        .content p {
            margin: 6px 0;
            color: #555;
            font-size: 14px;
        }

        .price {
            font-weight: bold;
            color: #27ae60;
        }
        /* for payment status */

        .payment-status {
            font-size: 16px;
            margin: 8px 0;
        }

        .payment-status b {
            margin-right: 5px;
        }

        /* Color coding based on status */
        .payment-status span.paid {
            color: green;
            font-weight: bold;
        }

        .payment-status span.unpaid {
            color: orange;
            font-weight: bold;
        }

        .payment-status span.failed {
            color: red;
            font-weight: bold;
        }

        .payment-status span.pending {
            color: blue;
            font-weight: bold;
        }

        
        .no-bookings {
            text-align: center;
            padding: 50px 20px;
            font-size: 18px;
            color: #555;
        }

        .btn {
            display: inline-block;
            padding: 8px 15px;
            margin-top: 12px;
            background: #3498db;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn:hover {
            background: #1f6ca8;
        }


    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <h2>My Event Bookings</h2>

    <?php if (mysqli_num_rows($result) == 0): ?>

        <p class="no-bookings">You have not booked any events yet.</p>

    <?php else: ?>

        <div class="booking-grid">

            <?php while ($row = mysqli_fetch_assoc($result)): ?>

                <div class="booking-card">

                    <img src="uploads/event/<?php echo $row['image']; ?>" class="event-img">

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

<?php
session_start();
include 'connection.php';
include 'functions.php';

// Check if user is admin
check_login();
if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Fetch all bookings with user and event details
$query = "SELECT eb.*, u.user_name AS user_name, e.title AS event_title
          FROM event_bookings eb
          JOIN user u ON eb.user_id = u.user_id
          JOIN events e ON eb.event_id = e.event_id
          ORDER BY eb.booking_date DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Event Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0 20px 40px;
            background: #f5f5f5;
            padding-top: 25px;
        }

        h1 {
            text-align: center;
            margin: 30px 0;
            color: #003b95;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background: #003b95;
            color: white;
            font-weight: 500;
        }

        tr:hover {
            background: #f1f5ff;
        }

        .status-badge, .payment-badge {
            padding: 5px 10px;
            border-radius: 12px;
            color: white;
            font-weight: bold;
            font-size: 13px;
        }

        .status-pending {
            background: orange;
        }

        .status-confirmed {
            background: green;
        }

        .status-cancelled {
            background: red;
        }

        .payment-paid {
            background: green;
        }

        .payment-unpaid {
            background: orange;
        }

        .payment-failed {
            background: red;
        }

        .payment-pending {
            background: blue;
        }

        .btn {
            padding: 5px 10px;
            background: #003b95;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 13px;
        }

        .btn:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            th, td {
                font-size: 12px;
            }

            .btn {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<h1>All Event Bookings</h1>

<table>
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>User</th>
            <th>Event</th>
            <th>Tickets</th>
            <th>Total Price (Rs)</th>
            <th>Booking Date</th>
            <th>Booking Status</th>
            <th>Payment Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['booking_id']; ?></td>
            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
            <td><?php echo htmlspecialchars($row['event_title']); ?></td>
            <td><?php echo $row['tickets']; ?></td>
            <td><?php echo number_format($row['total_price'],2); ?></td>
            <td><?php echo date("d M Y, H:i", strtotime($row['booking_date'])); ?></td>
            <td>
                <span class="status-badge status-<?php echo $row['status']; ?>">
                    <?php echo ucfirst($row['status']); ?>
                </span>
            </td>
            <td>
                <span class="payment-badge payment-<?php echo $row['payment_status']; ?>">
                    <?php echo ucfirst($row['payment_status']); ?>
                </span>
            </td>
            <td>

                <a class="btn" href="edit_booking.php?booking_id=<?php echo $row['booking_id']; ?>">Edit</a>
                <a class="btn" href="delete_booking.php?booking_id=<?php echo $row['booking_id']; ?>" 
                   onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

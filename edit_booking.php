<?php
session_start();
include 'connection.php';
include 'functions.php';

// Ensure user is admin
check_login();
if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Check if booking_id is provided
if (!isset($_GET['booking_id'])) {
    die("Invalid booking ID.");
}

$booking_id = intval($_GET['booking_id']);

// Fetch booking info
$query = "SELECT eb.*, u.user_name AS user_name, e.title AS event_title
          FROM event_bookings eb
          JOIN user u ON eb.user_id = u.user_id
          JOIN events e ON eb.event_id = e.event_id
          WHERE eb.booking_id = $booking_id";

$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) == 0) {
    die("Booking not found.");
}

$booking = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $payment_status = $_POST['payment_status'];

    $update_query = "UPDATE event_bookings 
                     SET status='$status', payment_status='$payment_status' 
                     WHERE booking_id=$booking_id";

    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Booking updated successfully'); window.location='admin_view_booking.php';</script>";
        exit();
    } else {
        echo "Error updating booking: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background: #fff;
            margin: 60px auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #003b95;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .btn {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: #003b95;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background: #002066;
        }

        p.info {
            margin-top: 5px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <h2>Edit Booking</h2>

    <p><b>User:</b> <?php echo htmlspecialchars($booking['user_name']); ?></p>
    <p><b>Event:</b> <?php echo htmlspecialchars($booking['event_title']); ?></p>
    <p><b>Tickets:</b> <?php echo $booking['tickets']; ?></p>
    <p><b>Total Price:</b> Rs. <?php echo number_format($booking['total_price'],2); ?></p>

    <form method="POST">
        <label for="status">Booking Status</label>
        <select name="status" id="status" required>
            <?php 
            $statuses = ['pending','confirmed','cancelled'];
            foreach ($statuses as $s) {
                $selected = ($booking['status'] == $s) ? "selected" : "";
                echo "<option value='$s' $selected>".ucfirst($s)."</option>";
            }
            ?>
        </select>

        <label for="payment_status">Payment Status</label>
        <select name="payment_status" id="payment_status" required>
            <?php 
            $payment_statuses = ['paid','unpaid','failed','pending'];
            foreach ($payment_statuses as $ps) {
                $selected = ($booking['payment_status'] == $ps) ? "selected" : "";
                echo "<option value='$ps' $selected>".ucfirst($ps)."</option>";
            }
            ?>
        </select>

        <button type="submit" class="btn">Update Booking</button>
    </form>
</div>

</body>
</html>

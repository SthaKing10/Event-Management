<?php
session_start();
include '../include/connection.php';
include '../include/functions.php';

// USER MUST BE LOGGED IN
if(!isset($_SESSION['user_id'])){
    $_SESSION['tost']= ["message"=>"Login is require to book the evnet", "type"=>"invalid"];
    header('location:../login/login.php');
    exit();
}
// If event_id is missing
if (!isset($_GET['event_id'])) {
    die("Invalid event ID.");
}

$event_id = intval($_GET['event_id']);

// Fetch event details
$event_query = "SELECT * FROM events WHERE event_id = $event_id";
$event_result = mysqli_query($con, $event_query);

if (mysqli_num_rows($event_result) == 0) {
    die("Event not found.");
}

$event = mysqli_fetch_assoc($event_result);

// When form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tickets = intval($_POST['tickets']);

    if ($tickets < 1) {
        echo "<script>alert('Please select a valid number of tickets');</script>";
    } else {
        $user_id = $_SESSION['user_id'];
        $total_price = $tickets * $event['price'];

        // Insert booking record
        $insert_query = "INSERT INTO event_bookings (user_id, event_id, tickets, total_price)
                         VALUES ('$user_id', '$event_id', '$tickets', '$total_price')";

        if (mysqli_query($con, $insert_query)) {
            header("Location: booking_success.php?booking_id=" . mysqli_insert_id($con));
            exit;
        } else {
            echo "Error booking event: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Event</title>

    <style>
        body {
            background: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .container {
            max-width: 700px;
            background: white;
            margin: 60px auto;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        .event-img {
            width: 60%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            background: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 6px;
        }

        .btn:hover {
            background: #1d6fa5;
        }
        select{
            width: 150px;
            border-radius: 12px;

        }
        option{
            text-align: center;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">

    <img src="../uploads/event/<?php echo $event['image']; ?>" class="event-img">

    <h2><?php echo $event['title']; ?></h2>
    <p><b>Date:</b> <?php echo $event['event_date']; ?></p>
    <p><b>Time:</b> <?php echo $event['event_time']; ?></p>
    <p><b>Location:</b> <?php echo $event['location']; ?></p>
    <p><b>Price per ticket:</b> Rs. <?php echo $event['price']; ?></p>

    <form method="POST">
        <label>Number of Tickets:</label><br>
            <select name="tickets" required>
                <option value="">Select Tickets</option>
                <?php 
                    for ($i = 1; $i <= 5; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                ?>
            </select>


            <br><br>
        <button class="btn" type="submit">Confirm Booking</button>

    </form>

</div>

</body>
</html>

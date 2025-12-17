<?php
session_start();
include '../include/connection.php';
include '../include/functions.php';

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

// Delete booking
$delete_query = "DELETE FROM event_bookings WHERE booking_id = $booking_id";

if (mysqli_query($con, $delete_query)) {
    echo "<script>alert('Booking deleted successfully'); window.location='admin_view_booking.php';</script>";
    exit();
} else {
    echo "Error deleting booking: " . mysqli_error($con);
}


?>
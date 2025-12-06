<?php
include 'connection.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    

    // Delete event record
    $deleteQuery = "DELETE FROM events WHERE event_id = $id";

    if(mysqli_query($con, $deleteQuery)){
        echo "<script>alert('Event Deleted Successfully'); window.location='view_event.php';</script>";
    } else {
        echo "Error deleting event: " . mysqli_error($con);
    }

} else {
    echo "<script>alert('Invalid Event ID'); window.location='view_event.php';</script>";
}
?>

<?php
include 'db.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    

    // Delete event record
    $deleteQuery = "DELETE FROM events WHERE id = $id";

    if(mysqli_query($conn, $deleteQuery)){
        echo "<script>alert('Event Deleted Successfully'); window.location='view_event.php';</script>";
    } else {
        echo "Error deleting event: " . mysqli_error($conn);
    }

} else {
    echo "<script>alert('Invalid Event ID'); window.location='view_event.php';</script>";
}
?>

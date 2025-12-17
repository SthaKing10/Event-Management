<?php
session_start();
include '../include/connection.php';

$id = intval($_GET['id']); // Ensure ID is numeric

// Fetch current event data
$query1 = "SELECT * FROM events WHERE event_id = $id";
$result = mysqli_query($con, $query1);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    die("Event not found.");
}

// Handle form submission
if (isset($_POST['submit'])) {
    // Sanitize inputs
    $eventtitle = mysqli_real_escape_string($con, $_POST['eventtitle']);
    $eventdate = $_POST['eventdate'];
    $eventtime = $_POST['eventtime'];
    $eventlocation = mysqli_real_escape_string($con, $_POST['eventlocation']);
    $eventcapacity = intval($_POST['eventcapacity']);
    $eventprice = floatval($_POST['eventprice']);
    $eventdescription = mysqli_real_escape_string($con, $_POST['description']);

    // Handle image upload
    if (!empty($_FILES['eventimage']['name'])) {
        $imageName = basename($_FILES['eventimage']['name']);
        $imageTmp = $_FILES['eventimage']['tmp_name'];
        $uploadFolder = "uploads/event/";
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0777, true); // create folder if not exists
        }
        $uploadPath = $uploadFolder . $imageName;
        move_uploaded_file($imageTmp, $uploadPath);
    } else {
        // Keep old image
        $imageName = $event['image'];
    }

    // Update event in database
    $query = "UPDATE events SET 
                title='$eventtitle',
                description='$eventdescription',
                event_date='$eventdate',
                event_time='$eventtime',
                location='$eventlocation',
                capacity='$eventcapacity',
                price='$eventprice',
                image='$imageName'
              WHERE event_id=$id";

    if (mysqli_query($con, $query)) {
        echo "<script>alert('Event Updated Successfully'); window.location='admin_dashboard.php';</script>";
        exit;
    } else {
        echo "Error updating data: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="../style/formstyle.css">
</head>
<body>

<?php include '../include/navbar.php'; ?>

<div class="container">
    <div class="add-event-box">
        <h2>Edit Event</h2>

        <form action="" method="POST" enctype="multipart/form-data" class="form-container">
            <input type="text" name="eventtitle" required 
                   value="<?php echo htmlspecialchars($event['title']); ?>">

            <label>Event Date</label>
            <input type="date" name="eventdate" required 
                   value="<?php echo $event['event_date']; ?>">

            <label>Event Time</label>
            <input type="time" name="eventtime" required 
                   value="<?php echo $event['event_time']; ?>">

            <input type="text" name="eventlocation" required 
                   value="<?php echo htmlspecialchars($event['location']); ?>">

            <input type="number" name="eventcapacity" required 
                   value="<?php echo $event['capacity']; ?>">

            <input type="number" name="eventprice" required 
                   value="<?php echo $event['price']; ?>">

            <label>Event Image</label>
            <input type="file" name="eventimage">

            <!-- Show current image -->
            <?php 
                $currentImage = "uploads/event/" . $event['image'];
                if (!empty($event['image']) && file_exists($currentImage)): ?>
                <img src="<?php echo $currentImage; ?>" alt="Event Image" style="width:100px; margin-top:10px;">
            <?php endif; ?>

            <label>Description</label>
            <textarea name="description" id="description"><?php echo htmlspecialchars($event['description']); ?></textarea>

            <button type="submit" name="submit" class="btn">Update Event</button>
        </form>
    </div>
</div>

</body>
</html>

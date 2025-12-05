


<?php
include 'db.php';

$id = $_GET['id'];

$query1 = "SELECT * FROM events WHERE id = $id";
$result = mysqli_query($conn, $query1);
$event = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){

    $eventtitle = $_POST['eventtitle'];
    $eventdate = $_POST['eventdate'];
    $eventtime = $_POST['eventtime'];
    $eventlocation = $_POST['eventlocation'];
    $eventcapacity = $_POST['eventcapacity'];
    $eventprice = $_POST['eventprice'];
    $eventdescription = $_POST['description'];

    // If new image selected
    if(!empty($_FILES['eventimage']['name'])) {
        $imageName = $_FILES['eventimage']['name'];
        $imageTmp = $_FILES['eventimage']['tmp_name'];
        $uploadPath = "image/" . $imageName;
        move_uploaded_file($imageTmp, $uploadPath);
    } else {
        // keep old image
        $uploadPath = $event['image'];
    }

    // UPDATE query (FIXED)
    $query = "UPDATE events SET 
                title='$eventtitle',
                description='$eventdescription',
                event_date='$eventdate',
                event_time='$eventtime',
                location='$eventlocation',
                capacity='$eventcapacity',
                price='$eventprice',
                image='$uploadPath'
              WHERE id=$id";

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Event Updated Successfully'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error updating data: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/formstyle.css">
    <title>Edit Event</title>
</head>
<body>

    <div class="login-container">
        <h2>Edit Event</h2>

        <form action="" method="POST" enctype="multipart/form-data">

            <input type="text" name="eventtitle" required 
                   value="<?php echo $event['title']; ?>">

            <label>Event Date</label>
            <input type="date" name="eventdate" required 
                   value="<?php echo $event['event_date']; ?>">

            <label>Event Time</label>
            <input type="time" name="eventtime" required 
                   value="<?php echo $event['event_time']; ?>">

            <input type="text" name="eventlocation" required 
                   value="<?php echo $event['location']; ?>">

            <input type="number" name="eventcapacity" required 
                   value="<?php echo $event['capacity']; ?>">

            <input type="number" name="eventprice" required 
                   value="<?php echo $event['price']; ?>">

            <label>Event Image</label>
            <input type="file" name="eventimage">

            <label>Description</label>
            <textarea name="description" id="description"><?php echo $event['description']; ?></textarea>

            <button type="submit" name="submit" class="btn">Update Event</button>
        </form>

    </div>

</body>
</html>

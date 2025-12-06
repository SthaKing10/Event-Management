<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/formstyle.css">
    <title>Add Event</title>
</head>
<body>
    <?php include 'navbar.php'?>
    <div class="container">
    <div class="add-event-box">
        <h2>Add Event</h2>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-container">
                <label for="eventtitle">Event <Title>:</Title></label>
                <input type="text" name="eventtitle" placeholder="Enter Event Title" id="eventtitle" required>

                <label for="eventdate">Event Date</label>
                <input type="date" name="eventdate" id="eventdate" required>

                <label for="eventtime">Event Time</label>
                <input type="time" name="eventtime" id="eventtime" required>

                <input type="text" name="eventlocation" placeholder="Enter Event Location" required>

                <input type="number" name="eventcapacity" placeholder="Enter Event Capacity" required>

                <input type="number" name="eventprice" placeholder="Enter Event Price" required>

                <label for="eventimage">Event Image</label>
                <input type="file" name="eventimage" id="eventimage" required>

                <label for="description">Description</label>
                <textarea name="description" id="description"></textarea>

                <button type="submit" name="submit" class="btn">Add Event</button>
            </div>
        </form>

    </div>
</div>
</body>
</html>



<?php
include 'connection.php';

if(isset($_POST['submit'])){

    $eventtitle = $_POST['eventtitle'];
    $eventdate = $_POST['eventdate'];
    $eventtime = $_POST['eventtime'];
    $eventlocation = $_POST['eventlocation'];
    $eventcapacity = $_POST['eventcapacity'];
    $eventprice = $_POST['eventprice'];
    $eventdescription = $_POST['description'];

    // IMAGE UPLOAD
    $imageName = time() . "_" . basename($_FILES['eventimage']['name']);
    $imageTmp = $_FILES['eventimage']['tmp_name'];

    // server path for uploading
    $uploadDir = __DIR__ . "/uploads/event/";
    $uploadPath = $uploadDir . $imageName;

    // relative path for database
    $imageDB =  $imageName;

    if(!move_uploaded_file($imageTmp, $uploadPath)){
        die("Image upload failed!");
    }

    // SQL INSERT (correct one)
    $query = "INSERT INTO events (title, description, event_date, event_time, location, capacity, price, image)
              VALUES ('$eventtitle', '$eventdescription', '$eventdate', '$eventtime', '$eventlocation', '$eventcapacity', '$eventprice', '$imageDB')";

    if(mysqli_query($con, $query)){
        echo "<script>alert('Event Added Successfully'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error inserting data: " . mysqli_error($con);
    }
}
?>

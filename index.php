<?php
session_start();
include 'include/connection.php';

// Fetch all events
$events_query = "SELECT * FROM events ORDER BY event_date ASC";
$events_result = mysqli_query($con, $events_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="Tost_Message/style.css">
    <script src="Tost_Message/script.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link rel="stylesheet" href="style/user_index_style.css">
    <script>
        
        function goToEvents() {
            document.getElementById('events').scrollIntoView({ behavior: 'smooth' });
        }
        // Confirm booking alert
        function confirmBooking() {
            return confirm('Are you sure you want to book this event?');
        }
    </script>
</head>
<body>

<div id="tostBox"></div>
<?php 
        if(!empty($_SESSION['tost'])){
            $tost = $_SESSION['tost']; ?>

            <script>
                showTost("<?= $tost['message'] ?>","<?= $tost['type'] ?>");
            </script>
        <?php
        unset($_SESSION['tost']);

        }


    ?>
    <!-- NAVBAR -->
    <?php include 'include/navbar.php'; ?>

    <!-- HERO SECTION -->
    <section class="hero" id="home">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Event Management System</h1>
            <p>Manage, organize and book events easily and efficiently.</p>
            <a href="javascript:void(0);" class="btn" onclick="goToEvents()">Get Started</a>
        </div>
    </section>

    <!-- EVENTS -->
    <section class="events" id="events">
        <h2>Upcoming Events</h2>
        <div class="event-container">
            <?php while($event = mysqli_fetch_assoc($events_result)): ?>
                <div class="event-box">
                    <img src="uploads/event/<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image">
                    <div class="event-content">
                        <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                        <p><strong>Date:</strong> <?php echo $event['event_date']; ?></p>
                        <p><strong>Time:</strong> <?php echo $event['event_time']; ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
                        <p><strong>Price:</strong> $<?php echo $event['price']; ?></p>
                        <a href="user/book_event.php?event_id=<?php echo $event['event_id']; ?>" class="buy-btn" onclick="return confirmBooking();">Book Now</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="features" id="features">
        <h2>Features</h2>
        <div class="feature-box-container">
            <div class="feature-box">
                <h3>Online Booking</h3>
                <p>Users can book events from anywhere at anytime.</p>
            </div>
            <div class="feature-box">
                <h3>User Dashboard</h3>
                <p>Separate dashboard for users and administrators.</p>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="about" id="about">
        <h2>About</h2>
        <p>
            The Event Management System is a web-based project developed for 
            Tribhuvan University 4th Semester. It demonstrates knowledge of HTML, CSS, PHP, 
            and MySQL by automating event creation, management, and user bookings.
        </p>
    </section>

    <!-- FOOTER -->
    <footer>
        © 2025 Sangyan and Susen
    </footer>

</body>
</html>

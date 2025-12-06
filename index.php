<?php
session_start();
include 'connection.php';

// Fetch all events
$events_query = "SELECT * FROM events ORDER BY event_date ASC";
$events_result = mysqli_query($con, $events_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #ffffff;
        }

        /* HERO SECTION */
        .hero {
            height: 85vh;
            background: url('uploads/event/Event1.jpg') center/cover no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }


        .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.55);
        }

        .hero-content {
            position: relative;
            text-align: center;
            color: white;
            max-width: 700px;
            padding: 20px;
        }

        .hero-content h1 {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .hero-content p {
            font-size: 18px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            margin-top: 20px;
            background: #3498db;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
        }

        .btn:hover {
            background: #1d6fa5;
        }

        /* EVENTS SECTION */
        .events {
            padding: 60px 20px;
            background: #f9f9f9;
            text-align: center;
        }

        .events h2 {
            font-size: 32px;
            margin-bottom: 40px;
        }

        .event-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
        }

        .event-box {
            background: white;
            width: 280px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .event-box:hover {
            transform: translateY(-6px);
        }

        .event-box img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .event-content {
            padding: 20px;
        }

        .event-content h3 {
            margin: 0 0 10px 0;
            font-size: 20px;
        }

        .event-content p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .event-content .buy-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background: #28a745;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        .event-content .buy-btn:hover {
            background: #1f7f35;
        }

        /* FEATURES SECTION */
        .features {
            padding: 60px 20px;
            text-align: center;
        }

        .features h2 {
            font-size: 32px;
            margin-bottom: 30px;
        }

        .feature-box-container {
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .feature-box {
            width: 280px;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .feature-box:hover {
            transform: translateY(-6px);
        }

        /* ABOUT SECTION */
        .about {
            background: #f2f2f2;
            padding: 60px 20px;
            text-align: center;
        }

        .about p {
            max-width: 800px;
            margin: auto;
            font-size: 17px;
        }

        /* FOOTER */
        footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 12px 0;
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 34px;
            }
            .navbar {
                flex-direction: column;
                text-align: center;
            }
            .navbar a {
                margin: 10px 0;
            }
            .event-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>

    <script>
        // Scroll to events section when Get Started clicked
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

    <!-- NAVBAR -->
    <?php include 'navbar.php'; ?>

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
                        <p><strong>Price:</strong> Rs.<?php echo $event['price']; ?></p>
                        <a href="book_event.php?event_id=<?php echo $event['event_id']; ?>" class="buy-btn" onclick="return confirmBooking();">Book Now</a>
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

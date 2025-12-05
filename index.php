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

        /* NAVIGATION BAR */
        .navbar {
            width: 100%;
            background: #222;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
        }

        .navbar .logo {
            color: white;
            font-size: 22px;
            font-weight: bold;
        }

        .navbar a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-size: 15px;
        }

        /* HERO SECTION */
        .hero {
            height: 85vh;
            background: url('https://images.unsplash.com/photo-1508609349937-5ec4ae374ebf?auto=format&fit=crop&w=1600&q=60') 
            center/cover no-repeat;
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

        /* RESPONSIVE */
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
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="logo">EventMS</div>
        <div>
            <a href="#home">Home</a>
            <a href="#features">Features</a>
            <a href="#about">About</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </div>

    <!-- HERO SECTION -->
    <section class="hero" id="home">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Event Management System</h1>
            <p>Manage, organize and book events easily and efficiently.</p>
            <a href="login.php" class="btn">Get Started</a>
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
        © 2025 Event Management System • Developed for TU BSc CSIT 4th Semester Project
    </footer>

</body>
</html>

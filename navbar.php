<?php
include 'connection.php';
$base_url = "/Event-Management/";
$user_id = $_SESSION['user_id'] ?? null;
$role = "";

if ($user_id) {
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE user_id='$user_id'"));
    $role = $user['role'];
}
?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<nav class="navbar">
    <div class="nav-left">
        <a  href="<?php echo ($role === 'admin') ? $base_url.'admin_dashboard.php' : (($role === 'user') ? $base_url.'index.php' : '#'); ?>">Home</a>

        <?php if ($role=='admin'): ?>
            <a href="<?php echo $base_url.'event_add.php' ?>">Add Event</a>
            <a href="<?php echo $base_url.'admin_view_booking.php' ?>">View Booking</a>
            <a href="<?php echo $base_url.'view_event.php' ?>">View Event</a>
        <?php endif; ?>

        <?php if ($role=='user'): ?>
            <a href="<?php echo $base_url.'user_booking.php' ?>">My Booking</a>
        <?php endif; ?>

        
    </div>

    <div class="nav-right">
        <?php if ($user_id): ?>
            <a href="<?php echo $base_url; ?>view_profile.php">Profile</a>
            <a class="logout-btn" href="<?php echo $base_url; ?>logout.php">Logout</a>
        <?php else: ?>
            <a href="<?php echo $base_url; ?>login.php">Login</a>
            <a class="register-btn" href="<?php echo $base_url; ?>register.php">Register</a>
        <?php endif; ?>
    </div>
</nav>

<style>
* {
    font-family: "Poppins", sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* NAVBAR */
.navbar {
    position: fixed;       /* sticky at top */
    top: 0;
    left: 0;
    width: 100%;
    background: black;
    color: white;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 999;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.nav-left, .nav-right {
    display: flex;
    align-items: center;
    gap: 25px;
}

.nav-left a, .nav-right a {
    color: white;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    transition: opacity 0.2s;
}



.nav-left a:hover, .nav-right a:hover {
    opacity: 0.8;
    text-decoration: underline;
}


</style>

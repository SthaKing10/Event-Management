<?php
if (session_status() == PHP_SESSION_NONE) session_start();
include '../include/connection.php';
include '../include/functions.php';
include '../include/navbar.php';

if (!isset($_SESSION['user_id'])) {
    die("You must <a href='login.php'>login</a> to view profile.");
}

$user_id = $_SESSION['user_id'];

// Fetch current user data
$result = mysqli_query($con, "SELECT * FROM user WHERE user_id='$user_id'");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="../style/formstyle.css">
</head>
<body>
    
</body>
</html>
<div class="wrapper">
    <div class="content">
        <h2>My Profile</h2>

        <div class="profile-card">
            <?php
            // Display current user image
            $img_path = "../uploads/user/" . $row['user_image'];
            if (!empty($row['user_image']) && file_exists($img_path)) {
                echo "<img src='" . str_replace('\\','/',$img_path) . "' class='profile-img'>";
            } else {
                echo "<img src='../uploads/user/default.png' class='profile-img'>";
            }
            ?>

            <p><b>Name:</b> <?php echo htmlspecialchars($row['user_name']); ?></p>
            <p><b>Email:</b> <?php echo htmlspecialchars($row['email']); ?></p>

           <a href="edit_profile.php" class="edit-btn"> <button>Edit Profile</button></a><br><br>
           <a href="check_password.php" class="Check_Password.php"> <button>Change Password</button></a>
        </div>
    </div>
</div>

    


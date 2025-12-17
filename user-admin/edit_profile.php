<?php
if (session_status() == PHP_SESSION_NONE) session_start();
include '../include/connection.php';
include '../include/functions.php';
include '../include/navbar.php';

if (!isset($_SESSION['user_id'])) {
    die("You must <a href='login.php'>login</a> to view profile.");
}

$user_id = $_SESSION['user_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = sanitize($con, $_POST['name']);
    $email = sanitize($con, $_POST['email']);

    // Handle image upload
    $image_sql = "";
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == 0) {
        $target_file = "../uploads/user/" . $_FILES['user_image']['name'];
        move_uploaded_file($_FILES['user_image']['tmp_name'], $target_file);
        $image_sql = ", user_image='" . $_FILES['user_image']['name'] . "'";
    }
   
        $update_query = "UPDATE user SET user_name='$name', email='$email' $image_sql WHERE user_id='$user_id'";

    if(mysqli_query($con, $update_query)){
        header('location:view_profile.php');
    }
}

// Fetch current user data
$result = mysqli_query($con, "SELECT * FROM user WHERE user_id='$user_id'");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/formstyle.css">
    <title>Edit Profile</title>
</head>
<body>
    

<div class="wrapper">
    <div class="content">
        <h2>View / Edit Profile</h2>

        <div class="profile-card">
            <?php
            $img_path = "../uploads/user/" . $row['user_image'];
            if (!empty($row['user_image']) && file_exists($img_path)) {
                echo "<img src='" . str_replace('\\','/',$img_path) . "' class='profile-img'>";
            } else {
                echo "<img src='uploads/user/default.png' class='profile-img'>";
            }
            ?>

            <form method="POST" action="" enctype="multipart/form-data" class="profile-form">
                <div class="form-row">
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($row['user_name']); ?>" required>
                </div>

                <div class="form-row">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                </div>

                <div class="form-row">
                    <label>Upload Image:</label>
                    <input type="file" name="user_image" accept="image/*">
                </div>

                <div class="form-row submit-row">
                    <button type="submit">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>



</body>
</html>

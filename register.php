<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/formstyle.css">

    <title>Register | Event Management System</title>

    

</head>
<body>

    <div class="register-container">
        <h2>Create Account</h2>

        <form action="register_process.php" method="POST">
            <input type="text" name="fullname" placeholder="Full Name" required>

            <input type="email" name="email" placeholder="Email Address" required>

            <input type="text" name="phone" placeholder="Phone Number" required>

            <input type="password" name="password" placeholder="Password" required>

            <input type="password" name="confirm_password" placeholder="Confirm Password" required>

            <button type="submit" class="btn">Register</button>
        </form>

        <div class="links">
            <p>Already have an account? <a href="login.php">Login</a></p>
            <p><a href="index.html">← Back to Home</a></p>
        </div>
    </div>

</body>
</html>

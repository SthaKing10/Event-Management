<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/formstyle.css">

    <title>Login | Event Management System</title>

    

</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>

        <form action="login_process.php" method="POST">
            <div class="login-form">
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>

            <button type="submit" class="btn">Login</button>
            </div>
        </form>

        <div class="links">
            <p>Don't have an account? <a href="register.php">Register</a></p>
            <p><a href="index.php">← Back to Home</a></p>
        </div>
    </div>
    </div>

</body>
</html>

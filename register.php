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
        <div class="register-box">
            <h2>Create Account</h2>

        <form action="register_process.php" method="POST">
            <div class="register-form">
                <div>
                    <label for="name">Full Name</label>
                    <input type="text" name="fullname" placeholder="Full Name" required id="name">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email Address" required id="email">
                </div>

                <div>
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" placeholder="Phone Number" required id="phone">
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required id="password">
                </div>

                <div>
                    <label for="conform">Conform Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required id="conform">
                </div>

            <button type="submit" class="btn" name="submit">Register</button>
            </div>
        </form>

        <div class="links">
            <p>Already have an account? <a href="login.php">Login</a></p>
            <p><a href="index.php">← Back to Home</a></p>
        </div>
    </div>
    </div>

</body>
</html>

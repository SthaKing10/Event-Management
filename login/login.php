
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../Tost_Message/style.css">
    <script src="../Tost_Message/script.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/formstyle.css">
        
    <title>Login | Event Management System</title>
    

    

</head>
<body>

        <div id="tostBox"></div>

    <?php 
        session_start();
        if(!empty($_SESSION['tost'])){
            $tost = $_SESSION['tost']; ?>

            <script>
                showTost("<?= $tost['message'] ?>","<?= $tost['type'] ?>");
            </script>
        <?php
        unset($_SESSION['tost']);

        }


    ?>


    <div class="container">
        <form action="login_process.php" method="POST">
            <div class="form-box">
                <h2>Login</h2>
                <input type="email" name="email" placeholder="Enter Email" value="<?= $_SESSION['email'] ?? '' ?>" required>

                <div class="password-icon">
                    <input type="password" name="password" placeholder="Enter Password" required class="password_input" value="<?= $_SESSION['password'] ?? '' ?>">
                    <img src="../uploads/login_icon/hide.png" alt="hide png" class="hide_icon">
                </div>

                <button type="submit" class="btn">Login</button>
                <div class="links">
                    <p>Don't have an account? <a href="register.php">Register</a></p>
                    <p><a href="../index.php">← Back to Home</a></p>
                </div>
                <div>
                    <a href="forget_password.php">Forget Password ?</a>
                </div>
            </div>
        </form>

    </div>

</body>
</html>

<script src="../script/form_icon.js"></script>




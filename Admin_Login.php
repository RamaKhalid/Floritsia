<!-- BY Jumana -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">  
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>
    <?php
        session_start();
        if (isset($_SESSION['AdminName']))
        {
        $_SESSION = array(); 
        session_destroy();
        }
    ?>

    <div class="login_split login_left">
        <div class="login_centered">
            <img style="height: 700px;" src="images\Desing imgs\login img.png">
        </div>
    </div>

    <div class="login_split login_right">
        <p class="login_welcome">
            <img class="login_BlackLogo" src= "images/Desing imgs/Black logo.png"> <br>
            Welcome to Floristia ! 
        </p>
        <form method="post" action="Admin_Login_Check.php" class="loginForm">
            <?php
                if (isset ($_GET['access']) and ($_GET['access']=='Unauthenticated'))
                    echo "<label style='color:red;'> ERROR: Unauthenticated access to the system. Please Login </label>";

                else if (isset ($_GET['problem']) and ($_GET['problem']=='ErrorLogin'))
                    echo "<label style='color:red;'> ERROR: Please check your email and/or password </label>";
            ?>
            <p class="login_label"> Email </p>
            <input required class="login_input" type="Email" name="Email"  placeholder="Enter your email" style="margin-bottom: 5%;">
            <p>
                <p class="login_label"> Password </p>
                <input required class="login_input" type="Password" name="Password" placeholder="Enter your password">
				
                <div class="custom-container">
							<p class="browser_class">
							<a class="browser_link" href="homepage.php">Want to browse?</a>
						  </p>
				
				
						  <p class="login_forgot">
							<a class="forgot_link" href="Admin_ForgotPass.php">Forgot Password?</a>
						  </p>
						 
				</div>
				
                <button class="AdminButton" type="submit" style="margin-left: 40%;"> Login </button> 
            <p>
        </form>
    </div>
</body>
</html
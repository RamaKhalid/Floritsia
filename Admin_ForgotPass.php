<!-- BY Jumana -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">  
</head>

<body>

    <div class="login_split login_left">
        <div class="login_centered">
            <img style="height: 700px;" src="images\Desing imgs\signup img.png">
        </div>
    </div>

    <div class="login_split login_right">
        <p class="login_welcome">
            <img class="login_BlackLogo" src= "images/Desing imgs/Black logo.png"> <br>
            Reset Your Password
        </p>
        <form method="post" action="Admin_ForgotPass_Reset.php" class="loginForm">
   
            <p class="login_label"> Email </p>
            <input required class="login_input" type="email" name="Email"  placeholder="Enter your email" style="margin-bottom: 5%;">

            <p class="login_label"> New Password </p>
            <input required class="login_input" type="password" name="NewPass"  placeholder="Enter new password" style="margin-bottom: 5%;">
            <p>
                <p class="login_label"> Confirm New Password </p>
                <input required class="login_input" type="password" name="ConfirmNewPass" placeholder="Confirm new password">
                <p class="login_forgot"> Go to <a class='forgot_link' href='Admin_Login.php'> Login </a></p>
                <button class="AdminButton" type="submit" style="margin-left: 40%;"> Reset </button>
            <p><br>
            <?php 
                if (isset ($_GET['problem']) and ($_GET['problem']=='NotMatchPasswords'))
                    echo "<label style='color:red; margin-left: 22%; font-size:1.25vw;'> ERROR: Not Match Passwords </label>";
                
                else if (isset ($_GET['UpdatePassword']) and ($_GET['UpdatePassword']=='Successful'))
                    echo "<label style='color:green; margin-left: 10%; font-size:1.25vw;'> Your Password has been updated successfully </label>";
            ?>
        </form>  
    </div>  
</body>
</html
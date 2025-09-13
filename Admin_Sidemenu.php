<!-- BY Jumana -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<aside class="admin_sideMenu">
            <section class="admin_profile">
                <img src="images/Desing imgs/user-image.jpg" alt="User" class="admin_logo">
                <h2 class="admin_name">
                    <?php
                        if (isset( $_SESSION['AdminName'])){
                            echo '<label class="lang"> <span class="UserName"> ';
                            if(empty($_POST['admin_name'])){echo $_SESSION['AdminName'];} else{$_SESSION['AdminName']=$_POST['admin_name']; echo $_SESSION['AdminName'];}
                            echo ' </span></label>';   
                        }
                    ?>
                </h2>
            </section>

            <nav>
                <ul style="height: fit-content;">
                    <li style="margin-top: 10px;"><a href="Admin_Account.php">My Account</a></li>
                    <li style="margin-bottom: 80%;"><a href="Admin_Manage_Items.php">Manage Items</a></li>
                    <li style="border: none;"><a href="Admin_Login.php">Logout</a></li>
                    
                </ul>
            </nav>
        </aside> 
</body>
</html>
<!-- BY Shahad -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />  <!-- Link for fonts styling -->
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Link to our website stylesheet-->
</head>

<body>
    <?php   require_once 'Admin_Header.php';
            require_once 'Admin_sideMenu.php';
            require_once 'Database_Connection.php';
            
                if (!isset( $_SESSION['AdminName'])){
                    header('location: Admin_Login.php?access=Unauthenticated');
                    exit;
                }
                else if(isset( $_SESSION['AdminName'])){
    ?>

    <!-- add your modified secrion here -->
    <section>
        <!-- Side Menu Design image -->
        <img src="images/Desing imgs/design 1.png" alt="design" id="admin_design_1">
        
        <!-- Admin Edit Information Section -->
        <div class="admin_account_section">
            <img src="images/Desing imgs/user-image.jpg" alt="User" class="admin_logo">
            <br><br>
            <form action="Admin_Account.php" method="post">
                <div style="width: 60%; height:max-content; margin-left:20%;">
                    <p class="admin_label"> Name 
                        <input required type="text" name="admin_name" value="<?php if(empty($_POST['admin_name'])){echo $_SESSION['AdminName'];} else{$_SESSION['AdminName']=$_POST['admin_name']; echo $_SESSION['AdminName'];}?>" class="admin_input">
                    </p>
                    <p class="admin_label"> Email
                        <input class="admin_input" type="email" name="admin_email" disabled value="<?php if (isset($_SESSION['AdminName'])) { echo $_SESSION['AdminEmail'];} ?>" > 
                        <p class="login_forgot"> <a class="forgot_link" href="Admin_ForgotPass.php"> Reset Password </a> </p>
                    </p>
                </div>
                <br><br>
                <input class="AdminButton" type="submit" value="Save" class="admin_page_button" id="save"> 
                <input class="AdminButton" type="reset" value="Cancel" class="admin_page_button">

            </form>
        </div>
        <img src="images/Desing imgs/design 2.png" alt="design image" id="admin_design_21">
    </section>
 
    <!-- BY Jumana -->
    <?php
        }
         #Include the footer file
         require_once 'footer.php';

        if (isset($_POST['admin_name']) ){
            if (!($con)){
                header('location: Admin_Account.php?problem=CannotConnectToServer');
                exit ("couldn't connect to the server");
            }

            if (!mysqli_select_db ($con,"floritsia")){
                header('location: Admin_Account.php?problem=CannotConnectToDB');
                exit ("couldn't open the database");
            }

            if ((mysqli_num_rows($result) > 0)){
                $row = mysqli_fetch_row($result);
                $sql = "UPDATE admin SET admin_name ='" . $_POST['admin_name'] . "' WHERE admin_email = '" . $_SESSION['AdminEmail'] . "'";

                if ($con->query($sql) === TRUE) {
                    $_SESSION['AdminName'] = $_POST['admin_name'];
                    header('location: Admin_Account.php?UpdateData=Successful');

                } else {
                    echo "Error updating record: " . $con->error;
                }
                exit;
            }
            else{
                header('location: Admin_Account.php');
                exit;
            }
            mysqli_close($con);
        }
    ?>
</body>
</html>

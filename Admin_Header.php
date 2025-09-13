<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8730e08515.js" crossorigin="anonymous"></script>
    <title>Admin Header</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="container">
            <div class="logo">
                <img src="images\Desing imgs\black logo.png" alt="black logo">
            </div>
            <div class="user">
                <p style="text-align:right; margin-right:20px;">
                    <?php
                        session_start();
                        if (isset( $_SESSION['AdminName'])){
                            echo '<label class="lang"> <span class="UserName"> ';
                            if(empty($_POST['admin_name'])){echo $_SESSION['AdminName'];} else{$_SESSION['AdminName']=$_POST['admin_name']; echo $_SESSION['AdminName'];}
                            echo ' </span></label>';
                        }
                    ?>
                </p>
                <div>
                    <div><a href="Admin_Account.php"><i class="fa-solid fa-user"></i></a></div>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>

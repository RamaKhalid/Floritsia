<!-- BY Jumana -->
<?php
    require_once 'Database_Connection.php';
    if (isset($_POST['Email']) && isset($_POST['Password'])){
        $email = $_POST['Email'];
        $Query = "SELECT admin_name FROM admin WHERE admin_email='" . $_POST['Email']."' and admin_password='".$_POST['Password'] ."'";
        if (!($con)){
            header('location: Admin_Login.php?problem=CannotConnectToServer');
            exit ("couldn't connect to the server");
        }

        if (!mysqli_select_db ($con,"floritsia")){
            header('location: Admin_Login.php?problem=CannotConnectToDB');
            exit ("couldn't open the database");
        }

        if (! ($result = mysqli_query ($con,$Query))){
            header('location: Admin_Login.php?problem=Querycouldntbeexecuted');
            exit(mysqli_error($con));
        }

        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_row($result);
            session_start();
            $_SESSION['AdminName'] = $row[0];
            $_SESSION['AdminEmail'] = $email;
            header('location: Admin_Account.php');
            exit;
        }
        else{
            header('location: Admin_Login.php?problem=ErrorLogin');
            exit;
        }

    }
?>
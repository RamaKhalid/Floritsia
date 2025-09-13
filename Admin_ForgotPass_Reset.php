<!-- BY Jumana -->
<?php
    require_once 'Database_Connection.php';
    if (isset($_POST['NewPass']) && isset($_POST['ConfirmNewPass']) ){
        if (!($con)){
            header('location: Admin_ForgotPass.php?problem=CannotConnectToServer');
            exit ("couldn't connect to the server");
        }

        if (!mysqli_select_db ($con,"floritsia")){
            header('location: Admin_ForgotPass.php?problem=CannotConnectToDB');
            exit ("couldn't open the database");
        }

        if ((mysqli_num_rows($result) > 0) && ($_POST['NewPass'] == $_POST['ConfirmNewPass'])){
            $row = mysqli_fetch_row($result);
            $sql = "UPDATE admin SET admin_password = '" . $_POST['NewPass']. "' WHERE admin_email='" . $_POST['Email'] . "'";
            if ($con->query($sql) === TRUE) {
                header('location: Admin_ForgotPass.php?UpdatePassword=Successful');

              } else {
                echo "Error updating record: " . $con->error;
              }
            exit;
        }
        else{
            header('location: Admin_ForgotPass.php?problem=NotMatchPasswords');
            exit;
        }
        mysqli_close($con);
    }
?>
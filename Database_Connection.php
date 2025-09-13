<?php
//suits my  port # 3307
    $servername = "localhost"; 
    $dbUsername = "root";
    $password = "";
    $dbname = "floritsia";

    $con = new mysqli($servername, $dbUsername, $password, $dbname);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $bdo = new PDO('mysql:host='.$servername.'; dbname='.$dbname, $dbUsername, $password);

    $ItemsQuery = "SELECT * FROM items";

    if (!($con))
        exit ("couldn't connect to the server</body></html>");

    if (!mysqli_select_db ($con,$dbname))
        exit ("couldn't open the database</body></html>");

    if (!($result = mysqli_query($con, $ItemsQuery))) {
        print ("<p> Query couldn't be executed </p>");
        exit (mysqli_error($con)."</body></html>");
    }

?>
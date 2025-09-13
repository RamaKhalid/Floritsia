<!-- BY Jumana -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Items</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    <!-- Delete confirmation using JS -->
    <script>
        function confirmDelete(){
            return confirm('The item will be deleted from the system permanently. If you are sure to delete this item press OK, otherwise press CANCEL');
        }
    </script>
</head>

<body>
    <?php   require_once 'Admin_Header.php';
            require_once 'Admin_sideMenu.php';
            require_once 'Database_Connection.php';

            if (!isset( $_SESSION['AdminName'])){
                header('location: admin_login.php?access=Unauthenticated');
                exit;
            }
            else if(isset( $_SESSION['AdminName'])){                
    ?> 
    
    <section> 
        <button class="AdminButton" style="float: right; margin-right: 5%; margin-bottom:1%;" onclick="document.location= 'Add_Plant.php' " > + Plant </button>
        <button class="AdminButton" style="float: right; margin-bottom:1%;" onclick="document.location= 'Add_Product.php' "> + Product </button>      
        <div class="ju-manage">

            <!-- search -->
            <form method="post" action="Admin_Manage_Items.php">
                <a style="margin-left: 20%; padding-top: 0.5%; text-decoration: none;" href="Admin_Manage_Items.php"><i class="AdminButton" style="font-size: 1.25em; font-weight: 800;"> < </i></a> 
                <input required type="text" placeholder="Enter the name of the item" name="search" id="ItemSearch" value="<?php if (isset($_POST["search"])) {echo $_POST["search"];} ?>"> 
                <button class="AdminButton" type="submit"> Search </button>                    
            </form>
      
            <?php
                if (isset($_POST["search"])) {
                    // SEARCH FOR ITEM
                    require "Admin_Search_Item.php";
                    echo"<h2 style='margin-left: 43%;'>Search Results</h2>";
                    printf("<div class='ju-col' id='itemresults'>");


                    // DISPLAY RESULTS
                    if (count($itemresults) > 0) { 
                        foreach ($itemresults as $item) {
                            printf("<div class='ju-item'>
                                    <img class='ju-itemImg' src='data:images/;base64,%s'/>
                                    <span class='ju-itemName'> %s <br>
                                    <span class='ju-itemPrice'> %s.00 SR <br> </span>
                                    <span class='ju-itemQuantity'>Quantity available: %s
                                    ", base64_encode($item["item_img"]), $item["item_name"], $item["item_price"], $item["item_quantity"]);
                            
                            if($item["item_category_id"] == 1 || $item["item_category_id"] == 2){
                                echo '
                                <a style="text-decoration: none;" href="Admin_Delete_Item.php?id=' . $item["item_id"] . '" onclick="return confirmDelete()">
                                <img src="images/Desing imgs/delete.png" style="margin-left: 150px; height: 25px; position: relative;">
                                </a>
                                <a style="text-decoration: none;" href="Update_Plant.php?item_id=' . $item["item_id"] . '">
                                    <img src="images/Desing imgs/edit.png" style="margin-left: 5px; height: 25px; position: relative;">
                                </a>
                            </span></span></div>';
                            } else if($item["item_category_id"] == 3 || $item["item_category_id"] == 4 || $item["item_category_id"] == 5 || $item["item_category_id"] == 6){
                            echo '
                                <a style="text-decoration: none;" href="Admin_Delete_Item.php?id=' . $item["item_id"] . '" onclick="return confirmDelete()">
                                <img src="images/Desing imgs/delete.png" style="margin-left: 150px; height: 25px; position: relative;">
                                </a>
                                <a style="text-decoration: none;" href="Update_Product.php?item_id=' . $item["item_id"] . '">
                                <img src="images/Desing imgs/edit.png" style="margin-left: 5px; height: 25px; position: relative;">
                                </a>
                            </span></span></div>';
                            }
                        }
                    } 
                    else { echo "No item or items found"; }
                }
                else{
                    echo"<h2 style='margin-left: 45%;'>All Items</h2>";
                    printf("<div class='ju-col' id='itemresults'>");

                    $ItemsQuery = "SELECT * FROM items";
    
                    foreach ($bdo->query($ItemsQuery) as $item){
                        echo '
                            <div class="ju-item">
                                <img class="ju-itemImg" src="data:images/;base64,' . base64_encode($item["item_img"]) . '"/>
                                <span class="ju-itemName">' . $item["item_name"] . '<br>
                                <span class="ju-itemPrice">' . $item["item_price"] . '.00 SR<br></span>
                                <span class="ju-itemQuantity">Quantity available: ' . $item["item_quantity"];
    
                        if ($item["item_category_id"] == 1 || $item["item_category_id"] == 2) {
                            echo '
                                <a style="text-decoration: none;" href="Admin_Delete_Item.php?id=' . $item["item_id"] . '" onclick="return confirmDelete()">
                                <img src="images/Desing imgs/delete.png" style="margin-left: 150px; height: 25px; position: relative;">
                                </a>
                                <a style="text-decoration: none;" href="Update_Plant.php?item_id=' . $item["item_id"] . '">
                                    <img src="images/Desing imgs/edit.png" style="margin-left: 5px; height: 25px; position: relative;">
                                </a>
                            </span></span></div>';
                        } else if($item["item_category_id"] == 3 || $item["item_category_id"] == 4 || $item["item_category_id"] == 5 || $item["item_category_id"] == 6){
                            echo '
                                <a style="text-decoration: none;" href="Admin_Delete_Item.php?id=' . $item["item_id"] . '" onclick="return confirmDelete()">
                                <img src="images/Desing imgs/delete.png" style="margin-left: 150px; height: 25px; position: relative;">
                                </a>
                                <a style="text-decoration: none;" href="Update_Product.php?item_id=' . $item["item_id"] . '">
                                <img src="images/Desing imgs/edit.png" style="margin-left: 5px; height: 25px; position: relative;">
                                </a>
                            </span></span></div>';
                        }
                    }
                }
            ?>
        </div>
    </section>


    <?php
        }
        // Include the footer file
        require_once 'footer.php';

    // Handle form submission and update data in the database
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        $itemId = $_POST['item_id'];
        $itemName = $_POST['item_name'];
        $itemQuantity = $_POST['item_quantity'];
        $itemPrice = $_POST['item_price'];
        $itemCategoryId = $_POST['item_category_id'];
        $plantPotSize = $_POST['plant_potSize'];
        $itemDescription = $_POST['item_description'];
        $watering = $_POST['watering'];
        $light = $_POST['light'];
        $fertilizing = $_POST['fertilizing'];
        $tempHumidity = $_POST['temp_humidity'];

        // Check if an image file was uploaded
        if ( $_FILES['item_img']['error'] == UPLOAD_ERR_OK) {
            // Read the image file as binary data
            $itemImgData = file_get_contents($_FILES['item_img']['tmp_name']);

        } else {
            // Handle the error case
            $itemImgData = $base64Img;
            echo "Error: Failed to upload the image. Please try again.";
            exit();
        }

        if ($itemCategoryId == 1 || $itemCategoryId == 2) {
            // Prepare and execute the SQL statement
            $stmtUpdateItems = $con->prepare("UPDATE items SET item_name=?, item_quantity=?, item_img=?, item_price=?, item_category_id=?, plant_potSize=?, item_description=? WHERE item_id=?");
            $stmtUpdateItems->bind_param("sibdsisi", $itemName, $itemQuantity, $itemImgData, $itemPrice, $itemCategoryId, $plantPotSize, $itemDescription, $itemId);
            $stmtUpdateItems->send_long_data(2, $itemImgData); // BLOB data needs to be sent separately
            $stmtUpdateItems->execute();
            $stmtUpdateItems->close();

            // Update the plant care data in the "plant_care" table
            // Update the plant care data in the "plant_care" table
            $sqlUpdatePlantCare = "UPDATE plant_care SET Watring = ?, Light = ?, Fertilizing = ?, Temp_Humidity = ? WHERE plant_ID = ?";
            $stmtUpdatePlantCare = $con->prepare($sqlUpdatePlantCare);
            $stmtUpdatePlantCare->bind_param("ssssi", $watering, $light, $fertilizing, $tempHumidity, $itemId);
            $stmtUpdatePlantCare->execute();
            $stmtUpdatePlantCare->close();

        } else if ($itemCategoryId == 3 || $itemCategoryId == 4 || $itemCategoryId == 5 || $itemCategoryId == 6) {
            // Prepare and execute the SQL statement
            $stmtUpdateItems = $con->prepare("UPDATE items SET item_name=?, item_quantity=?, item_img=?, item_price=?, item_category_id=?, plant_potSize=?, item_description=? WHERE item_id=?");
            $stmtUpdateItems->bind_param("sibdsisi", $itemName, $itemQuantity, $itemImgData, $itemPrice, $itemCategoryId, $plantPotSize, $itemDescription, $itemId);
            $stmtUpdateItems->send_long_data(2, $itemImgData); // BLOB data needs to be sent separately
            $stmtUpdateItems->execute();   
            $stmtUpdateItems->close();
        }

        // Close the prepared statements
        $stmtUpdateItems->close();
        $stmtUpdatePlantCare->close();
        exit();
    }

    mysqli_close($con);
    ?>
</body>
</html>
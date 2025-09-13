<!-- #Ruba's interface -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Plant</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php   require_once 'Admin_Header.php';
            require_once 'Database_Connection.php';

            if (!isset( $_SESSION['AdminName'])){
                header('location: admin_login.php?access=Unauthenticated');
                exit;
            }
            else if(isset( $_SESSION['AdminName'])){                
    ?> 
    
    <section>
        <div class="container">
            <div class="title">Edit Plant</div>
            <form class="form-ruba" action="Admin_Manage_Items.php" method="post"  enctype="multipart/form-data" >
            
            <!-- this part will be updated to take data from the database -->
                <?php
                    $itemId = $_GET['item_id']; // Retrieve the item_id from the URL parameter

                    // Fetch data from the "items" table
                    $sqlItems = "SELECT * FROM items WHERE item_id = $itemId";
                    $resultItems = $con->query($sqlItems);

                    if ($resultItems->num_rows > 0) {
                        $rowItems = $resultItems->fetch_assoc();

                        // Store the item data in variables
                        $itemName = $rowItems['item_name'];
                        $itemCategoryId = $rowItems['item_category_id'];
                        $itemImg = $rowItems['item_img'];
                        $itemDescription = $rowItems['item_description'];
                        $itemPrice = $rowItems['item_price'];
                        $itemQuantity = $rowItems['item_quantity'];
                        $plantPotSize = $rowItems['plant_potSize'];
                    
                    }
                    else {
                        echo "No item found with the provided item_id.";
                        exit();
                    }

                    // Fetch data from the "plant_care" table
                    $sqlPlantCare = "SELECT * FROM plant_care WHERE plant_ID = $itemId";
                    $resultPlantCare = $con->query($sqlPlantCare);

                    if ($resultPlantCare->num_rows > 0) {
                        $rowPlantCare = $resultPlantCare->fetch_assoc();

                        // Store the plant care data in variables
                        $watering = $rowPlantCare['Watring'];
                        $light = $rowPlantCare['Light'];
                        $fertilizing = $rowPlantCare['Fertilizing'];
                        $tempHumidity = $rowPlantCare['Temp_Humidity'];
                    } else {
                        echo "No plant care details found for the item.";
                    }
                ?>

                <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
                <div class="fields">
                <!-- Fields from the "items" table -->
                    <div class="image">
                        <div>
                            <?php
                                // Check if the item image exists
                                if (!empty($itemImg)) {
                                    $base64Img = base64_encode($itemImg);
                                    echo '<img src="data:images/;base64,' . $base64Img . '" alt="Item Image" id="previewImg">';
                                } else {
                                    echo '<img src="#" alt="Preview Image" id="previewImg" style="display: none;">';
                                }
                            ?>
                            <input  type="file" name="item_img" id="imageInput" accept="image/*" onchange="previewImage(event);">
                        </div>
                    </div>

                    <script>
                        function previewImage(event) {
                            var input = event.target;
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('previewImg').src = e.target.result;
                                    document.getElementById('previewImg').style.display = 'block';
                                };
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>

                    <div class="name">
                        <div><label for="">Name</label></div>
                        <div><input type="text" name="item_name" value="<?php echo $itemName; ?>" required></div>
                    </div>

                    <div class="quantity">
                        <div><label for="">Quantity</label></div>
                        <div><input type="number" name="item_quantity" value="<?php echo $itemQuantity; ?>" min="1" step="1" required></div>
                    </div>

                    <div class="price">
                        <div><label for="">Price</label></div>
                        <div><input type="number" name="item_price" value="<?php echo $itemPrice; ?>" min="0.1" step="0.1" required></div>
                    </div>

                    <div class="category">
                        <div><label for="">Category</label></div>
                        <div>
                        <select name="item_category_id" required>
                                <option value=""></option>

                                <option value="1" <?php if ($itemCategoryId === '1') echo 'selected'; ?>>Indoor</option> 
                                <option value="2" <?php if ($itemCategoryId === '2') echo 'selected'; ?>>Outdoor</option>
                                <option value="3" <?php if ($itemCategoryId === '3') echo 'selected'; ?>>Soil & Fertilizer</option>
                                <option value="4" <?php if ($itemCategoryId === '4') echo 'selected'; ?>>Planters</option>
                                <option value="5" <?php if ($itemCategoryId === '5') echo 'selected'; ?>>Plant Tools</option>
                                <option value="6" <?php if ($itemCategoryId === '6') echo 'selected'; ?>>Gifts</option>
                            </select>
                        </div>
                    </div>

                    <div class="potsize">
                        <div><label for="">Pot Size</label></div>
                        <div><input type="number" name="plant_potSize" value="<?php echo $plantPotSize; ?>" min="0.1" step="0.1" required></div>
                    </div>

                    <div class="description two">
                        <div><label for="">Description</label></div>
                        <div><textarea name="item_description" required><?php echo $itemDescription; ?></textarea></div>
                    </div>

                    <!-- Fields from the "plant_care" table -->
                    <div class="watering one">
                        <div><label for="">Watering</label></div>
                        <div><textarea name="watering" required><?php echo $watering; ?></textarea></div>
                    </div>

                    <div class="light one">
                        <div><label for="">Light</label></div>
                        <div><textarea name="light" required><?php echo $light; ?></textarea></div>
                    </div>

                    <div class="fertilizing one">
                        <div><label for="">Fertilizing</label></div>
                        <div><textarea name="fertilizing" required><?php echo $fertilizing; ?></textarea></div>
                    </div>

                    <div class="temperature one">
                        <div><label for="">Temperature and Humidity</label></div>
                        <div><textarea name="temp_humidity" required><?php echo $tempHumidity; ?></textarea></div>
                    </div>
                </div>

                <div class="buttons">
                    <button type="reset" onclick="document.location='Admin_Manage_Items.php';">Cancel</button>
                    <button type="submit" onclick="document.location='Admin_Manage_Items.php';" >Save</button>
                </div>
            </form>
        </div>
    </section>
    <?php
        }
        #Include the footer file
        require_once 'footer.php';
    ?>
</body>
</html>

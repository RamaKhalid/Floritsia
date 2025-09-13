 <!--Done by: Ramlah Al Matter -->
    <!--This page is for the admin to edit the product's details in our shopping website Floristia. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title> <!--title tab of the page-->
    <link rel="stylesheet" href="style.css">
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
            <div class="title">Edit Product</div> 
            <form class="form-ruba" action="admin_manage_items.php"  method="post" enctype="multipart/form-data">
			
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
                ?>

                <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
                <div class="fields"> <!-- same fields to add the product's details BUT with added information as sample-->
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
                        <div><label for="product_name">Name</label></div>
                        <div><input type="text" name="item_name" value="<?php echo $itemName; ?>" required></div>
                    </div>
                        
                    <div class="quantity">
                        <div><label for="product_quantity">Quantity</label></div>
                        <div><input type="number" name="item_quantity" value="<?php echo $itemQuantity; ?>" min="1" step="1" required></div>
                    </div>

                    <div class="price">
                        <div><label for="product_price">Price (in SR)</label></div>
                        <div><input type="number" name="item_price" value="<?php echo $itemPrice; ?>" min="0.1" step="0.1" required></div>
                    </div>

                    <div class="category">
                        <div><label for="product_category">Category</label></div>
                        <div>
                            <select name="item_category_id" required>
                                <option value=""></option>
                                
                                <option value="3" <?php if ($itemCategoryId === '3') echo 'selected'; ?>>Soil & Fertilizer</option>
                                <option value="4" <?php if ($itemCategoryId === '4') echo 'selected'; ?>>Planters</option>
                                <option value="5" <?php if ($itemCategoryId === '5') echo 'selected'; ?>>Plant Tools</option>
                                <option value="6" <?php if ($itemCategoryId === '6') echo 'selected'; ?>>Gifts</option>
                            </select>
                        </div>
                    </div>
                        
                    <div class="potsize">
                        <div><label for="product_size">Size (in Inches)</label></div>
                        <div><input type="number" name="plant_potSize" value="<?php echo $plantPotSize; ?>" min="0.1" step="0.1" required></div>
                    </div>
                        
                    <div class="watering one">
                        <div><label for="product_desc">Description</label></div>
                        <div><textarea name="item_description" required><?php echo $itemDescription; ?></textarea></div>
                    </div>
                </div>
                
                <div class="buttons">
                    <button type="reset" onclick="document.location='admin_manage_items.php';">Cancel</button>
                    <button type="submit" onclick="document.location='admin_manage_items.php';" >Save</button>
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
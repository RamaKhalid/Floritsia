<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php
        require_once 'Admin_Header.php';
        require_once 'Database_Connection.php';

        if (!isset( $_SESSION['AdminName'])){
            header('location: admin_login.php?access=Unauthenticated');
            exit;
        }
        else if(isset( $_SESSION['AdminName'])){                

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the file is a valid image
            if (isset($_FILES["item_img"]) && $_FILES["item_img"]["error"] === UPLOAD_ERR_OK) {
                $imageData = file_get_contents($_FILES['item_img']['tmp_name']);
                $imageData = mysqli_real_escape_string($con, $imageData);
            } else {
                die("File is not an image or was not uploaded.");
            }

            // Rest of the product details handling
            $product_name = mysqli_real_escape_string($con, $_POST["product_name"]);
            $product_desc = mysqli_real_escape_string($con, $_POST["product_desc"]);
            $product_quantity = mysqli_real_escape_string($con, $_POST["product_quantity"]);
            $product_price = mysqli_real_escape_string($con, $_POST["product_price"]);
        
            $itemCategoryId = mysqli_real_escape_string($con, $_POST["item_category_id"]);
            $product_size = mysqli_real_escape_string($con, $_POST["product_size"]);

            $query = "INSERT INTO items (item_name, item_description, item_quantity, item_price, item_category_id, plant_potSize, item_img) 
            VALUES ('$product_name', '$product_desc', '$product_quantity', '$product_price', '$itemCategoryId', '$product_size', '$imageData')";
            
            mysqli_query($con, $query);
            mysqli_close($con);
        }
    ?>

    <section>
        <div class="container">
            <div class="title">Add Product</div>
            <form class="form-ruba" action="" method="post" enctype="multipart/form-data">
                <div class="fields">
                    <div class="name">
                        <div><label for="product_name">Name</label></div>
                        <div><input type="text" required placeholder="Enter the product's name" name="product_name"></div>
                    </div>

                    <div class="quantity">
                        <div><label for="product_quantity">Quantity</label></div>
                        <div><input type="number" required min="1" max="1000" step="1" placeholder="Enter the quantity" name="product_quantity"></div>
                    </div>

                    <div class="price">
                        <div><label for="product_price">Price (in SR)</label></div>
                        <div><input type="number" required min="1" step="0.01" placeholder="Enter the product's price" name="product_price"></div>
                    </div>

                    <div class="category">
                        <div><label for="product_category">Category</label>
					</div>
                         <div>
                            <select name="item_category_id" required>
                                <option value=""></option>

                                <option value="3" <?php $itemCategoryId = '3' ?>>Soil & Fertilizer</option>
                                <option value="4" <?php $itemCategoryId = '4' ?>>Planters</option>
                                <option value="5" <?php $itemCategoryId = '5' ?>>Plant Tools</option>
                                <option value="6" <?php $itemCategoryId = '6' ?>>Gifts</option>
                            </select>
                        </div>
                    </div>

                    <div class="potsize">
                        <div><label for="product_size">Size (in Inches)</label></div>
                        <div><input type="number" required min="1" step="0.1" placeholder="Enter the product's size" name="product_size"></div>
                    </div>

                    <div class="watering one">
                        <div><label for="product_desc">Description</label></div>
                        <div><textarea required placeholder="Enter a description of the product" name="product_desc"></textarea></div>
                    </div>

                   <div class="image">
						<div>
                            <img id="previewImg" src="" alt="Preview Image" style="display: none;">
                            <input type="file" required name="item_img" id="item_img" alt="product image" accept="image/*" onchange="previewImage(event);">
                        </div>
                    </div>

                    <script>
                        function previewImage(event) {
                            var input = event.target;
                            var preview = document.getElementById('previewImg');

                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    preview.src = e.target.result;
                                    preview.style.display = 'block';
                                };

                                reader.readAsDataURL(input.files[0]);
                            } else {
                                preview.src = '';
                                preview.style.display = 'none';
                            }
                        }
                    </script>
                </div>

                <div class="buttons">
                    <button type="reset">Cancel</button>
                    <button type="submit" name="submit">Save</button>
                    <button  style="float: right;" name="submit" onclick="document.location='Admin_Manage_Items.php';">Return to Manage Items </button>
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
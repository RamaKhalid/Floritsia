<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Plant</title>
    <link rel="stylesheet" href="./style.css">
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

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the file is a valid image
            if (isset($_FILES["item_img"]) && $_FILES["item_img"]["error"] === UPLOAD_ERR_OK) {
                $imageData = file_get_contents($_FILES['item_img']['tmp_name']);
                $imageData = mysqli_real_escape_string($con, $imageData);
            } else {
                die("File is not an image or was not uploaded.");
            }

            // Sanitize and validate form inputs
            $plant_name = mysqli_real_escape_string($con, $_POST['plant_name']);
            $plant_desc = mysqli_real_escape_string($con, $_POST['plant_desc']);
            $plant_quantity = mysqli_real_escape_string($con, $_POST['plant_quantity']);
            $plant_price = mysqli_real_escape_string($con, $_POST['plant_price']);
            $item_category_id = mysqli_real_escape_string($con, $_POST['item_category_id']);
            $plant_potSize = mysqli_real_escape_string($con, $_POST['plant_potSize']);
            $watering = mysqli_real_escape_string($con, $_POST['plant_watering']);
            $light = mysqli_real_escape_string($con, $_POST['plant_light']);
            $fertilizing = mysqli_real_escape_string($con, $_POST['plant_fertilizing']);
            $tempHumidity = mysqli_real_escape_string($con, $_POST['plant_temp']);

            // Insert the item information into the database
            $query = "INSERT INTO items (item_name, item_description, item_quantity, item_price, item_category_id, plant_potSize, item_img) 
            VALUES ('$plant_name', '$plant_desc', '$plant_quantity', '$plant_price', '$item_category_id', '$plant_potSize', '$imageData')";
                    
            $result = mysqli_query($con, $query);
            $item_id = mysqli_insert_id($con); // Get the ID of the inserted item

            // Prepare the INSERT statement for plant_care table
            $query2 = "INSERT INTO plant_care (plant_ID, Watring, Light, Fertilizing, Temp_Humidity) 
            VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $query2);

            // Bind the parameters to the statement
            mysqli_stmt_bind_param($stmt, "issss", $item_id, $watering, $light, $fertilizing, $tempHumidity);

            // Execute the statement
            $result2 = mysqli_stmt_execute($stmt);

            // Close the statement
            mysqli_stmt_close($stmt);
            
            // Close the database connection
            mysqli_close($con);
        }
    ?>

    <section>
        <div class="container">
            <div class="title">Add Plant</div>
            <form class="form-ruba" action="" method="post" enctype="multipart/form-data">
                <div class="fields">
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

                    <div class="name">
                        <div><label for="">Name</label></div>
                        <div><input type="text" required name="plant_name"></div>
                    </div>

                    <div class="quantity">
                        <div><label for="quantity">Quantity</label></div>
                        <div><input type="number" required min="1" step="1" name="plant_quantity"></div>
                    </div>

                    <div class="price">
                        <div><label for="price">Price</label></div>
                        <div><input type="number" required min="0.1" step="0.1" name="plant_price"></div>
                    </div>

                    <div class="category">
                        <div><label for="Plant_category">Category</label></div>
                        <div>
                            <select name="item_category_id" required>
                                <option value=""></option>

                                <option value="1">Indoor</option>
                                <option value="2">Outdoor</option>
                            </select>
                        </div>
                    </div>

                    <div class="potsize">
                        <div><label for="potsize">Pot Size</label></div>
                        <div><input type="number" required min="0.1" step="0.1" name="plant_potSize"></div>
                    </div>

                    <div class="description two">
                        <div><label for="">Description</label></div>
                        <div><textarea required name="plant_desc"></textarea></div>
                    </div>

                    <div class="watering one">
                        <div><label for="">Watering</label></div>
                        <div><textarea required name="plant_watering"></textarea></div>
                    </div>

                    <div class="light one">
                        <div><label for="">Light</label></div>
                        <div><textarea required name="plant_light"></textarea></div>
                    </div>

                    <div class="temperature one">
                        <div><label for="">Temperature and Humidity</label></div>
                        <div><textarea required name="plant_temp"></textarea></div>
                    </div>

                    <div class="fertilizing one">
                        <div><label for="">Fertilizing</label></div>
                        <div><textarea required name="plant_fertilizing"></textarea></div>
                    </div>
                </div>

                <div class="buttons">
                    <button type="reset">Cancel</button>
                    <button type="submit" name="submit">Save</button>
                    <button style="float: right;" name="submit" onclick="document.location='Admin_Manage_Items.php';">Return to Manage Items</button>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

<?php
require('customer_header.php');
require_once 'Database_Connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-to-cart'])) {
    $product_id = $_POST['product_id'];

    // Fetch the current stock from the database
    $query = "SELECT item_quantity FROM items WHERE item_id = '$product_id'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $product_stock = $row['item_quantity'];

        if ($product_stock > 0) {
            $product_stock--; // Decrease stock by 1

            if (isset($_COOKIE["shopping_cart"])) {
                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                $cart_data = json_decode($cookie_data, true);
            } else {
                $cart_data = array();
            }

            $item_id_list = array_column($cart_data, 'item_id');

            if (in_array($_POST["product_id"], $item_id_list)) {
                foreach ($cart_data as $keys => $values) {
                    if ($cart_data[$keys]["item_id"] == $_POST["product_id"]) {
                        $cart_data[$keys]["item_Quantity"] = $cart_data[$keys]["item_Quantity"] + $_POST["product_Quantity"];
                    }
                }
            } else {
                $item_array = array(
                    'item_id' => $_POST['product_id'],
                    'item_price' => $_POST['product_price'],
                    'item_name' => $_POST['product_name'],
                    'item_Quantity' => (int)$_POST['product_Quantity'],
                    'item_stock' => $product_stock,
                );
                $cart_data[] = $item_array;
            }

            

            $item_data = json_encode($cart_data);
            setcookie('shopping_cart', $item_data, time() + (86400 * 30));
            $item_id = $_POST['product_id'];
            $redirect_url = "item-details.php?data=" . urlencode($item_id) . "&success=1";
            header("Location: $redirect_url");
            exit();
        } else {
            echo "<script>
                var stockZero = true;
            </script>";
        }
    }
}
?>

<section class="producDeatils">
    <div class="item-deails">

        <?php
        // Check if the data parameter exists in the URL
        if (isset($_GET['data'])) {
            // Retrieve and display the data
            $item_id = htmlspecialchars($_GET['data']);

            $select_item = mysqli_query($con, "SELECT * FROM items WHERE item_id = $item_id");
            if (mysqli_num_rows($select_item) > 0) {
                // Loop through the results if there are any
                while ($fetch_item = mysqli_fetch_assoc($select_item)) {
                   
        ?>

                    <div class="itemImg">
                        <!-- Display the image using the base64 encoded image data -->
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($fetch_item['item_img']); ?>" width="550px" height="498.30px" alt="<?php echo $fetch_item['item_name']; ?>"> 
                    </div>

                    <div class="deails">
                        <h1><?php echo $fetch_item['item_name'] ?></h1>
                        <h2><?php echo $fetch_item['item_price'] . '.00 SR'  ?></h2>
                        <p><?php echo $fetch_item['item_description'] ?></p>
                        <h5><?php echo 'Pot Size:' . $fetch_item['plant_potSize'] . 'cm' ?></h5>

                        <form class="plant-count" method="post" action="">
                            <input type="hidden" name="product_id" value="<?php echo $fetch_item['item_id'] ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_item['item_price'] ?>">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_item['item_name'] ?>">
                            <?php $min = ($fetch_item['item_quantity'] == 0) ? 0 : 1; ?>
                            <input type="number" min="<?php echo $min ?>"  max="<?php echo $fetch_item['item_quantity'] ?>" name="product_Quantity" value="<?php echo $min ?>">

                            <button class="AddToCart_button" button type="submit" name="add-to-cart">Add to Cart</button>
                        </form>
        <?php
                }
            } else {
                echo "No item found with ID: $itemid";
            }

            $plant_care = mysqli_query($con, "SELECT * FROM plant_care WHERE plant_ID = $item_id");
            if (mysqli_num_rows($plant_care) > 0) {
                while ($fetch_care = mysqli_fetch_assoc($plant_care)) {

                    echo '<div class="careInfo">';
                    echo   '<div class="Info">';
                    echo        '<i class="fa-solid fa-droplet" style="color: #74C0FC;"></i>';
                    echo        '<h4>' . $fetch_care['Watring'] . '</h4>';
                    echo    '</div>';
                    echo    '<div class="Info">';
                    echo        '<i class="fa-solid fa-sun" style="color: #FFD43B;"></i>';
                    echo         '<h4>' . $fetch_care['Light'] . '</h4>';
                    echo    '</div>';
                    echo     '<div class="Info">';
                    echo         '<i class="fa-solid fa-seedling" style="color: #74873d;"></i>';
                    echo         '<h4>' . $fetch_care['Fertilizing'] . '</h4>';
                    echo     '</div>';
                    echo     '<div class="Info">';
                    echo        '<i class="fa-solid fa-temperature-low" style="color: #e51010;"></i>';
                    echo         '<h4>' . $fetch_care['Temp_Humidity'] . '</h4>';
                    echo     '</div>';
                    echo '</div>';
                }
            }
        }
        ?>
    </div>
</section>

<script>
    // Function to get URL parameters
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    // Check if "success" parameter is in URL
    document.addEventListener("DOMContentLoaded", function() {
        var successParam = getUrlParameter('success');
        if (successParam) {
            swal("Congrats!", "Item Added into Cart successfully!", "success").then(() => {
                // Remove the "success" parameter from URL
                var url = new URL(window.location.href);
                url.searchParams.delete('success');
                window.history.replaceState({}, document.title, url.toString());
            });
        }

        // Check if stockZero variable is set
        if (typeof stockZero !== 'undefined' && stockZero) {
        swal("Error", "This item is out of stock!", "error").then(() => {
            <?php if (isset($_SESSION['category_id'])): ?>
                var redirectUrl = "Category-list.php?category_id=<?php echo $_SESSION['category_id']; ?>";
                window.location.href = redirectUrl;
            <?php endif; ?>
        });
    
        }
    });
</script>

<br>
<?php
require('footer.php');
?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category-list</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .out-of-stock {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }
        .blurry {
            filter: grayscale(100%) blur(2px);
        }
        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }
    </style>
</head>

<body class="Category-list">

    <?php
    require('customer_header.php');
    require_once 'Database_Connection.php';

    if (isset($_POST['add-to-cart'])) {
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
                            $cart_data[$keys]["item_Quantity"] += $_POST["product_Quantity"];
                        }
                    }
                } else {
                    $item_array = array(
                        'item_id' => $_POST['product_id'],
                        'item_price' => $_POST['product_price'],
                        'item_name' => $_POST['product_name'],
                        'item_Quantity' => $_POST['product_Quantity'],
                        'item_stock' => $product_stock,
                    );
                    $cart_data[] = $item_array;
                }


                $item_data = json_encode($cart_data);
                setcookie('shopping_cart', $item_data, time() + (86400 * 30));
                $item_category_id = $_POST['product_category_id'];
                $redirect_url = "Category-list.php?category_id=" . urlencode($item_category_id) . "&success=1";
                header("Location: $redirect_url");
                exit();
            } else {
                echo 'sold out';
            }
        }
    }
    ?>

    <?php
    if (isset($_GET['category_id'])) {
        $category_id = htmlspecialchars($_GET['category_id']);
        $select_category = mysqli_query($con, "SELECT * FROM category WHERE category_id = $category_id");
        if (mysqli_num_rows($select_category) > 0) {
            while ($fetch_item = mysqli_fetch_assoc($select_category)) {
    ?>
                <h1 class="title-list"><strong><?php echo $fetch_item['category_name'] ?> </strong></h1>
        <?php
            }
        } else {
            echo "no items";
        }
        ?>

        <section class="productList">
            <div class="Items-contener">
                <?php
                $select_item = mysqli_query($con, "SELECT * FROM items WHERE item_category_id=$category_id");
                if (mysqli_num_rows($select_item) > 0) {
                    while ($fetch_item = mysqli_fetch_assoc($select_item)) {
                        $is_out_of_stock = $fetch_item['item_quantity'] == 0;
                ?>
                        <form method="post" action="">
                            <div class="items <?php echo $is_out_of_stock ? 'disabled' : ''; ?>" id="items_details" data-info="<?php echo $fetch_item['item_id'] ?>">
                                <?php
                                if ($is_out_of_stock) {
                                    echo '<div class="out-of-stock">Out of Stock</div>';
                                }
                                ?>
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($fetch_item['item_img']) . '" height="355.77px" alt="' . $fetch_item['item_name'] . '" class="' . ($is_out_of_stock ? 'blurry' : '') . '">'; ?>
                                <div class="itemsInfo">
                                    <h5><?php echo $fetch_item['item_name'] ?></h5>
                                    <h4><?php echo $fetch_item['item_price'] . '.00 SR'  ?></h4>
                                </div>
                                <input type="hidden" name="product_category_id" value="<?php echo $fetch_item['item_category_id'] ?>">
                                <input type="hidden" name="product_id" value="<?php echo $fetch_item['item_id'] ?>">
                                <input type="hidden" name="product_name" value="<?php echo $fetch_item['item_name'] ?>">
                                <input type="hidden" name="product_price" value=" <?php echo $fetch_item['item_price'] ?>">
                                <input type="hidden" name="product_stock" value=" <?php echo $fetch_item['item_quantity'] ?>">
                                <input type="hidden" name="product_Quantity" value="1">
                                <input type="hidden" name="product_img" value="<?php echo base64_encode($fetch_item['item_img']) ?>">
                                <button type="submit" name="add-to-cart" <?php echo $is_out_of_stock ? 'disabled' : ''; ?>><i class="fa-solid fa-circle-plus fa-2xl"></i></button>
                            </div>
                        </form>
                <?php
                    }
                } else {
                    echo "No items";
                }
            }
                ?>

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

                    // JavaScript code to handle click event and redirect to item-details.php with data-info
                    var items = document.querySelectorAll(".items");
                    items.forEach(function(item) {
                        item.addEventListener("click", function() {
                            var dataInfo = item.getAttribute("data-info");
                            window.location.href = "item-details.php?data=" + encodeURIComponent(dataInfo);
                        });
                    });
                });
            </script>
        </section>

        <?php
        require('footer.php');
        ?>
</body>

</html>
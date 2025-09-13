<?php
session_start();

// Function to generate a unique order ID
function generateUniqueOrderId() {
    if (!isset($_SESSION['used_order_ids'])) {
        $_SESSION['used_order_ids'] = array();
    }

    do {
        $newOrderId = rand(10000, 99999);
    } while (in_array($newOrderId, $_SESSION['used_order_ids']));  // Ensure the ID is unique

    $_SESSION['used_order_ids'][] = $newOrderId;  // Track used IDs
    return $newOrderId;
}

// Generate order details
$deliveryDate = date('Y-m-d', strtotime('+7 days'));
$orderId = generateUniqueOrderId();
$orderDate = date('Y-m-d');  // Today's date as order date

// Initialize order details
$orderDetails = [
    'orderId' => $orderId,
    'orderDate' => $orderDate,
    'deliveryDate' => $deliveryDate,
    'delivered' => false,
    'items' => []
];

// Append order details to session array to store multiple orders
if (!isset($_SESSION['orders'])) {
    $_SESSION['orders'] = array();
}

if (isset($_COOKIE["shopping_cart_backup"])) {
    // Decode the cookie and get cart data
    $cookie_data = stripslashes($_COOKIE['shopping_cart_backup']);
    $cart_data = json_decode($cookie_data, true);

    // Collect all items in one order
    foreach ($cart_data as $keys => $values) {
        $orderDetails['items'][] = [
            'item_id' => $values['item_id'],
            'item_name' => $values['item_name'],
            'item_Quantity' => $values['item_Quantity'],
            'item_Price' => $values['item_price']
        ];
    }
}

// Store the single order into the session
$_SESSION['orders'][] = $orderDetails;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php require_once 'customer_header.php'; ?>
    
    <section>
        <div class="receipt_main_section">
            <p id="congrats_message"><b>Congrats!</b></p>
            <p id="order_status_message">Your Order Has Been<br>Placed Successfully!</p>
            <p id="order_num">
                <?php 
                    // Access the last added order details
                    $lastOrder = end($_SESSION['orders']);
                    echo "Order ID: " . $lastOrder['orderId'] . "<br><br>Delivery Date: " . $lastOrder['deliveryDate'];
                    echo '<br><br><a href="orders.php"> View Order History</a>';
                ?>
            </p>
        </div>   
        <img src="images\desing imgs\design 5.png" alt="Page Decoration Photo" id="receipt_design_img">
    </section> 

    <?php require_once 'footer.php'; ?>
</body>
</html>

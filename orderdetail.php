<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'customer_header.php'; ?>
    <div class="od-page"> 
        <aside class="side-menu">
        <section class="user-profile">
                <img src="images/Desing imgs/user-image.jpg" alt="User" class="user-logo">
            </section>
            <!-- Assuming customer_header.php includes user-profile, if not, add here -->
            <nav>
                <ul>
                    <li><a href="orders.php">My Orders</a></li>
                </ul>
            </nav>
        </aside>

        <?php
        if (isset($_SESSION['orders']) && isset($_GET['orderId'])) {
            $orderId = $_GET['orderId'];
            $totalPrice = 0; // Initialize totalPrice to 0

            foreach ($_SESSION['orders'] as $order) {
                if ($order['orderId'] == $orderId) {
                    echo "<div class='order-container'>";
                    echo "<div class='order-header'>";
                    echo "<div class='order-info'>";
                    echo "<h2>Order ID: " . htmlspecialchars($order['orderId']) . "</h2>";
                    echo "<p>Order date: " . htmlspecialchars($order['orderDate']) . " | Estimated delivery: " . htmlspecialchars($order['deliveryDate']) . "</p>";
                    echo "</div>";
                    echo "</div>"; // Close order-header

                    foreach ($order['items'] as $item) {
                        $itemTotalPrice = $item['item_Price'] * $item['item_Quantity'];
                        $totalPrice += $itemTotalPrice; // Accumulate total price
                        echo "<div class='item-container'>";
                        echo "<div class='item-details'>";
                        echo "<p><strong>" . htmlspecialchars($item['item_name']) . "</strong></p>";
                        echo "</div>";
                        echo "<div class='item-price-qty'>";
                        echo "<p><strong>$" . number_format($item['item_Price'], 2) . "</strong></p>";
                        echo "<p>Qty: " . htmlspecialchars($item['item_Quantity']) . "</p>";
                        echo "</div>";
                        echo "</div>"; // Close item-container
                    }

                    echo "<div class='payment-detail'>";
                    echo "<div>";
                    echo "<p><strong>Subtotal:</strong> $" . number_format($totalPrice, 2) . "</p>";
                    echo "<p><strong>Delivery fee:</strong> $20.00</p>";
                    echo "<p><strong>Promo:</strong> $0.00</p>";
                    echo "<p><strong>TOTAL:</strong> $" . number_format($totalPrice + 20, 2) . "</p>";
                    echo "</div>";
                    // echo "<div class='payment-method'>";
                    // echo "<p><strong>Payment Method:</strong></p>";
                    // echo "<p>Apple Pay</p>";
                    echo "</div>"; // Close payment-method
                    echo "</div>"; // Close payment-detail
                    echo "</div>"; // Close order-container

                    break; // Stop the loop after finding the matching order
                }
            }
            if ($totalPrice == 0) {
                echo "<p>No order found or missing order ID.</p>";
            }
        }
        ?>
    </div> <!-- Close od-page -->

    <?php include 'footer.php'; ?>
</body>
</html>

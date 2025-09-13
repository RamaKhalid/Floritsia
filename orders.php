<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require_once 'customer_header.php'; ?>

    <div class="orders-page">
        <aside class="side-menu">
            <section class="user-profile">
                <img src="images/Desing imgs/user-image.jpg" alt="User" class="user-logo">
            </section>
            <nav>
                <ul>
                    <li><a href="orders.php">My Orders</a></li>
                </ul>
            </nav>
        </aside>

        <div class="orders-wrapper">
            <div class="orders-container">
            <h1>Orders</h1>
            <?php
            // Retrieve all orders from the session
            $orders = isset($_SESSION['orders']) ? $_SESSION['orders'] : [];

            if (empty($orders)): ?>
                <p>No past orders available.</p>
            <?php else:
                foreach ($orders as $order): ?>
                    <div class="order-card">
                        <img src="images/Desing imgs/<?php echo ($order['delivered'] ? 'green.jpg' : 'palegreen.jpg'); ?>" alt="Order Status" class="status-icon">
                        <div class="order-details">
                            <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['orderId']); ?></p>
                            <p><strong>Order date:</strong> <?php echo htmlspecialchars($order['orderDate']); ?></p>
                            <p><strong><?php echo ($order['delivered'] ? 'Delivered on:' : 'Estimated delivery:'); ?></strong> <?php echo htmlspecialchars($order['deliveryDate']); ?></p>
                        </div>
                        <button class="details-button" onclick="location.href='orderdetail.php?orderId=<?php echo urlencode($order['orderId']); ?>';">Details</button>
                    </div>
                <?php endforeach;
            endif; ?>
            </div>
        </div>
        
        <?php require_once 'footer.php'; ?>
    </div>
</body>
</html>

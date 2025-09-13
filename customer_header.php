<!--Raghad-->
<!DOCTYPE html>
 <html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Welcome to Floritsia </title>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <?php 
    // start session if not started
    if (session_status()==PHP_SESSION_NONE){
      session_start();
      $itemQty=0;
    }
    // Check if the user has a unique identifier cookie
    if (!isset($_COOKIE['user_id'])) {
        // Generate a unique identifier
        $user_id = uniqid();
        // Set the unique identifier as a cookie
        setcookie('user_id', $user_id, time() + (86400 * 30), "/"); // Cookie valid for 30 days
    } else {
        // Retrieve the user's unique identifier from the cookie
        $user_id = $_COOKIE['user_id'];
    }
  ?>  
    </head>
    
    <body>
    <?php
    // Initialize the item quantity variable
    $itemQty = 0;

    // Check if the shopping_cart cookie is set
    if (isset($_COOKIE['shopping_cart'])) {
        // Decode the JSON encoded cookie value
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
        // Calculate the total quantity of items in the cart
        foreach ($cart_data as $item) {
            $itemQty += $item['item_Quantity'];
        }
    }
    ?>
        <div class="header">
          <nav>
              <a href="homepage.php"><img src="images\Desing imgs\Black logo.png" alt="black logo"></a>
            <ul>
			<li><a style="text-decoration: none;" href="Admin_Login.php" ><i class="fa-solid fa-user-tie"></i> Login as an Admin</a></li>
              <li style="margin-left: 1px; margin-right: 1px;"> | </li>
              <li><a href="./homepage.php#categories">Shop</a></li>
              <li><a href="./homepage.php#about us" >About </a></li>
              <li><a href="contactUs.php">Contact us</a></li>
              <li><a href="cart.php" > <i class="fa-solid fa-cart-shopping"></i><i class="numberOfItems"><?php echo $itemQty; ?></i></a></li>
              <li><a href="orders.php" ><i class="fa fa-history"></i></a></li>
            </ul>
          </nav>
        </div>
</body>
 </html>
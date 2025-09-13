<!--cart us by r.m. -->

<?php
require_once("Database_Connection.php");
function displayAlert($message) {
    echo "<script>alert('$message');</script>";
  
}
if (isset($_COOKIE["shopping_cart"])) {
    // $total=0;
     $cookie_data = stripslashes($_COOKIE['shopping_cart']);
     $cart_data = json_decode($cookie_data, true);
}


if(isset($_POST["update_cart"])){
  
    $update=$_POST["update_qn"];
   // echo $update;
   $update_id=$_POST["update_qn_id"];
   // echo $update_id;
   //qury
   $item_id_list=array_column($cart_data,'item_id');
   if(in_array($update_id,$item_id_list))
   {
           foreach($cart_data as $keys => $values){
               if($cart_data[$keys]["item_id"]==$update_id)
               {
         
                $cart_data[$keys]["item_Quantity"] =   $update;
                $item_data1 = json_encode($cart_data);
                setcookie('shopping_cart', $item_data1, time() + (86400 * 30));
                header("Location: cart.php"); // Redirect to update changes
                exit();

               }

           }
   }

   
   
}

function backupShoppingCart() {
    
    if (isset($_COOKIE["shopping_cart"])) {
        global $con;
        update_datatbase_qn();
        // Get current cart data
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        
        // Store cart data in backup cookie
        $backup_data = json_encode($cart_data);
        setcookie('shopping_cart_backup', $backup_data, time() + (86400 * 30));
        foreach ($cart_data as $key => $value) {
                
                unset($cart_data[$key]);
                $item_data2 = json_encode(array_values($cart_data));
                setcookie("shopping_cart", $item_data2, time() + (86400 * 30));
            
        }

    }
}


function checkCartQuantity() {
    global $con;
    $updated_cart_data = []; // Array to hold updated cart data
    $remove_items = false; // Flag to indicate if any item needs to be removed

    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        
        foreach ($cart_data as $keys => $values) {
            $get_id = (int) $values["item_id"];
            $get_stock = (int) $values["item_Quantity"];
            $query = "SELECT item_quantity FROM items WHERE item_id=$get_id";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $current_stock = $row['item_quantity'];
            
           

            if ($get_stock <= $current_stock) {
                // Item quantity is within available stock, keep it in the cart
                $updated_cart_data[] = $values;
            } else {
                // Item quantity exceeds available stock, remove it from the cart
          
                $remove_items = true;
            }
        }

        // If any items were removed, update the shopping cart cookie
        if ($remove_items) {
          
            $item_data1 = json_encode($updated_cart_data);
            setcookie('shopping_cart', $item_data1, time() + (86400 * 30));
         
        }
        if(!$remove_items)
        {
        return true;
        } // Return true if all items are within stock, false otherwise
    }


    return false; // Return false if there is no shopping cart data
}


// Function to calculate total price
function calculateTotalPrice() {
    $total_price = 0;
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);

        foreach ($cart_data as $item) {
            $total_price += ($item["item_price"] * $item["item_Quantity"]);
        }
    }
    return $total_price." SAR";
}

// Delete item if delete button is clicked
if(isset($_GET['action']) && $_GET['action'] == "delete") {

    if(isset($_GET['id'])) {
        $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
        $cart_data = json_decode($cookie_data, true);
        foreach ($cart_data as $key => $value) {
            if ($cart_data[$key]["item_id"] == $_GET["id"]) {
                unset($cart_data[$key]);
                $item_data2 = json_encode(array_values($cart_data));
                setcookie("shopping_cart", $item_data2, time() + (86400 * 30));
                header("location:cart.php?remove=1");
            }
        }
    }
}

if(isset($_GET['action']) && $_GET['action'] == "clear") {
    if(isset($_COOKIE["shopping_cart"])) {
        // Clear the cart data
        setcookie("shopping_cart", "", time() - 3600);
        // Redirect to refresh cart display
        header("Location: Cart.php");
        exit();
    }
}

function update_datatbase_qn()
{
    global $con;
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        foreach ($cart_data as $keys => $values) {
            $get_id = (int)$values["item_id"];
            $get_stock = (int)$values["item_Quantity"];

            $query = "SELECT item_quantity FROM items WHERE item_id=$get_id"; 
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $current_stock = $row['item_quantity'];

            $new_stock = $current_stock - $get_stock;

            // Update the stock in the database
            $update_query = "UPDATE items SET item_quantity=$new_stock WHERE item_id=$get_id"; 
            mysqli_query($con, $update_query);
        }
    }
}



function findimg($id_search)
{
    global $con;
    settype($id_search, "integer");
    $qrm = "SELECT * FROM items WHERE item_id = $id_search";
    $imgprint = mysqli_query($con, $qrm);
    if ($imgprint) {
        $fetch_img = mysqli_fetch_assoc($imgprint);
        return $fetch_img;
    } else {
        echo "Error: " . mysqli_error($con);
        return null;
    }
}
if (isset($_GET['go_to_checkout'])) {
    if (checkCartQuantity()) {
        backupShoppingCart();
        header("Location: receipt.php");
        exit();
    } else {
      
       header("location: cart.php?alertrm");
        
    }
   
}
if(isset($_GET["alertrm"]))
{
    displayAlert("Some items in your cart have insufficient quantity and have been removed.");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<script>
    function confirmDelete(){
        return confirm('The item will be deleted. If you are sure to delete this item press OK, otherwise press CANCEL');
    }
    function confirmDeleteall(){
        return confirm('The cart will be clear . If you are sure to delete all item press OK, otherwise press CANCEL');
    }
    function confirmCHECKOUT(){
        return confirm('are you sure to pay know?');
    }
</script>
<body>
<?php
       
       #Include the customer_header file
      require_once 'customer_header.php';
      ?>
<center> <h1 class="Cart_titel">Shopping Cart</h1></center>


<center><section >
	

    <div class="rm-container">
    
        <section class="boxcart">
           
        <table width="100%">
          
        
                <thead>
                <tr>

                    <td>
                        ADDED ITEMS
                    </td>
                    <td>
                        PRODUCT
                    </td>
                   
                    <td>
                       QUANTITY
                    </td>
                  
                    <td>
                        PRICE
                    </td>
                    <td>
                        REMOVE
                    </td>
                </tr>
                </thead> 
               <tbody>
                <?php
                    if (isset($_COOKIE["shopping_cart"])) {
                    // $total=0;
                        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                        $cart_data = json_decode($cookie_data, true);
                        
                        foreach($cart_data as $keys => $values){
                            global $con;
                            $fetch_img = findimg($values["item_id"]);
                        

                ?>
                                    
                                
                <tr>
                    <td>
                    <?php echo '<img src="data:images/;base64,' . base64_encode($fetch_img["item_img"]) . ' " alt="$values["item_name"]" style="height: 80%;">';

                    ?> 

               
                    </td>
                    <td>
                        <?php echo $values["item_name"]; ?>
                    </td>
                    <form action="" method="post" id="rm_qn" >
                       
                       <td>
                        <?php 
                        $conv= $values["item_Quantity"] ;
                        settype($conv,"integer");
                        ?>
                        
                           <input type="hidden" value="<?php echo $values["item_id"]?>" name="update_qn_id">
                          <div>
                         
                           <input class="Qty"  type="number"  min="1"  value="<?php echo $conv;?>" name="update_qn" >
                           </div>
                           <div>
                           <input class="updateQty" type="submit" value="update" name="update_cart">
                           </div>
                           
                       
                       </td>
                   
                       </form>


                    <td>
                        <?php echo ($values["item_price"]*$values["item_Quantity"]." SAR"); ?>
                    </td>
                    <td>
                        <a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>" onclick="return confirmDelete()" >
                        <i class="fas fa-trash"  ></i>
                    </a>
                    </td>

                </tr>
       
         <?php

     
        }
    }
    else {  
        echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";}
    
        ?>

         </tbody>
        </table>

        </section>
    </center>
        <section>

       
        <?php
            if(!empty($cart_data)) {
            ?>
            <center>
            <table >
                <tr>
                    <td>
                    Total Price:
                    </td>
                    <td>
                    <div><?php echo calculateTotalPrice(); ?></div>
                    </td>
                </tr>
                <tr>
                    <form>

                   
                    <td>
                        <button type="submit" value="checkout" name="go_to_checkout" onclick="return confirmCHECKOUT()" class='new_rmcheck'>
      go to checkout
                        </button>
                         

                    </td>
                    </form>
                </tr>

            </table>
        <a href="cart.php?action=clear" onclick="return confirmDeleteall()" >
                            <i class='fas fa-trash'></i> delete all
                        </a>
        
                        </center>
                   
        <?php
        }
    
     else {
       echo   "     <center><p>Your cart is empty.</p></center>";
    }
    
    ?>
                        
    
    </section>
	
<?php
            #Include the footer file
	        require_once 'footer.php';
	    ?>
</body>

</html>
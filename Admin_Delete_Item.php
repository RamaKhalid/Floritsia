<?php
    require_once 'Database_Connection.php';
    if (isset($_GET['id'])) {
        $item_id = $_GET['id'];
        
        // Delete associated records in plant_care table
        $deletePlantCareQuery = "DELETE FROM plant_care WHERE plant_ID = '$item_id'";
        if (mysqli_query($con, $deletePlantCareQuery)) {
            // Proceed with deleting the item
            $deleteItemQuery = "DELETE FROM items WHERE item_id = '$item_id'";
            if (mysqli_query($con, $deleteItemQuery)) {
                echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=Admin_Manage_Items.php">';
            } else {
                echo "Error deleting record: " . mysqli_error($con);
            }
        } else {
            echo "Error deleting associated records: " . mysqli_error($con);
        }
        
        // close connection
        mysqli_close($con);
    }
?>

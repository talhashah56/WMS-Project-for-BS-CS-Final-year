<?php
include("../config/db.php");

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM orders WHERE id='$id'");
}

// After deletion, redirect back to view_orders
header("Location: view_orders.php");
exit();
?>

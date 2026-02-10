<?php
include("../config/db.php");

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM inventory WHERE id=$id");

header("Location: view_items.php");
?>

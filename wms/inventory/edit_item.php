<?php
include("../config/db.php");

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM inventory WHERE id=$id"));

if(isset($_POST['update'])){
    $name = $_POST['item_name'];
    $qty  = $_POST['quantity'];
    $loc  = $_POST['location'];

    mysqli_query($conn, "UPDATE inventory 
        SET item_name='$name', quantity='$qty', location='$loc' 
        WHERE id=$id");

    header("Location: view_items.php");
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Edit Item</h2>

<form method="POST">
    <input type="text" name="item_name" value="<?php echo $data['item_name']; ?>"><br><br>
    <input type="number" name="quantity" value="<?php echo $data['quantity']; ?>"><br><br>
    <input type="text" name="location" value="<?php echo $data['location']; ?>"><br><br>
    <button name="update">Update</button>
</form>

</body>
</html>

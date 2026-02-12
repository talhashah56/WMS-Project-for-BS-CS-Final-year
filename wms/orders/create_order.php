<?php
include("../config/db.php");

$items = mysqli_query($conn, "SELECT * FROM inventory");

if(isset($_POST['order'])){
    $item = $_POST['item_name'];
    $qty = $_POST['quantity'];
    $date = date("Y-m-d");

    // Save order
    mysqli_query($conn, "INSERT INTO orders(item_name, quantity, order_date) 
                         VALUES('$item','$qty','$date')");

    // Reduce stock
    mysqli_query($conn, "UPDATE inventory 
                         SET quantity = quantity - $qty 
                         WHERE item_name='$item'");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Order</title>
    <style>

        :root {
    --order-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --dark-blue: #2c3e50;
    --white: #ffffff;
    --shadow: 0 15px 35px rgba(0,0,0,0.15);
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: var(--order-gradient);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0;
}

.order-card {
    background: rgba(255, 255, 255, 0.95);
    padding: 40px;
    border-radius: 20px;
    box-shadow: var(--shadow);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

h2 {
    color: var(--dark-blue);
    margin-bottom: 25px;
    font-size: 1.8rem;
}

/* Select & Input Styling */
select, input {
    width: 100%;
    padding: 14px;
    margin-bottom: 20px;
    border: 2px solid #ddd;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s;
    background: white;
    box-sizing: border-box;
}

select:focus, input:focus {
    outline: none;
    border-color: #f5576c;
    box-shadow: 0 0 10px rgba(245, 87, 108, 0.2);
}

/* Place Order Button */
button[name="order"] {
    width: 100%;
    padding: 15px;
    background: var(--dark-blue);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

button[name="order"]:hover {
    background: #1a252f;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Success Message */
.msg-box {
    background: #d4edda;
    color: #155724;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 500;
}

/* Back Link */
.back-link {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    color: white;
    font-size: 0.9rem;
    opacity: 0.8;
}

.back-link:hover {
    opacity: 1;
    text-decoration: underline;
}
.back-btn{
    margin-top: 30px;
    color: var(--nav-dark);
    text-decoration: none;
    font-weight: 600;
}

.back-btn:hover{
    text-decoration: underline;
}
    </style>
</head>
<body>

<h2>Create Order</h2>

<form method="POST">

<select name="item_name" required>
    <option value="">Select Item</option>
    <?php while($row = mysqli_fetch_assoc($items)){ ?>
        <option value="<?php echo $row['item_name']; ?>">
            <?php echo $row['item_name']; ?>
        </option>
    <?php } ?>
</select><br><br>

<input type="number" name="quantity" placeholder="Order Quantity" required><br><br>

<button name="order">Place Order</button>

</form>

<a href="../dashboard.php" class="back-btn"><button>Back to Dashboard</button></a>

</body>
</html>

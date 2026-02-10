<?php
include("../config/db.php");

if(isset($_POST['save'])){
    $name = $_POST['item_name'];
    $qty = $_POST['quantity'];
    $loc = $_POST['location'];

    mysqli_query($conn, "INSERT INTO inventory(item_name, quantity, location) 
                         VALUES('$name','$qty','$loc')");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title>
<style>
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --success-color: #2ecc71;
    --dark-blue: #2c3e50;
    --glass-white: rgba(255, 255, 255, 0.95);
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: var(--primary-gradient); /* Nice colorful background */
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 20px;
}

/* The Form Card */
.form-card {
    background: var(--glass-white);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 450px;
    text-align: center;
}

h2 {
    color: var(--dark-blue);
    margin-bottom: 30px;
    font-weight: 700;
    font-size: 1.8rem;
}

/* Input Styling */
input {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-sizing: border-box; /* Crucial for width */
}

input:focus {
    outline: none;
    border-color: #764ba2;
    box-shadow: 0 0 8px rgba(118, 75, 162, 0.2);
}

/* The Save Button */
button[name="save"] {
    width: 100%;
    padding: 14px;
    background: var(--success-color);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 1.1rem;
    font-weight: bold;
    cursor: pointer;
    transition: transform 0.2s, background 0.3s;
    margin-top: 10px;
}

button[name="save"]:hover {
    background: #27ae60;
    transform: translateY(-2px);
}

button[name="save"]:active {
    transform: translateY(0);
}

/* Back Button Style */
.btn-dashboard {
    margin-top: 25px;
    display: inline-block;
    text-decoration: none;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    transition: color 0.3s;
}

.btn-dashboard:hover {
    color: #ffffff;
    text-decoration: underline;
}

/* Alert Message (if you add one later) */
.success-msg {
    color: var(--success-color);
    margin-bottom: 15px;
    font-weight: bold;
}
</style>
</head>
<body>

<h2>Add Inventory Item</h2>

<form method="POST">
    <input type="text" name="item_name" placeholder="Item Name" required><br><br>
    <input type="number" name="quantity" placeholder="Quantity" required><br><br>
    <input type="text" name="location" placeholder="Storage Location" required><br><br>
    <button name="save">Save Item</button>
</form>

<a href="../dashboard.php" class="btn-dashboard"><button>Back to Dashboard</button></a>

</body>
</html>

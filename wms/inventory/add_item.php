<?php
include("../config/db.php");

$success = "";
$error = "";

// Save item
if(isset($_POST['save'])){
    $name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $qty = intval($_POST['quantity']);
    $loc = mysqli_real_escape_string($conn, $_POST['location']);

    if($name && $qty >= 0 && $loc){
        mysqli_query($conn, "INSERT INTO inventory(item_name, quantity, location) 
                             VALUES('$name','$qty','$loc')");
        $success = "Item added successfully!";
    } else {
        $error = "Please fill all fields correctly!";
    }
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
            background: var(--primary-gradient);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

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

        input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #764ba2;
            box-shadow: 0 0 8px rgba(118, 75, 162, 0.2);
        }

        button[name="save"], .btn-dashboard {
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

        button[name="save"]:hover, .btn-dashboard:hover {
            background: #27ae60;
            transform: translateY(-2px);
        }

        button[name="save"]:active, .btn-dashboard:active {
            transform: translateY(0);
        }

        .message {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .success-msg { color: var(--success-color); }
        .error-msg { color: red; }

        #preview {
            font-size: 0.95rem;
            margin-bottom: 15px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="form-card">
    <h2>Add Inventory Item</h2>

    <?php
    if($success) echo "<div class='message success-msg'>$success</div>";
    if($error) echo "<div class='message error-msg'>$error</div>";
    ?>

    <form id="addItemForm" method="POST">
        <input type="text" name="item_name" id="itemName" placeholder="Item Name" required>
        <input type="number" name="quantity" id="itemQty" placeholder="Quantity" required>
        <input type="text" name="location" id="itemLoc" placeholder="Storage Location" required>
        <div id="preview"></div>
        <button name="save">Save Item</button>
    </form>
<br><br>
  
    <a href="../dashboard.php" class="btn-dashboard">← Back to Dashboard</a>
</div>

<script>
const form = document.getElementById('addItemForm');
const nameInput = document.getElementById('itemName');
const qtyInput = document.getElementById('itemQty');
const locInput = document.getElementById('itemLoc');
const preview = document.getElementById('preview');

function updatePreview() {
    const name = nameInput.value.trim();
    const qty = qtyInput.value;
    const loc = locInput.value.trim();
    if(name && qty && loc){
        preview.textContent = `Preview: ${name} → ${qty} pcs at ${loc}`;
    } else {
        preview.textContent = '';
    }
}

nameInput.addEventListener('input', updatePreview);
qtyInput.addEventListener('input', updatePreview);
locInput.addEventListener('input', updatePreview);

form.addEventListener('submit', function(e){
    if(nameInput.value.trim() === '' || qtyInput.value < 0 || locInput.value.trim() === ''){
        alert('Please fill all fields correctly!');
        e.preventDefault();
    }
});
</script>

</body>
</html>

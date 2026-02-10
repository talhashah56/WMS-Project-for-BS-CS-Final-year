<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit(); // important
}

include("config/db.php");

// stats
$totalItems  = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM inventory"))[0];
$totalOrders = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM orders"))[0];
$lowStock    = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM inventory WHERE quantity <= 10"))[0];

// chart data
$items = [];
$qty   = [];

$result = mysqli_query($conn,"SELECT item_name, quantity FROM inventory");
while($row = mysqli_fetch_assoc($result)){
    $items[] = $row['item_name'];
    $qty[]   = $row['quantity'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>WMS Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body{font-family: Arial, sans-serif; background:#f5f5f5;}
        .box{
            width:200px; padding:20px; margin:10px; display:inline-block;
            text-align:center; font-size:20px; border-radius:12px;
            background:white; box-shadow:0 0 10px rgba(0,0,0,.1);
        }
        #chartBox{
            width:70%; margin:30px auto; background:white; padding:20px; border-radius:12px;
        }
        a{ text-decoration:none; margin:0 8px; font-weight:bold;}
        p{
            font-size: 0.5em;
            align-items: center;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

<h1 align="center">Warehouse Management System</h1>

<div align="center">
    <div class="box">📦 Items <br><?php echo $totalItems; ?></div>
    <div class="box">📤 Orders <br><?php echo $totalOrders; ?></div>
    <div class="box">🚨 Low Stock <br><?php echo $lowStock; ?></div>
</div>

<div id="chartBox">
    <canvas id="stockChart"></canvas>
</div>

<hr>

<div align="center">
<a href="inventory/add_item.php">Add Inventory</a>
<a href="inventory/view_items.php">View Inventory</a>
<a href="orders/create_order.php">Create Order</a>
<a href="orders/view_orders.php">View Orders</a>
<a href="reports_inventory.php">Inventory Report</a>
<a href="reports_orders.php">Orders Report</a>
<a href="logout.php" style="color:red">Logout</a>
</div>


<div>
    <footer>
        <div>
        <p><b>Proggramed by GCMS-II Mardan Students</b></p>
        <p><b>Zeeshan Khan</b></p>
        <p><b>Muhammmad Talha Shah</b></p>
        <p><b>Ansar Shah</b></p>
        </div>
    </footer>
</div>
<script>
const ctx = document.getElementById('stockChart');

new Chart(ctx, {
    type: 'line',   // changed from bar to modern line graph
    data: {
        labels: <?php echo json_encode($items); ?>,
        datasets: [{
            label: 'Stock Level',
            data: <?php echo json_encode($qty); ?>,
            fill: true,
            backgroundColor: 'rgba(31,60,136,0.15)',
            borderColor: '#1f3c88',
            tension: 0.4,
            pointRadius:5,
            pointBackgroundColor:'#1f3c88'
        }]
    },
    options:{
        responsive:true,
        plugins:{
            legend:{ display:true }
        },
        scales:{
            y:{ beginAtZero:true }
        }
    }
});
</script>


</body>
</html>

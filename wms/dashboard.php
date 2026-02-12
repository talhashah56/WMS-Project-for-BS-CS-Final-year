<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}

include("config/db.php");

// stats
$totalItems  = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM inventory"))[0];
$totalOrders = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM orders"))[0];
$lowStock    = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM inventory WHERE quantity <= 10"))[0];
$totalUsers  = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM users"))[0];

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

</head>
<body>
    <header>
        <h1>Warehouse Management System</h1>
    </header>

    <main>
       <section class="stats">
<div class="box" id="totalItemsBox">📦 Items <br><?php echo $totalItems; ?></div>
<div class="box" id="totalOrdersBox">📤 Orders <br><?php echo $totalOrders; ?></div>
<div class="box" id="lowStockBox">🚨 Low Stock <br><?php echo $lowStock; ?></div>
<div class="box" id="totalUsersBox">👤 Users <br><?php echo $totalUsers; ?></div>

</section>


        <section id="chartBox">
            <canvas id="stockChart"></canvas>
        </section>

        <nav class="dashboard-links">
            <a href="inventory/add_item.php">Add Inventory</a>
            <a href="inventory/view_items.php">View Inventory</a>
            <a href="orders/create_order.php">Create Order</a>
            <a href="orders/view_orders.php">View Orders</a>
            <a href="reports_inventory.php">Inventory Report</a>
            <a href="reports_orders.php">Orders Report</a>
            <a href="users_manage.php">Manage Users</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
    </main>

    <footer>
        <p><b>Programmed by GCMS-II Mardan Students</b></p>
        <p><b>Zeeshan Khan | Muhammad Talha Shah | Ansar Shah</b></p>
    </footer>

    <script>
        const ctx = document.getElementById('stockChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($items); ?>,
                datasets: [{
                    label: 'Stock Level',
                    data: <?php echo json_encode($qty); ?>,
                    fill: true,
                    backgroundColor: 'rgba(31,60,136,0.15)',
                    borderColor: '#1f3c88',
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#1f3c88'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: true } },
                scales: { y: { beginAtZero: true } }
            }
        });
        // Highlight Low Stock if items <= 10
            const lowStock = <?php echo $lowStock; ?>;
            const lowStockBox = document.getElementById('lowStockBox');

            if(lowStock > 0){
        lowStockBox.style.background = '#ffcccc';
        lowStockBox.style.border = '2px solid #ff0000';
        }
        
        

        function animateCount(elementId, end){
    let count = 0;
    const speed = 50; // milliseconds
    const obj = document.getElementById(elementId);
    const interval = setInterval(() => {
        if(count >= end) clearInterval(interval);
        obj.innerHTML = obj.innerHTML.split('<br>')[0] + '<br>' + count;
        count++;
    }, speed);
}

animateCount('totalItemsBox', <?php echo $totalItems; ?>);
animateCount('totalOrdersBox', <?php echo $totalOrders; ?>);
animateCount('lowStockBox', <?php echo $lowStock; ?>);
animateCount('totalUsersBox', <?php echo $totalUsers; ?>);
    </script>
</body>
</html>

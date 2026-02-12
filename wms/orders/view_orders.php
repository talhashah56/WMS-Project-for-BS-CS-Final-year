<?php
include("../config/db.php");

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $result = mysqli_query($conn, "SELECT * FROM orders WHERE item_name LIKE '%$search%' OR id LIKE '%$search%'");
} else {
    $result = mysqli_query($conn, "SELECT * FROM orders");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orders List</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; margin:0; padding:40px; display:flex; flex-direction:column; align-items:center; }
        h2 { color:#2c3e50; font-size:2rem; margin-bottom:25px; }
        form { margin-bottom:20px; display:flex; gap:10px; }
        input[type="text"] { padding:10px; border-radius:20px; border:2px solid #ddd; flex:1; }
        input[type="text"]:focus { outline:none; border-color:#3498db; }
        button { padding:10px 20px; background:#667eea; color:white; border:none; border-radius:20px; cursor:pointer; }
        button:hover { opacity:0.9; }
        table { width:100%; max-width:1000px; border-collapse:collapse; background:white; border-radius:12px; overflow:hidden; box-shadow:0 10px 25px rgba(0,0,0,0.05); margin-bottom:30px; }
        th { background:#2c3e50; color:white; padding:15px; text-align:left; }
        td { padding:15px; border-bottom:1px solid #eee; }
        tr:hover { background:#f1f4ff; }
        .btn-delete { padding:6px 12px; background:#e74c3c; color:white; border-radius:6px; text-decoration:none; font-weight:bold; }
        .btn-delete:hover { background:#c0392b; }
    </style>
</head>
<body>

<h2>Orders List</h2>

<form method="GET">
    <input type="text" name="search" placeholder="Search by Order ID or Item Name" value="<?php echo htmlspecialchars($search); ?>">
    <button>Search</button>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Item</th>
    <th>Quantity</th>
    <th>Order Date</th>
    <th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['item_name']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['order_date']; ?></td>
    <td>
        <a href="delete_order.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this order?');" class="btn-delete">Delete</a>
    </td>
</tr>
<?php } ?>
</table>

<a href="../dashboard.php"><button>Back to Dashboard</button></a>

</body>
</html>

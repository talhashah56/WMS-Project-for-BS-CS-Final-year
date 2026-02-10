<?php
include("../config/db.php");
$result = mysqli_query($conn, "SELECT * FROM inventory");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory List</title>
    
    <style>
        .low { background:#ffcccc; }
        .ok { background:#ccffcc; }
        a{ margin:5px; }

        :root {
    --primary-bg: #f4f7f9;
    --nav-dark: #2c3e50;
    --danger: #e74c3c;
    --success: #2ecc71;
    --edit-blue: #3498db;
    --white: #ffffff;
}
    :root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --dark-blue: #2c3e50;
    --accent-blue: #3498db;
    --bg-light: #f8f9fa;}
body {
    font-family: 'Segoe UI', sans-serif;
    background-color: var(--primary-bg);
    margin: 0;
    padding: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

h2 {
    color: var(--nav-dark);
    font-size: 2rem;
    margin-bottom: 25px;
    border-bottom: 3px solid var(--edit-blue);
    padding-bottom: 10px;
}

/* Table Container */
.table-wrapper {
    width: 100%;
    max-width: 1100px;
    background: var(--white);
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    overflow: hidden; /* Rounds the table corners */
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background-color: var(--nav-dark);
    color: var(--white);
    text-align: left;
    padding: 15px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

td {
    padding: 15px;
    border-bottom: 1px solid #eee;
    color: #444;
    font-size: 0.95rem;
}

tr:hover {
    background-color: #f9fbff;
}

/* Status Badges */
.status-badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: bold;
    display: inline-block;
}

.status-badge.low {
    background-color: #ffdce0;
    color: var(--danger);
}

.status-badge.ok {
    background-color: #defadb;
    color: var(--success);
}

/* Action Buttons */
.btn-action {
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-right: 5px;
    transition: 0.2s;
}


.btn-delete {
    background: #ffe5e5;
    color: var(--danger);
}

.btn-delete:hover {
    background: var(--danger);
    color: white;
}

/* Back Link */
button {
    padding: 12px 25px;
    background: var(--primary-gradient);
    color: white;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    font-weight: bold;
    transition: opacity 0.3s;
}

button:hover {
    opacity: 0.9;
}
    </style>
</head>
<body>

<h2>Inventory Items</h2>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Item</th>
    <th>Quantity</th>
    <th>Location</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ 
$status = ($row['quantity'] <= 10) ? "LOW" : "OK";
$class  = ($row['quantity'] <= 10) ? "low" : "ok";
?>
<tr class="<?php echo $class; ?>">
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['item_name']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['location']; ?></td>
    <td><?php echo $status; ?></td>
    <td>
        <a href="delete_item.php?id=<?php echo $row['id']; ?>" 
           onclick="return confirm('Delete this item?')" class="btn-delete">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

<a href="../dashboard.php"><button class='back-btn'>Back to Dashboard</button></a>

</body>
</html>

<?php
include("../config/db.php");

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $result = mysqli_query($conn, 
        "SELECT * FROM inventory WHERE item_name LIKE '%$search%'");
} else {
    $result = mysqli_query($conn, "SELECT * FROM inventory");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory List</title>
  <style>
    :root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --dark-blue: #2c3e50;
    --accent-blue: #3498db;
    --bg-light: #f8f9fa;
}

body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: var(--bg-light); /* Lighter background for better table contrast */
    margin: 0;
    padding: 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

h2 {
    color: var(--dark-blue);
    margin-bottom: 20px;
    font-size: 2rem;
}

/* Search Bar Section */
form {
    margin-bottom: 30px;
    display: flex;
    gap: 10px;
    width: 100%;
    max-width: 600px;
}

input[type="text"] {
    flex: 1;
    padding: 12px 20px;
    border: 2px solid #ddd;
    border-radius: 30px; /* Rounded pill shape */
    font-size: 1rem;
    transition: border-color 0.3s;
}

input[type="text"]:focus {
    outline: none;
    border-color: var(--accent-blue);
}

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

/* Table Styling */
table {
    width: 100%;
    max-width: 1000px;
    background: white;
    border-collapse: collapse; /* Merges borders */
    border-radius: 15px;
    overflow: hidden; /* Clips corners to the border-radius */
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

th {
    background: var(--dark-blue);
    color: white;
    text-align: left;
    padding: 18px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 1px;
}

td {
    padding: 15px 18px;
    border-bottom: 1px solid #eee;
    color: #444;
}

/* Zebra Striping & Hover Effect */
tr:nth-child(even) {
    background-color: #fcfcfc;
}

tr:hover {
    background-color: #f1f4ff;
    transition: background 0.2s;
}

/* Back Button */
.btn-dashboard {
    text-decoration: none;
    color: var(--accent-blue);
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-dashboard:hover {
    text-decoration: underline;
}

/* Low Stock Warning Style */
.low-stock {
    color: #e74c3c;
    font-weight: bold;
}
  </style>
</head>
<body>

<h2>Inventory Items</h2>
<form method="GET">
    <input type="text" name="search" placeholder="Search item..." 
           value="<?php echo $search; ?>">
    <button>Search</button>
</form>
<br>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Item</th>
    <th>Quantity</th>
    <th>Location</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['item_name']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['location']; ?></td>
</tr>
<?php } ?>

</table>

<a href="../dashboard.php"><button>Back to Dashboard</button></a>

</body>
</html>

<?php
include("config/db.php");
$data = mysqli_query($conn,"SELECT * FROM inventory");
?>

<!DOCTYPE html>
<html>
<head>
<title>Inventory Report</title>

<style>
table{width:100%;border-collapse:collapse}
th,td{border:1px solid black;padding:6px;text-align:center}

:root {
    --report-blue: #2c3e50;
    --accent-blue: #3498db;
    --light-bg: #f9f9f9;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #525659; /* Dark grey background to make the "page" pop */
    margin: 0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* The Paper Sheet */
.report-container {
    background: white;
    width: 210mm; /* A4 Width */
    min-height: 297mm;
    padding: 50px;
    margin: 20px auto;
    box-shadow: 0 0 20px rgba(0,0,0,0.3);
    border-radius: 5px;
    position: relative;
}

h2 {
    color: var(--report-blue);
    text-transform: uppercase;
    letter-spacing: 2px;
    border-bottom: 2px solid var(--report-blue);
    padding-bottom: 10px;
    margin-bottom: 30px;
}

/* Metadata (Date/Time) */
.report-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    font-size: 0.9rem;
    color: #666;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th {
    background-color: #f2f2f2;
    color: var(--report-blue);
    font-weight: bold;
    text-transform: uppercase;
    font-size: 0.85rem;
    border: 1px solid #ddd;
    padding: 12px;
}

td {
    border: 1px solid #eee;
    padding: 10px;
    text-align: center;
    color: #333;
}

tr:nth-child(even) {
    background-color: #fafafa;
}

/* Print Button Styling */
.print-btn {
    background: var(--accent-blue);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 30px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transition: 0.3s;
    margin-bottom: 20px;
}

.print-btn:hover {
    background: var(--report-blue);
    transform: translateY(-2px);
}

/* --- PRINT MEDIA QUERIES --- */
@media print {
    body {
        background: white;
        padding: 0;
    }
    .report-container {
        box-shadow: none;
        margin: 0;
        width: 100%;
        padding: 0;
    }
    .print-btn, .back-link {
        display: none; /* Hide buttons when printing */
    }
    th {
        background-color: #eee !important;
        -webkit-print-color-adjust: exact;
    }
}
</style>
</head>
<body>

<h2 align="center">Warehouse Inventory Report</h2>

<table>
<tr>
<th>ID</th><th>Item</th><th>Quantity</th><th>Location</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['item_name'] ?></td>
<td><?= $row['quantity'] ?></td>
<td><?= $row['location'] ?></td>
</tr>
<?php } ?>

</table>

<br>
<button onclick="window.print()">Print Report</button>

</body>
</html>

<?php
include("config/db.php");
$data = mysqli_query($conn,"SELECT * FROM orders");
?>

<!DOCTYPE html>
<html>
<head>
<title>Orders Report</title>
<link rel="stylesheet" href="style.css">
<style>
table{width:100%;border-collapse:collapse}
th,td{border:1px solid black;padding:6px;text-align:center}

:root {
    --order-purple: #4b3077;
    --accent-purple: #8e44ad;
    --paper-bg: #fdfdfd;
}

body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: #4a4a4a; /* Dark background for focus */
    margin: 0;
    padding: 40px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* The A4 Paper Container */
.report-sheet {
    background: var(--paper-bg);
    width: 210mm;
    min-height: 297mm;
    padding: 60px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    border-radius: 4px;
}

h2 {
    color: var(--order-purple);
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 3px;
    border-bottom: 3px double var(--order-purple);
    padding-bottom: 15px;
    margin-bottom: 40px;
}

/* Metadata Bar */
.meta-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
    font-size: 0.9rem;
    color: #555;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

/* Table Design */
table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background-color: #f8f9fa;
    color: var(--order-purple);
    border: 1px solid #ddd;
    padding: 12px;
    font-size: 0.85rem;
}

td {
    border: 1px solid #eee;
    padding: 12px;
    text-align: center;
    color: #333;
}

tr:nth-child(even) {
    background-color: #fafaff;
}

/* Interactive Elements */
.action-area {
    margin-bottom: 25px;
    display: flex;
    gap: 15px;
}

.print-btn {
    background: var(--accent-purple);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 50px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.print-btn:hover {
    background: var(--order-purple);
    transform: scale(1.05);
}

.back-link {
    color: white;
    text-decoration: none;
    font-size: 0.9rem;
    margin-top: 20px;
    opacity: 0.7;
}

.back-link:hover { opacity: 1; }

/* Print Mode Adjustments */
@media print {
    body { background: white; padding: 0; }
    .report-sheet { box-shadow: none; margin: 0; width: 100%; padding: 0; }
    .action-area, .back-link { display: none; }
    th { background-color: #eee !important; -webkit-print-color-adjust: exact; }
}
</style>
</head>
<body>

<h2 align="center">Warehouse Orders Report</h2>

<table>
<tr>
<th>ID</th><th>Item</th><th>Quantity</th><th>Date</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['item_name'] ?></td>
<td><?= $row['quantity'] ?></td>
<td><?= $row['order_date'] ?></td>
</tr>
<?php } ?>

</table>

<br>
<button onclick="window.print()">Print Report</button>

</body>
</html>

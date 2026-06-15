<?php
include("db.php");

$result=
mysqli_query($conn,

"SELECT

purchase_orders.*,

suppliers.supplier_name

FROM purchase_orders

INNER JOIN suppliers
ON purchase_orders.supplier_id=suppliers.id

ORDER BY purchase_orders.id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<title>Purchase Orders</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="top-nav">

<a href="dashboard.php">
<button>Dashboard</button>
</a>

<a href="javascript:history.back()">
<button>Back</button>
</a>

</div>

<h1>

Purchase Orders

</h1>

<a href="add_purchase.php">

<button>

Add Purchase

</button>

</a>

<br><br>

<table>

<tr>

<th>ID</th>
<th>Supplier</th>
<th>Order Date</th>
<th>Total Amount</th>
<th>Status</th>

</tr>

<?php
while(
$row=
mysqli_fetch_assoc(
$result))
{
?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['supplier_name']; ?>
</td>

<td>
<?php echo $row['order_date']; ?>
</td>

<td>

₹<?php echo $row['total_amount']; ?>

</td>

<td>
<?php echo $row['status']; ?>
</td>

</tr>

<?php } ?>

</table>

</body>
</html>
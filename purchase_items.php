<?php
include("db.php");

$suppliers=
mysqli_query($conn,

"SELECT *
FROM suppliers");

if(isset($_POST['add_purchase']))
{

$supplier_id=
$_POST['supplier_id'];

$order_date=
$_POST['order_date'];

$total_amount=
$_POST['total_amount'];

$status=
$_POST['status'];

mysqli_query($conn,

"INSERT INTO purchase_orders

(

supplier_id,
order_date,
total_amount,
status

)

VALUES

(

'$supplier_id',
'$order_date',
'$total_amount',
'$status'

)");

header(
"Location: purchases.php");

exit();

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Purchase</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="top-nav">

<a href="purchases.php">
<button>Purchases</button>
</a>

<a href="javascript:history.back()">
<button>Back</button>
</a>

</div>

<div class="login-box">

<h2>

Add Purchase Order

</h2>

<form method="POST">

<select
name="supplier_id"
required>

<option value="">
Select Supplier
</option>

<?php
while(
$s=
mysqli_fetch_assoc(
$suppliers))
{
?>

<option
value="<?php echo $s['id']; ?>">

<?php
echo
$s['supplier_name'];
?>

</option>

<?php } ?>

</select>

<input
type="date"
name="order_date"
required>

<input
type="number"
step="0.01"
name="total_amount"
placeholder="Total Amount"
required>

<select
name="status"
required>

<option value="">
Select Status
</option>

<option value="Paid">
Paid
</option>

<option value="Pending">
Pending
</option>

</select>

<button
type="submit"
name="add_purchase">

Save Purchase

</button>

</form>

</div>

</body>
</html>
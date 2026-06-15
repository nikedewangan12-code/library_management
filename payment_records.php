<?php
include("db.php");

$purchases=
mysqli_query($conn,

"SELECT *

FROM purchase_orders

WHERE id NOT IN

(

SELECT purchase_id

FROM payment_records

WHERE payment_status='Paid'

)");

if(isset($_POST['add_payment']))
{

$purchase_id=
$_POST['purchase_id'];

$payment_method=
$_POST['payment_method'];

$amount=
$_POST['amount'];

$payment_status=
$_POST['payment_status'];

$payment_date=
$_POST['payment_date'];

mysqli_query($conn,

"INSERT INTO payment_records

(

purchase_id,
payment_method,
amount,
payment_status,
payment_date

)

VALUES

(

'$purchase_id',
'$payment_method',
'$amount',
'$payment_status',
'$payment_date'

)");

header(
"Location: payment_records.php");

exit();

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Payment Records</title>

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

Payment Records

</h1>

<div class="login-box">

<form method="POST">

<select
name="purchase_id"
id="purchase_id"
onchange="fillAmount()"
required>

<option value="">

Select Purchase Order

</option>

<?php
while(
$p=
mysqli_fetch_assoc(
$purchases))
{
?>

<option

value="<?php echo $p['id']; ?>"

data-amount=

"<?php echo $p['total_amount']; ?>">

Order #

<?php echo $p['id']; ?>

—

₹<?php echo $p['total_amount']; ?>

</option>

<?php } ?>

</select>

<select
name="payment_method"
required>

<option value="">
Payment Method
</option>

<option>
Cash
</option>

<option>
UPI
</option>

<option>
Card
</option>

<option>
Bank Transfer
</option>

</select>

<input

type="number"

step="0.01"

name="amount"

id="amount"

placeholder="Amount"

required>

<select
name="payment_status"
required>

<option>
Paid
</option>

<option>
Pending
</option>

</select>

<input
type="date"
name="payment_date"
required>

<button
type="submit"
name="add_payment">

Save Payment

</button>

</form>

</div>

<br>

<table>

<tr>

<th>ID</th>
<th>Purchase</th>
<th>Method</th>
<th>Amount</th>
<th>Status</th>
<th>Date</th>

</tr>

<?php

$result=
mysqli_query($conn,

"SELECT *

FROM payment_records

ORDER BY id DESC");

while(
$row=
mysqli_fetch_assoc(
$result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>
Order #
<?php echo $row['purchase_id']; ?>
</td>

<td><?php echo $row['payment_method']; ?></td>

<td>
₹<?php echo $row['amount']; ?>
</td>

<td><?php echo $row['payment_status']; ?></td>

<td><?php echo $row['payment_date']; ?></td>

</tr>

<?php } ?>

</table>

<script>

function fillAmount()
{

let select=

document
.getElementById(
'purchase_id');

let option=

select.options[
select.selectedIndex
];

let amount=

option.getAttribute(
'data-amount');

document
.getElementById(
'amount'
)

.value=

amount;

}

</script>

</body>
</html>
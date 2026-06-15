<?php
include("db.php");

$where="";

if(isset($_GET['search']))
{

$search=
mysqli_real_escape_string(
$conn,
$_GET['search']);

$where=

"WHERE

supplier_name
LIKE '%$search%'

OR

contact_person
LIKE '%$search%'

OR

phone
LIKE '%$search%'";
}

$result=
mysqli_query($conn,

"SELECT *

FROM suppliers

$where

ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<title>Suppliers</title>

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

<h1>Suppliers Management</h1>

<a href="add_supplier.php">
<button>

Add Supplier

</button>
</a>

<br><br>

<form method="GET">

<input
type="text"
name="search"
placeholder="Search Supplier">

<button
type="submit">

Search

</button>

</form>

<br>

<table>

<tr>

<th>ID</th>
<th>Supplier</th>
<th>Contact Person</th>
<th>Phone</th>
<th>Email</th>
<th>Action</th>

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
<?php echo $row['contact_person']; ?>
</td>

<td>
<?php echo $row['phone']; ?>
</td>

<td>
<?php echo $row['email']; ?>
</td>

<td>

<a href=
"add_supplier.php?id=<?php echo $row['id']; ?>">

<button>

Edit

</button>

</a>

<a href=
"delete_supplier.php?id=<?php echo $row['id']; ?>"

onclick=
"return confirm('Delete Supplier?')">

<button>

Delete

</button>

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>
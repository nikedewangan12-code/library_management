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

members.full_name
LIKE '%$search%'

OR

books.book_name
LIKE '%$search%'";
}

$result=mysqli_query($conn,

"SELECT fines.*,

members.full_name,

books.book_name

FROM fines

INNER JOIN members
ON fines.member_id=members.id

INNER JOIN books
ON fines.book_id=books.id

$where

ORDER BY fines.id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<title>Fine Management</title>

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

<h1>Fine Management</h1>

<form method="GET">

<input
type="text"
name="search"
placeholder="Search Member / Book">

<button
type="submit">

Search

</button>

</form>

<br>

<table>

<tr>

<th>ID</th>
<th>Member</th>
<th>Book</th>
<th>Fine</th>
<th>Date</th>
<th>Action</th>

</tr>

<?php
while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['full_name']; ?>
</td>

<td>
<?php echo $row['book_name']; ?>
</td>

<td>
₹<?php echo $row['fine_amount']; ?>
</td>

<td>
<?php echo $row['created_at']; ?>
</td>

<td>

<a

href=

"pay_fine.php?id=<?php echo $row['id']; ?>"

onclick=

"return confirm('Mark this fine as Paid?')"

>

<button>

Paid

</button>

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>
<?php

include("db.php");

$result=

mysqli_query($conn,

"SELECT

fines.*,

members.full_name,

books.book_name

FROM fines

INNER JOIN members
ON fines.member_id=members.id

INNER JOIN books
ON fines.book_id=books.id

ORDER BY fines.id DESC");

?>

<!DOCTYPE html>

<html>

<head>

<title>Fine Management</title>

<link
rel="stylesheet"
href="style.css">

</head>

<body>

<div class="top-nav">

<a href="dashboard.php">

<button>

Dashboard

</button>

</a>

</div>

<div class="login-box">

<h2>

Fine Management

</h2>

<table>

<tr>

<th>ID</th>

<th>Member</th>

<th>Book</th>

<th>Fine</th>

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

<?php echo $row['full_name']; ?>

</td>

<td>

<?php echo $row['book_name']; ?>

</td>

<td>

₹<?php echo $row['fine_amount']; ?>

</td>

<td>

<a

href=

"delete_fine.php?id=<?php echo $row['id']; ?>"

>

<button>

Paid

</button>

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>
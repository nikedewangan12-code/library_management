<?php

include("db.php");

$books=
mysqli_query($conn,

"SELECT *

FROM books");

if(isset($_POST['add_damage']))
{

$book_id=
$_POST['book_id'];

$damage_type=
$_POST['damage_type'];

$description=
$_POST['description'];

$report_date=
$_POST['report_date'];

mysqli_query($conn,

"INSERT INTO damaged_books

(

book_id,
damage_type,
description,
report_date

)

VALUES

(

'$book_id',

'$damage_type',

'$description',

'$report_date'

)");

$action=

"Book Damage Added";

mysqli_query($conn,

"INSERT INTO activity_logs

(

admin_id,
action,
activity_date

)

VALUES

(

'1',

'$action',

CURDATE()

)");

}

$result=
mysqli_query($conn,

"SELECT

damaged_books.*,

books.book_name

FROM damaged_books

LEFT JOIN books

ON damaged_books.book_id=
books.id

ORDER BY damaged_books.id DESC");

?>

<!DOCTYPE html>

<html>

<head>

<title>

Damaged Books

</title>

<link rel="stylesheet"
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

Damaged Books Management

</h2>

<form method="POST">

<select
name="book_id"
required>

<option value="">

Select Book

</option>

<?php
while(
$b=
mysqli_fetch_assoc(
$books))
{
?>

<option
value="<?php echo $b['id']; ?>">

<?php
echo
$b['book_name'];
?>

</option>

<?php } ?>

</select>

<select
name="damage_type"
required>

<option value="">
Select Damage
</option>

<option>
Damaged
</option>

<option>
Lost
</option>

<option>
Missing Pages
</option>

<option>
Repair Needed
</option>

</select>

<input
type="date"
name="report_date"
required>

<textarea
name="description"
placeholder="Description">
</textarea>

<button
type="submit"
name="add_damage">

Save

</button>

</form>

</div>

<br>

<table>

<tr>

<th>ID</th>
<th>Book</th>
<th>Damage</th>
<th>Description</th>
<th>Date</th>
<th>Status</th>
<th>

Action

</th>

</tr>

<?php
while(
$row=
mysqli_fetch_assoc(
$result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['book_name']; ?></td>

<td><?php echo $row['damage_type']; ?></td>

<td><?php echo $row['description']; ?></td>

<td><?php echo $row['report_date']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<?php

if($row['status']=="Pending")
{
?>

<a href=
"resolve_damage.php?id=<?php echo $row['id']; ?>">

<button>

Resolve

</button>

</a>

<?php
}
else
{

echo
"Completed";

}
?>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>
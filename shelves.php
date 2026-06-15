<?php

include("db.php");

if(isset($_POST['add_room']))
{

$room_name=
$_POST['room_name'];

mysqli_query($conn,

"INSERT INTO library_rooms
(room_name)

VALUES

('$room_name')");

}

if(isset($_POST['add_shelf']))
{

$room_id=
$_POST['room_id'];

$shelf_code=
$_POST['shelf_code'];

mysqli_query($conn,

"INSERT INTO book_shelves

(

room_id,
shelf_code

)

VALUES

(

'$room_id',

'$shelf_code'

)");

}

$rooms=
mysqli_query($conn,

"SELECT *

FROM library_rooms");

$result=
mysqli_query($conn,

"SELECT

book_shelves.*,

library_rooms.room_name

FROM book_shelves

LEFT JOIN library_rooms

ON book_shelves.room_id=
library_rooms.id

ORDER BY book_shelves.id DESC");

?>

<!DOCTYPE html>

<html>

<head>

<title>

Shelf Management

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

Add Room

</h2>

<form method="POST">

<input
type="text"
name="room_name"
placeholder="Room Name"
required>

<button
type="submit"
name="add_room">

Add Room

</button>

</form>

<br>

<h2>

Add Shelf

</h2>

<form method="POST">

<select
name="room_id"
required>

<option value="">

Select Room

</option>

<?php
while(
$r=
mysqli_fetch_assoc(
$rooms))
{
?>

<option
value="<?php echo $r['id']; ?>">

<?php
echo
$r['room_name'];
?>

</option>

<?php } ?>

</select>

<input
type="text"
name="shelf_code"
placeholder="Shelf Code"
required>

<button
type="submit"
name="add_shelf">

Add Shelf

</button>

</form>

</div>

<br>

<table>

<tr>

<th>ID</th>

<th>Room</th>

<th>Shelf</th>

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

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['room_name']; ?></td>

<td><?php echo $row['shelf_code']; ?></td>

<td>

<a href="delete_shelf.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Shelf?')">

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
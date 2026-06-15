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

$result=
mysqli_query($conn,

"INSERT INTO activity_logs
(admin_id,action,activity_date)

VALUES

(
'1',

'Added Room',

CURDATE()

)");
}

$result=
mysqli_query($conn,

"SELECT *

FROM library_rooms

ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>

Rooms Management

</title>

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

</div>

<br>

<table>

<tr>

<th>ID</th>
<th>Room Name</th>

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

<?php
echo $row['id'];
?>

</td>

<td>

<?php
echo $row['room_name'];
?>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>
<?php
include("db.php");

if(isset($_POST['add_publisher']))
{
$publisher_name=
$_POST['publisher_name'];

mysqli_query($conn,

"INSERT INTO publishers
(publisher_name)

VALUES

('$publisher_name')");

$action=

"Added Publisher: "

.$publisher_name;

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
"SELECT * FROM publishers");
?>

<!DOCTYPE html>
<html>

<head>

<title>Publishers</title>

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

<div class="login-box">

<h2>Publishers Management</h2>

<form method="POST">

<input
type="text"
name="publisher_name"
placeholder="Enter Publisher Name"
required>

<button
type="submit"
name="add_publisher">

Add Publisher

</button>

</form>

</div>

<br>

<table>

<tr>

<th>ID</th>
<th>Publisher</th>
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
<?php echo $row['publisher_name']; ?>
</td>

<td>

<a href="edit_publisher.php?id=<?php echo $row['id']; ?>">
<button>Edit</button>
</a>

<a href="delete_publisher.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Publisher?')">

<button>Delete</button>

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>
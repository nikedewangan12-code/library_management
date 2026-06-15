<?php
include("db.php");

if(isset($_POST['add_notification']))
{
$title=$_POST['title'];
$message=$_POST['message'];

mysqli_query($conn,

"INSERT INTO notifications

(

title,
message,
notification_date

)

VALUES

(

'$title',
'$message',
CURDATE()

)");

}

$result=mysqli_query($conn,

"SELECT * FROM notifications
ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<title>Notifications</title>

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

<h2>Notifications</h2>

<form method="POST">

<input
type="text"
name="title"
placeholder="Notification Title"
required>

<textarea
name="message"
placeholder="Notification Message"
required>
</textarea>

<button
type="submit"
name="add_notification">

Add Notification

</button>

</form>

</div>

<br>

<table>

<tr>

<th>ID</th>
<th>Title</th>
<th>Message</th>
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
<?php echo $row['title']; ?>
</td>

<td>
<?php echo $row['message']; ?>
</td>

<td>
<?php echo $row['notification_date']; ?>
</td>

<td>

<a href="edit_notification.php?id=<?php echo $row['id']; ?>">
<button>Edit</button>
</a>

<a href="delete_notification.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Notification?')">

<button>Delete</button>

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>
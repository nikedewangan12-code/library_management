<?php
include("db.php");

$id=$_GET['id'];

$result=mysqli_query($conn,

"SELECT * FROM notifications
WHERE id='$id'");

$row=mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
$title=$_POST['title'];
$message=$_POST['message'];

mysqli_query($conn,

"UPDATE notifications

SET

title='$title',
message='$message'

WHERE id='$id'");

$action=

"Updated Notification";

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

header("Location: notifications.php");
exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Notification</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="top-nav">

<a href="dashboard.php">
<button>Dashboard</button>
</a>

<a href="notifications.php">
<button>Back</button>
</a>

</div>

<div class="login-box">

<h2>Edit Notification</h2>

<form method="POST">

<input
type="text"
name="title"

value="<?php
echo $row['title'];
?>"

required>

<textarea
name="message"
required><?php
echo $row['message'];
?></textarea>

<button
type="submit"
name="update">

Update Notification

</button>

</form>

</div>

</body>
</html>
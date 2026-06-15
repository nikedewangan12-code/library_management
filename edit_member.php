<?php
include("db.php");

$id=$_GET['id'];

$result=mysqli_query($conn,
"SELECT * FROM members
WHERE id='$id'");

$row=mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
$name=$_POST['full_name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$department=$_POST['department'];
$address=$_POST['address'];

mysqli_query($conn,

"UPDATE members SET

full_name='$name',
email='$email',
phone='$phone',
department='$department',
address='$address'

WHERE id='$id'");

mysqli_query($conn,

"INSERT INTO activity_logs
(admin_id,action)

VALUES

('1',
'Updated Member')");

$action=

"Updated Member: "

.$full_name;

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

header
    ("Location: members.php");
exit();
}
?>
<!DOCTYPE html>
<html>

<head>

<title>Edit Member</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="top-nav">

<a href="dashboard.php">
<button>Dashboard</button>
</a>

<a href="members.php">
<button>Back</button>
</a>

</div>

<div class="login-box">

<h2>Edit Member</h2>

<form method="POST">

<input
type="text"
name="full_name"

value="<?php
echo $row['full_name'];
?>"

required>

<input
type="email"
name="email"

value="<?php
echo $row['email'];
?>"

required>

<input
type="text"
name="phone"

value="<?php
echo $row['phone'];
?>"

required>

<input
type="text"
name="department"

value="<?php
echo $row['department'];
?>"

required>

<textarea
name="address"><?php
echo $row['address'];
?></textarea>

<button
type="submit"
name="update">

Update Member

</button>

</form>

</div>

</body>
</html>
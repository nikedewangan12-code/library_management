<?php
include("db.php");

$id=$_GET['id'];

$result=mysqli_query($conn,

"SELECT * FROM publishers
WHERE id='$id'");

$row=mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
$publisher_name=
$_POST['publisher_name'];

mysqli_query($conn,

"UPDATE publishers

SET publisher_name='$publisher_name'

WHERE id='$id'");

$action=

"Updated Publisher";

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

header("Location: publishers.php");
exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Publisher</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="top-nav">

<a href="dashboard.php">
<button>Dashboard</button>
</a>

<a href="publishers.php">
<button>Back</button>
</a>

</div>

<div class="login-box">

<h2>Edit Publisher</h2>

<form method="POST">

<input
type="text"
name="publisher_name"

value="<?php
echo $row['publisher_name'];
?>"

required>

<button
type="submit"
name="update">

Update Publisher

</button>

</form>

</div>

</body>
</html>
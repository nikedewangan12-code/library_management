<?php
include("db.php");

$id=$_GET['id'];

$result=mysqli_query($conn,

"SELECT * FROM categories
WHERE id='$id'");

$row=mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
$category_name=
$_POST['category_name'];

mysqli_query($conn,

"UPDATE categories

SET category_name='$category_name'

WHERE id='$id'");

$action=

"Updated Category";

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

header("Location: categories.php");
exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Category</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="top-nav">

<a href="dashboard.php">
<button>Dashboard</button>
</a>

<a href="categories.php">
<button>Back</button>
</a>

</div>

<div class="login-box">

<h2>Edit Category</h2>

<form method="POST">

<input
type="text"
name="category_name"

value="<?php
echo $row['category_name'];
?>"

required>

<button
type="submit"
name="update">

Update Category

</button>

</form>

</div>

</body>
</html>
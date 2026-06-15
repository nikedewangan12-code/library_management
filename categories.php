<?php
include("db.php");

if(isset($_POST['add_category']))
{
$category_name=
$_POST['category_name'];

mysqli_query($conn,

"INSERT INTO categories
(category_name)

VALUES

('$category_name')");

$action=

"Added Category: "

.$category_name;

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
"SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>

<head>

<title>Categories</title>

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

<h2>Categories Management</h2>

<form method="POST">

<input
type="text"
name="category_name"
placeholder="Enter Category Name"
required>

<button
type="submit"
name="add_category">

Add Category

</button>

</form>

</div>

<br>

<table>

<tr>

<th>ID</th>
<th>Category</th>
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
<?php echo $row['category_name']; ?>
</td>

<td>

<a href="edit_category.php?id=<?php echo $row['id']; ?>">
<button>Edit</button>
</a>

<a href="delete_category.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Category?')">

<button>Delete</button>

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>
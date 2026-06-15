<?php
include("db.php");

$id=$_GET['id'];

$authors=mysqli_query($conn,"SELECT * FROM authors");
$categories=mysqli_query($conn,"SELECT * FROM categories");
$publishers=mysqli_query($conn,"SELECT * FROM publishers");

$result=mysqli_query($conn,
"SELECT * FROM books WHERE id='$id'");

$row=mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
$book_name=$_POST['book_name'];
$author_id=$_POST['author_id'];
$category_id=$_POST['category_id'];
$publisher_id=$_POST['publisher_id'];
$isbn=$_POST['isbn'];
$quantity=$_POST['quantity'];

mysqli_query($conn,

"UPDATE books SET

book_name='$book_name',
author_id='$author_id',
category_id='$category_id',
publisher_id='$publisher_id',
isbn='$isbn',
quantity='$quantity'

WHERE id='$id'");

mysqli_query($conn,

"INSERT INTO activity_logs
(admin_id,action)

VALUES

('1',
'Updated Book')");

$action=

"Updated Book: "

.$book_name;

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

header("Location: books.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Book</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="top-nav">

<a href="dashboard.php">
<button>Dashboard</button>
</a>

<a href="books.php">
<button>Back</button>
</a>

</div>

<div class="login-box">

<h2>Edit Book</h2>

<form method="POST">

<input
type="text"
name="book_name"

value="<?php echo $row['book_name']; ?>"

required>

<select name="author_id">

<?php
while($a=mysqli_fetch_assoc($authors))
{
?>

<option
value="<?php echo $a['id']; ?>">

<?php
echo $a['author_name'];
?>

</option>

<?php } ?>

</select>

<select name="category_id">

<?php
while($c=mysqli_fetch_assoc($categories))
{
?>

<option
value="<?php echo $c['id']; ?>">

<?php
echo $c['category_name'];
?>

</option>

<?php } ?>

</select>

<select name="publisher_id">

<?php
while($p=mysqli_fetch_assoc($publishers))
{
?>

<option
value="<?php echo $p['id']; ?>">

<?php
echo $p['publisher_name'];
?>

</option>

<?php } ?>

</select>

<input
type="text"
name="isbn"

value="<?php echo $row['isbn']; ?>"

required>

<input
type="number"
name="quantity"

value="<?php echo $row['quantity']; ?>"

required>

<button
type="submit"
name="update">

Update Book

</button>

</form>

</div>

</body>
</html>
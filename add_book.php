<?php
include("db.php");

$authors =
mysqli_query($conn,
"SELECT * FROM authors");

$categories =
mysqli_query($conn,
"SELECT * FROM categories");

$publishers =
mysqli_query($conn,
"SELECT * FROM publishers");

$shelves=

mysqli_query($conn,

"SELECT *

FROM book_shelves");

if(isset($_POST['add_book']))
{
$book_name=$_POST['book_name'];
$author_id=$_POST['author_id'];
$category_id=$_POST['category_id'];
$publisher_id=$_POST['publisher_id'];
$isbn=$_POST['isbn'];
$quantity=$_POST['quantity'];
$shelf_id=

$_POST['shelf_id'];

mysqli_query($conn,

"INSERT INTO books
(book_name,author_id,
category_id,publisher_id,
isbn,quantity,shelf_id)

VALUES

('$book_name',
'$author_id',
'$category_id',
'$publisher_id',
'$isbn',
'$quantity',
'$shelf_id')");

$action=

"Added Book: "

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

<title>Add Book</title>

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

<h2>Add Book</h2>

<form method="POST">

<input
type="text"
name="book_name"
placeholder="Book Name"
required>

<select
name="author_id"
required>

<option value="">
Select Author
</option>

<?php while($a=mysqli_fetch_assoc($authors)) { ?>

<option
value="<?php echo $a['id']; ?>">

<?php
echo $a['author_name'];
?>

</option>

<?php } ?>

</select>

<select
name="category_id"
required>

<option value="">
Select Category
</option>

<?php while($c=mysqli_fetch_assoc($categories)) { ?>

<option
value="<?php echo $c['id']; ?>">

<?php
echo $c['category_name'];
?>

</option>

<?php } ?>

</select>

<select
name="publisher_id"
required>

<option value="">
Select Publisher
</option>

<?php while($p=mysqli_fetch_assoc($publishers)) { ?>

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
placeholder="ISBN"
required>

<select

name="shelf_id"

required>

<option value="">

Select Shelf

</option>

<?php
while(
$s=
mysqli_fetch_assoc(
$shelves))
{
?>

<option
value="<?php echo $s['id']; ?>">

<?php
echo
$s['shelf_code'];
?>

</option>

<?php } ?>

</select>

<input
type="number"
name="quantity"
placeholder="Quantity"
required>

<button
type="submit"
name="add_book">

Add Book

</button>

</form>

</div>

</body>
</html>
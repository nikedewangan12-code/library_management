<?php
include("db.php");

$where="";

if(isset($_GET['search']))
{

$search=
mysqli_real_escape_string(
$conn,
$_GET['search']);

$where=

"WHERE

books.book_name
LIKE '%$search%'

OR

authors.author_name
LIKE '%$search%'

OR

categories.category_name
LIKE '%$search%'";
}

$result=mysqli_query($conn,

"SELECT books.*,

authors.author_name,

categories.category_name,

publishers.publisher_name,

book_shelves.shelf_code

FROM books

LEFT JOIN authors
ON books.author_id=authors.id

LEFT JOIN categories
ON books.category_id=categories.id

LEFT JOIN publishers
ON books.publisher_id=publishers.id

LEFT JOIN book_shelves

ON books.shelf_id=
book_shelves.id

$where

ORDER BY books.id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<title>Books Management</title>

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

<h1>Books Management</h1>

<a href="add_book.php">
<button>Add New Book</button>
</a>

<br><br>

<form method="GET">

<input
type="text"
name="search"
placeholder="Search Book / Author / Category">

<button
type="submit">

Search

</button>

</form>

<br>

<table>

<tr>

<th>ID</th>
<th>Book</th>
<th>Author</th>
<th>Category</th>
<th>Publisher</th>
<th>ISBN</th>
<th>Qty</th>
<th>Shelf</th>
<th>Action</th>

</tr>

<?php
while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['book_name']; ?></td>

<td><?php echo $row['author_name']; ?></td>

<td><?php echo $row['category_name']; ?></td>

<td><?php echo $row['publisher_name']; ?></td>

<td><?php echo $row['isbn']; ?></td>

<td><?php echo $row['quantity']; ?></td>

<td>

<?php

echo

$row['shelf_code'];

?>

</td>

<td>

<a href=
"edit_book.php?id=<?php echo $row['id']; ?>">

<button>Edit</button>

</a>

<a href=
"delete_book.php?id=<?php echo $row['id']; ?>"

onclick=
"return confirm('Delete Book?')">

<button>Delete</button>

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>
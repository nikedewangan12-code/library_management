<?php
include("db.php");

if(isset($_POST['add_author']))
{
    $author_name = $_POST['author_name'];

    mysqli_query($conn,

    "INSERT INTO authors
    (author_name)

    VALUES

    ('$author_name')");

    $action =

    "Added Author: "

    .$author_name;

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

$result =
mysqli_query($conn,
"SELECT * FROM authors");
?>

<!DOCTYPE html>
<html>

<head>

<title>Authors</title>

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

<br><br>

<div class="login-box">

<h2>Authors Management</h2>

<form method="POST">

<input
type="text"
name="author_name"
placeholder="Enter Author Name"
required>

<button
type="submit"
name="add_author">

Add Author

</button>

</form>

</div>

<br>

<table>

<tr>

<th>ID</th>
<th>Author</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['author_name']; ?>
</td>

<td>

<a href="edit_author.php?id=<?php echo $row['id']; ?>">
<button>Edit</button>
</a>

<a href="delete_author.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Author?')">

<button>Delete</button>

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>
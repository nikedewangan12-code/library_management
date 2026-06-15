<?php
include("db.php");

$id = $_GET['id'];

$result =
mysqli_query($conn,

"SELECT * FROM authors
WHERE id='$id'");

$row =
mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
$author_name =
$_POST['author_name'];

mysqli_query($conn,

"UPDATE authors

SET author_name='$author_name'

WHERE id='$id'");

$action=

"Updated Author";

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

header("Location: authors.php");
exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Author</title>

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

<a href="authors.php">
<button>Back</button>
</a>

<h2>Edit Author</h2>

<form method="POST">

<input
type="text"
name="author_name"

value="<?php
echo $row['author_name'];
?>"

required>

<button
type="submit"
name="update">

Update Author

</button>

</form>

</div>

</body>
</html>
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

full_name
LIKE '%$search%'

OR

email
LIKE '%$search%'

OR

department
LIKE '%$search%'";
}

if(
isset($_GET['department'])
&&
$_GET['department']!=""
)
{

$dept=
mysqli_real_escape_string(
$conn,
$_GET['department']);

if(empty($where))
{
$where=
"WHERE department='$dept'";
}
else
{
$where.=
" AND department='$dept'";
}

}

$result=mysqli_query($conn,

"SELECT * FROM members

$where

ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<title>Members Management</title>

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

<h1>Members Management</h1>

<a href="add_member.php">
<button>Add Member</button>
</a>

<br><br>

<form method="GET">

<input
type="text"
name="search"
placeholder="Search Name / Email / Department">

<select name="department">

<option value="">
All Departments
</option>

<option value="BCA">
BCA
</option>

<option value="BCom">
BCom
</option>

<option value="MCA">
MCA
</option>

<option value="MBA">
MBA
</option>

</select>

<button type="submit">

Search

</button>

</form>

<br>

<table>

<tr>

<th>ID</th>
<th>Name</th>
<th>Department</th>
<th>Email</th>
<th>Phone</th>
<th>Action</th>

</tr>

<?php
while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['department']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td>

<a href=
"edit_member.php?id=<?php echo $row['id']; ?>">

<button>Edit</button>

</a>

<a href=
"delete_member.php?id=<?php echo $row['id']; ?>"

onclick=
"return confirm('Delete Member?')">

<button>Delete</button>

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>
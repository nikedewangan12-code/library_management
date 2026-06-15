<?php
include("db.php");

$filter="";

if(isset($_GET['type']))
{
$type=$_GET['type'];

if($type=="issue")
{
$filter=
"WHERE action LIKE '%Issued Book%'";
}

elseif($type=="return")
{
$filter=
"WHERE action LIKE '%Returned Book%'";
}
}

if(isset($_GET['search']))
{

$search=
mysqli_real_escape_string(
$conn,
$_GET['search']
);

if(empty($filter))
{
$filter=
"WHERE action LIKE '%$search%'";
}
else
{
$filter.=
" AND action LIKE '%$search%'";
}

}

$result=mysqli_query($conn,

"SELECT activity_logs.*,
admins.username

FROM activity_logs

LEFT JOIN admins
ON activity_logs.admin_id=admins.id

$filter

ORDER BY activity_logs.id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<title>Activity Logs</title>

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

<h1>Activity Logs</h1>

<div class="top-nav">

<a href="activity_logs.php">
<button>All</button>
</a>

<a href="?type=issue">
<button>Issue Books</button>
</a>

<a href="?type=return">
<button>Return Books</button>
</a>

</div>

<form method="GET">

<input
type="text"
name="search"
placeholder="Search member / book name">

<button
type="submit">

Search

</button>

</form>

<br>

<table>

<tr>

<th>ID</th>
<th>Admin</th>
<th>Action</th>
<th>Date</th>

</tr>

<?php
while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['action']; ?></td>

<td>

<?php

echo

$row['activity_date'];

?>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>
<?php
include("db.php");

$total_books =
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM books"));

$total_members =
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM members"));

$total_issued =
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM issued_books"));

$total_returned =
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM returned_books"));

$total_fines =
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM fines"));
?>

<!DOCTYPE html>
<html>

<head>

<title>Reports</title>

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

<div class="main">

<h1>Reports & Analytics</h1>

<br>

<a href="export_books.php">

<button>

Download Books Report

</button>

</a>


<br><br>

<a href="export_members.php">

<button>

Download Members Report

</button>

</a>

<div class="cards">

<div class="card">
<h2>Total Books</h2>
<p><?php echo $total_books; ?></p>
</div>

<div class="card">
<h2>Total Members</h2>
<p><?php echo $total_members; ?></p>
</div>

<div class="card">
<h2>Issued Books</h2>
<p><?php echo $total_issued; ?></p>
</div>

<div class="card">
<h2>Returned Books</h2>
<p><?php echo $total_returned; ?></p>
</div>

<div class="card">
<h2>Fine Records</h2>
<p><?php echo $total_fines; ?></p>
</div>

</div>

<br><br>

<table>

<tr>

<th>Module</th>
<th>Total Count</th>

</tr>

<tr>
<td>Books</td>
<td><?php echo $total_books; ?></td>
</tr>

<tr>
<td>Members</td>
<td><?php echo $total_members; ?></td>
</tr>

<tr>
<td>Issued Books</td>
<td><?php echo $total_issued; ?></td>
</tr>

<tr>
<td>Returned Books</td>
<td><?php echo $total_returned; ?></td>
</tr>

<tr>
<td>Fine Records</td>
<td><?php echo $total_fines; ?></td>
</tr>

</table>

</div>

</body>
</html>
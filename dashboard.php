<?php
session_start();

include("db.php");

if(!isset($_SESSION['admin']))
{
header("Location: login.php");
exit();
}

$settings=mysqli_query($conn,
"SELECT * FROM library_settings LIMIT 1");

$setting=mysqli_fetch_assoc($settings);

$total_books=
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM books"));

$total_members=
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM members"));

$total_issued=
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM issued_books"));

$total_fines=
mysqli_num_rows(
mysqli_query($conn,
"SELECT * FROM fines"));

$recent_logs=
mysqli_query($conn,

"SELECT *
FROM activity_logs
ORDER BY id DESC
LIMIT 5");

$low_stock=
mysqli_query($conn,

"SELECT *
FROM books
WHERE quantity<=2
ORDER BY quantity ASC");

$due_books=
mysqli_query($conn,

"SELECT

issued_books.*,

members.full_name,

books.book_name

FROM issued_books

INNER JOIN members
ON issued_books.member_id=members.id

INNER JOIN books
ON issued_books.book_id=books.id

ORDER BY due_date ASC

LIMIT 5");
?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="sidebar">

<h2>📚 Library Admin</h2>

<a href="dashboard.php"><button>Dashboard</button></a>

<a href="books.php"><button>Books</button></a>

<a href="authors.php"><button>Authors</button></a>

<a href="categories.php"><button>Categories</button></a>

<a href="publishers.php"><button>Publishers</button></a>

<a href="supplier.php">
<button>Suppliers</button>
</a>

<a href="shelves.php">

<button>

Shelf Management

</button>

</a>

<a href="damaged_books.php">

<button>

Damaged Books

</button>

</a>

<a href="purchases.php">
<button>Purchases</button>
</a>

<a href="purchase_items.php">
<button>Purchase Items</button>
</a>

<a href="payment_records.php">
<button>Payment Records</button>
</a>

<a href="members.php"><button>Members</button></a>

<a href="issue_book.php"><button>Issue Book</button></a>

<a href="return_book.php"><button>Return Book</button></a>

<a href="activity_logs.php"><button>Activity Logs</button></a>

<a href="fines.php"><button>Fine Management</button></a>

<a href="reports.php"><button>Reports</button></a>

<a href="notifications.php"><button>Notifications</button></a>

<a href="settings.php"><button>Settings</button></a>

<a href="logout.php"><button>Logout</button></a>

</div>

<div class="main">

<h1>

<?php
echo
$setting['library_name'];
?>

Dashboard

</h1>

<h3>

Welcome,
<?php echo $_SESSION['admin']; ?>

</h3>

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
<h2>Fine Records</h2>
<p><?php echo $total_fines; ?></p>
</div>

</div>

<br><br>

<h2>Analytics</h2>

<div class="cards">

<div class="card">

<h3>Books</h3>

<div
style="
background:#38bdf8;
height:25px;
width:<?php echo $total_books*20; ?>px;
border-radius:10px;">

</div>

<p><?php echo $total_books; ?></p>

</div>

<div class="card">

<h3>Members</h3>

<div
style="
background:#22c55e;
height:25px;
width:<?php echo $total_members*20; ?>px;
border-radius:10px;">

</div>

<p><?php echo $total_members; ?></p>

</div>

<div class="card">

<h3>Fines</h3>

<div
style="
background:#ef4444;
height:25px;
width:<?php echo $total_fines*20; ?>px;
border-radius:10px;">

</div>

<p><?php echo $total_fines; ?></p>

</div>

</div>

<br><br>

<div class="card">

<h2>

⚠ Low Stock Alerts

</h2>

<?php
while(
$book=
mysqli_fetch_assoc(
$low_stock))
{
?>

<p>

<?php
echo
$book['book_name'];
?>

—

<?php

if($book['quantity']==0)
{
echo "Out Of Stock";
}
else
{
echo
"Only "
.$book['quantity']
." Left";
}

?>

</p>

<hr>

<?php } ?>

</div>

<br><br>

<div class="card">

<h2>

⏰ Due / Overdue Books

</h2>

<?php
while(
$due=
mysqli_fetch_assoc(
$due_books))
{
?>

<p>

<?php
echo
$due['full_name'];
?>

—

<?php
echo
$due['book_name'];
?>

<br>

Due:

<?php
echo
$due['due_date'];
?>

<?php

if(
strtotime($due['due_date'])
<
time()
)
{
?>

<br>

<b style="color:red;">

OVERDUE

</b>

<?php } ?>

</p>

<hr>

<?php } ?>

</div>

<br><br>

<div class="card">

<h2>

Recent Activity

</h2>

<?php
while(
$log=
mysqli_fetch_assoc(
$recent_logs))
{
?>

<p>

<?php
echo
$log['action'];
?>

</p>

<hr>

<?php } ?>

</div>

</div>
<style>

#aiBtn{

position:fixed;

right:25px;
bottom:25px;

width:75px;
height:75px;

border:none;

border-radius:50%;

background:linear-gradient(
135deg,
#2563eb,
#7c3aed
);

color:white;

font-size:32px;

cursor:pointer;

box-shadow:
0 0 25px #2563eb;

z-index:99999;

transition:.3s;

}

#aiBtn:hover{

transform:scale(1.08);

}

#aiBox{

display:none;

position:fixed;

right:25px;
bottom:120px;

width:400px;

background:
rgba(15,23,42,.97);

backdrop-filter:
blur(12px);

border-radius:28px;

padding:20px;

box-shadow:
0 0 40px black;

z-index:99999;

animation:
fade .3s ease;

}

@keyframes fade{

from{
opacity:0;
transform:translateY(20px);
}

to{
opacity:1;
transform:translateY(0px);
}

}

.aiHeader{

display:flex;

justify-content:space-between;

align-items:center;

margin-bottom:18px;

}

.aiTitle{

font-size:22px;

font-weight:bold;

color:#fff;

}

.aiClose{

cursor:pointer;

font-size:24px;

color:#ef4444;

}

.aiGrid{

display:grid;

grid-template-columns:1fr 1fr;

gap:12px;

}

.aiGrid button{

padding:14px;

border:none;

border-radius:16px;

background:#334155;

color:white;

cursor:pointer;

font-weight:bold;

transition:.2s;

}

.aiGrid button:hover{

background:#2563eb;

transform:translateY(-2px);

}

#botAnswer{

margin-top:18px;

background:#111827;

border-radius:18px;

padding:18px;

color:#22c55e;

min-height:90px;

max-height:250px;

overflow:auto;

line-height:1.7;

}

</style>

<button id="aiBtn">

🤖

</button>

<div id="aiBox">

<div class="aiHeader">

<div class="aiTitle">

Library Assistant

</div>

<div
class="aiClose"

onclick="closeBot()">

✕

</div>

</div>

<div class="aiGrid">

<button onclick="askBot('books')">

📚 Total Books

</button>

<button onclick="askBot('members')">

👥 Total Members

</button>

<button onclick="askBot('issued')">

📕 Issued Books

</button>

<button onclick="askBot('returned')">

📗 Returned Books

</button>

<button onclick="askBot('stock')">

⚠ Low Stock

</button>

<button onclick="askBot('fines')">

💰 Total Fines

</button>

<button onclick="askBot('latest_member')">

🆕 Latest Member

</button>

<button onclick="askBot('latest_book')">

🆕 Latest Book

</button>

<button onclick="askBot('suppliers')">

🚚 Suppliers

</button>

<button onclick="askBot('orders')">

🛒 Orders

</button>

<button onclick="askBot('latest_issued')">

📘 Latest Issued

</button>

<button onclick="askBot('latest_returned')">

📗 Latest Returned

</button>

<button onclick="askBot('pending_payments')">

⏳ Pending Payments

</button>

<button onclick="askBot('highest_fine')">

💸 Highest Fine

</button>

<button onclick="askBot('latest_supplier')">

🚚 Latest Supplier

</button>

</div>

<div id="botAnswer">

Choose a question.

</div>

</div>

<script>

document
.getElementById(
'aiBtn')

.onclick=function(){

let box=

document
.getElementById(
'aiBox');

box.style.display=

box.style.display=="block"

?

"none"

:

"block";

}

function closeBot(){

document
.getElementById(
'aiBox')

.style.display='none';

}

function askBot(q)
{

let xhr=
new XMLHttpRequest();

xhr.open(
"POST",
"chatbot_response.php",
true);

xhr.setRequestHeader(

"Content-type",

"application/x-www-form-urlencoded"

);

xhr.onload=function(){

document
.getElementById(
'botAnswer')

.innerHTML=

this.responseText;

}

xhr.send(
"question="+q);

}

</script>
</body>
</html>
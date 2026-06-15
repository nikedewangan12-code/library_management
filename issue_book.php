<?php

include("db.php");

$message="";

$members=

mysqli_query($conn,

"SELECT *

FROM members

ORDER BY full_name ASC");

$books=

mysqli_query($conn,

"SELECT *

FROM books

WHERE quantity>0

ORDER BY book_name ASC");

if(isset($_POST['issue']))
{

$member_id=
$_POST['member_id'];

$book_id=
$_POST['book_id'];

$issue_date=
$_POST['issue_date'];

$due_date=
$_POST['due_date'];

mysqli_query($conn,

"INSERT INTO issued_books

(

member_id,
book_id,
issue_date,
due_date,
status

)

VALUES

(

'$member_id',

'$book_id',

'$issue_date',

'$due_date',

'Issued'

)");

mysqli_query($conn,

"UPDATE books

SET quantity=
quantity-1

WHERE id='$book_id'");

$member_data=
mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT full_name

FROM members

WHERE id='$member_id'"));

$book_data=
mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT book_name

FROM books

WHERE id='$book_id'"));

$action=

"Issued Book: "

.$book_data['book_name']

." by "

.$member_data['full_name'];

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

'$issue_date'

)");

$message=

"✅ Book Issued Successfully";

}
?>

<!DOCTYPE html>

<html>

<head>

<title>

Issue Book

</title>

<link
rel="stylesheet"
href="style.css">

</head>

<body>

<div class="top-nav">

<a href="dashboard.php">

<button>

Dashboard

</button>

</a>

<a href="javascript:history.back()">

<button>

Back

</button>

</a>

</div>

<div class="login-box">

<h2>

Issue Book

</h2>

<?php
if(!empty($message))
{
?>

<div

style="

background:#16a34a;

color:white;

padding:15px;

border-radius:12px;

margin-bottom:15px;

font-weight:bold;

">

<?php
echo $message;
?>

</div>

<?php } ?>

<form method="POST">

<select
name="member_id"
required>

<option value="">

Select Member

</option>

<?php
while(
$m=
mysqli_fetch_assoc(
$members))
{
?>

<option
value="<?php echo $m['id']; ?>">

<?php
echo
$m['full_name'];
?>

</option>

<?php } ?>

</select>

<br><br>

<select
name="book_id"
required>

<option value="">

Select Book

</option>

<?php
while(
$b=
mysqli_fetch_assoc(
$books))
{
?>

<option
value="<?php echo $b['id']; ?>">

<?php

echo

$b['book_name']

." ("

.$b['quantity']

." left)";

?>

</option>

<?php } ?>

</select>

<br><br>

<label>

Issue Date

</label>

<input

type="date"

name="issue_date"

required>

<br><br>

<label>

Due Date

</label>

<input

type="date"

name="due_date"

required>

<br><br>

<button
type="submit"
name="issue">

Issue Book

</button>

</form>

</div>

</body>

</html>
<?php
include("db.php");

$message="";

$issued=mysqli_query($conn,

"SELECT

issued_books.id,
issued_books.member_id,
issued_books.book_id,
issued_books.due_date,

members.full_name,
members.department,

books.book_name

FROM issued_books

INNER JOIN members
ON issued_books.member_id=members.id

INNER JOIN books
ON issued_books.book_id=books.id");

if(isset($_POST['return_book']))
{

$issue_id=
$_POST['issue_id'];

$return_date=
$_POST['return_date'];

$issue_result=
mysqli_query($conn,

"SELECT *

FROM issued_books

WHERE id='$issue_id'");

if(mysqli_num_rows($issue_result)>0)
{

$issue_data=
mysqli_fetch_assoc(
$issue_result);

$member_id=
$issue_data['member_id'];

$book_id=
$issue_data['book_id'];

$due_date=
$issue_data['due_date'];

$message=
"Book Returned Successfully";

$days_late=0;

if(
!empty($due_date)
&&
$due_date!="0000-00-00"
)
{

$due_timestamp=
strtotime($due_date);

$return_timestamp=
strtotime($return_date);

if(
$due_timestamp!==false
&&
$return_timestamp!==false
)
{

if(
$return_timestamp>
$due_timestamp
)
{

$days_late=

round(

(
$return_timestamp
-
$due_timestamp
)

/86400

);

}

}

}

if($days_late<0)
{
$days_late=0;
}

if($days_late>365)
{
$days_late=0;
}

if($days_late>0)
{

$fine_amount=
$days_late*10;

mysqli_query($conn,

"INSERT INTO fines

(

member_id,
book_id,
fine_amount

)

VALUES

(

'$member_id',

'$book_id',

'$fine_amount'

)");

$message=

"Fine Generated: ₹"

.$fine_amount;

}

mysqli_query($conn,

"INSERT INTO returned_books

(

member_id,
book_id,
return_date

)

VALUES

(

'$member_id',

'$book_id',

'$return_date'

)");

mysqli_query($conn,

"UPDATE books

SET quantity=
quantity+1

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

"Returned Book: "

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

'$return_date'

)");

mysqli_query($conn,

"DELETE FROM issued_books

WHERE id='$issue_id'");

$message=

$message

." | Issue Record Removed";

}

}
?>

<!DOCTYPE html>

<html>

<head>

<title>

Return Book

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

Return Book

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
name="issue_id"
required>

<option value="">
Select Issued Book
</option>

<?php
while(
$r=
mysqli_fetch_assoc(
$issued))
{
?>

<option
value="<?php echo $r['id']; ?>">

<?php

echo

$r['full_name']

." ("

.$r['department']

.") - "

.$r['book_name'];

?>

</option>

<?php } ?>

</select>

<br><br>

<input
type="date"
name="return_date"
required>

<br><br>

<button
type="submit"
name="return_book">

Return Book

</button>

</form>

</div>

</body>

</html>
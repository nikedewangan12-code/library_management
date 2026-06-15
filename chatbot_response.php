<?php

include("db.php");

$q=$_POST['question'];

$answer="No Data Found";

if($q=="books")
{

$r=mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT COUNT(*) total
FROM books"));

$answer=

"📚 Total Books: "

.$r['total'];

}

elseif($q=="members")
{

$r=mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT COUNT(*) total
FROM members"));

$answer=

"👥 Total Members: "

.$r['total'];

}

elseif($q=="issued")
{

$r=mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT COUNT(*) total
FROM issued_books"));

$answer=

"📕 Issued Books: "

.$r['total'];

}

elseif($q=="returned")
{

$r=mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT COUNT(*) total
FROM returned_books"));

$answer=

"📗 Returned Books: "

.$r['total'];

}

elseif($q=="fines")
{

$r=mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT
COALESCE(
SUM(fine_amount),0
)
AS total
FROM fines"));

$answer=

"💰 Total Fines: ₹"

.$r['total'];

}

elseif($q=="latest_member")
{

$r=mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT full_name
FROM members
ORDER BY id DESC
LIMIT 1"));

$answer=

"🆕 Latest Member:<br><br>"

.$r['full_name'];

}

elseif($q=="latest_book")
{

$r=mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT book_name
FROM books
ORDER BY id DESC
LIMIT 1"));

$answer=

"🆕 Latest Book:<br><br>"

.$r['book_name'];

}

elseif($q=="stock")
{

$res=
mysqli_query($conn,

"SELECT
book_name,
quantity

FROM books

WHERE quantity<=2");

$answer=

"⚠ Low Stock Books:<br><br>";

while(
$row=
mysqli_fetch_assoc(
$res))
{

$answer.=

$row['book_name']

." → "

.$row['quantity']

." left<br>";

}

}

elseif($q=="suppliers")
{

$r=mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT COUNT(*) total
FROM suppliers"));

$answer=

"🚚 Suppliers: "

.$r['total'];

}

elseif($q=="latest_issued")
{

$result=

mysqli_query($conn,

"SELECT

books.book_name,

members.full_name,

issued_books.issue_date

FROM issued_books

LEFT JOIN books
ON issued_books.book_id=books.id

LEFT JOIN members
ON issued_books.member_id=members.id

ORDER BY issued_books.id DESC

LIMIT 1");

if(
mysqli_num_rows($result)>0
)
{

$r=
mysqli_fetch_assoc(
$result);

$answer=

"📘 Latest Issued Book<br><br>"

."Book: "

.$r['book_name']

."<br>"

."Member: "

.$r['full_name']

."<br>"

."Date: "

.$r['issue_date'];

}

else
{

$answer=

"📘 No Issued Book Found";

}

}

elseif($q=="latest_returned")
{

$result=

mysqli_query($conn,

"SELECT

books.book_name,

members.full_name,

returned_books.return_date

FROM returned_books

LEFT JOIN books
ON returned_books.book_id=books.id

LEFT JOIN members
ON returned_books.member_id=members.id

ORDER BY returned_books.id DESC

LIMIT 1");

if(
mysqli_num_rows($result)>0
)
{

$r=
mysqli_fetch_assoc(
$result);

$answer=

"📗 Latest Returned Book<br><br>"

."Book: "

.$r['book_name']

."<br>"

."Member: "

.$r['full_name']

."<br>"

."Date: "

.$r['return_date'];

}

else
{

$answer=

"📗 No Returned Book Found";

}

}

elseif($q=="pending_payments")
{

$r=
mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT COUNT(*) total

FROM payment_records

WHERE payment_status='Pending'"));

$answer=

"⏳ Pending Payments: "

.$r['total'];

}

elseif($q=="highest_fine")
{

$r=
mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT MAX(fine_amount)
AS maxfine

FROM fines"));

$answer=

"💸 Highest Fine: ₹"

.$r['maxfine'];

}

elseif($q=="latest_supplier")
{

$r=
mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT supplier_name

FROM suppliers

ORDER BY id DESC

LIMIT 1"));

$answer=

"🚚 Latest Supplier:<br><br>"

.$r['supplier_name'];

}

echo $answer;

?>
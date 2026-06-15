<?php
include("db.php");

header(
'Content-Type: text/csv');

header(
'Content-Disposition: attachment; filename=books_report.csv');

$output=
fopen(
'php://output',
'w');

fputcsv(
$output,

array(
'ID',
'Book',
'ISBN',
'Quantity'));

$result=
mysqli_query($conn,

"SELECT *

FROM books");

while(
$row=
mysqli_fetch_assoc(
$result))
{

fputcsv(
$output,

array(

$row['id'],

$row['book_name'],

$row['isbn'],

$row['quantity']

));

}

fclose($output);
exit();
?>
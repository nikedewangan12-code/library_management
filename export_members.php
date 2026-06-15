<?php
include("db.php");

header(
'Content-Type: text/csv');

header(
'Content-Disposition: attachment; filename=members_report.csv');

$output=
fopen(
'php://output',
'w');

fputcsv(
$output,

array(
'ID',
'Name',
'Department',
'Email',
'Phone'));

$result=
mysqli_query($conn,

"SELECT *
FROM members");

while(
$row=
mysqli_fetch_assoc(
$result))
{

fputcsv(
$output,

array(

$row['id'],
$row['full_name'],
$row['department'],
$row['email'],
$row['phone']

));

}

fclose($output);

exit();
?>
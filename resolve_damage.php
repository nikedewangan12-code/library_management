<?php

include("db.php");

$id=
$_GET['id'];

mysqli_query($conn,

"UPDATE damaged_books

SET status='Resolved'

WHERE id='$id'");

$action=

"Damage Resolved";

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

header(

"Location: damaged_books.php");

exit();

?>
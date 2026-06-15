<?php

include("db.php");

$id=
$_GET['id'];

mysqli_query($conn,

"DELETE FROM fines

WHERE id='$id'");

$action=

"Deleted Fine";

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

"Location: fine_management.php");

exit();

?>
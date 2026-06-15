<?php

include("db.php");

if(isset($_GET['id']))
{

$id=
$_GET['id'];

mysqli_query($conn,

"UPDATE fines

SET status='Paid'

WHERE id='$id'");

}

$action=

"Fine Paid";

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
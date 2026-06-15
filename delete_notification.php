<?php
include("db.php");

$id=$_GET['id'];

mysqli_query($conn,

"DELETE FROM notifications
WHERE id='$id'");

$action=

"Deleted Notification";

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

header("Location: notifications.php");
exit();
?>
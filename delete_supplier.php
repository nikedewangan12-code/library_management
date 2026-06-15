<?php

include("db.php");

$id=
$_GET['id'];

mysqli_query($conn,

"DELETE FROM payment_records

WHERE purchase_id IN

(

SELECT id

FROM purchase_orders

WHERE supplier_id='$id'

)");

mysqli_query($conn,

"DELETE FROM purchase_items

WHERE purchase_id IN

(

SELECT id

FROM purchase_orders

WHERE supplier_id='$id'

)");

mysqli_query($conn,

"DELETE FROM purchase_orders

WHERE supplier_id='$id'");

mysqli_query($conn,

"DELETE FROM suppliers

WHERE id='$id'");

$action=

"Deleted Supplier";

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

"Location: supplier.php");

exit();

?>
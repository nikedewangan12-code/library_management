<?php

include("db.php");

$id=
$_GET['id'];

mysqli_query($conn,

"DELETE FROM purchase_items

WHERE book_id IN

(

SELECT id

FROM books

WHERE publisher_id='$id'

)");

mysqli_query($conn,

"DELETE FROM issued_books

WHERE book_id IN

(

SELECT id

FROM books

WHERE publisher_id='$id'

)");

mysqli_query($conn,

"DELETE FROM returned_books

WHERE book_id IN

(

SELECT id

FROM books

WHERE publisher_id='$id'

)");

mysqli_query($conn,

"DELETE FROM fines

WHERE book_id IN

(

SELECT id

FROM books

WHERE publisher_id='$id'

)");

mysqli_query($conn,

"DELETE FROM books

WHERE publisher_id='$id'");

mysqli_query($conn,

"DELETE FROM publishers

WHERE id='$id'");

$action=

"Deleted Publisher";

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

"Location: publishers.php");

exit();

?>
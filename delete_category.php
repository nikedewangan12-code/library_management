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

WHERE category_id='$id'

)");

mysqli_query($conn,

"DELETE FROM issued_books

WHERE book_id IN

(

SELECT id

FROM books

WHERE category_id='$id'

)");

mysqli_query($conn,

"DELETE FROM returned_books

WHERE book_id IN

(

SELECT id

FROM books

WHERE category_id='$id'

)");

mysqli_query($conn,

"DELETE FROM fines

WHERE book_id IN

(

SELECT id

FROM books

WHERE category_id='$id'

)");

mysqli_query($conn,

"DELETE FROM books

WHERE category_id='$id'");

mysqli_query($conn,

"DELETE FROM categories

WHERE id='$id'");

$action=

"Deleted Category";

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

"Location: categories.php");

exit();

?>
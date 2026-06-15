<?php

include("db.php");

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM damaged_books
WHERE book_id='$id'");

mysqli_query($conn,
"DELETE FROM lost_books
WHERE book_id='$id'");

mysqli_query($conn,
"DELETE FROM reservations
WHERE book_id='$id'");

mysqli_query($conn,
"DELETE FROM book_reviews
WHERE book_id='$id'");

mysqli_query($conn,
"DELETE FROM book_history
WHERE book_id='$id'");

mysqli_query($conn,
"DELETE FROM book_copies
WHERE book_id='$id'");

mysqli_query($conn,
"DELETE FROM issued_books
WHERE book_id='$id'");

mysqli_query($conn,
"DELETE FROM returned_books
WHERE book_id='$id'");

mysqli_query($conn,
"DELETE FROM fines
WHERE book_id='$id'");

mysqli_query($conn,
"DELETE FROM purchase_items
WHERE book_id='$id'");

mysqli_query($conn,
"DELETE FROM books
WHERE id='$id'");

$action = "Deleted Book";

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

header("Location: books.php");

exit();

?>
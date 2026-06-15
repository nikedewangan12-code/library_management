<?php

include("db.php");

$id=
$_GET['id'];

mysqli_query($conn,

"DELETE FROM book_shelves

WHERE id='$id'");

header(
"Location: shelves.php");

exit();

?>
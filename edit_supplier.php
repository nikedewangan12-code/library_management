<?php
include("db.php");

if(isset($_POST['add_supplier']))
{

$supplier_name=
$_POST['supplier_name'];

$contact_person=
$_POST['contact_person'];

$phone=
$_POST['phone'];

$email=
$_POST['email'];

$address=
$_POST['address'];

mysqli_query($conn,

"INSERT INTO suppliers

(

supplier_name,
contact_person,
phone,
email,
address

)

VALUES

(

'$supplier_name',
'$contact_person',
'$phone',
'$email',
'$address'

)");

$action=

"Updated Supplier: "

.$supplier_name;

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

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Supplier</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="top-nav">

<a href="supplier.php">
<button>Suppliers</button>
</a>

<a href="javascript:history.back()">
<button>Back</button>
</a>

</div>

<div class="login-box">

<h2>

Add Supplier

</h2>

<form method="POST">

<input
type="text"
name="supplier_name"
placeholder="Supplier Name"
required>

<input
type="text"
name="contact_person"
placeholder="Contact Person"
required>

<input
type="text"
name="phone"
placeholder="Phone Number"
required>

<input
type="email"
name="email"
placeholder="Email"
required>

<textarea
name="address"
placeholder="Address"
required
style="
width:100%;
padding:12px;
border-radius:10px;
margin-top:10px;
margin-bottom:10px;
"></textarea>

<button
type="submit"
name="add_supplier">

Add Supplier

</button>

</form>

</div>

</body>
</html>
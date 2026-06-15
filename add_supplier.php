<?php

include("db.php");

$id="";

$supplier_name="";
$contact_person="";
$phone="";
$email="";
$address="";

if(isset($_GET['id']))
{

$id=
$_GET['id'];

$data=
mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT *

FROM suppliers

WHERE id='$id'"));

$supplier_name=
$data['supplier_name'];

$contact_person=
$data['contact_person'];

$phone=
$data['phone'];

$email=
$data['email'];

$address=
$data['address'];

}

if(isset($_POST['save']))
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

if($id!="")
{

mysqli_query($conn,

"UPDATE suppliers

SET

supplier_name='$supplier_name',

contact_person='$contact_person',

phone='$phone',

email='$email',

address='$address'

WHERE id='$id'");

}

else
{

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

}

$action=

$id==""

?

"Added Supplier: "

.$supplier_name

:

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

<title>

Add Supplier

</title>

<link
rel="stylesheet"
href="style.css">

</head>

<body>

<div class="login-box">

<h2>

<?php

echo

$id==""

?

"Add Supplier"

:

"Edit Supplier";

?>

</h2>

<form method="POST">

<input
type="text"
name="supplier_name"

value="<?php echo $supplier_name; ?>"

placeholder="Supplier Name"

required>

<input
type="text"
name="contact_person"

value="<?php echo $contact_person; ?>"

placeholder="Contact Person"

required>

<input
type="text"
name="phone"

value="<?php echo $phone; ?>"

placeholder="Phone"

required>

<input
type="email"
name="email"

value="<?php echo $email; ?>"

placeholder="Email"

required>

<textarea
name="address"

placeholder="Address"

required><?php echo $address; ?></textarea>

<button
type="submit"
name="save">

<?php

echo

$id==""

?

"Add Supplier"

:

"Update Supplier";

?>

</button>

</form>

</div>

</body>

</html>

<?php
include("db.php");

if(isset($_POST['add_member']))
{
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $address = $_POST['address'];

    mysqli_query($conn,

    "INSERT INTO members
    (full_name,email,phone,department,address)

    VALUES

    ('$name',
     '$email',
     '$phone',
     '$department',
     '$address')");

$action=

"Added Member: "

.$name;

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
    header("Location: members.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<div class="login-box">

<title>Add Member</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>
    <div class="top-nav">

<a href="dashboard.php">
<button>Dashboard</button>
</a>

<a href="javascript:history.back()">
<button>Back</button>
</a>

</div>

<h2>Add Member</h2>

<form method="POST">

<input
type="text"
name="full_name"
placeholder="Full Name"
required>

<br><br>

<input
type="email"
name="email"
placeholder="Email"
required>

<br><br>

<input
type="text"
name="phone"
placeholder="Phone"
required>

<br><br>

<input
type="text"
name="department"
placeholder="Department (BCA / MCA)"
required>

<br><br>

<textarea
name="address"
placeholder="Address">
</textarea>

<br><br>

<button
type="submit"
name="add_member">

Add Member

</button>

</form>

</div>

</body>
</html>
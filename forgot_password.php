<?php
include("db.php");

$message = "";

if(isset($_POST['reset']))
{
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    $query = "UPDATE admins
              SET password='$new_password'
              WHERE username='$username'";

    if(mysqli_query($conn,$query))
    {
        $message = "Password Updated Successfully";
    }
    else
    {
        $message = "Update Failed";
    }
}
?>
<!DOCTYPE html>
<html>

<head>

<title>Forgot Password</title>

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
<div class="login-box">

<h2>Forgot Password</h2>

<form method="POST">

<input type="text"
name="username"
placeholder="Enter Username"
required>

<br><br>

<input type="password"
name="new_password"
placeholder="New Password"
required>

<br><br>

<button type="submit" name="reset">
Reset Password
</button>

</form>

<p><?php echo $message; ?></p>
</div>

</body>
</html>
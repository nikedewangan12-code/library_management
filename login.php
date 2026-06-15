<?php
session_start();
include("db.php");

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admins
              WHERE username='$username'
              AND password='$password'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0)
    {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    }
    else
    {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Login</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="login-box">

<h2>Admin Login</h2>

<form method="POST">

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button
type="submit"
name="login">

Login

</button>

</form>

<br>

<a href="forgot_password.php">
Forgot Password?
</a>

<br><br>

<?php
if(isset($error))
{
    echo $error;
}
?>

</div>

</body>
</html>
<?php
include("db.php");

$result=mysqli_query($conn,
"SELECT * FROM library_settings LIMIT 1");

$row=mysqli_fetch_assoc($result);

if(isset($_POST['save']))
{
$library_name=$_POST['library_name'];

mysqli_query($conn,

"UPDATE library_settings

SET
library_name='$library_name'

WHERE id='1'");

header("Location: settings.php");
exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Settings</title>

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

<h2>Settings</h2>

<form method="POST">

<input
type="text"
name="library_name"

value="<?php echo $row['library_name']; ?>"

required>

<button
type="submit"
name="save">

Save Settings

</button>

</form>

</div>

</body>
</html>
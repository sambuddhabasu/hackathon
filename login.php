<?php
session_start();
if(isset($_SESSION['handle'])) {
	header("location: user_home.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>LogIn</title>
</head>
<body>
<form id="signup" method="post" action="scripts/check_login.php">
<input type="text" name="handle" id="handle" />
<input type="password" name="password" id="password" />
<input type="submit" value="Submit"/>
</form>
</body>
</html>
<?php
$error = false;
$handle = $_POST['handle'];
$password = $_POST['password'];
if($handle == "" && $password == "") {
	$reason = "noemailpassword";
}
else if($handle == "" && $password != "") {
	$reason = "noemail";
}
else if($handle != "" && $password == "") {
	$reason = "nopassword";
}
if($handle == "" || $password == "") {
	$error = true;
}
else {
	if($error == false) {
		$handle = preg_replace('#[^A-Za-z0-9@.]#i', '', $handle); 
		$password = preg_replace('#[^A-Za-z0-9]#i', '', $password);
		$password = md5($password);
		include "connect_to_mysql.php";
		echo $handle . " " . $password;
		$sql = mysql_query("SELECT * FROM users WHERE handle='$handle' AND password='$password' LIMIT 1");
		$existCount = mysql_num_rows($sql);
		if ($existCount == 0) {
			$reason = "norecord";
			$error = true;
		}
		if ($existCount == 1) {
			$row = mysql_fetch_array($sql);
			session_start();
			$_SESSION['handle'] = $row['handle'];
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['my_rating'] = $row['rating'];
			$count = mysql_query("SELECT * FROM users");
			$count_users = mysql_num_rows($count);
			$_SESSION['num_users'] = $count_users;
			$top = mysql_query("SELECT handle FROM users ORDER BY rating DESC");
			$row = mysql_fetch_array($top);
			$_SESSION['top_handle'] = $row['handle'];
		}
	}
}
if ($error == true) {
	$url = "../index.php?loginFailed=true&reason=" . $reason;
}
else if($error == false) {
	$url = "../user_home.php";
}
header("location: " . $url);
exit();
?>
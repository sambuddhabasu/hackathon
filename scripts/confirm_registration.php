<?php
$md5sum = $_GET['code'];
include "connect_to_mysql.php";
$md5sum = preg_replace('#[^A-Za-z0-9@.]#i', '', $md5sum);
$sql = mysql_query("SELECT * FROM temporary_users WHERE md5sum='$md5sum' LIMIT 1");
$existCount = mysql_num_rows($sql);
if($existCount == 1) {
	$row = mysql_fetch_array($sql);
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$email = $row['email'];
	$country = $row['country'];
	$handle = $row['handle'];
	$password = $row['password'];
	$file = "../country_codes.txt";
	$lines = file($file, FILE_IGNORE_NEW_LINES);
	$lines = preg_replace('#[^a-z0-9.-]#i', '', $lines);
	for($x=0;$x<960;$x=$x+4) {
		if($lines[$x] == strtolower($country)) {
			$latitude = $lines[$x + 1];
			$longitude = $lines[$x + 2];
		}
	}
	mysql_query("INSERT INTO users VALUES ('', '$first_name', '$last_name', '$email', '$country', '$handle', '$password', '0', '$latitude', '$longitude')");
	mysql_query("DELETE FROM temporary_users WHERE md5sum='$md5sum'");
	echo "<script type=\"text/javascript\">
	alert('You are ready to use your account now!');
	window.location.href='../login.php';
	</script>";
}
else {
	echo "<script type=\"text/javascript\">
	alert('An error has occured!');
	window.location.href='../index.php';
	</script>";
}
?>
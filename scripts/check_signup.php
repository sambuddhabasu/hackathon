<?php
$error = false;
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$country = $_POST['country'];
$handle = $_POST['handle'];
$password = $_POST['password'];
$verify_password = $_POST['verify_password'];
if($first_name == "" || $last_name == "" || $email == "" || $country == "" || $handle == "" || $password == "" || $verify_password == "") {
	$error = true;
	$reason = "no_fields";
}
else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
	$error = true;
	$reason = "wrong_email";
}
else if($password != $verify_password) {
	$error = true;
	$reason = "password";
}
if($error == false) {
	$first_name = preg_replace('#[^A-Za-z0-9]#i', '', $first_name);
	$last_name = preg_replace('#[^A-Za-z0-9]#i', '', $last_name);
	$email = preg_replace('#[^A-Za-z0-9@.]#i', '', $email);
	$country = preg_replace('#[^A-Za-z0-9]#i', '', $country);
	$handle = preg_replace('#[^A-Za-z0-9]#i', '', $handle);
	$password = preg_replace('#[^A-Za-z0-9]#i', '', $password);
	$password = md5($password);
	include "connect_to_mysql.php";
	$check_handle_and_email_in_users = mysql_query("SELECT * FROM users WHERE handle='$handle' OR email='$email' LIMIT 1");
	$exist_count = mysql_num_rows($check_handle_and_email_in_users);
	$check_handle_and_email_in_temporary_users = mysql_query("SELECT * FROM temporary_users WHERE handle='$handle' OR email='$email' LIMIT 1");
	$exist_count = $exist_count + mysql_num_rows($check_handle_and_email_in_temporary_users);
	if($exist_count != 0) {
		$error = true;
		$reason = "existing";
	}
	else {
		$md5sum = md5($email);
		mysql_query("INSERT INTO temporary_users VALUES ('$md5sum', '$first_name', '$last_name', '$email', '$country', '$handle', '$password')");
		$to = $email;
		$subject = "CodeRating Registration";
		$message = "Your registration with CodeRating is successful! To start using your account, click on the link given http://" . $_SERVER['SERVER_ADDR'] . "/scripts/confirm_registration.php?code=" . $md5sum;
		$headers = "From: coderating3@gmail.com";
		mail($to, $subject, $message, $headers);
		echo "<script type=\"text/javascript\">
				alert('Account created.');
				window.location.href='../index.php';
				</script>";
	}
}
if($error == true) {
	header("location: ../signup.php?registerFailed=true&reason=" . $reason);
}
?>
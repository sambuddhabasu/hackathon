<?php
session_start();
$handle = $_SESSION['handle'];
$code_id = $_POST['code_id'];
$question_id = $_POST['question_id'];
$code_id = preg_replace('#[^0-9]#i', '', $code_id);
include "connect_to_mysql.php";
$error = false;
$check_uploaded_code = mysql_query("SELECT * FROM codes WHERE code_id='$code_id'");
$exist_count = mysql_num_rows($check_uploaded_code);
if($exist_count != 0) {
	$error = true;
	$reason = "existing";
}
else{
	mysql_query("INSERT INTO codes VALUES ('', '$handle', '$code_id', '$question_id', '0', '0', '0')");
	echo "<script type=\"text/javascript\">
			alert('Code uploaded.');
			window.location.href='../user_home.php';
			</script>";
	}
if($error == true) {
	header("location: ../codes_list.php?pcode=" . $code_id);
}
?>
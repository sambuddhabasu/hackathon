<?php 
session_start();
if(!isset($_SESSION['handle'])) {
	echo "<script type=\"text/javascript\">
	window.location.href='../index.php';
	</script>";
}
?>
<!DOCTYPE HTML>
<html>
<head>
<?php
$pcode = $_GET['pcode'];
$difficulty = $_GET['difficulty'];
$pcode = strtoupper($pcode);
include "scripts/connect_to_mysql.php";
if(isset($_GET['easypos'])) {
	$id = $_GET['easypos'];
	mysql_query("UPDATE codes SET easy = easy +1 WHERE code_id='$id'");
	$get_handle = mysql_query("SELECT * from codes WHERE code_id='$id'");
	$row = mysql_fetch_array($get_handle);
	$get_handle = $row['user_handle'];
	mysql_query("UPDATE users SET rating = rating +1 WHERE handle='$get_handle'");
}
else if(isset($_GET['easyneg'])) {
	$id = $_GET['easyneg'];
	mysql_query("UPDATE codes SET easy = easy -1 WHERE code_id='$id'");
	$get_handle = mysql_query("SELECT * from codes WHERE code_id='$id'");
	$row = mysql_fetch_array($get_handle);
	$get_handle = $row['user_handle'];
	mysql_query("UPDATE users SET rating = rating -1 WHERE handle='$get_handle'");
}
else if(isset($_GET['mediumpos'])) {
	$id = $_GET['mediumpos'];
	mysql_query("UPDATE codes SET medium = medium +1 WHERE code_id='$id'");
	$get_handle = mysql_query("SELECT * from codes WHERE code_id='$id'");
	$row = mysql_fetch_array($get_handle);
	$get_handle = $row['user_handle'];
	mysql_query("UPDATE users SET rating = rating +1 WHERE handle='$get_handle'");
}
else if(isset($_GET['mediumneg'])) {
	$id = $_GET['mediumneg'];
	mysql_query("UPDATE codes SET medium = medium -1 WHERE code_id='$id'");
	$get_handle = mysql_query("SELECT * from codes WHERE code_id='$id'");
	$row = mysql_fetch_array($get_handle);
	$get_handle = $row['user_handle'];
	mysql_query("UPDATE users SET rating = rating -1 WHERE handle='$get_handle'");
}
else if(isset($_GET['hardpos'])) {
	$id = $_GET['hardpos'];
	mysql_query("UPDATE codes SET hard = hard +1 WHERE code_id='$id'");
	$get_handle = mysql_query("SELECT * from codes WHERE code_id='$id'");
	$row = mysql_fetch_array($get_handle);
	$get_handle = $row['user_handle'];
	mysql_query("UPDATE users SET rating = rating +1 WHERE handle='$get_handle'");
}
else if(isset($_GET['hardneg'])) {
	$id = $_GET['hardneg'];
	mysql_query("UPDATE codes SET hard = hard -1 WHERE code_id='$id'");
	$get_handle = mysql_query("SELECT * from codes WHERE code_id='$id'");
	$row = mysql_fetch_array($get_handle);
	$get_handle = $row['user_handle'];
	mysql_query("UPDATE users SET rating = rating -1 WHERE handle='$get_handle'");
}
?>
	<title>Problem Code - <?php echo $pcode; ?></title>
	<script>
	function easypos(id) {
		var link = document.URL + "&easypos=" + id;
		window.location.href = link; 
	}
	function easyneg(id) {
		var link = document.URL + "&easyneg=" + id;
		window.location.href = link;
	}
	function mediumpos(id) {
		var link = document.URL + "&mediumpos=" + id;
		window.location.href = link;
	}
	function mediumneg (id) {
		var link = document.URL + "&mediumneg=" + id;
		window.location.href = link;
	}
	function hardpos (id) {
		var link = document.URL + "&hardpos=" + id;
		window.location.href = link;
	}
	function hardneg(id) {
		var link = document.URL + "&hardneg=" + id;
		window.location.href = link;
	}
	</script>
</head>
<body>
<h1>Problem Code - <?php echo $pcode; ?></h1>
<?php
$url = 'http://www.codechef.com/problems/' . $pcode;
$proxy = 'proxy.iiit.ac.in:8080';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
$content = curl_exec($ch);
curl_close($ch);
$res = preg_match("/<title>(.*)<\/title>/siU", $content, $title_matches);
$start_pos = strpos($content, '<div class="primary-colum-width-left">');
$end_pos = strpos($content, '<table cellspacing="0" cellpadding="0" align="left">');
echo substr($content, $start_pos+302, $end_pos - $start_pos - 300);
$problem_name = substr($title_matches[1], 0, -10); 
?>
<h2>Problem Name - <?php echo $problem_name; ?></h2>
<form method="post" action="scripts/check_upload.php">
<input type="text" name="code_id" id="code_id" />
<input type="text" name="question_id" id="question_id" value="<?php echo $pcode; ?>" readonly/>
<input type="submit" value="Submit Code" />
</form>
<br />
<?php
if($_GET['difficulty'] == 'easy') { 
	$get_codes = mysql_query("SELECT * FROM codes WHERE question_id='$pcode' ORDER BY easy DESC");
}
else if($_GET['difficulty'] == 'medium') {
	$get_codes = mysql_query("SELECT * FROM codes WHERE question_id='$pcode' ORDER BY medium DESC");
}
else if($_GET['difficulty'] == 'hard') {
	$get_codes = mysql_query("SELECT * FROM codes WHERE question_id='$pcode'  ORDER BY hard DESC");
}
echo "<table>";
while ($row = mysql_fetch_array($get_codes)) {
	echo "<tr>";
	echo "<td>" . $row['user_handle'] . "</td>";
	echo "<td><iframe height='200' width='600' src='http://www.codechef.com/viewplaintext/" . $row['code_id'] . "'></iframe></td>";
	echo "</tr><tr><td>" . $row['code_id'] . "</td><td>";
	echo "<a onClick='easypos(". $row['code_id'] .");'><button>Easy +</button></a>";
	echo "<a onClick='easyneg(". $row['code_id'] .");'><button>Easy -</button></a>";
	echo "<a onClick='mediumpos(". $row['code_id'] .");'><button>Medium +</button></a>";
	echo "<a onClick='mediumneg(". $row['code_id'] .");'><button>Medium -</button></a>";
	echo "<a onClick='hardpos(". $row['code_id'] .");'><button>Hard +</button>";
	echo "<a onClick='hardneg(". $row['code_id'] .");'><button>Hard -</button></a>";
	echo "</td></tr>";
}
echo "</table>";
?>
</p>
</body>
</html>
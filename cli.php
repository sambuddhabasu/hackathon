<?php
session_start();
if(!isset($_SESSION['handle'])) {

	echo "<script type=\"text/javascript\">
	alert('You need to log in to view this page.');
	window.location.href='index.php';
	</script>";
}
?>
<?php
	$sql = mysql_query("SELECT * FROM users WHERE handle='$handle' LIMIT 1");
	$row = mysql_fetch_array($sql);
	$my_handle = "hellobye";
?>
<html>
<head>
<script src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
newline="<br><br>$ _";
contactinfo = "<br><br>&copy; CodeRating Inc.<br>Made by a team of developers :)<br>Write to us at - coderating3@gmail.com";

function print_error(command)
{
	$("body").append("<br>[ " + command + " ] is not a valid command<br>");
	$("body").append("Type HELP for a list of valid commands");
	$("body").append(newline);
}

function process(command)
{
	cmd=command.toLowerCase();
	if(cmd=="help")
	{
		$("body").append("<br>MYRATING - View your overall rating");
		//$("body").append("<br>VIEW [ID] - View the code with code id as ID");
		$("body").append("<br>WHOAMI - Print your profile info.");
		//$("body").append("<br>MYUPLOADS - View number of uploads by me");
		$("body").append("<br>CLEAR - Clear the screen");
		$("body").append("<br>TOP - Displays a handle of the top contributor from all around the world");
		//$("body").append("<br>CODESOF [ID] - View all submitted codes with question id as ID");
		$("body").append("<br>CONTACT - Contact Us");
		$("body").append("<br>TOTALUSERS - Display the total number of users who registered on this website");
		$("body").append("<br>EXIT - Exit this terminal and go back to main site");
		$("body").append(newline);
	}
	else if(cmd=="iiit") {
		$("body").append("<br>Light Hai!!");
		$("body").append(newline);
	}
	else if(cmd=="top") {
		$("body").append("<br>The top contributor is: <?php echo $_SESSION['top_handle']; ?>");
		$("body").append(newline);
	}
	else if(cmd=="clear")
	{
		$("body").html("$ _");
	}
	else if(cmd=="exit")
	{
		window.location.href = "user_home.php";
	}
	else if(cmd=="totalusers") {
		$("body").append("<br>Total number of users are: <?php echo $_SESSION['num_users']; ?>");
		$("body").append(newline);
	}
	else if(cmd=="whoami") {
		$("body").append("<br>Your handle is: <?php echo $_SESSION['handle']; ?><br>");
		$("body").append("Your first name is: <?php echo $_SESSION['first_name']; ?><br>");
		$("body").append("Your rating is: <?php echo $_SESSION['my_rating']; ?>");
		$("body").append(newline);
	}
	else if(cmd=="contact")
	{
		$("body").append(contactinfo);
		$("body").append(newline);
	}
	else if(cmd=="myrating")
	{
		var my_rating = "<?php echo $_SESSION['my_rating']; ?>";
		$("body").append("<br>Your rating is: " + my_rating);
		$("body").append(newline);
	}
	else
	{
		print_error(cmd);
	}
}
$(document).ready(function(){
	var command="";
	$("body").html("Welcome " + "<?php echo $_SESSION['first_name']; ?><br>This is your personal CLI<br>" + "$ _");
	$(document).keypress(function(x){
		if(x.which==8)
		{
			if(command.length>0)
			{
				str=$("body").html();
				$("body").html(str.slice(0,-2)+"_");
				command=command.slice(0,-1);
			}
		}
		else if(x.which==13)
		{
			str=$("body").html();
			$("body").html(str.slice(0,-1));
			process(command);
			command="";
		}
		else
		{
			s=String.fromCharCode(x.which);
		//	y=x.which.toString();
			command+=s;
			str=$("body").html();
			$("body").html(str.slice(0,-1)+s+"_");
		//	$("body").append(y+" ");
		}
	});

});
</script>

<style>
	
body{
	background-color: #000000;
	color: #00CC00;
	font-family: courier;
	font-size: 22px;
}

</style>
</head>

<body>
</body>

</html>
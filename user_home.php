<?php
session_start();
if(!isset($_SESSION['handle'])) {
	header("location: index.php");
}
if (isset($_POST['logoutbutton'])) {
	session_destroy();
	echo "<script type=\"text/javascript\">
	alert('Successfully logged out!');
	window.location.href='index.php';
	</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>HomePage</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
   
  <?php 
    include_once('template_header.php');
  ?>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <h1>Hi, <?php echo $_SESSION['first_name']; ?></h1>
 <form id="logoutform" method="post">
	<input type="submit" id="logoutbutton" name="logoutbutton" value="Log Out" />
	<?php
    	include_once('template_footer.php');
    ?>
  </body>
</html>
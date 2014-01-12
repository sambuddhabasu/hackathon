<?php
session_start();
if(!isset($_SESSION['handle'])) {
  echo "<script type=\"text/javascript\">
  window.location.href='index.php';
  </script>";
}
if (isset($_POST['submit_problem'])) {
  $problem_code = $_POST['problem_code'];
  $difficulty = $_POST['difficulty'];
  $url = "codes_list.php?pcode=" . $problem_code . "&difficulty=" . $difficulty;
  header("location: codes_list.php?pcode=" . $problem_code . "&difficulty=" . $difficulty);
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
    <form method="post">
      <table>
        <tr>
          <td>Problem Code</td>
          <td>Difficulty</td>
          <td></td>
        </tr>
        <tr>
          <td><input type="text" name="problem_code" id="problem_code" /></td>
          <td><input type="text" name="difficulty" id="difficulty" /></td>
          <td><input type="submit" name="submit_problem" id="submit_problem" value="Submit"/></td>
        </tr>
      </table>
    </form>
  <?php
      include_once('template_footer.php');
    ?>
  </body>
</html>
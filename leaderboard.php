<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Leaderboard</title>


    <style>
      html, body {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #map-canvas {
      	margin-left: auto;
      	margin-right: auto;
      	height: 500px;
      	width: 800px;
      }
    </style>

 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
function initialize() {
	<?php
		include "scripts/connect_to_mysql.php";
		$map_load_users = mysql_query("SELECT handle, country, rating, latitude, longitude FROM users ORDER BY rating DESC LIMIT 10");
		$rows = array();
		while($r = mysql_fetch_assoc($map_load_users)) {
			$rows[] = $r;
		}
	?>
	var markers = <?php echo json_encode($rows) ?>;
	var myLatlng = new Array();
	var i;
  for(i=0;i<markers.length;i++) {
  	myLatlng[i] = new google.maps.LatLng(markers[i]['latitude'], markers[i]['longitude']);
  }
  var mapOptions = {
    zoom: 2,
    center: myLatlng[0]
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  var marker = new Array();
  for(i=0; i<markers.length; i++) {
  	marker[i] = new google.maps.Marker({
  		position: myLatlng[i],
  		map: map,
  		title: markers[i]['handle']
  	});
  }
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>


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
  <h1>Leaderboard</h1>
<table>
<tr>
<th>Handle</th>
<th>Rating</th>
<th>Country</th>
</tr>
<?php
include "scripts/connect_to_mysql.php";
$get_handles = mysql_query("SELECT * FROM users");
while ($row = mysql_fetch_array($get_handles)) {
	echo "<tr>";
	echo "<td>" . $row['handle'] . "</td>";
	echo "<td>" . $row['rating'] . "</td>";
	echo "<td>" . $row['country'] . "</td>";
	echo "</tr>";
}
?>
</table>
<div id="map-canvas" style="margin-bottom: 50px;"></div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<?php
    	include_once('template_footer.php');
    ?>
  </body>
</html>
   <!-- Fixed navbar -->
<link href="css/navbar.css" rel="stylesheet">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">CodeRating</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="problem_list.php">Problems</a></li>
        <li><a href="leaderboard.php">Leaderboard</a></li>
        <li><a href="cli.php">SweetSurprise!</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact Us <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <!--li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li-->
            <li class="dropdown-header">&copy; CodeRating Inc.</li>
            <li class="dropdown-header">Developed during Hackathon :)</li>
            <li class="dropdown-header">Contact us at - coderating3@gmail.com</li>
            <!--li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li-->
          </ul>
        </li>
      </ul>
      <?php
        session_start();
        if(!isset($_SESSION['handle'])) {
          echo '<form class="navbar-form navbar-right" role="form" id="signup" method="post" action="scripts/check_login.php">
        <div class="form-group">
          <input type="text" placeholder="Handle" class="form-control" size="10" id="handle" name="handle">
        </div>
        <div class="form-group">
          <input type="password" placeholder="Password" class="form-control" size="10" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-success">Sign in</button>
      </form>';
        }
        else {
          echo '<a href="user_home.php"><h4 class="navbar-right" style="padding-top: 7px;">Hi, ' . $_SESSION['handle'] . '</h4></a>';
        }
      ?>
    </div><!--/.nav-collapse -->
  </div>
</div>
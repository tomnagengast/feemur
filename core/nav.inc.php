<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Feemur</title>

    <!-- Latest compiled and minified CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="assets/css/navbar-fixed-top.css" rel="stylesheet"> -->
    <link href="assets/css/firstshot.css" rel="stylesheet">

  
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>

    <script>
      WebFont.load({
        google: {
          families: ["Montserrat:400,700","Varela Round:400","Varela:400"]
        }
      });
    </script>
  </head>
  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-fixed-top">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
        more
        </button>
        <div class="nav-collapse collapse">
          <?php 
          $PHP_SELF = $_SERVER['PHP_SELF'];
                echo '<ul class="nav navbar-nav">';

                    echo ($PHP_SELF == '/feemur/index.php') ?
                    '<li class="active"><a href="index.php">Hot</a></li>' :
                    '<li class="none"><a href="index.php">Hot</a></li>';

                    echo ($PHP_SELF == '/feemur/_new.php') ?
                    '<li class="active"><a href="_new.php">New</a></li>' :
                    '<li class="none"><a href="_new.php">New</a></li>';

                    echo ($PHP_SELF == '/feemur/_rising.php') ?
                    '<li class="active"><a href="_rising.php">Rising</a></li>' :
                    '<li class="none>"><a href="_rising.php">Rising</a></li>';

                    echo ($PHP_SELF == '/feemur/_controversial.php') ?
                    '<li class="active"><a href="_controversial.php">Controversial</a></li>' :
                    '<li class="none"><a href="_controversial.php">Controversial</a></li>';

                    echo ($PHP_SELF == '/feemur/_top.php') ?
                    '<li class="active"><a href="_top.php">Top</a></li>' :
                    '<li class="none>"><a href="_top.php">Top</a></li>';

                echo '</ul>';
                ?>
          <ul class="nav navbar-nav pull-right">
            <?php

            if (isset($_SESSION['username'])){
                ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php echo $_SESSION['username']; ?>
                            <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="none"><a href="index.php">Home</a></li>
                        <li class="none"><a href="dashboard.php">Dashboard</a></li>
                        <li class="none"><a href="profile.php">Profile</a></li>
                        <li class="none"><a href="connect_pocket.php">Connect to Pocket</a></li>
                        <li class="none"><a href="user_list.php">Users</a></li>
                        <li class="none"><a href="logout.php">Logout</a></li>
                    </ul>
                </li>

                <?php
            } else {
                ?>

                <li class="none"><a href="login.php">Sign In</a></li>
                <li><button type="button" class="btn btn-default navbar-btn sup" href="register.php">Sign Up</button></li>

            <?php
            }
            ?>

          </ul>
        </div>
      </div>
    </div>

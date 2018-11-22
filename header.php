<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/webd3201.css"/>
  <!--
  	Name: Soban Farhan, Richard Ocampo, Adam Peltenburg, Syed Hasan Raqib
  	File: <?php echo $file . "\n"; ?>
  	Date: <?php echo $date . "\n"; ?>
  	Description: <?php echo $description . "\n"; ?>
  -->
    <?php
    session_start();
    ob_start();
    ?>

    <?php require("./includes/functions.php"); ?>
    <title><?php echo $title; ?></title>
    <script src="http://code.jquery.com/jquery-3.3.1.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
</head>
<body>
  <nav>
        <div>
              <i class="fa fa-bars"></i>
        </div>

        <ul>
              <li><a href="./index.php">Index</a></li>

              <li>Users <i class="fa fa-sort-desc"></i>
                    <ul>
                          <li><a href="./admin.php">Admin</a></li>
                          <li><a href="./welcome.php">Client</a></li>
                          <li><a href="./dashboard.php">Agent</a></li>
                    </ul>
              </li>
              <li>Listing<i class="fa fa-sort-desc"></i>
                    <ul>
                          <li><a href="./dashboard.php">Dashboard</a></li>
                          <li><a href="./listing-create.php">Create Listing</a></li>
                          <li><a href="./listing-display.php">Display Listing</a></li>
                          <li><a href="./listing-search.php">Search Listing</a></li>
                    </ul>
              </li>
              <li><a href="./login.php">Login</a></li>
              <li><a href="./register.php">Register</a></li>
              <li><a href="./update.php">Update</a></li>
              <li><a href="change-password.php">Security</a></li>
              <li><a href="./logout.php">logout</a></li>
        </ul>
  </nav>


      <div class="header-image">
      </div>

      <div class="header-text">
        <p><span class="custom_one">Hello!</span> Welcome to our <b><?php echo $banner ?></b> page.</p>
      </div>
      <hr/>
      <div class="content">

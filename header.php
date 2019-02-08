<?php @ob_start();
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/webd3201.css">
  <!--
  	Name: Soban Farhan, Richard Ocampo, Adam Peltenburg, Syed Hasan Raqib
  	File: <?php echo $file . "\n"; ?>
  	Date: <?php echo $date . "\n"; ?>
  	Description: <?php echo $description . "\n"; ?>
  -->
    <?php
    require("./includes/functions.php");
    require("./includes/db.php");
    ?>
    <title><?php echo $title; ?></title>
</head>
  <body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-md navbar-light bg-dark sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#index.php"><img src="./picture/logo.jpg" alt="RR"></a>
        <button class="navbar-toggler bg-light" data-toggle="collapse" type="button" data-target="#navbarResponsive">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <?php
              if (!isset($_SESSION['user_type']))
              {
                echo "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./index.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Home </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./listing-search.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Search Listing </button></a>
                      </li>
                      <li class=\"nav-item \">
                        <a class=\"nav-link\" href=\"./login.php\"><button type=\"button\" class=\"btn btn-outline-light btn-sl\"> Login </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./register.php\"><button type=\"button\" class=\"btn btn-primary btn-sl\"> Register </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"#\"><button class=\"btn btn-outline-light btn-sl\"> Our Team </button></a>
                      </li>";
              }
              elseif ($_SESSION['user_type'] == CLIENT)
              {
                echo "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./index.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Home </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./welcome.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Welcome </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./listing-search.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Search Listing </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./update.php\"><button class=\"btn btn-outline-light btn-sl\"> Update </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./logout.php\"><button class=\"btn btn-primary btn-sl\"> Log out </button></a>
                      </li>";
              }
              elseif ($_SESSION['user_type'] == PENDING)
              {
                echo "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./index.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Home </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./welcome.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Welcome </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./listing-search.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Search Listing </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./update.php\"><button class=\"btn btn-outline-light btn-sl\"> Update </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./logout.php\"><button class=\"btn btn-primary btn-sl\"> Log out </button></a>
                      </li>";
              }
              elseif ($_SESSION['user_type'] == AGENT)
              {
                echo "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./index.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Home </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./welcome.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Welcome </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./dashboard.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Dashboard </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./listing-search.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Search Listing </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./listing-create.php\"><button class=\"btn btn-outline-light btn-sl\"> Create Listing </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./update.php\"><button class=\"btn btn-outline-light btn-sl\"> Update </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./logout.php\"><button class=\"btn btn-primary btn-sl\"> Log out </button></a>
                      </li>";
              }
              elseif ($_SESSION['user_type'] == ADMIN)
              {
                echo "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./index.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Home </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./admin.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Administrator </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./welcome.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Welcome </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./listing-search.php\"><button style=\"border: none;\" class=\"btn btn-outline-light btn-sl\"> Search Listing </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./update.php\"><button class=\"btn btn-outline-light btn-sl\"> Update </button></a>
                      </li>
                      <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"./logout.php\"><button class=\"btn btn-primary btn-sl\"> Log out </button></a>
                      </li>";
              }
            ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Image slideshow -->
  <?php
    if ($title === "Index")
    {
    echo  "<div id=\"slides\" class=\"carousel slide\" data-ride=\"carousel\">
            <ul class=\"carousel-indicators\">
              <li data-target=\"#slides\" data-slide-to=\"0\" class=\"active\"></li>
              <li data-target=\"#slides\" data-slide-to=\"1\"></li>
              <li data-target=\"#slides\" data-slide-to=\"2\"></li>
            </ul>
            <div class=\"carousel-inner\">
              <div class=\"carousel-item active\">
                <img src=\"./picture/house1.jpg\" alt=\"House 1\"/>
                <div class=\"carousel-caption\">
                </div>
              </div>
              <div class=\"carousel-item\">
                <img src=\"./picture/house2.jpg\" alt=\"House 2\"/>
                <div class=\"carousel-caption\">
                </div>
              </div>
              <div class=\"carousel-item\">
                <img src=\"./picture/house3.jpg\" alt=\"House 3\"/>
                <div class=\"carousel-caption\">
                </div>
              </div>
            </div>
          </div>";
    }
   ?>
  <div class="container-fluid jumbotron text-center">
        <h1>Hello! Welcome to our <b><?php echo $title; ?></b> page.</h1>
  </div>

  <div class="container-fluid">

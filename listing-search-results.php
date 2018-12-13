<?php
  $title = "Search-Result";
  include("./header.php");

  if (!isset($_SESSION['listing_array'])) {
    header("location:./listing-search.php");
  }

  $error = "";
  $output = "";

  $query = "";
  $sql = "";

 ?>

<?php
  if (isset($_POST['favourite-listing-id'])) {

    if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {

      header("location:./login.php");
      ob_flush();

    } else {

        $conn = db_Connect();

        $query = "favourite_create_query";
        $result = db_prepare($conn, $query, 'INSERT INTO favourites( user_id, listing_id ) VALUES ( $1, $2 )');

        $result =  pg_execute($conn, $query, array( $_SESSION['user_id'], $_POST['favourite-listing-id'] ));

        $output = "Listing was added to your favourites.";
      }
    }

    if (isset($_POST['unfavourite-listing-id'])) {

      if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {

        header("location:./login.php");
        ob_flush();

      } else {

          $conn = db_Connect();

          $query = "unfavourite_query";
          $result = db_prepare($conn, $query, 'DELETE FROM favourites WHERE user_id = $1 AND listing_id = $2 ');

          $result =  pg_execute($conn, $query, array( $_SESSION['user_id'], $_POST['unfavourite-listing-id'] ));

          $output = "Listing was deleted from your favourites.";
        }
      }

      if (isset($_POST['report-listing-id'])) {

        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {

          header("location:./login.php");
          ob_flush();

        } else {

            $conn = db_Connect();

            $query = "report_listing_query";
            $result = db_prepare($conn, $query, 'INSERT INTO offensives( user_id, listing_id, reported_on, status ) VALUES ( $1, $2, $3, $4 )');

            $result =  pg_execute($conn, $query, array( $_SESSION['user_id'], $_POST['report-listing-id'], date("Y-m-d",time()), $_POST['report-listing-status'] ));

            $output = "Listing was reported.";
          }
      }

 ?>

 <div class="row justify-content-center">
     <h5><?php echo $error; ?></h5>
     <h4><?php echo $output; ?></h4>
 </div>

<div class="row">

  <?php

  	$my_array = $_SESSION['listing_array'];

  	for ($index = 0; $index < sizeof($my_array); $index++) {

  			build_listing($my_array[$index]['listing_id'], $title);
  	}

  ?>
</div>

<?php include("./footer.php"); ?>

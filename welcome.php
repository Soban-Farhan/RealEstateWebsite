<?php
  $title = "Home";
  include("./header.php");

  $error = "";
  $output = "";

  if (!isset($_SESSION['user_id'])) {
    header("location:./login.php");
    ob_flush();
  } else {

    if (isset($_POST['unfavourite-listing-id'])) {

      if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {

        header("location:./login.php");
        ob_flush();

      } else {

          $conn = db_Connect();

          $query = "unfavourite_query";
          $result = db_prepare($conn, $query, 'DELETE FROM favourites WHERE user_id = $1 AND listing_id = $2 ');

          $result =  pg_execute($conn, $query, array( $_SESSION['user_id'], $_POST['unfavourite-listing-id'] ));

          $output = "<br/>Listing was deleted from your favourites.<br/>";
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


  $conn = db_Connect();
  $query = "listing_query";
  $sql = 'SELECT listing_id FROM favourites
          WHERE user_id = $1';
  $result = db_prepare($conn, $query, $sql);

  $result =  pg_execute($conn, $query, array($_SESSION['user_id']));

  if (pg_num_rows($result) === 0) {
    $error = "No favourite listing found found. Want to search some? <a href=\"./listing-search.php\"><b>Click here</b></a>.<br/>";
  } else {

    while ($row = pg_fetch_assoc($result)) {
      $array[] = $row;
    }

  }
}
?>

<div class="row justify-content-center">
    <h5><?php echo $error; ?></h5>
    <h4><?php echo $output; ?></h4>
</div>

<div class="row">

 <?php
 if (!empty($array)) {
   	for ($index = 0; $index < sizeof($array); $index++) {

   			build_listing($array[$index]['listing_id'], $title);
   	}
 }
 ?>
</div>
<?php
  include("./footer.php");
?>

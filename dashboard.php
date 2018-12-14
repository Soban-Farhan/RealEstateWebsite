<?php
  $title = "Dashboard";
  include("./header.php");

  $sql = "";
  $result = "";
  $array = "";

  $error = "";
  $output = "";

  if (!isset($_SESSION['user_type']))
	{
		header("Location:./login.php");
		ob_flush();
	}
	elseif ($_SESSION['user_type'] == CLIENT )
	{
		header("Location:./welcome.php");
		ob_flush();
	}


  if (isset($_POST['delete-listing'])) {

    if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {

      header("location:./login.php");
      ob_flush();

    } else {

        $conn = db_Connect();

        $query = "delete_listing_query";
        $result = db_prepare($conn, $query, 'DELETE FROM listings WHERE listing_id = $1');

        $result =  pg_execute($conn, $query, array( $_POST['delete-listing'] ));

        $error = "Your listing was deleted.";
      }
    }

  $conn = db_Connect();
  $query = "listing_query";
  $sql = 'SELECT listing_id FROM listings
          WHERE user_id = $1';
  $result = db_prepare($conn, $query, $sql);

  $result =  pg_execute($conn, $query, array( $_SESSION['user_id'] ));

  if (pg_num_rows($result) === 0) {
    $error = "No listing found. Please try again.<br/>";
  } else {

    while ($row = pg_fetch_assoc($result)) {
      $array[] = $row;
    }
  }
?>

<div class="row justify-content-center">
    <h4><?php echo $error;?></h4>
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

<?php include("./footer.php"); ?>
